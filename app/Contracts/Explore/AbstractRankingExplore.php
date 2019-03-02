<?php

namespace App\Contracts\Explore;

use App\HTTP\Repositories\RankingRepository;

Abstract class AbstractRankingExplore {

	protected $rankingRepo;

	public function __construct() {
		$this->rankingRepo = new RankingRepository();
	}

	public abstract function explore($user_id);

}