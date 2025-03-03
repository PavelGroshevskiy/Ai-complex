<?php

namespace App\Http\Controllers\api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    function register(Request $request)
    {
        $fields = $request->validate(
            [
            'name' =>       ['required', 'string'],
            'email' =>       ['required', 'string'],
            'nickname' =>   ['required', 'string'],
            'password' =>   ['required', 'string', 'confirmed']
            ]
        );

        $user = User::create($fields);

        $token = $user->createToken($request->name);

        return response()->json(
            [
            'success'=> 'true',
            'message'=> $user,
            'token' => $token->plainTextToken,
            ]
        );
    }
}
