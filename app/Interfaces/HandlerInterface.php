<?php

namespace App\Interfaces;

use App\Services\IPG\DTOs\HandlerDto;

interface HandlerInterface
{
    /**
     * @param HandlerDto $handlerDto
     *
     * @return bool
     */
    public function handle(HandlerDto $handlerDto): bool;

    /**
     * @return int
     */
    public function getCode(): int;
}