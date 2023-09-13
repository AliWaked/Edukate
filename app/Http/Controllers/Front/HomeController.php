<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Information;
use App\Models\Instructor;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // dd(Course::with('students')->where('status', 'acceptable')->first()->students()->where('rating','<>',0)->count());
        return view('front.index', [
            'numberOfCategories' => Category::where('status', 'active')->get()->count(),
            // 'numberOfCourses' => Course::where('status', 'acceptable')->get()->count(),
            'numberOfInstructors' => Instructor::all()->count(),
            'numberOfStudent' => User::all()->count(),
            'instructors' => Instructor::has('profile')->get(),
            'testimonials' => Testimonial::where('favourite', true)->get(),
            // 'coursesNames' => Course::where('status', 'acceptable')->pluck('name'),
            'courses' => Course::where('status', 'acceptable')->get(),
        ]);
    }
}
