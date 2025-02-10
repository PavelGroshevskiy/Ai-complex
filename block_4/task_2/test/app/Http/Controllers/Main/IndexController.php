<?php

namespace App\Http\Controllers\Main;

use App\Exceptions\MyCustomExeption;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {

        throw new MyCustomExeption('customExeption');
        return view('welcome');
    }
}
