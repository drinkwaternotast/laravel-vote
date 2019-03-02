<?php

namespace App\Repositories;

interface VotesRepositoryInterface

{
    /**
     * Get all photos.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function vote($params);

    /**
     * Get all photos.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getSelfVoteHistories($id);

    /**
     * Get vote history by battle_id.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getSelfVoteHistory($params);
}
