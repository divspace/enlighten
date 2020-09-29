<?php

namespace Styde\Enlighten;

use ReflectionClass;
use ReflectionMethod;

class Annotations
{
    public static function fromClass($class)
    {
        $reflectionClass = new ReflectionClass($class);

        return static::fromDocComment($reflectionClass->getDocComment());
    }

    public static function fromMethod($class, $method)
    {
        $reflectionMethod = new ReflectionMethod($class, $method);

        return static::fromDocComment($reflectionMethod->getDocComment());
    }

    public static function fromDocComment($docComment)
    {
        preg_match_all("#@(\w+)( (.*?))?\n#s", $docComment, $matches);
        
        return collect($matches[1])
            ->combine($matches[3])
            ->map(function ($annotation) {
                return trim($annotation, '. ');
            });
    }
}
