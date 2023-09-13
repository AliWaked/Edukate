<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Models\Course;
use App\Models\User;
use Faker\Provider\Lorem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index():View
    {
        return view('front.contact',[
            'coursesNames' => Course::where('status', 'acceptable')->get()->pluck('name'),
        ]);
    }
    public function sendEmail(Request $request):RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255|min:3',
            'message' => 'required|string',
        ]);
        // dd($request->all());
        Mail::to(Config::get('mail.from.address'))
            ->send(new SendEmail(['from' => $request->email, 'subject' => $request->subject,'name' => $request->name,'message' => $request->message]));
        return back()->with('success','Send Message Successflly');
    }
}