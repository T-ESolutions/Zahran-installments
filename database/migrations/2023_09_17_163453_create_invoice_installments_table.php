<?php

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
        Schema::create('invoice_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Invoice::class);
            $table->date('pay_date');
            $table->double('monthly_installment',8, 2);
            $table->date('collect_date')->nullable();
            $table->tinyInteger('status')->default(\App\Enums\InvoiceInstallmentsStatusEnum::UNPAID->value);
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
        Schema::dropIfExists('invoice_installments');
    }
};
