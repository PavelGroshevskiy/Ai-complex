<?php

namespace Decorators;

abstract class DecoratorFactory
{
    public static function create(string $class, object $model)
    {
        $cls = 'Decorators\\' . ucfirst($class) . 'Decorator';
        return new $cls($model);
    }
    abstract public function title() : string;
    abstract public function body() : string;
    abstract public function items() : string;
}