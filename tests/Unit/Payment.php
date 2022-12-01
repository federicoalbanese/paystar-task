<?php

namespace Tests\Unit;

use App\Constants\PaymentConstants;
use App\Services\IPG\Exceptions\InvoiceNotFoundException;
use App\Services\IPG\Exceptions\PaymentException;
use App\Services\PaystarIpgService;
use Illuminate\Support\Facades\Http;
use Tests\PaymentHelper;
use Tests\TestCase;

class Payment extends TestCase
{
    use PaymentHelper;

    private PaystarIpgService $payStarIpg;

    protected function setUp(): void
    {
        parent::setUp();
        $this->payStarIpg = new PaystarIpgService();
    }

    public function test_can_purchase()
    {
        Http::preventStrayRequests();
        Http::fake([
            'https://core.paystar.ir/api/pardakht/create' => Http::response(
                $this->getSuccessData(), 200),
        ]);

        $invoice = $this->getInvoice();

        $this->payStarIpg
            ->invoice($invoice)
            ->purchase(function($refId) {
                $this->assertEquals($this->successRefNum, $refId);
            });
    }

    public function test_shop_inactive()
    {
        Http::preventStrayRequests();
        Http::fake([
            'https://core.paystar.ir/api/pardakht/create' => Http::response(
                $this->getFailData(), 200),
        ]);
        $this->expectException(PaymentException::class);
        $this->expectExceptionCode(PaymentConstants::RESPONSE_STATUS_INACTIVE_GATEWAY);

        $invoice = $this->getInvoice();
        $this->payStarIpg->invoice($invoice)->purchase();
    }

    public function test_invoice_not_set()
    {
        $this->expectException(InvoiceNotFoundException::class);
        $this->payStarIpg->purchase();
    }

    public function test_pay_successful()
    {
        Http::preventStrayRequests();
        Http::fake([
            'https://core.paystar.ir/api/pardakht/create' => Http::response(
                $this->getSuccessData(), 200),
        ]);

        $invoice = $this->getInvoice();
        $redirect = $this->payStarIpg
            ->invoice($invoice)
            ->purchase()
            ->pay();

        $this->assertEquals($this->getRedirectUrl(), $redirect->getTargetUrl());
    }
}
