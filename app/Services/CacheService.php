<?php

namespace App\Http\Service;

use Illuminate\Support\Facades\Redis;

class CacheService {

	const UNIQUE_GUEST_ID_EXPIRED =  259200; 

	private $redis = null;

	public function __construct() {
		$this->redis = Redis::connection();
	}

	public function set() {

	}

}