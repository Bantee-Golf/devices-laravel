<?php


namespace EMedia\Devices\Commands;

use ElegantMedia\OxygenFoundation\Console\Commands\ExtensionInstallCommand;
use EMedia\Devices\DevicesServiceProvider;

class OxygenDevicesExtInstallCommand extends ExtensionInstallCommand
{

	protected $signature = 'oxygen:ext:devices:install';

	protected $description = 'Setup the Devices package';

	public function getExtensionServiceProvider(): string
	{
		return DevicesServiceProvider::class;
	}

	public function getExtensionDisplayName(): string
	{
		return 'Devices';
	}
}
