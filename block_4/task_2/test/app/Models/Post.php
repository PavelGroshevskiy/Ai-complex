<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{

    use HasFactory;

    protected $table = 'posts';
    protected $guarded = false;
    //


    public static function all($columns = ['*'])
    {
        return DB::table('posts')->get();
    }

}
