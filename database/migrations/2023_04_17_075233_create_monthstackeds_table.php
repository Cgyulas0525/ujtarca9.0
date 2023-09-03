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
        if (Schema::hasTable('monthstackeds')) {
            return;
        }

        Schema::create('monthstackeds', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('year');
            $table->integer('month');
            $table->integer('revenue')->default(0);
            $table->integer('spend')->default(0);
            $table->integer('average')->default(0);
            $table->integer('card')->default(0);
            $table->integer('szcard')->default(0);
            $table->integer('cash')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['year', 'month'], 'monthstackeds_year_month_uindex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthstackeds');
    }
};
