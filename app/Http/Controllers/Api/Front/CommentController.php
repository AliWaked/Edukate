<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Course;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'course' => 'required|integer|exists:courses,id'
        ]);
        return CommentResource::collection(Course::findOrFail($request->query('course'))->commnets);
    }
}
