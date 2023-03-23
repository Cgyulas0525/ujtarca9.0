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
        Schema::create('partnertypes', function (Blueprint $table) {
            $table->integer('id', true)->unique('partnertypes_id_uindex');
            $table->string('name', 100)->unique('partnertypes_name_uindex');
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('partnertypes');
    }
};
