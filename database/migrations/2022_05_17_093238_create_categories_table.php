<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
            $table->id();
			// $table->integer('user_id')->unsigned();
			$table->string('name', 191);
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}