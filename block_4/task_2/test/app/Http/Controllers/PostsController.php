<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('posts.index')
        ->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        Post::create($request->only(['title', 'description']));
        return redirect('posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) : View
    {
        // return view(
        //     'posts.show', [
        //     'post' => Post::findOrFail($ id)
        //     ]
        // );

        return view('posts.show')->with('post', $post);
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Post::destroy($id);
    }
}

