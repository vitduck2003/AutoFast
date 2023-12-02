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
        Schema::create('service_items', function (Blueprint $table) {
            $table->id();
            $table->integer('id_service')->nullable();
            $table->string('item_name');
            $table->string('time_done');
            $table->float('price',255);
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
        Schema::dropIfExists('service_items');
    }
};

// INSERT INTO `service_items` (`id`, `id_service`, `item_name`, `time_done`, `price`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES(NULL, '1', 'Kiêm tra hệ thống phanh còi', '10', '56000', NULL, NULL, NULL, NULL), (NULL, '2', 'Kiêm tra hệ thống phanh còi', '10', '56000', NULL, NULL, NULL, NULL),(NULL, '3', 'Kiêm tra hệ thống phanh còi', '10', '56000', NULL, NULL, NULL, NULL),(NULL, '4', 'Kiêm tra hệ thống phanh còi', '10', '56000', NULL, NULL, NULL, NULL);
