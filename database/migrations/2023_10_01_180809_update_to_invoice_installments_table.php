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
        Schema::table('invoice_installments', function (Blueprint $table) {
            $table->integer('moved_days')->nullable()->after('status');
            $table->decimal('paid_amount')->default(0)->after('monthly_installment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_installments', function (Blueprint $table) {
              $table->dropColumn('moved_days');
                $table->dropColumn('paid_amount');
        });
    }
};
