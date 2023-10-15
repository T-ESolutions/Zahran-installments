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
        Schema::create('law_suit_histories', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->foreignIdFor(\App\Models\Lawsuit::class);
            $table->foreignIdFor(\App\Models\Admin::class);
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
        Schema::dropIfExists('law_suit_histories');
    }
};
