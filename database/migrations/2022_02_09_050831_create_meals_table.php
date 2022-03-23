<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMealsTable extends Migration {

	public function up()
	{
		Schema::create('meals', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('resturant_id')->unsigned();
			$table->string('name', 60);
			$table->decimal('price');
			$table->string('description');
			$table->string('prepation_time');
			$table->string('image');
		});
	}

	public function down()
	{
		Schema::drop('meals');
	}
}