<?php

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Invoice;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->nullable();
            $table->string('transaction_number') ;
            $table->date('invoice_date')->nullable();
            $table->integer('pay_day');
            $table->text('note')->nullable();
            $table->foreignIdFor(Admin::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Invoice::class)->nullable()->constrained()->cascadeOnDelete();
            $table->tinyInteger('invoice_type');
            $table->text('product')->nullable();
            $table->double('total_price', 8, 2);
            $table->double('deposit', 8, 2);
            $table->double('remaining_price', 8, 2);
            $table->double('monthly_profit_percent',8, 2);
            $table->double('monthly_installment',8, 2);
            $table->double('profit',8, 2);
            $table->tinyInteger('status')->default(0);


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
        Schema::dropIfExists('invoices');
    }
};
