<?php
namespace Tests;

use ElegantMedia\OxygenFoundation\OxygenFoundationServiceProvider;
use EMedia\Devices\DevicesServiceProvider;
use Tests\Traits\MocksScoutEngines;

class TestCase extends \Orchestra\Testbench\TestCase
{

	use MocksScoutEngines;

	protected function tearDown(): void
	{
		\Mockery::close();
	}

	protected function getPackageProviders($app)
	{
		return [
			OxygenFoundationServiceProvider::class,
			DevicesServiceProvider::class,
		];
	}

}
