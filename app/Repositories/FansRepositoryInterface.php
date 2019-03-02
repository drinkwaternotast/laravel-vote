<?php

namespace App\Repositories;

interface FansRepositoryInterface

{
    /**
     * Get all photos.
     *
     * @param $params user_id
     * @return Illuminate\Database\Eloquent
     */
    public function getFans($id);

    /**
     * Add user in fans table.
     *
     * @param $params object fan_id user_id
     * @return Illuminate\Database\Eloquent
     */
    public function addFan($params);

    /**
     * Remove fan in the table.
     *
     * @param $params object fan_id
     * @return Illuminate\Database\Eloquent
     */
    public function deleteFan($params);


}
