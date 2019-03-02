<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\ProfilesRepositoryInterface;
use App\DataAccess\Eloquent\Profile;

class ProfilesRepository extends BaseRepository implements ProfilesRepositoryInterface
{
    /**
     * Display your profile photo.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent
     */
    public function getProfileById($id)
    {   
        // do not use firstOrFail to avoid 404 return.(return will be 200)
        return $this->table
            ->select('user_id','name','comment','image','facebook','twitter')
            ->where('user_id', $id)
            ->join('users','user_id','=','users.id')
            ->first();
    }

    /**
     * Update your profile.(Chenge this method from Eloquent to QueryBuilder later)
     *
     * @param $data object user_id comment image
     * @return Illuminate\Database\Eloquent
     */
    public function updateProfile($data)
    {
        $profile = $this->table
            ->where('user_id', $data->user_id)
            ->update([
                'user_id'     => $data->user_id,
                'comment'     => $data->comment,
                'image'       => $data->image,
                'facebook'    => $data->facebook,
                'twitter'     => $data->twitter
            ]);

        return $profile;
    }

    /**
     * save data for profile except image data
     *
     * @param $data object
     * @return Illuminate\Database\Eloquent
     */
    public function save($data)
    {
        $data = $this->setTimestamps($data);

        return $this->table->insert([
            'user_id'     => $data->user_id,
            'comment'     => $data->comment,
            'image'       => $data->image,
            'facebook'    => $data->facebook,
            'twitter'     => $data->twitter
        ]);
    }
}
