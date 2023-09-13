<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Rating;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'comment' => 'required|string|min:3',
        ]);
        if (Rating::where('user_id', ($id = auth()->guard('web')->user()->id))->where('course_id', $course->id)->first()) {
            Comment::create([
                'user_id' => auth('web')->user()->id,
                'course_id' => $course->id,
                'comment' => $request->comment,
            ]);
        }
        return response()->json(['comment' => $request->comment], 201);
    }
}
