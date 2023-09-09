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
        if (Schema::hasTable('closurecimlets')) {
            return;
        }

        Schema::create('closurecimlets', function (Blueprint $table) {
            $table->id();
            $table->integer('closures_id');
            $table->integer('cimlets_id');
            $table->integer('value')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['closures_id', 'cimlets_id'], 'closurecimlets_closures_id_cimlets_id_uindex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('closurecimlets');
    }
};
