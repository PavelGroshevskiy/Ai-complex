<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index')
        ->with('posts', Post::all());
    }

    public function create()
    {
        return view('create');
    }
}
