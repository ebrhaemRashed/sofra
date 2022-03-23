<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 60);
			$table->string('email', 60);
			$table->string('password', 60);
			$table->string('confirm_password', 60);
			$table->string('phone', 20);
			$table->string('api_token', 80);
			$table->string('pin_code');
			$table->integer('neighborhood_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}