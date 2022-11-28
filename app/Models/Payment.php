<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 *
 * @package App\Models
 * @property int    id
 * @property int    invoice_id
 * @property string transaction_id
 * @property string reference_id
 * @property string status
 * @property int    amount
 * @property string card_number
 * @property string paid_at
 * @property string message
 */
class Payment extends Model
{
    use HasFactory;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getInvoiceId(): int
    {
        return $this->invoice_id;
    }

    /**
     * @param int $invoice_id
     *
     * @return Payment
     */
    public function setInvoiceId(int $invoice_id): Payment
    {
        $this->invoice_id = $invoice_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transaction_id;
    }

    /**
     * @param string $transaction_id
     *
     * @return Payment
     */
    public function setTransactionId(string $transaction_id): Payment
    {
        $this->transaction_id = $transaction_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceId(): string
    {
        return $this->reference_id;
    }

    /**
     * @param string $reference_id
     *
     * @return Payment
     */
    public function setReferenceId(string $reference_id): Payment
    {
        $this->reference_id = $reference_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return Payment
     */
    public function setStatus(string $status): Payment
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     *
     * @return Payment
     */
    public function setAmount(int $amount): Payment
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->card_number;
    }

    /**
     * @param string $card_number
     *
     * @return Payment
     */
    public function setCardNumber(string $card_number): Payment
    {
        $this->card_number = $card_number;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaidAt(): string
    {
        return $this->paid_at;
    }

    /**
     * @param string $paid_at
     *
     * @return Payment
     */
    public function setPaidAt(string $paid_at): Payment
    {
        $this->paid_at = $paid_at;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return Payment
     */
    public function setMessage(string $message): Payment
    {
        $this->message = $message;

        return $this;
    }
}
