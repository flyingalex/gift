<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		Sentry::register([
			'email'=> '826308409@qq.com',
			'username' => 'admin',
			'phone' => '132478888882',
			'avatar' => 'http://7xk6xh.com1.z0.glb.clouddn.com/avatar.png',
			'password' =>'666666',
			'role_id' => 3
		]);

		Sentry::register([
			'email'=> '82630849@qq.com',
			'username' => 'tiger1',
			'phone' => '13247888888',
			'avatar' => 'http://7xk6xh.com1.z0.glb.clouddn.com/avatar.png',
			'password' =>'666666',
			'role_id' => 2
		]);

		Sentry::register([
			'email'=> '82608409@qq.com',
			'username' => 'tiger2',
			'phone' => '13247888887',
			'avatar' => 'http://7xk6xh.com1.z0.glb.clouddn.com/avatar.png',
			'password' =>'666666',
			'role_id' => 2
		]);

		Sentry::register([
			'email'=> '828409@qq.com',
			'username' => 'tiger3',
			'phone' => '13247888884',
			'avatar' => 'http://7xk6xh.com1.z0.glb.clouddn.com/avatar.png',
			'password' =>'666666',
			'role_id' => 2
		]);


	}

}