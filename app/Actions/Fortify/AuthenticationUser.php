<?php

namespace App\Actions\Fortify;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthenticationUser
{
    use PasswordValidationRules;

    public function  authtication($request)
    {
        $username = $request->post(config('fortify.username'));
        $password = $request->post('passowrd');
        // $user = Instructor::where('username', '=', $username)->orWhere('email', $username)->orWhere('phone_number', $username)->first();
        $user = Instructor::where('name', '=', $username)->first();
        if ($user && Hash::check($password, $user->password)) {
            //Auth::guard('admin')->login($user); // in fortify automitic call this
            return $user;
        }
        return false;
    }
}
