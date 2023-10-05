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
        Schema::create('current_repair', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->integer('staff_id');
            $table->text('note');
            $table->string('status');
            $table->string('image_done');
            $table->date('target_time_done');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('current_repair');
    }
};
