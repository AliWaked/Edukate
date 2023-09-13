<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class InstructorsController extends Controller
{
    public function index(): View
    {
        return view('front.pages.instructor', [
            'instructors' => Instructor::all()->take(4),
            'coursesNames' => Course::where('status', 'acceptable')->get()->pluck('name'),
        ]);
    }
}
