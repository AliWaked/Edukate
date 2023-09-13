<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Information;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $course_ids = Course::where('user_id', Auth::user()->id)->pluck('id');
        if (Config::get('fortify.guard') == 'admin') {
            return view('dashboard.admin.student', [
                // 'students' => User::whereHas('courses', function ($query) use ($course_ids) {
                //     $query->whereIn('course_id', $course_ids);
                // })->paginate(),
                'students' => User::paginate(),
                'filter' => $request->filter,
            ]);
        }
        return view('dashboard.instructor.student', [
            // 'students' => User::whereHas('courses', function ($query) use ($course_ids) {
            //     $query->whereIn('course_id', $course_ids);
            // })->paginate(),
            'courses' => Course::with('students')->where('id',Auth::user()->id)->paginate(),
            'filter' => $request->filter,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $student)
    {
        return view('dashboard.admin.show-student-details', ['student' => $student, 'information' => $student->information ?? new Information]);
    }

    /** 
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
