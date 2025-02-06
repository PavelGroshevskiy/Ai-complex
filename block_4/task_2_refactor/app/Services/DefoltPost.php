<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class DefoltPost extends Controller
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
