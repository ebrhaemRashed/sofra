<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
            $table->string('name');
			$table->string('description');
			$table->integer('meal_id')->unsigned();
			$table->integer('resturant_id')->unsigned();
			$table->date('start_date');
			$table->date('end_date');
			$table->string('image');

		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}
