<?php


namespace EMedia\Devices;


use EMedia\Devices\Auth\DeviceAuthenticator;
use EMedia\Devices\Console\Commands\DevicesPackageSetupCommand;
use EMedia\Helpers\Components\Menu\MenuBar;
use EMedia\Helpers\Components\Menu\MenuItem;
use Illuminate\Support\ServiceProvider;

class DeviceAuthServiceProvider extends ServiceProvider
{

	public function boot()
	{
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'devices');

		$menuItem = (new MenuItem())->setText('Devices')
									->setResource('manage.devices.index')
									->setClass('fas fa-mobile-alt');

		MenuBar::add($menuItem, 'sidebar.manage');
	}


	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		if (!app()->environment('production')) {
			$this->commands(DevicesPackageSetupCommand::class);
		}

		$this->app->singleton('emedia.devices.auth', DeviceAuthenticator::class);
    }

}