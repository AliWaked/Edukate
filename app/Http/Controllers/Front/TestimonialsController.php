<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialsController extends Controller
{
    public function index(): View
    {
        return view('front.pages.testimonial',[
            'testimonials' => Testimonial::where('favourite',true)->take(5)->get(),
            'coursesNames' => Course::where('status', 'acceptable')->get()->pluck('name'),
        ]);
    }
}
