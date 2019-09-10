<?php


namespace EMedia\Devices\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use EMedia\Devices\Entities\Devices\Device;
use EMedia\Devices\Entities\Devices\DevicesRepository;

class DevicesController extends Controller
{

	/**
	 * @var DevicesRepository
	 */
	protected $devicesRepo;

	public function __construct(DevicesRepository $devicesRepo)
	{
		$this->devicesRepo = $devicesRepo;

		// $this->middleware('auth.acl:permissions[manage-devices]');
	}

	public function index()
	{
		$data = [
			'allItems' => $this->devicesRepo->search(),
			'pageTitle' => 'All Devices',
		];

		return view('devices::devices.index', $data);
	}

	public function show(Device $device)
	{
		$data = [
			'entity' => $device,
			'pageTitle' => 'Devices Details',
		];

		return view('devices::devices.show', $data);
	}

	public function destroy($id)
	{
		$this->devicesRepo->delete($id);

		return redirect()->route('manage.devices.index')->with('success', 'Device removed.');
	}

}
