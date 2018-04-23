<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('users')->insert([
			'name'           => 'admin',
			'email'          => 'admin@sbs.ll',
			'password'       => bcrypt('qwe`123'),
			'remember_token' => str_random(10),
			'created_at'     => date("Y-m-d H:i:s"),
			'updated_at'     => date("Y-m-d H:i:s")
		]);
		factory(App\User::class, 3)->create();
	}
}
