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
        Schema::create('offerdetails', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('offers_id');
            $table->integer('products_id');
            $table->integer('quantities_id');
            $table->integer('value');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['products_id', 'offers_id'], 'offerdetail_products_id_offers_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offerdetails');
    }
};
