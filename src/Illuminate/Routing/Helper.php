<?php

namespace Dingo\Api\Illuminate\Routing;

use ReflectionClass;

trait Helper
{
    public function __construct()
    {
        //
    }

    public static function clone($parent)
    {
        $instance = new self;

        $reflection = new ReflectionClass($parent);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            if ($property->isStatic()) {
                continue;
            }
            $property->setAccessible(true);
            $instance->{$property->getName()} = $property->getValue($parent);
        }

        return $instance;
    }
}
