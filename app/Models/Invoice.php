<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Invoice
 *
 * @package App\Models
 * @property int    id
 * @property int    user_id
 * @property string number
 * @property string status
 * @property int    final_price
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 */
class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Invoice
     */
    public function setId(int $id): Invoice
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     *
     * @return Invoice
     */
    public function setUserId(int $user_id): Invoice
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     *
     * @return Invoice
     */
    public function setNumber(string $number): Invoice
    {
        $this->number = $number;

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
     * @return Invoice
     */
    public function setStatus(string $status): Invoice
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getFinalPrice(): int
    {
        return $this->final_price;
    }

    /**
     * @param int $final_price
     *
     * @return Invoice
     */
    public function setFinalPrice(int $final_price): Invoice
    {
        $this->final_price = $final_price;

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
     * @param string $created_at
     *
     * @return Invoice
     */
    public function setCreatedAt(string $created_at): Invoice
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     *
     * @return Invoice
     */
    public function setUpdatedAt(string $updated_at): Invoice
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeletedAt(): string
    {
        return $this->deleted_at;
    }

    /**
     * @param string $deleted_at
     *
     * @return Invoice
     */
    public function setDeletedAt(string $deleted_at): Invoice
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }

}
