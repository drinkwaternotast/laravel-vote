<?php

namespace App\Services;

use Carbon\Carbon;
use App\Exceptions\PreconditionException;
use App\Repositories\VoteCountersRepositoryInterface;

class VoteCounterService extends Service
{
    protected $voteCounterRepo;

    public function __construct(VoteCountersRepositoryInterface $voteCounterRepo)
    {
        $this->voteCounterRepo = $voteCounterRepo;
    }

    public function createVoteCount($data)
    {
        // BaseRepository@insertAndGetData will make a return of array( use get(), not first() ) 
        $data = [
            'battle_id'     => $data[0]->id,
            'photo_you'     => $data[0]->photo_you,
            'photo_enemy'   => $data[0]->photo_enemy,
            'created_at'    => $data[0]->created_at,
            'default_score' => 0
        ];

        return $this->voteCounterRepo->createVoteCount($data);
    }

    public function getBattlesWithScore($resources = 'current')
    {
        if (!($resources === 'current' || $resources === 'history')) {
            throw new PreconditionException('could_not_find_battles');
        }
        // Voting is allowed within 2 Days
        $formatted_date = Carbon::now()->subDay(2)->toDateTimeString();

        $ret = $this->voteCounterRepo->getBattlesWithScore($formatted_date, $resources);

        return $this->appendEndDate($ret);

    }

    public function getBattlesByIdWithScore($user_id, $resources = 'current')
    {
        if (!($resources === 'current' || $resources === 'history')) {
            throw new PreconditionException('could_not_find_battles');
        }
        // Voting is allowed within 2 Days
        $formatted_date = Carbon::now()->subDay(2)->toDateTimeString();

        $ret = $this->voteCounterRepo->getBattlesByIdWithScore($user_id, $resources, $formatted_date);

        return $this->appendEndDate($ret);
    }

    public function getBattlesByPhotoIdWithScore($resources, $option)
    {
        if (!($resources === 'current' || $resources === 'history')) {
            throw new PreconditionException('could_not_find_battles');
        }
        // Voting is allowed within 2 Days
        $formatted_date = Carbon::now()->subDay(2)->toDateTimeString();

        $ret = $this->voteCounterRepo->getBattlesByPhotoIdWithScore($resources, $formatted_date, $option);

        return $this->appendEndDate($ret);
    }

    public function updateVote($request)
    {
        return $this->voteCounterRepo->updateVote($request);
    }

    public function getRankingWithTag()
    {
        // Voting is allowed within 2 Days
        $formatted_date = Carbon::now()->subDay(2)->toDateTimeString();
        //get photo_id ordered by vote count
        $ranking_raw = $this->voteCounterRepo->getRankingWithTag($formatted_date);

        return $this->appendRank($ranking_raw);
    }

    public function getWinRatioByPhotoId($photo_id)
    {
        // Vote is counted after 2 Days
        $formatted_date = Carbon::now()->subDay(2)->toDateTimeString();

        $wonCount     = $this->voteCounterRepo->getWonCountByPhotoId($photo_id, $formatted_date);
        $entriedCount = $this->voteCounterRepo->getEntriedCountByPhotoId($photo_id, $formatted_date);

        !$entriedCount == 0 ? $winRatio  = round(($wonCount / $entriedCount * 100), 1) : $winRatio  = 0;

        $ret = [
            'wonCount'   => $wonCount,
            'entryCount' => $entriedCount,
            'winRatio'   => $winRatio."%"
        ];

        return $ret;
    }

    public function getWinRatioById($user_id)
    {
        // Vote is counted after 2 Days
        $formatted_date = Carbon::now()->subDay(2)->toDateTimeString();
        
        return $this->voteCounterRepo->getWonCountById($user_id, $formatted_date);
        // return $ret;
    }

    private function appendRank($Object)
    {
        for ($i=0; $i < $Object->count(); $i++) { 
            $Object[0]->RANK = ($Object->currentPage() - 1) * 5 + 1;
            $Object[$i]->RANK = $Object[0]->RANK + $i;
        }
        return $Object;
    }

    private function appendEndDate($Object)
    {
        for ($i=0; $i < $Object->count(); $i++) { 
            $start = $Object[$i]->created_at; 
            $time_stamp[$i] = strtotime("+2days $start");
            $end[$i]  =  date("Y-m-d H:i", $time_stamp[$i]);
            $Object[$i]->end_at = $end[$i];
        }
        return $Object;
    }

    private function devideIdsAsArray($Object)
    {
        for ($i=0; $i < $Object->count(); $i++) { 
            $Object[$i] = $Object[$i]->photo_id;
        }
        return $Object;
    }
}
