<?php

use App\Enums\BlockEnum;
use App\Models\Admin;
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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Admin::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->string('id_number')->unique()->index();
            $table->string('address_id');
            $table->string('address')->nullable();
            $table->string('governorate');
            $table->string('center');
            $table->text('note')->nullable();
            $table->tinyInteger('is_blocked')->default(BlockEnum::UNBLOCKED->value);
            $table->string('id_image')->nullable();
//            $table->string('id_image_front');
//            $table->string('id_image_back');
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
        Schema::dropIfExists('customers');
    }
};
