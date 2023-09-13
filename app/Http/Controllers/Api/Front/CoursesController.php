<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Http\Resources\GetSingleCourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CoursesController extends Controller
{
    public function index()
    {
        // return Response::json(Course::where('status', 'acceptable')->paginate());
        // return CourseResource::collection(Course::where('status', 'acceptable')->get());
        // return CourseResource::collection(Course::where('status', 'acceptable')->get());
        return new CourseCollection(Course::where('status', 'acceptable')->get());
    }
    public function show(Course $course)
    {
        return new GetSingleCourseResource($course);
    }
}
