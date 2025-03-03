<?php

namespace App\Http\Controllers\api\v1\Post;

use App\Http\Controllers\api\v1\Post\Requests\StorePostRequest;
use App\Http\Controllers\Controller;

use App\Models\Post;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(StorePostRequest $request)
    {
        try {
            $data = $request->validated();
            if ($data) {
                Post::create($data);
                return response()->json(
                    [
                    'success' => 'true',
                    'message'=>'Post creat succesfully'
                    ]
                );
            } else {
                return response()->json('Something went wrong');
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'success' => 'false',
                    'message'=> $th->getMessage()
                ]
            );
        }

    }
}
