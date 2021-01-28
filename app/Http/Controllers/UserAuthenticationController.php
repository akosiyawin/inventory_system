<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        auth()->guard()->login($user);

        return response(['message' => 'User Created Successfully!', 'data' => $user]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required']
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Login success!', 'data' => auth()->user()], 200);
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => ['The provided credentials does not match with our records']
        ]);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->logout();
        return response()->json(['message' => 'Logout success!']);
    }
}
