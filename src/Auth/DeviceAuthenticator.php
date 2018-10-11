<?php

namespace EMedia\Devices\Auth;

use EMedia\Devices\Entities\Devices\Device;
use EMedia\Devices\Entities\Devices\DevicesRepository;


class DeviceAuthenticator
{

	/**
	 * @var DevicesRepository
	 */
	private $devicesRepo;

	public function __construct(DevicesRepository $devicesRepo)
	{
		$this->devicesRepo = $devicesRepo;
	}

	/**
	 *
	 * Get an access token
	 *
	 * @param $deviceId
	 * @param $userId
	 *
	 * @return int
	 */
	public function getTokenByDeviceByUser($deviceId, $userId)
    {
        $accessToken = Device::where('device_id', $deviceId)
        			   ->active()
			  		   ->where('user_id', $userId)
			  		   ->first();

		return (empty($accessToken))? null: $accessToken->access_token;
    }


    public function setToken($deviceId, $deviceType, $devicePushToken, $userId)
    {
    	$device = new Device([
    		'device_id' => $deviceId,
    		'device_type' => $deviceType,
    		'device_push_token' => $devicePushToken,
    		'user_id' => $userId
    	]);

        return $device->token;
    }


	/**
	 *
	 * Validate to see if a token exists
	 *
	 * @param $accessToken
	 *
	 * @return bool
	 */
	public static function validateToken($accessToken)
    {
        $accessToken = Device::where('token', $accessToken)->active()->first();

        return ($accessToken)? true: false;
    }


    public function discardToken($deviceId, $accessToken = null) {
    	if (!$accessToken) {
			//delete all the tokens associated with device
			$this->devicesRepo->deleteByToken($accessToken);
    	} else {
    		$this->devicesRepo->deleteByDeviceId($deviceId);
    	}

        return true;
    }
}