<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\VotesRepositoryInterface;

class VotesRepository extends BaseRepository implements VotesRepositoryInterface
{
    /**
     * resister a new Vote.
     *
     * @param $params object battle_id, photo_id_like, user_id_voter
     * @return Illuminate\Database\Eloquent
     */
    public function vote($params)
    {
        $params = $this->setTimestamps($params);

        return $this->table->insert([
            'battle_id'      => $params->battle_id,
            'photo_id_like'  => $params->photo_id,
            'user_id_voter'  => $params->user_id,
            'created_at'     => $params->created_at
        ]);
    }

    /**
     * get Histories that Login User was Voted.
     *
     * @param $params object entry, candidate
     * @return Illuminate\Database\Eloquent
     */
    public function getSelfVoteHistories($id)
    {
        $result = $this->table
            ->where('user_id_voter',$id)
            ->join('battles','votes.battle_id','=','battles.battle_id')
            ->join('photos','photos.id','=','battles.photo_id')
            ->select('votes.battle_id','photos.id','original_path')
            ->get();

        return $result;
    }

    /**
     * get Login User's Vote history by battle_id.
     *
     * @param $params object entry, candidate
     * @return Illuminate\Database\Eloquent
     */
    public function getSelfVoteHistory($params)
    {
        $result = $this->table
            ->where('battle_id', $params->battle_id)
            ->where('user_id_voter', $params->user_id)
            ->count();

        return $result;
    }

    /**
     * get Login User's Vote history.
     *
     * @param $params object entry, candidate
     * @return Illuminate\Database\Eloquent
     */
    public function updateVote($params)
    {
        //
    }
}
