<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        if (Config::get('fortify.guard') == 'admin') {
            return view('dashboard.admin.testimonials', ['testimonials' => Testimonial::paginate()]);
        }
        return view('dashboard.student.testimonials', ['testimonials' => Testimonial::where('user_id', Auth::user()->id)->get()]);
    }
    public function create()
    {
        return view('dashboard.student.add-testimonial');
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:65000',
        ]);
        Testimonial::create([
            ...$request->all(),
            'user_id' => Auth::user()->id,
        ]);
        return to_route('student.testimonials.index')->with('success', 'Created Successflly');
    }
    public function show(Testimonial $testimonial): View
    {
        if (Config::get('fortify.guard') == 'admin') {
            return view('dashboard.admin.show-testimonial', ['testimonial' => $testimonial]);
        }
        return view('dashboard.student.show-testimonial', ['testimonial' => $testimonial]);
    }
    public function update(Testimonial $testimonial): void
    {
        $testimonial->update(['favourite' => !$testimonial->favourite]);
    }
    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();
        return to_route('dashboard.testimonials.index')->with('delete', 'Deleted Successflly');
    }
}
