<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;


class CreateForeignKeys extends Migration
{

	public function up()
	{
		Schema::table('posts', function (Blueprint $table) {
			// $table->foreign('user_id')->references('id')->on('users')
			// 			->onDelete('cascade')
			// 			->onUpdate('restrict');

			$table->foreignId('user_id')
				->constrained('users')
				->onUpdate('restrict')
				->onDelete('cascade');
		});

		Schema::table('posts', function (Blueprint $table) {

			$table->foreignId('category_id')
				->constrained('categories')
				->onUpdate('restrict')
				->onDelete('cascade');
		});
		Schema::table('categories', function (Blueprint $table) {
			$table->foreignId('user_id')
				->constrained('users')
				->onUpdate('restrict')
				->onDelete('cascade');
		});
		Schema::table('tags', function (Blueprint $table) {
			$table->foreignId('user_id')
				->constrained('users')
				->onUpdate('restrict')
				->onDelete('cascade');
		});
		Schema::table('post_tag', function (Blueprint $table) {

			$table->foreignId('post_id')
				->constrained('posts')
				->onUpdate('restrict')
				->onDelete('cascade');
		});
		Schema::table('post_tag', function (Blueprint $table) {

			$table->foreignId('tag_id')
				->constrained('tags')
				->onUpdate('restrict')
				->onDelete('cascade');
		});

		Schema::table('transactions', function (Blueprint $table) {

			$table->foreignId('user_id')
				->constrained('users')
				->onUpdate('restrict')
				->onDelete('cascade');
		});

	}

	public function down()
	{
		Schema::table('posts', function (Blueprint $table) {
			$table->dropForeign('posts_user_id_foreign');
		});
		Schema::table('posts', function (Blueprint $table) {
			$table->dropForeign('posts_category_id_foreign');
		});
		Schema::table('categories', function (Blueprint $table) {
			$table->dropForeign('categories_user_id_foreign');
		});
		Schema::table('tags', function (Blueprint $table) {
			$table->dropForeign('tags_user_id_foreign');
		});
		Schema::table('post_tag', function (Blueprint $table) {
			$table->dropForeign('post_tag_post_id_foreign');
		});
		Schema::table('post_tag', function (Blueprint $table) {
			$table->dropForeign('post_tag_tag_id_foreign');
		});
	}
}
