<?php

namespace App\Services\IPG\Abstracts;

use Illuminate\Support\Str;

class AbstractBaseDTO
{
    /**
     * AbstractBaseDTO constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->batchSetAttributes($attributes);
    }

    /**
     * @param array $attributes
     */
    public function batchSetAttributes(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $setterFunction = sprintf('set%s', Str::camel($key));
            if (method_exists($this, $setterFunction)) {
                $this->{$setterFunction}($value);
            }
        }
    }
}