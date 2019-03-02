<?php

namespace App\Services;

use App\Repositories\BattlesRepositoryInterface;
use Carbon\Carbon;

class BattleService extends Service
{

    protected $BattlesRepo;

    public function __construct(BattlesRepositoryInterface $BattlesRepo)
    {
        $this->BattlesRepo = $BattlesRepo;
    }

    public function registerBattle($params)
    {
        return $this->BattlesRepo->registerBattle($params);
    }

    public function isExistedPair(array $photo_ids)
    {
        return $this->BattlesRepo->isExistedPair($photo_ids);
    }
    
}
