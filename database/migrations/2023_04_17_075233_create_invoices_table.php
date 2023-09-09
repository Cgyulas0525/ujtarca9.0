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
        if (Schema::hasTable('invoices')) {
            return;
        }

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('partner_id');
            $table->string('invoicenumber', 25);
            $table->integer('paymentmethod_id');
            $table->integer('amount');
            $table->date('dated');
            $table->date('performancedate');
            $table->date('deadline');
            $table->string('description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['paymentmethod_id', 'id']);
            $table->index(['dated', 'partner_id', 'id']);
            $table->index(['partner_id', 'paymentmethod_id', 'id']);
            $table->index(['paymentmethod_id', 'partner_id', 'id']);
            $table->index(['partner_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
