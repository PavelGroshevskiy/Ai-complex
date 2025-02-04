<?php

namespace App\Services;

class DefoltPost
{

    public function __construct(
        protected string $title = 'DefoltTitle',
        protected string $description = 'DefoltDescription'
    ) {

    }
}
