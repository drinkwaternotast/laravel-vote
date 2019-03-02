<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RankingService;
use App\Services\TagService;
use App\Services\VoteCounterService;

class RankingController extends Controller
{
    use ApiControllerTrait;

    /** @var rankingService */
    protected $rankingService;
    protected $tagService;
    protected $voteCounterService;

    /**
     * @param RankingService   $rankingService
     * 
     */
    public function __construct(
        RankingService $rankingService,
        TagService $tagService,
        VoteCounterService $voteCounterService
    )
    {
        $this->rankingService = $rankingService;
        $this->tagService = $tagService;
        $this->voteCounterService = $voteCounterService;
        $this->middleware('auth:api',['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ret = $this->voteCounterService->getRankingWithTag();

        return $this->responseOk($ret);

    }
}
