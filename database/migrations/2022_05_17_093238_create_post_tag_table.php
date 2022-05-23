<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration {

	public function up()
	{
		Schema::create('post_tag', function(Blueprint $table) {
            $table->id();
			// $table->integer('post_id')->unsigned();
			// $table->integer('tag_id')->unsigned();
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('post_tag');
	}
}