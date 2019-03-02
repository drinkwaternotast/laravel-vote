<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BattleService;
use App\Services\VoteCounterService;

class PhotoBattleController extends Controller
{
    use ApiControllerTrait;

    /** @var battleService */
    protected $battleService;
    protected $voteCounterService;

    /**
     * @param BattleService   $battleService
     * 
     */
    public function __construct(
        BattleService $battleService,
        VoteCounterService $voteCounterService
    )
    {
        $this->battleService = $battleService;
        $this->voteCounterService = $voteCounterService;
        // $this->middleware('auth:api');
    }
    /**
     * Display the specified resource.
     *
     * @param  string $resources  int $photo_id
     * @return \Illuminate\Http\Response
     */
    public function show($resources, $photo_id)
    {
        $option['photo_id'] = $photo_id;
        $results = $this->voteCounterService->getBattlesByPhotoIdWithScore($resources, $option);

        if (empty($results)) {
            return $this->responseNotFound();
        }

        return $this->responseOK($results);
    }

}
