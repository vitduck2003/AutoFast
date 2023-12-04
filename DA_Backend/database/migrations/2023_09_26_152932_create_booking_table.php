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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->integer('user_id')->nullable();
            $table->date('target_date');
            $table->time('target_time');
            $table->text('note')->nullable();
            $table->string('model_car');
            $table->integer('mileage');
            $table->string('status');
            $table->string('status_bill')->nullable();
            $table->integer('total_price');
            $table->integer('id_staff')->nullable();
            $table->integer('id_room')->nullable();
            $table->integer('log_id')->nullable();
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
        Schema::dropIfExists('booking');
    }
};
