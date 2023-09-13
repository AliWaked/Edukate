<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InformationsController extends Controller
{

    public function index(): View
    {
        $user = Auth::guard('web')->user();
        return view('dashboard.student.profile-show', [
            'information' => $user->information ?? new Information,
            'email' => $user->email,
            'name' => $user->name,
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'field_title' => 'nullable|max:255',
            'birthday' => 'nullable|date|before:today',
            'gender' => 'nullable|string|in:male,female',
            'avatar' => 'nullable|file|mimes:png,jpg',
        ]);
        // dd($request->post('field_title'));
        $user = Auth::guard('web')->user();
// dd($user->information->gender);
        if (!$user->information) {
            $this->addInformation($request, $user);
        } else {
            $this->updateInformation($request, $user);
        }

        return to_route('student.dashboard.index');
    }
    public function updateInformation(Request $request, User $user): void
    {
        $avatar = !(($value = $user->information->avatar) && $request->avatar) ?: $value;
        $path = $this->uploadeLogoImage($request->file('avatar'));
        $user->information->update([...$request->except('avatar'), 'avatar' => $path]);
        Storage::disk('public')->delete($avatar);
    }
    public function addInformation(Request $request, User $user): void
    {
        $path = $this->uploadeLogoImage($request->file('avatar'));
        // dd($path, $request->file('avatar')->getClientOriginalName());
        Information::create([
            'user_id' => $user->id,
            'avatar' => $path,
            ...$request->except('avatar'),
        ]);
    }
    public function uploadeLogoImage(?object $path = null): ?string
    {
        if ($path) {
            return (Storage::disk('public')->append('/students/logoImage', $path));
        }
        return null;
    }
}
