<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('email');
			$table->string('phone');
			$table->string('fb_link');
			$table->string('tw_link');
			$table->string('inst_link');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}