<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\FansRepositoryInterface;
use App\DataAccess\Eloquent\Fan;
use DB;

class FansRepository extends BaseRepository implements FansRepositoryInterface
{
    /**
     * resister a photo_id to the favorite table.
     *
     * @param $data user_id
     * @return Illuminate\Database\Eloquent
     */
    public function getFans($id)
    {
        return $this->table
            ->select('fans.id','fan_id','fans.user_id','users.name','profiles.comment','profiles.image')
            ->join('users','users.id','=','fans.fan_id')
            ->join('profiles', 'profiles.user_id', '=', 'fans.fan_id')
            ->where('fans.user_id',$id)
            ->paginate(8);
    }

    /**
     * resister a photo_id to the favorite table.
     *
     * @param $data object user_id
     * @return Illuminate\Database\Eloquent
     */
    public function addFan($params)
    {
        $fan = Fan::firstOrCreate(
            ['fan_id' => $params->fan_id, 'user_id' => $params->user_id ],
            ['fan_id' => $params->fan_id, 'user_id' => $params->user_id ]
        );
        
        return $fan;
    }

    /**
     * delete a fan_id in the fan table.
     *
     * @param int $fan_id
     * @return Illuminate\Database\Eloquent
     */
    public function deleteFan($fan_id)
    {
        $fan = $this->table
            ->where('id', $fan_id)
            ->delete();
        
        return $fan;
    }

}
