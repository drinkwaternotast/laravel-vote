<?php

namespace App\Services;

use App\Repositories\RankingsRepositoryInterface;
use Carbon\Carbon;

class RankingService extends Service
{
    protected $rankingsRepo;

    public function __construct(RankingsRepositoryInterface $rankingsRepo)
    {
        $this->rankingsRepo = $rankingsRepo;
    }

    public function getRankingByType($ranking_type, $user_id)
    {
        $rankingExplore = new RankingExploreAdapter($ranking_type);
        return $rankingExplore->explore($user_id);
    }

}
