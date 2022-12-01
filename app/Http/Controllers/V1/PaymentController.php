<?php

namespace App\Http\Controllers\V1;

use App\Constants\ErrorConstants;
use App\Exceptions\LogicException;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use App\Services\IPG\DTOs\GatewayResponse;
use App\Services\IPG\DTOs\Invoice as InvoiceDto;
use App\Services\PaymentService;
use App\Services\PaystarIpgService;
use Illuminate\Contracts\Foundation\Application;
use \Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use \Illuminate\Contracts\View\View;

class PaymentController extends Controller
{
    /**
     * @param \App\Services\PaystarIpgService $ipgService
     * @param \App\Services\PaymentService    $paymentService
     */
    public function __construct(private PaystarIpgService $ipgService, private PaymentService $paymentService) { }

    /**
     * @throws \App\Services\IPG\Exceptions\InvoiceNotFoundException
     * @throws \App\Exceptions\LogicException
     * @throws \App\Services\IPG\Exceptions\PurchaseFailedException
     */
    public function pay(Invoice $invoice)
    {
        if (! auth()->user()->getCardNumber()) {
            session()->flash('card-number', false);

            return redirect()->route('basket.checkout');
        }
        $invoiceDto = $this->getInvoiceDto($invoice->getFinalPrice());

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

    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     * @throws LogicException
     */
    public function callback(Request $request)
    {
        $gatewayResponse = new GatewayResponse($request->all());
        $user = $request->user();
        $payment = $this->paymentService->findPayment($user->getId(), $gatewayResponse->getRefNum());

        try {
            if (! $payment) {
                throw new LogicException(ErrorConstants::PAYMENT_NOT_FOUND);
            }
            if (! $gatewayResponse->hasSameCard($user->getCardNumber())) {
                throw new LogicException(ErrorConstants::CARD_NUMBER_NOT_MATCH);
            }

            $invoice = $this->getInvoiceDto($payment->getAmount());
            $receipt = $this->ipgService
                ->invoice($invoice)
                ->verify($gatewayResponse);

            $payment = $this->paymentService
                ->makeSuccessPayment($payment, $receipt, $gatewayResponse->getTransactionId());

            return view('payments.successful-payment', compact('payment'));
        } catch (\Exception $exception) {
            $this->paymentService->makeFailPayment($payment, $exception->getMessage());

            return view('payments.fail-payment', compact('payment'));
        }
    }

    /**
     * @param integer $amount
     *
     * @return InvoiceDto
     * @throws LogicException
     */
    private function getInvoiceDto(int $amount): InvoiceDto
    {
        $invoiceDto = new InvoiceDto();
        $invoiceDto->setAmount($amount);

        return $invoiceDto;
    }
}
