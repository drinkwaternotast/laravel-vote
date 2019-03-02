<?php

namespace App\Services;

use App\Repositories\StagesRepositoryInterface;

class StageService extends Service
{
    protected $stagesRepo;

    public function __construct(StagesRepositoryInterface $stagesRepo)
    {
        $this->stagesRepo = $stagesRepo;
    }

    public function createStage($params)
    {
        return $this->stagesRepo->createStage($params);
    }

    public function getCurrentStageById($id)
    {
        $stage = $this->stagesRepo->getCurrentStageById($id);

        if ($stage[0]->owner === 0) {
        return [
                'form' => [
                    'entry' => $stage[1] ?? null,
                    'candidate' => $stage[0] ?? null
                ]
            ];           
        }else{
        return [
                'form' => [
                    'entry' => $stage[0] ?? null,
                    'candidate' => $stage[1] ?? null
                ]
            ];
        }
    }

    public function deleteStage($id)
    {
        return $this->stagesRepo->deleteStage($id);
    }

}
