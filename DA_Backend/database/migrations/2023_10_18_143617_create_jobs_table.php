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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_service')->nullable();
            $table->integer('id_booking_detail');
            $table->integer('id_booking');
            $table->integer('id_staff')->nullable();
            $table->string('item_name');
            $table->float('item_price');
            $table->string('target_time_done');
            $table->string('images_done')->nullable();
            $table->float('price');
            $table->string('status');
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
        Schema::dropIfExists('jobs');
    }
};
