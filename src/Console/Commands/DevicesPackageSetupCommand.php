<?php


namespace EMedia\Devices\Console\Commands;


use EMedia\Helpers\Console\Commands\Packages\BasePackageSetupCommand;

class DevicesPackageSetupCommand extends BasePackageSetupCommand
{

	protected $signature = 'setup:package:devices';

	protected $description = 'Setup the Devices package';

	protected $packageName = 'Devices';

	protected $updateRoutesFile = true;

	/**
	 *
	 * Any name to display to the user
	 *
	 * @return mixed
	 */
	protected function generateMigrations()
	{
		$this->copyMigrationFile(__DIR__, '001_create_devices_table.php', \CreateDevicesTable::class);
	}

	protected function generateSeeds()
	{
		$this->copySeedFile(__DIR__, 'DevicesTableSeeder.php', \DevicesTableSeeder::class);
	}
}