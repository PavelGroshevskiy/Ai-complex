<?php

namespace App\Http\Controllers\api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index(Request $request)
    {
        // dd($request);

        dd($request->all());

    }
    function login(Request $request)
    {
        $request->validate(
            [
            'email' => ['required', 'string', 'exists:users'],
            'password' => ['required', 'string']
            ]
        );
        // dd($validation);
        if (Auth::attempt(
            ['email' => $request->email,
            'password' => $request->password]
        )
        ) {
            $user = User::where('email', $request->email)->first();

            $token = $user->createToken($user->name);

            return response()->json(
                [
                "user" => $user,
                'message' => 'Login',
                'token' => $token->plainTextToken,
                ]
            );
        } else {
            return response()->json(
                [
                'message' => 'something went wrong',
                ]
            );
        }
    }

    function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(
            [
                'message' => 'You are Logout',
            ]
        );
    }
}
