<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('content');
			$table->integer('order_id')->unsigned();
			$table->integer('notificable_id');
			$table->string('notificable_type');
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}