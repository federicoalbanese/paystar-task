<?php

namespace App\Services;

use App\Services\IPG\Exceptions\PurchaseFailedException;
use App\Services\IPG\Invoice;
use App\Services\IPG\Payment;
use Shetabit\Multipay\Exceptions\InvoiceNotFoundException;

class PaystarIpgService
{
    protected array $config = [];

    protected Payment $payment;

    protected Invoice $invoice;

    public function __construct(array $config = [])
    {
        $this->config = empty($config) ? $this->getConfig() : $config;
    }

    /**
     * @param Invoice       $invoice
     * @param callable|null $initCallback
     *
     * @return PaystarIpgService
     * @throws PurchaseFailedException
     */
    public function purchase(Invoice $invoice, callable $initCallback = null): PaystarIpgService
    {
        $this->payment = $this->getPaymentObject($invoice);

        $this->invoice = $this->payment->purchase();
        if ($initCallback) {
            call_user_func($initCallback, $this->invoice->getTransactionId());
        }

        return $this;
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
