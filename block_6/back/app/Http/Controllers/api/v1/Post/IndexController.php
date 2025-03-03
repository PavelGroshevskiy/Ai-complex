<?php

namespace App\Http\Controllers\api\v1\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        $collection = Post::query();

        $allowedFilterFields = (new Post())->getFillable();
        $allowedSortFields = ['id', ...$allowedFilterFields];
        $allowedSortDirection = ['asc','desc'];

        $sortBy = request()->query('sortby', 'id');
        $sortDir = request()->query('sortdir', 'asc');

        if (!in_array($sortBy, $allowedSortFields)) {
            $sortBy = $allowedSortFields[0];
        }
        if (!in_array($sortDir, $allowedSortDirection)) {
            $sortDir = $allowedSortDirection[0];
        }
        $collection->orderBy($sortBy, $sortDir);

        foreach ( $allowedFilterFields as $key) {
            if ($paramFilter = request()->query('_' . $key)) {
                $paramFilter = preg_replace("#([%_?+])#", "\\$1", $paramFilter);
                $collection->where($key, 'LIKE', '%'.$paramFilter.'%');
            }
        }

        // $limit = intval(request()->query('limit', '20'));
        // // $limit = min($limit, 20);
        // $collection->limit($limit);

        // $offset = intval(request()->query('offset', '0'));
        // $offset = max($offset, 0);
        // $collection->offset($offset);


        $collection->with(['user', 'mentions.user', 'tags']);
        return $collection->get();
    }
}
