<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_dons', function (Blueprint $table) {
            $table->id('id');
            $table->integer('order_id')->nullable();
            $table->integer('pro_id')->nullable();
            $table->string('pro_name')->nullable();
            $table->string('pro_quantity')->nullable();
            $table->string('product_price')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('order_dons');
    }
}
