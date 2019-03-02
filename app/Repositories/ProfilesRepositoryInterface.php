<?php

namespace App\Repositories;

interface ProfilesRepositoryInterface

{   
    /**
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getProfileById($id);

    /**
     *
     * @return Illuminate\Database\Eloquent
     */
    public function updateProfile($params);

}
