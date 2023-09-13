<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'device_name' => 'string|max:255',
            'abilities' => 'nullable|array',
        ]);
        $user = User::where('email', $request->post('email'))->first();
        if($user && Hash::check($request->post('password'),$user->password)){
            $device_name = $request->post('device_name' ,$request->userAgent());
            $token = $user->createToken($device_name);
            return Response::json([
                'code' => 1,
                'token' => $token->plainTextToken,
                'user' => $user,
            ],201);
        }
    }
    public function destroy(string $token = null)
    {
        $user = Auth::guard('sanctum')->user();
        // $user->tokens()->delete()
        // return $user;
        if (!$token) {
            $user->currentAccessToken()->delete();
            return response()->json(['message' => 'success']);
        }
        $personalAccessToken = PersonalAccessToken::findToken($token);
        if ($user->id == $personalAccessToken->tokenable_id && get_class($user) == $personalAccessToken->tokenable_type) {
            $personalAccessToken->delete();
            // $user->tokens->where('token', $token)->delete();
        }
        return response()->json(['message' => 'success']);
    }
}
