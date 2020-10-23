<?php


namespace EMedia\Devices;


use EMedia\Devices\Auth\DeviceAuthenticator;
use EMedia\Devices\Commands\OxygenDevicesExtInstallCommand;
use EMedia\Helpers\Components\Menu\MenuBar;
use EMedia\Helpers\Components\Menu\MenuItem;
use Illuminate\Support\ServiceProvider;

class DevicesServiceProvider extends ServiceProvider
{

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		if (app()->environment(['local', 'testing'])) {
			$this->commands(OxygenDevicesExtInstallCommand::class);
		}

		$this->app->singleton('emedia.devices.auth', DeviceAuthenticator::class);
	}

	public function boot()
	{
		// auto-publishing files
		$this->publishes([
			__DIR__ . '/../publish' => base_path(),
		], 'oxygen::auto-publish');

		// load default views
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'devices');

		// add vies for manual publishing
		$this->publishes([
			__DIR__ . '/../resources/views' => base_path('resources/views/vendor/oxygen'),
		], 'views');



		// $menuItem = (new MenuItem())->setText('Devices')
		// 							->setResource('manage.devices.index')
		// 							->setClass('fas fa-mobile-alt');
		//
		// MenuBar::add($menuItem, 'sidebar.manage');
	}




}
