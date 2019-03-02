<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\StageRepositoryInterface;
use App\DataAccess\Eloquent\Stage;
use DB;

class StagesRepository extends BaseRepository implements StagesRepositoryInterface
{
    /**
     * resister photo on stage wirh Eloquent.
     *
     * @param $params user_id, photo_id, owner
     * @return Illuminate\Database\Eloquent
     */
    public function createStage($params)
    {
        $stage = Stage::updateOrCreate(
                ['user_id' => $params->user_id,'owner' => $params->owner],
                ['user_id' => $params->user_id,'photo_id' => $params->photo_id,'owner' => $params->owner]
            );

        return $stage;
    }

    /**
     * Get your standby table for battle by id.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getCurrentStageById($id)
    {
        $stage = $this->table->where('stages.user_id', $id)
            ->select('users.name','users.id as owner_id','stages.user_id','stages.photo_id','owner','original_path')
            ->join('photos', 'photo_id', '=', 'photos.id')
            ->join('users','users.id','=','photos.user_id')
            ->orderBy('owner', 'asc')
            ->get();

        if (!empty($stage)) {
            return $stage;
        }
        return false;
    }

    /**
     * Get your standby table for battle by id.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent\Model
     */
    public function deleteStage($id)
    {
        $stage = $this->table->where('stages.user_id', $id)->delete();

        if (!empty($stage)) {
            return $stage;
        }
        return false;
    }
}
