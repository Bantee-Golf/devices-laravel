<?php

namespace EMedia\Devices\Middleware;

use Closure;

use EMedia\Devices\Auth\DeviceAuthenticator;
use Illuminate\Support\Facades\Response;


class DeviceAuthMiddleware
{

    public function handle($request, Closure $next)
	{
		$token = null;

		if ($request->filled('access_token')) {
			$token = $request->access_token;
    	} elseif ($request->filled('token')) {
    		$token = $request->token;
    	}

        if (!$token || !DeviceAuthenticator::validateToken($token))
        {
            return Response::json([
                'result'  => [],
                'error' => 'InvalidAccessToken',
                'status'   => 401
            ],401);
        }

		return $next($request);
    }
}