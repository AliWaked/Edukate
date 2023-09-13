<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // dd(Course::where('status', 'acceptable')->get()->pluck('name'));
        return view('front.about', [
            'numberOfCategories' => Category::where('status', 'active')->get()->count(),
            'numberOfCourses' => Course::where('status', 'acceptable')->get()->count(),
            'numberOfInstructors' => Instructor::all()->count(),
            'numberOfStudent' => User::all()->count(),
            'coursesNames' => Course::where('status', 'acceptable')->get()->pluck('name'),
        ]);
    }
}
