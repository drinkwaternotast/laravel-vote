<?php

namespace App\Contracts\Adapter;

use App\Http\Contracts\Explore\AbstractPostExplore;
use App\Http\Contracts\Explore\CommentRankingExplore;
use App\Http\Contracts\Explore\NewestRankingExplore;
use App\Http\Contracts\Explore\RecentViewPostExplore;
use App\HTTP\Dao\RanksDao;

class RanksExploreAdapter {

	const VOTE_RANKING 		= 1;
	const BADGE_RANKING 	= 2;
	const FAVORITE_RANKING 	= 3;

	private $RanksDao = null;
	private $explore = null;

	public function __construct(int $ranking_type) {
		$this->RanksDao = new RanksDao();
		switch ($ranking_type) {
			case self::NEWEST_RANKING:
				$this->explore = new NewestRankingExplore();
				break;
			case self::COMMENT_RANKING:
				$this->explore = new CommentRankingExplore();
				break;
			case self::RECENT_VIEW_RANKING:
				$this->explore = new RecentViewPostExplore();
				break;
			default:
				throw new \InvalidArgumentException('Invalid ranking_type argument <' . $ranking_type  .'>');
		}
	}

	public function explore($options) {
		return $this->getExplore()->explore($options);
	}

	private function getExplore() : AbstractPostExplore {
		return $this->explore;
	}


}