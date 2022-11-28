<?php

namespace App\Interfaces;

use App\Services\IPG\Invoice;

interface PaymentInterface
{
    public function purchase();

    public function pay();

    public function verify();
}
