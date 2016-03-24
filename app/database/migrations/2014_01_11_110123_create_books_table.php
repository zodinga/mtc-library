<?php

use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function($table){
			$table->increments('id');
			$table->string('barcode')->nullable();
			$table->string('title');
			$table->integer('category_id');
			$table->string('classification_no')->nullable();
			$table->string('accession_no');
			$table->integer('author_id');
			$table->string('edition')->nullable();
			$table->integer('publisher_id');
			$table->string('published_year',4)->nullable();
			$table->integer('pages')->nullable();
			$table->string('volume')->nullable();
			$table->string('isbn_no')->nullable();
			$table->integer('copies');
			$table->integer('price');
			$table->integer('source');
			$table->integer('source_name');
			$table->integer('remarks');
			$table->string('shelf_no');
			$table->string('row_no');

			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('books');
	}

}