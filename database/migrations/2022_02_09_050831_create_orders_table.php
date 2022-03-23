<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id')->unsigned();
			$table->integer('resturant_id')->unsigned();
			$table->decimal('delivery_price');
			$table->decimal('total_price');
			$table->string('address');
			$table->enum('status', array('pending', 'accepted', 'rejected', 'delivered', 'decline'));
			$table->decimal('commission');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
