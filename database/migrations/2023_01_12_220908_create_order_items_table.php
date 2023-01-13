<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orders_id');
            $table->unsignedBigInteger('dishes_id');
            $table->unsignedBigInteger('count');
            $table->foreign('orders_id')
                ->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('dishes_id')
                ->references('id')->on('dishes')->onDelete('cascade');
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
        Schema::dropIfExists('orders_item');
    }
};
