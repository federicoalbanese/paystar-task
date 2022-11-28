<?php

namespace App\Services;

use App\Constants\PaymentConstants;
use App\Services\IPG\Invoice;
use App\Services\IPG\Payment;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\Pure;

class PaystarIpgService
{
    protected array $config = [];

    protected Payment $payment;

    public function __construct(array $config = [])
    {
        $this->config = empty($config) ? $this->getConfig() : $config;
    }

    public function purchase(Invoice $invoice, callable $initCallback = null)
    {
        $this->payment = $this->getPaymentObject($invoice);

        $this->payment->purchase();
    }

    public function pay()
    {
    }

    public function verify()
    {
    }

    /**
     * @return mixed
     */
    private function getConfig(): mixed
    {
        return require(dirname(__DIR__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config'
            . DIRECTORY_SEPARATOR . 'payment.php');
    }

    /**
     * @param Invoice $invoice
     *
     * @return Payment
     */
    public function getPaymentObject(Invoice $invoice): Payment
    {
        return new Payment($invoice, $this->config);
    }
}
