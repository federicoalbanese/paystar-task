<?php

namespace App\Services;

use App\Constants\ErrorConstants;
use App\Services\IPG\DTOs\GatewayResponse;
use App\Services\IPG\DTOs\Receipt;
use App\Services\IPG\Exceptions\InvoiceNotFoundException;
use App\Services\IPG\Exceptions\PurchaseFailedException;
use App\Services\IPG\DTOs\Invoice;
use App\Services\IPG\Payment;
use Illuminate\Http\RedirectResponse;

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
        $this->validateInvoice();

        return $this->payment->pay();
    }

    /**
     * @param GatewayResponse $gatewayResponse
     *
     * @return Receipt
     * @throws InvoiceNotFoundException
     * @throws PurchaseFailedException
     */
    public function verify(GatewayResponse $gatewayResponse): Receipt
    {
        $this->validateInvoice();

        return $this->payment->verify($gatewayResponse);
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

    /**
     * @throws InvoiceNotFoundException
     */
    protected function validateInvoice()
    {
        if (empty($this->invoice)) {
            throw new InvoiceNotFoundException('Invoice not selected or does not exist.');
        }
    }
}
