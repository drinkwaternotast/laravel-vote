<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\BattlesRepositoryInterface;
use DB;

class BattlesRepository extends BaseRepository implements BattlesRepositoryInterface
{
    protected $id_name = 'id';

    /**
     * resister a new battle.
     *
     * @param $params object entry, candidate
     * @return Illuminate\Database\Eloquent
     */
    public function registerBattle($data)
    {   
        $data = $this->setTimestamps($data);

        return $this->insertAndGetData([
            'photo_you'   => $data->entry['photo_id'],
            'photo_enemy' => $data->candidate['photo_id'],
            'user_id'     => $data->user_id,
            'created_at'  => $data->created_at    
        ]);
    }

    /**
     * check if the pair is already existed in battle table.
     * @param $params array photo_ids
     * @return Integer
     * 
     */
    public function isExistedPair(array $photo_ids)
    {
        return $this->table
            ->where(function($query) use($photo_ids) {
                $query->orWhere('photo_you', '=', $photo_ids[0])
                    ->orWhere('photo_enemy', '=', $photo_ids[0]);
            })
            ->where(function($query) use($photo_ids) {
                $query->orWhere('photo_you', '=', $photo_ids[1])
                    ->orWhere('photo_enemy', '=', $photo_ids[1]);
            })
            ->count();
    }

}
