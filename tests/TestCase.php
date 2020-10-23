<?php
namespace Tests;

use EMedia\Devices\DevicesServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

	protected function getPackageProviders($app)
	{
		return [
			DevicesServiceProvider::class,
		];
	}

}
