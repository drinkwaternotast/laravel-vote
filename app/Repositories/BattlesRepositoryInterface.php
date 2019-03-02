<?php

namespace App\Repositories;

interface BattlesRepositoryInterface

{
    /**
     * Register Battle.
     *
     * @param $params object photo_id, user_id
     * @return Illuminate\Database\Eloquent
     */
    public function registerBattle($params);

    /**
     * check if the pair is already existed in battle table.
     *
     * @param array $photo_ids
     * @return Integer
     */
    public function isExistedPair(array $photo_ids);
    
}
