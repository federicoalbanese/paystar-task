<?php

namespace App\Services;

use App\Constants\PaymentConstants;
use App\Models\Payment;
use App\Services\IPG\DTOs\Receipt;

class PaymentService
{
    /**
     * @param int    $userId
     * @param string $referenceId
     *
     * @return Payment|null
     */
    public function findPayment(int $userId, string $referenceId): Payment|null
    {
        return Payment::query()
            ->select('payments.*')
            ->join('invoices as i', 'i.id', '=', 'payments.invoice_id')
            ->where('i.user_id', '=', $userId)
            ->where('reference_id', '=', $referenceId)
            ->first();
    }

    /**
     * @param Payment $payment
     * @param Receipt $receipt
     * @param string  $transactionId
     *
     * @return Payment
     */
    public function makeSuccessPayment(Payment $payment, Receipt $receipt, string $transactionId): Payment
    {
        $payment->setStatus(PaymentConstants::SUCCESS);
        $payment->setMessage($receipt->getMessage());
        $payment->setTransactionId($transactionId);
        $payment->setCardNumber($receipt->getCardNumber());
        $payment->setPaidAt($receipt->getDate());
        $payment->save();

        return $payment->refresh();
    }

    /**
     * @param Payment $payment
     * @param string  $message
     *
     * @return Payment
     */
    public function makeFailPayment(Payment $payment, string $message): Payment
    {
        $payment->setStatus(PaymentConstants::FAIL);
        $payment->setMessage($message);
        $payment->save();

        return $payment->refresh();
    }
}