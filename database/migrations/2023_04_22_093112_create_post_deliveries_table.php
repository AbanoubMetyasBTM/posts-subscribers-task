<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostDeliveriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_deliveries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('post_id')->index('post_id');
			$table->integer('user_id')->index('user_id');
			$table->boolean('is_sent');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_deliveries');
	}

}
