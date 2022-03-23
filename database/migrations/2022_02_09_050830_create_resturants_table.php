<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResturantsTable extends Migration {

	public function up()
	{
		Schema::create('resturants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 60);
			$table->string('email', 60);
			$table->string('password', 60);
			$table->string('confirm_password', 60);
			$table->string('phone', 20);
			$table->string('api_token', 80);
			$table->string('pin_code', 80);
			$table->decimal('delivery_price');
			$table->string('image', 80);
			$table->decimal('min_charge');
			$table->boolean('is_opened');
			$table->integer('neighborhood_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('resturants');
	}
}