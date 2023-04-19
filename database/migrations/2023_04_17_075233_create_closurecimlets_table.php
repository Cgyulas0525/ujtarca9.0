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
        Schema::create('closurecimlets', function (Blueprint $table) {
            $table->integer('id', true)->unique('closurecimlets_id_uindex');
            $table->integer('closures_id');
            $table->integer('cimlets_id');
            $table->integer('value')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['closures_id', 'cimlets_id'], 'closurecimlets_closures_id_cimlets_id_uindex');
            $table->primary(['id']);
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