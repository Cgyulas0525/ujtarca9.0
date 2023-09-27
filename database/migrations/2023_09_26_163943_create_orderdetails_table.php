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
        if (Schema::hasTable('orderdetails')) {
            return;
        }
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->id();
            $table->integer('orders_id');
            $table->integer('products_id');
            $table->integer('quantities_id');
            $table->integer('value');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['products_id', 'orders_id'], 'orderdetail_products_id_orders_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderdetails');
    }
};
