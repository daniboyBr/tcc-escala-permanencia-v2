<?php

namespace App\Audit\Resolvers;

use Illuminate\Support\Facades\Request;

class IpAddressResolver implements \OwenIt\Auditing\Contracts\IpAddressResolver
{
	/**
	 * {@inheritdoc}
	 */
	public static function resolve(): string
	{
		return Request::header('HTTP_X_FORWARDED_FOR', Request::ip());
	}
}