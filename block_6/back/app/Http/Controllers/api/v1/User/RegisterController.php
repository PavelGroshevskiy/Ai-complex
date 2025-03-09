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
            'name' =>       ['required', 'string', 'max:50','min:3'],
            'email' =>       ['required', 'string', 'unique:users', 'max:50', 'email'],
            'nickname' =>   ['required', 'string','max:50','min:2'],
            'password' =>   ['required', 'string', 'confirmed','min:6']
            ]
        );

        $user = User::query()->create($fields);

        $token = $user->createToken($request->name);

        return response()->json(
            [
            'success'=> 'true',
            'user'=> $user,
            'token' => $token->plainTextToken,
            ]
        );
    }
}
