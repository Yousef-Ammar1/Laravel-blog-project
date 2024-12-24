<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController
{
    public function signUp(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $token = $user->createToken('authToken')->plainTextToken;

        $R = [
            'user' => $user,
            'token' => $token,
        ];
        
        return response($R, 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['incorrect username or password.'],
            ]);
        }
        $token = $user->createToken('authToken')->plainTextToken;

        $R = [
            'user' => $user,
            'token' => $token,
        ];

        return response($R, 201);


}

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response('logged out Successfully', 201);
    }
}
