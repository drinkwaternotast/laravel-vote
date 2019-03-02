<?php

namespace App\Repositories;

interface VoteCountersRepositoryInterface

{
    /**
     * transfer into staged phase.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function createVoteCount($params);

    /**
     * transfer into staged phase.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getBattlesWithScore($formatted_date, $resources);

    /**
     * transfer into staged phase.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function updateVote($request);

    /**
     * transfer into staged phase.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getRankingWithTag($formatted_date);

    /**
     * transfer into staged phase.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getBattlesByIdWithScore($id, $resources, $formatted_date);

    /**
     * transfer into staged phase.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getBattlesByPhotoIdWithScore($resources, $formatted_date, $option);

    /**
     * get the number of battles specified photo entried.
     * -After 2days-
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getEntriedCountByPhotoId($photo_id, $formatted_date);

    /**
     * Get the number of win of the specified photo.
     * Calculate from 2days before.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getWonCountByPhotoId($photo_id, $formatted_date);

    /**
     * Calculate won count by user id.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getBattleResultsById($user_id, $term, $status);
}
