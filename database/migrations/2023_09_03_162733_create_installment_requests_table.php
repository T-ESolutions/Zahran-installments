<?php

use App\Enums\IRStatusEnum;
use App\Models\Admin;
use App\Models\Customer;
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
        Schema::create('installment_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Admin::class)->constrained()->cascadeOnDelete();
            $table->double('deposit');
            $table->double('price');
            $table->text('product')->nullable();
            $table->tinyInteger('status')->default(IRStatusEnum::PENDING->value);
            $table->dateTime('id_received_at')->nullable();
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
        Schema::dropIfExists('installment_requests');
    }
};
