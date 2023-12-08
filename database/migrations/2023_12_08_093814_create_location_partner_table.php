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
        if (Schema::hasTable('location_partner')) {
            return;
        }

        Schema::create('location_partner', function (Blueprint $table) {
            $table->bigInteger('location_id');
            $table->bigInteger('partners_id');

            $table->unique(['location_id', 'partners_id']);
            $table->unique(['partners_id', 'location_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_partner');
    }
};
