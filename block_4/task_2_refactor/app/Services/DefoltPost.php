<?php

namespace App\Services;

use App\Http\Controllers\Controller;

class DefoltPost extends Controller
{

    public function index()
    {
        return response()->view('posts.default');
    }
}
