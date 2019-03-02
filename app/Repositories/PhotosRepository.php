<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\PhotosRepositoryInterface;
use DB;

class PhotosRepository extends BaseRepository implements PhotosRepositoryInterface
{
    /**
     * get all new photos.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function allUsersPhotos()
    {
        return $this->table
            ->select('users.id as user_id','photos.id as photo_id','name','original_path')
            ->join('users','user_id','=','users.id')
            ->whereNull('photos.deleted_at')
            ->orderBy('photos.id','DESC')
            ->paginate(8);
    }

    /**
     * resister a new photo.
     *
     * @param $data object
     * @return Illuminate\Database\Eloquent
     */
    public function createPhoto($data)
    {
        $data = $this->setTimestamps($data);

        return $this->insertGetId([
            'original_path' => $data->original_path,
            'description'   => $data->description,
            'user_id'       => $data->user_id,
            'created_at'    => $data->created_at    
        ]);
    }

    /**
     * Get photos by user id.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent
     */
    public function getPhotosById($id, $isPrivateFlag)
    {
        $sql = $this->table
            ->select('name','users.id as user_id','photos.id as photo_id','original_path')
            ->join('users','user_id','=','users.id')
            ->where('user_id', $id)
            ->orderBy('photos.id', 'ASC')
            ->whereNull('photos.deleted_at');

            if ($isPrivateFlag === true) {
                return $sql->addSelect(DB::raw('"true" as isPrivateFlag'))->paginate(8);
            }
            return $sql->paginate(8);    
    }

    /**
     * Get photo by photo id.
     *
     * @param $photo_id int
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getPhotoByPhotoId($photo_id)
    {
        return $this->table
            ->select('*','id as photo_id')
            ->where('id', $photo_id)
            ->whereNull('photos.deleted_at')
            ->first();
    }

    /**
     * Get photo by photo id.
     *
     * @param $photo_id int
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getUserByPhotoId($photo_id)
    {
        return $this->table->where('id', $photo_id)->whereNull('deleted_at')->value('user_id');
    }

    /**
     * Get photo by photo id.
     *
     * @param $photo_id int
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getUserByPhotoIds(array $photo_ids)
    {
        return $this->findByIds($photo_ids, $id_name = 'id');
    }

     /**
     * SoftDelete a photo by photo id.
     *
     * @param $photo_id int
     * @return boolean
     */
    public function deletePhotoByPhotoId($photo_id)
    {
        $photo = $this->softDelete($photo_id);

        return $photo;
    }

}
