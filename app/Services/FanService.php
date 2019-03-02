<?php

namespace App\Services;

use App\Repositories\FansRepositoryInterface;

class FanService extends Service
{

    protected $fansRepo;

    public function __construct(FansRepositoryInterface $fansRepo)
    {
        $this->fansRepo = $fansRepo;
    }

    public function getFans($id)
    {
        return $this->fansRepo->getFans($id);
    }

    public function addFan($params)
    {
        return $this->fansRepo->addFan($params);
    }
    public function deleteFan($params)
    {
        return $this->fansRepo->deleteFan($params);
    }
}
