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
        if (Schema::hasTable('cimlets')) {
            return;
        }

        Schema::create('cimlets', function (Blueprint $table) {
            $table->integer('id', true)->unique('cimlets_id_uindex');
            $table->string('name', 100)->unique('cimlets_name_uindex');
            $table->integer('value')->index();
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cimlets');
    }
};
