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
        if (Schema::hasTable('offers')) {
            return;
        }
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('offernumber', 25)->unique('offers_offernumber_uindex');
            $table->date('offerdate');
            $table->integer('partners_id');
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['offerdate', 'partners_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
};
