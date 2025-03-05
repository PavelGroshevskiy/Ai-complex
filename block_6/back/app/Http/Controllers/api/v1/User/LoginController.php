<?php

namespace App\Http\Controllers\api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\error;

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

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)
        ) {
            return response()->json(
                [
                    "errors"=> [
                        "message"=> [
                            "Incorrect credential"
                        ]
                    ]
                        ], 401
            );
        }
            $token = $user->createToken($user->name);

            return response()->json(
                [
                "user" => $user,
                'message' => 'Login',
                'token' => $token->plainTextToken,
                ]
            );
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
