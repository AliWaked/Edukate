<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    public function index()
    {
        // dd(Course::all()->first()->pivot, Auth::user()->courses()->first()->pivot->rating);

        // dd(Course::get()->first()->students()->where('user_id', '1')->first()->pivot->update(['rating'=>'2']),Auth::guard('web')->user()->id);
        return view('dashboard.student.courses', [
            'courses' => User::with('courses')->where('id', auth()->user()->id)->first()->courses()->paginate(),
            // 'courses' => auth()->user()->courses(),
        ]);
    }
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'rating' => 'required|int|max:5|min:1',
        ]);
        return $course->students()->where('user_id', Auth::guard('web')->user()->id)->first()->pivot->update(['rating' => $request->rating]);
        // $course->students()->where('user_id', Auth::guard('web')->user()->id)->first()->pivot->update(['rating' => $request->post('rating')]);
        return json_encode($course->name);
    }
}
