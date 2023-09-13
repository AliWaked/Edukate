<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Course;
use App\Models\Section;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class CoursesControllr extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        if (Config::get('fortify.guard') == 'admin') {
            return view('dashboard.admin.courses', [
                'courses' => Course::paginate(),
            ]);
        }
        return view('dashboard.instructor.courses', [
            'courses' => auth()->user()->courses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.instructor.add_course', [
            'categories' => Category::where('status', 'active')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Section $section)
    {
        // dd($request->only(['en','ar','course_image','status','price','skill_level','category_id']));
        $time = time();
        $slug = Str::slug("{$request->name} $time");
        // $data = $request->only(['en', 'ar', 'status', 'price', 'skill_level', 'category_id']);
        // $data['course_image'] = $this->uplodeFiles($request->course_image, $slug);
        // $data['slug'] = $slug;
// dd($request->all());
        // Course::create($data);
        // Course::create($request->only(['en', 'ar']));
        DB::beginTransaction();
        try {
            $course = Course::create([
                ...$request->except('course_image'),
                'slug' => $slug. '2',
                'course_image' => $this->uplodeFiles($request->course_image, $slug)
            ]);
            $course->duration = $section->createSections($request, $course);
            $course->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        if (Config::get('fortify.guard') == 'admin') {
            return to_route('dashboard.course.index')->with('success', 'Created New Course Successflly');
        }
        return to_route('dashboard.instructor.course.index')->with('success', 'Created New Course Successflly');
    }
    public function uplodeFiles(array|object $files, string $slug, bool $video = false): array|string
    {
        if (is_array($files)) {
            foreach ($files as $file) {
                $paths[$file->getClientOriginalName() . '*' . time()] = Storage::disk('public')->append("courses/$slug/attachments", $file);
            }
            return $paths;
        }
        if ($video) {
            return Storage::disk('public')->append("courses/$slug/videos", $files);
        }
        return Storage::disk('public')->append("courses/$slug", $files);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course): View
    {
        $lecucterCount = 0;
        foreach ($course->section as $section) {
            $lecucterCount += count($section->lectures);
        }
        $numberOfStars = $course->students()->pluck('rating')->sum();
        $numberOfStudents = $course->students()->count();
        $numberOfStudents == 0 ? $numberOfStudents = 1 : '';
        return view('dashboard.instructor.show-course', ['course' => $course, 'lecucterCount' => $lecucterCount, 'numberOfStudents' => $numberOfStudents, 'numberOfStars' => $numberOfStars]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course): View
    {
        // dd($course->name);
        return view('dashboard.instructor.edit-course', ['course' => $course, 'categories' => Category::where('status', 'active')->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course): RedirectResponse
    {
        if (auth('admin')->user() && $request->status) {
            $request->validate([
                'status' => 'required|string|in:"acceptable","not acceptable"'
            ]);
            $course->update(['status' => $request->status]);
        }
        // dd((new Course)->getVideoDuration($request->file('course_image')),date('h i','5'));

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'language' => 'required|string',
            'skill_level' => ['required', 'string', Rule::in(['beginners', 'intermediate', 'advanced', 'all level'])],
            'category_id' => 'required|exists:categories,id',
            'course_image' => 'nullable|file|image|mimes:png,jpg,svg',
            'descriptions' => 'required|string|max:65000',
        ]);
        $this->updateCourseInformation($request, $course);

        return to_route('dashboard.course.index')->with('info', 'Updated Course Information Successflly');
    }
    public function updateCourseInformation(Request $request, Course $course): void
    {
        $slug = $course->slug;
        $path = $course->course_image;
        if ($request->course_image) {
            $course_image = Storage::disk('public')->append("courses/$slug", $request->file('course_image'));
        } else {
            $course_image = $path;
        }
        $course->update([...$request->except('course_image'), 'course_image' => $course_image]);
        if ($path && $request->course_image) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course): RedirectResponse
    {
        $dirName = $course->slug;
        $course->delete();
        Storage::disk('public')->deleteDirectory("/courses/$dirName");
        if (Auth::user() instanceof Admin) {
            return to_route('dashboard.course.index')->with('delete', 'Deleted Course Successflly');
        }
        return to_route('dashboard.instructor.course.index')->with('delete', 'Deleted Course Successflly');
    }
    public function downloadAttachment(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);
        return Storage::disk('public')->download($request->path, $request->file_name);
    }
}
