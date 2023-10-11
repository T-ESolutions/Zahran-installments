<?php

use App\Enums\LawsuitStatusEnum;
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
        Schema::create('lawsuits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Admin::class);
            $table->foreignIdFor(Invoice::class);
            $table->decimal('amount');
            $table->decimal('paid_amount')->nullable();
            $table->tinyInteger('status')->default(LawsuitStatusEnum::UNPAID->value);
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
        Schema::dropIfExists('lawsuits');
    }
};
