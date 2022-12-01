<?php

use App\Constants\PaymentConstants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function(Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->string('transaction_id')->nullable();
            $table->string('reference_id')->nullable();
            $table->enum('status', PaymentConstants::STATUSES)->default(PaymentConstants::INIT);
            $table->unsignedBigInteger('amount');
            $table->string('card_number')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
