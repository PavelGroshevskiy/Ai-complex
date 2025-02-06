<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        Post::create($data);
        return redirect('posts');

    }
}
