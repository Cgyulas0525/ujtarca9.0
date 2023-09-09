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
        if (Schema::hasTable('userstatuses')) {
            return;
        }
        Schema::create('userstatuses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191)->nullable()->index('IDX_UserStatus_Name');
            $table->string('commit', 500)->nullable();
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
        Schema::dropIfExists('userstatuses');
    }
};
