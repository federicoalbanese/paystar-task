<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class InvoiceItem
 *
 * @package App\Models
 * @property int    id
 * @property int    invoice_id
 * @property string name
 * @property string description
 * @property int    price
 * @property string created_at
 * @property string updated_at
 */
class InvoiceItem extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

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
     * @return InvoiceItem
     */
    public function setInvoiceId(int $invoice_id): InvoiceItem
    {
        $this->invoice_id = $invoice_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return InvoiceItem
     */
    public function setName(string $name): InvoiceItem
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return InvoiceItem
     */
    public function setDescription(string $description): InvoiceItem
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     *
     * @return InvoiceItem
     */
    public function setPrice(int $price): InvoiceItem
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }
}
