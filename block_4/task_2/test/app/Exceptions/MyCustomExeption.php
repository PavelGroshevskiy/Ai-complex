<?php

namespace App\Exceptions;

use Exception;

use Illuminate\Http\Request;

class MyCustomExeption extends Exception
{

    public function render()
    {
        return response()->json(
            [
                "message" => $this->getMessage()
                ]
        );

    }

}
