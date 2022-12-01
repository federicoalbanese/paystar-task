<?php

namespace App\Interfaces;

interface HandlerInterface
{
    public function handle();

    public function getCode(): int;
}