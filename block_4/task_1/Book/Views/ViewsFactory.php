<?php

namespace Views;
use Decorators\DecoratorFactory;

abstract class ViewsFactory
{
    abstract public function render();

    public static function create(
        string $type, 
        string $class, 
        DecoratorFactory $decorator
    ): ViewsFactory {
        $class = 'Views\\' .
        ucfirst($class) .
        ucfirst($type) .
        'View';
        $obj = new $class($decorator);
        return $obj;
    }
}