<?php

namespace App\Http\Controllers\api\v1\Post;

use App\Http\Controllers\api\v1\Post\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class UpdateController extends Controller
{
    public function __invoke(UpdatePostRequest $request, Post $post)
    {


        Gate::authorize('update', $post);


        $fields = $request->validated();

        $post->update($fields);

        return ['post' => $post, 'user' => $post->user];
    }
}
