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
        if (Schema::hasTable('feature_product')) {
            return;
        }

        Schema::create('feature_product', function (Blueprint $table) {
            $table->bigInteger('feature_id');
            $table->bigInteger('products_id');
            $table->boolean('value')->default(0);

            $table->unique(['feature_id', 'products_id']);
            $table->unique(['products_id', 'feature_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_product');
    }
};
