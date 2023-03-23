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
        Schema::create('partners', function (Blueprint $table) {
            $table->integer('id', true)->unique('partners_id_uindex');
            $table->string('name', 100);
            $table->integer('partnertypes_id')->nullable();
            $table->string('taxnumber', 15)->nullable();
            $table->string('bankaccount', 30)->nullable();
            $table->integer('postcode')->nullable();
            $table->integer('settlement_id')->nullable();
            $table->string('address', 100)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('phonenumber', 20)->nullable();
            $table->string('description', 500)->nullable();
            $table->integer('active')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['name', 'id'], 'partners_name_id_uindex');
            $table->unique(['partnertypes_id', 'id'], 'partners_partnertypes_id_id_uindex');
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
        Schema::dropIfExists('partners');
    }
};
