<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User|Instructor|Admin
    {

        if (Config::get('fortify.guard') == 'instructor') {
            $this->validation($input, Instructor::class);
            return Instructor::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
        } elseif (Config::get('fortify.guard') == 'admin') {
            $this->validation($input, Admin::class);
            return Admin::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
        }
        $this->validation($input, User::class);
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
    public function validation(array $input, string $className): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique($className),
            ],
            'password' => $this->passwordRules(),
        ])->validate();
    }
}
