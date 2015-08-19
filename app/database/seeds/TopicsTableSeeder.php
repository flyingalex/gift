<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TopicsTableSeeder extends Seeder {

	public function run()
	{
	
		Topic::create([
			'title'=>'shoes for young',
			'content' => 'awesome shoes, you need that',
			'topic_url' => 'http://7xl6gj.com1.z0.glb.clouddn.com/zhuantiyijian_pic2@3x.png',
			'scan_num' => '19289',
			'focus_num' => '2828'
		]);
	}

}