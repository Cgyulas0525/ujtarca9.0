<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
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

            $table->unique(['products_id', 'orders_id'], 'orderdetail_products_id_orders_id_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orderdetails');
    }
};
