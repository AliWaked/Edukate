<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Section;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SectionsController extends Controller
{
    public function create(Course $course): View
    {
        return view('dashboard.instructor.add-section', [
            'categories' => Category::where('status', 'active')->get(),
            'course' => $course,
        ]);
    }
    public function store(Request $request, Section $section, Course $course): RedirectResponse
    {
        $request->validate($section->rules());
        DB::beginTransaction();
        try {
            $section->createSections($request, $course);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return to_route('dashboard.course.edit', $course->slug);
    }

    public function edit(Course $course)
    {
        return view('dashboard.instructor.edit-sections', ['sections' => $course->section, 'slug' => $course->slug]);
    }
    public function update(Request $request, Section $section, Course $course)
    {
        $data = $request->validate($section->rules());
        $slug = $course->slug;
        $sections = $course->section;
        $lessons = $request->post('lesson_title');
        $section_lectures =  $request->lectures;
        $number = 0;
        $remove = [];
        $attachments = $request->attachments;
        DB::beginTransaction();
        try {
            foreach ($sections as $section) {
                $videos = $section_lectures[$number]['file'] ?? [];
                $lectures = $section_lectures[$number]['title'];
                $section_lectures_video = array_values($section->lectures);
                $section_lectures_attach_values = array_values($section->attachments ?? []);
                $section_lectures_attach_keys = array_keys($section->attachments ?? []);
                $result = [];
                for ($i = 0; $i < count($lectures); $i++) {
                    if ($videos[$i] ?? '') {
                        $result[$lectures[$i]] = Storage::disk('public')->append("courses/$slug/videos", $videos[$i]);
                        $remove[] = $section_lectures_video[$i];
                        continue;
                    }
                    $result[$lectures[$i]] = $section_lectures_video[$i];
                }
                if ($attachments) {
                    $files = $attachments[$number];
                    for ($i = 0; $i < count($files); $i++) {
                        if ($file = $files[$i]) {
                            $attach[$file->getClientOriginalName() . '*' . time()] = Storage::disk('public')->append("courses/$slug/attachments", $file);
                            $remove[] = $section_lectures_attach_values[$i];
                        } else {
                            $attach[$section_lectures_attach_keys[$i]] = $section_lectures_attach_values[$i];
                        }
                    }
                } else {
                    $attach = $section->attachments;
                }
                $section->update([
                    'lesson_title' => $lessons[$number],
                    'lectures' => $result,
                    'attachments' => $attach,
                ]);
                foreach ($remove as $item) {
                    Storage::disk('public')->delete($item);
                }
                ++$number;
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        if (Config::get('fortify.guard') == 'admin') {
            return to_route('dashboard.course.edit', $course->slug);
        }
        return to_route('dashboard.instructor.course.edit', $course->slug);
    }
}
