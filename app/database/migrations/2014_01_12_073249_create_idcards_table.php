<?php

use Illuminate\Database\Migrations\Migration;

class CreateIdcardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('idcards', function($table){
			$table->increments('id');
			$table->string('card_no');
			$table->string('name');
			$table->string('father_name')->nullable();
			$table->string('id_mark')->nullable();
			$table->string('contact');
			$table->string('blood_group', 5)->nullable();
			$table->enum('type', array('pre service', 'in service', 'faculty', 'staff', 'temporary'))->default('pre service');
			$table->string('picture')->default('avatar/default.png');

			$table->string('session')->nullable(); // Session year. Only for student
			$table->text('present_address')->nullable(); // For faculty and student
			$table->text('permanent_address')->nullable(); // Only for student
			$table->string('designation')->nullable(); // For faculty only
			$table->string('name_of_school')->nullable(); // For temporary teacher only

			$table->date('date_of_issue');	
			$table->string('date_of_birth')->nullable();	
			$table->date('valid_upto')->nullable();
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
		Schema::drop('idcards');
	}

}