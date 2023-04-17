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
        Schema::create('closures', function (Blueprint $table) {
            $table->integer('id', true)->unique('closures_id_uindex');
            $table->date('closuredate')->unique('closures_closuredate_uindex');
            $table->integer('card');
            $table->integer('szcard');
            $table->integer('dayduring');
            $table->integer('dailysum')->nullable();
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
        Schema::dropIfExists('closures');
    }
};
