<?php

namespace Models;

class Users
{
    public $collection;
    function __construct(public ?array $users = null)
    {
        $users ??= [
            new User(
                'dmitry.koterov@gmail.com',
                'password',
                'Дмитрий',
                'Котеров'
            ) ,
            new User(
                'igorsimdyanov@gmail.com',
                'password',
                'Игорь',
                'Симдянов'
            )
            ];
            $this->collection = $users;
    }
}