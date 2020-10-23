<?php

namespace Tests\Feature;


use Carbon\Carbon;
use EMedia\Devices\Entities\Devices\Device;

class DeviceAuthenticatorTest extends \Tests\TestCase
{

	/**
	 * Define environment setup.
	 *
	 * @param  \Illuminate\Foundation\Application  $app
	 * @return void
	 */
	protected function getEnvironmentSetUp($app)
	{
		// Setup default database to use sqlite :memory:
		$app['config']->set('database.default', 'testbench');
		$app['config']->set('database.connections.testbench', [
			'driver'   => 'sqlite',
			'database' => ':memory:',
			'prefix'   => '',
		]);
	}

	public function testAuthenticatorCanValidateTokens(): void
	{
		// seed data
		$this->loadLaravelMigrations();
		$this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

		$this->artisan('migrate', ['--database' => 'testbench'])->run();

		$now = Carbon::now();

		\DB::table('users')->insert([
			'name' => 'Orchestra',
			'email' => 'hello@localhost.test',
			'password' => \Hash::make('456'),
			'created_at' => $now,
			'updated_at' => $now,
		]);

		$newDevice = Device::create([
			'device_id' => '123456',
			'device_type' => 'apple',
			'device_push_token' => '1231232',
			'user_id' => 1,
		]);
		$token = $newDevice->access_token;

		$device = \DB::table('devices')->where('device_id', '=', '123456')->first();

		$this->assertEquals($token, $device->access_token);
	}

}
