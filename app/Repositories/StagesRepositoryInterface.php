<?php

namespace App\Repositories;

interface StagesRepositoryInterface

{

    /**
     * transfer into staged phase.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function createStage($params);

    /**
     * Display your staged images by user_id.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getCurrentStageById($id);

    /**
     * Delete staged images.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function deleteStage($id);

}
