<?php

namespace App\Services;


use Illuminate\Support\Facades\Cache;

class DefoltPost
{

    public function index()
    {
        Cache::add('title', 'Titlecahed');
        Cache::add('description', 'Descriptioncahed');
        $title = Cache::get('title');
        $description = Cache::get('description');
        return response()->view('posts.default', compact('title', 'description'));
    }
}
