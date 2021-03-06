<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('resturant_id')->unsigned();
			$table->decimal('amount');
            $table->string('name');

		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}
