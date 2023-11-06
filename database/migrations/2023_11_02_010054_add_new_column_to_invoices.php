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
        Schema::table('invoices', function (Blueprint $table) {
            $table->integer('pay_month')->default(0)->comment('بداية شهر الدفع');
            $table->integer('pay_year')->default(0)->comment('بداية سنة الدفع');
            $table->double('last_deposit')->default(0)->comment('المقدم السابق');
            $table->double('current_deposit')->default(0)->comment('المقدم الحالي');
            $table->double('months_total_percentage')->default(0)->comment('النسبة الكلية لعدد الاشهر');
            $table->double('profit_percentage')->default(0)->comment('نسبة الربح للفاتورة');
            $table->double('installment_price')->default(0)->comment('اجمالي سعر القسط');
            $table->enum('division_type',['dynamic','manual'])->default('dynamic')->comment('طريقة تقسيم سعر القسط');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            //
        });
    }
};
