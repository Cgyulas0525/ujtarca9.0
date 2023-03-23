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
        Schema::create('settlements', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 100);
            $table->integer('postcode');
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['id'], 'settlements_id_uindex');
            $table->index(['name', 'postcode', 'id']);
            $table->index(['postcode', 'name', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settlements');
    }
};
