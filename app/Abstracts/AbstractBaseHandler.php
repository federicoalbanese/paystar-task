<?php

namespace App\Abstracts;

abstract class AbstractBaseHandler
{
    abstract protected static function getRawHandlers(): array;

    /**
     * @return array
     */
    protected static function getHandlers(): array
    {
        $handlerObjects = [];
        foreach (static::getRawHandlers() as $item) {
            $handlerObjects += new $item();
        }

        return $handlerObjects;
    }
}