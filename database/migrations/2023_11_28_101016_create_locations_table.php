<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsTable extends Migration {

	public function up()
	{
		Schema::create('locations', function(Blueprint $table) {
			$table->id();
			$table->string('name', 100)->index();
			$table->string('description', 500)->nullable();
			$table->integer('postcode')->nullable();
			$table->integer('settlement_id')->nullable();
			$table->string('address', 100)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('locations');
	}
}
