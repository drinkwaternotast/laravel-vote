<?php

namespace App\Services;

use App\Repositories\VotesRepositoryInterface;
use App\Exceptions\PreconditionException;
use Illuminate\Support\Facades\Auth;
use App\DataAccess\Eloquent\Photo;

class VoteService extends Service
{

    protected $votesRepo;

    public function __construct(VotesRepositoryInterface $votesRepo)
    {
        $this->votesRepo = $votesRepo;
    }

    public function votePhoto($params)
    {
        return $this->votesRepo->votePhoto($params);
    }

    public function vote($params)
    {
        return $this->votesRepo->vote($params);
    }

    public function getSelfVoteHistories($id)
    {
        return $this->votesRepo->getSelfVoteHistories($id);
    }

    public function getSelfVoteHistory($params)
    {
        return $this->votesRepo->getSelfVoteHistory($params);
    }

}
