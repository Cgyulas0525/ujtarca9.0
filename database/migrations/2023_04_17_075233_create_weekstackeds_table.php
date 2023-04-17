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
        Schema::create('weekstackeds', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('year');
            $table->integer('week');
            $table->integer('revenue')->default(0);
            $table->integer('spend')->default(0);
            $table->integer('average')->default(0);
            $table->integer('card')->default(0);
            $table->integer('szcard')->default(0);
            $table->integer('cash')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['year', 'week'], 'weekstackeds_year_week_uindex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weekstackeds');
    }
};
