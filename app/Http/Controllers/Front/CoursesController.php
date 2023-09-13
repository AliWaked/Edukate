<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Rating;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        // dd(
        // Storage::disk('public')->allFiles('courses/php-1689009785/videos'),
        // (new Section)->getVideoDuration(Storage::disk('public')->get("storage/courses/php-1689009785/videos/FYEvSn9jJqqMf1tmKxHehv7xQGmI0mUdp3DhkZEG.mp4")),
        // (new Section)->getVideoDuration('storage/courses/php-1689009785/videos/FYEvSn9jJqqMf1tmKxHehv7xQGmI0mUdp3DhkZEG.mp4')
        // );
        // , (new Section())->getVideoDuration(Storage::disk('public')->allFiles('courses/php-1689009785/videos')[2]));
        // dd($request->query('category'));
        // dd($request->filter,$request->query('category'));
        // dd(Course::get()->where('name','laravel'));
        // dd(Course::filter($request->filter, $request->query('category'))->get());
        // dd(Course::where('status', 'acceptable')->get()->translations()->filter($request->filter, $request->query('category'))->paginate(3));
        return view('front.courses', [
            'courses' => Course::where('status', 'acceptable')->filter($request->filter, $request->query('category'))->paginate(3),
            'coursesNames' => Course::where('status', 'acceptable')->get()->pluck('name'),
            'filter' => $request->filter,
        ]);
    }
    public function show(Course $course)
    {
        // dd(App::getLocale());
        // dd(Comment::where('course_id',$course->id)->get(),$course->id);
        return view('front.pages.courseDetail', [
            'course' => $course,
            'categories' => Category::where('status', 'active')->take(10),
            'courses' => Course::where('category_id', $course->category_id)->where('id', '<>', $course->id)->take(10),
            'comments' => Comment::where('course_id', $course->id)->take(10)->get(),
        ]);
    }
}
