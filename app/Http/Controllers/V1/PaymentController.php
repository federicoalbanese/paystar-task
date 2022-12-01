<?php

namespace App\Http\Controllers\V1;

use App\Constants\ErrorConstants;
use App\Exceptions\LogicException;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use App\Services\IPG\DTOs\GatewayResponse;
use App\Services\IPG\DTOs\Invoice as InvoiceDto;
use App\Services\PaystarIpgService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private PaystarIpgService $ipgService) { }

    /**
     * @throws \App\Services\IPG\Exceptions\InvoiceNotFoundException
     * @throws \App\Exceptions\LogicException
     * @throws \App\Services\IPG\Exceptions\PurchaseFailedException
     */
    public function pay(Invoice $invoice)
    {
        $invoiceDto = new InvoiceDto();
        $invoiceDto->setAmount($invoice->getFinalPrice());

        return $this->ipgService
            ->invoice($invoiceDto)
            ->purchase(function($referenceId) use ($invoice) {
                $payment = new Payment();
                $payment->setAmount($invoice->getFinalPrice());
                $payment->setInvoiceId($invoice->getId());
                $payment->setReferenceId($referenceId);
                $payment->save();
            })
            ->pay();
    }

    public function callback(Request $request)
    {
        dd($request->user());
        $gatewayResponse = new GatewayResponse($request->all());

        try {
            if (! $gatewayResponse->hasSameCard('6037998130284622')) {
                throw new LogicException(ErrorConstants::CARD_NUMBER_NOT_MATCH);
            }

        } catch (\Exception $exception) {
        }
        dd();
    }
}
