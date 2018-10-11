<?php


namespace EMedia\Devices\Entities\Devices;


use EMedia\QuickData\Entities\Repositories\BaseRepository;

class DevicesRepository extends BaseRepository
{

	public function __construct(Device $model)
	{
		parent::__construct($model);
	}

	public function getByToken($accessToken)
	{
		return Device::where('access_token', $accessToken)->get();
	}

	public function getByUserId($userId)
	{
		return Device::where('user_id', $userId)->get();
	}

	public function resetAccessTokensByUserId($userId)
	{
		$devices = $this->getByUserId($userId);

		foreach ($devices as $device) {
			$device->resetAccessToken();
		}
	}

	public function deleteByDeviceId($deviceId)
	{
		$devices = Device::where('device_id', $deviceId)->get();

		foreach ($devices as $device) {
			$device->delete();
		}
	}

	public function deleteByToken($accessToken)
	{
		$devices = $this->getByToken($accessToken);

		foreach ($devices as $device) {
			$device->delete();
		}
	}

}