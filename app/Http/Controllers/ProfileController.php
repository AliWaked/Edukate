<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $instructor = Auth::guard('instructor')->user();
        $profile = Profile::where('instructor_id', $instructor->id)->first() ?? new Profile;
        return view('dashboard.instructor.profile', ['profile' => $profile, 'name' => $instructor->name, 'email' => $instructor->email]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $gender = ['female','male'];
        $request->validate([
            'job_title' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:png,jpg',
            'gender' => "nullable|string|in:female,male",
            'birthday' => 'nullable|date|before:yesterday',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'socail_media' => 'nullable|array',
            'socail_media.*' => 'nullable|string|url|active_url',
        ]);

        $instructor = Auth::guard('instructor')->user();
// dd($request->socail_media);
        if ($profile = $instructor->profile) {
            $this->updateProfile($request, $profile);
        } else {
            $this->createProfile($request, $instructor->id);
        }
        return to_route('dashboard.instructor.dashboard.index');
    }

    /**
     * Display the specified resource.
     */


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
    public function createProfile(Request $request, int $instructor_id): void
    {
        Profile::create([
            ...$request->except('avatar'),
            'avatar' => $this->uploadImage($request->file('avatar')),
            'instructor_id' => $instructor_id,
        ]);
    }
    public function updateProfile(Request $request, Profile $profile): void
    {
        $avatar = $profile->avatar;
        $profile->update([
            ...$request->except('avatar'),
            'avatar' => $this->uploadImage($request->file('avatar')) ?? $avatar,
        ]);
        !($avatar && $request->hasFile('avatar')) ?: Storage::disk('public')->delete($avatar);
    }
    public function uploadImage(?object $image): string|null
    {
        return $image ? Storage::disk('public')->append('/instructor', $image) : null;
    }
}
