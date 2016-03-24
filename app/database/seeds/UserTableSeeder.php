<?php
class UserTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'username' => 'admin',
			'fullname' => 'Administrator',
			'password' => Hash::make('pass'),
			'avatar' => 'avatar/default-white.png',
			'role' => 'administrator'
			));
		User::create(array(
			'username' => 'principal',
			'fullname' => 'Principal',
			'password' => Hash::make('pass'),
			'avatar' => 'avatar/default-white.png',
			'role' => 'principal'
			));
	}
}