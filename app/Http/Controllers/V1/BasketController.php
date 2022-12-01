<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Services\IPG\DTOs\Invoice as InvoiceDto;
use App\Services\PaystarIpgService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function checkout(): Factory|View|Application
    {
        $invoice = $this->createInvoice();
        $invoiceItem = $this->createInvoiceItem($invoice->getId());

        return view('basket.checkout', compact('invoiceItem', 'invoice'));
    }

    /**
     * @return \App\Models\Invoice
     */
    private function createInvoice()
    {
        $invoice = new Invoice();
        $invoice->setNumber(generateRandomString(6));
        $invoice->setUserId(auth('web')->user()->id);
        $invoice->setFinalPrice(5000);
        $invoice->save();

        return $invoice->refresh();
    }

    /**
     * @param int $invoiceId
     *
     * @return InvoiceItem
     */
    private function createInvoiceItem(int $invoiceId): InvoiceItem
    {
        $invoiceItem = new InvoiceItem();
        $invoiceItem->setInvoiceId($invoiceId);
        $invoiceItem->setName('محصول تستی');
        $invoiceItem->setPrice(5000);
        $invoiceItem->setDescription('برای تست');
        $invoiceItem->save();

        return $invoiceItem->refresh();
    }
}
