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
        Schema::create('booking_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('id_booking');
            $table->integer('id_staff');
            $table->integer('id_service');
            $table->integer('id_role');
            $table->text('note');
            $table->string('status');
            $table->string('image_done');            
            $table->dateTime('target_date_done');
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
        Schema::dropIfExists('booking_detail');
    }
};
