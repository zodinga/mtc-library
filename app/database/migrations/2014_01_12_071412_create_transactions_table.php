<?php

use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function($table){
			$table->increments('id');
			$table->string('card_no');
			$table->integer('book_id');
			$table->string('copies')->default(1);
			$table->timestamp('issued_at')->nullable();
			$table->timestamp('due_at')->nullable();
			$table->timestamp('returned_at')->nullable();
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
		Schema::drop('transactions');
	}

}