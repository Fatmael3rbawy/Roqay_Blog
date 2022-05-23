<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration {

	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
            $table->id();
			$table->string('title', 191);
			$table->text('body');
			// $table->integer('user_id')->unsigned();
			// $table->integer('category_id')->unsigned();
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('posts');
	}
}