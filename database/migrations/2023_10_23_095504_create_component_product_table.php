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
    public function up(): void
    {
        if (Schema::hasTable('component_product')) {
            return;
        }

        Schema::create('component_product', function (Blueprint $table) {
            $table->bigInteger('component_id');
            $table->bigInteger('products_id');
            $table->string('value', 100)->nullable();

            $table->unique(['component_id', 'products_id']);
            $table->unique(['products_id', 'component_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('component_product');
    }
};
