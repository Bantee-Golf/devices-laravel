<?php


use EMedia\Devices\Entities\Devices\Device;
use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{

	use \EMedia\QuickData\Database\Seeds\Traits\SeedsWithoutDuplicates;

	public function run()
	{
		$data = [
			[
				'device_id' => 112233,
				'device_type' => 'apple',
				'device_push_token' => '23232323232323',
				'user_id' => 1,
			],
			[
				'device_id' => 332211,
				'device_type' => 'android',
				'device_push_token' => '500500500500500',
			]
		];

		$this->seedButDontCreateDuplicates($data, Device::class, 'device_id', 'device_id');
	}

}