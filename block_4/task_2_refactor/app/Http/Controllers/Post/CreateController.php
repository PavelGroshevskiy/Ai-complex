<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        return view('posts.create');

    }
}
