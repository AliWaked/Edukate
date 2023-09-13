<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AboutController extends Controller
{
    public function index() {
        return Response::json([
            'numberOfCategories' => Category::where('status','active')->count(),
            'numberOfCourses' => Course::where('status','acceptable')->count(),
            'numberOfInstructors' => Instructor::all()->count(),
            'numberOfStudents' => User::all()->count(),
        ],200);
    }
}
