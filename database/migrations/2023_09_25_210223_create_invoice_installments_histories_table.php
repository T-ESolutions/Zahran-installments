<?php

use App\Models\Admin;
use App\Models\Invoice;
use App\Models\InvoiceInstallments;
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
        Schema::create('invoice_installments_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(InvoiceInstallments::class);
            $table->foreignIdFor(Invoice::class);
            $table->foreignIdFor(Admin::class)->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('invoice_installments_histories');
    }
};
