<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliveriesTable extends Migration {

	public function up()
	{
        if (Schema::hasTable('deliveries')) {
            return;
        }

        Schema::create('deliveries', function(Blueprint $table) {
			$table->id();
			$table->string('delivery_number', 100)->index();
			$table->date('date')->index();
			$table->integer('location_id')->unsigned();
			$table->string('description', 500)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('deliveries');
	}
}
