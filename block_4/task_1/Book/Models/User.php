<?php

namespace Models;

class User
{
    function __construct(
        public string $email,
        private string $password,
        public ?string $first_name = null,
        public ?string $last_name = null,
    ) {
    }
}