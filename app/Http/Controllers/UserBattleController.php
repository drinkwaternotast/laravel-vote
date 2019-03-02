<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BattleRequest;
use App\Services\BattleService;
use App\Services\PhotoService;
use App\Services\StageService;
use App\Services\VoteCounterService;

class UserBattleController extends Controller
{
    use ApiControllerTrait;

    /** @var battleService */
    protected $battleService;
    protected $photoService;
    protected $stageService;
    protected $voteCounterService;

    /**
     * @param BattleService   $battleService
     * @param PhotoService   $photoService
     * @param StageService   $stageService
     * @param VoteCounterService   $voteCounterService
     * 
     */
    public function __construct(
        BattleService $battleService,
        PhotoService $photoService,
        StageService $stageService,
        VoteCounterService $voteCounterService
        )
    {
        $this->battleService = $battleService;
        $this->photoService = $photoService;
        $this->stageService = $stageService;
        $this->voteCounterService = $voteCounterService;
        $this->middleware('auth:api',['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     * @param  $request current history
     * @return \Illuminate\Http\Response
     */
    public function index($resources)
    {   
        $results = $this->voteCounterService->getBattlesWithScore($resources);

        return $this->responseOK($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "entry.photo_id"     => 'required',
            "candidate.photo_id" => 'required'
        ]);

        $request->user_id = $request->user()->id;

        $user = $this->photoService->getUserByPhotoIds([
                $request->entry['photo_id'],
                $request->candidate['photo_id']
            ]);        

        if ($user['user1'] == false || $user['user2'] == false) {
            return $this->responseMethodNotAllowed('Requested photo does not exist');
        }

        if (!in_array($request->user()->id, $user)  || $user['user1'] === $user['user2']) {
            return $this->responseMethodNotAllowed('Your entry was denied');
        }
        //add method to avoid duplicated registration of the selected pair
        $isExistedPair = $this->battleService->isExistedPair([
                $request->entry['photo_id'],
                $request->candidate['photo_id']
            ]);

        if ($isExistedPair !== 0) {
            return $this->responseMethodNotAllowed('This pair was already registered(now or in the past).');
        }
        $battle = $this->battleService->registerBattle($request);
        //Insert Data in VoteCount table to manage only the number of vote.
        $this->voteCounterService->createVoteCount($battle);
        //remove staged data from stages table.
        $this->stageService->deleteStage($request->user_id);

        return response()
            ->json([
                'registered' => true,
                'message' => 'You have registered the battle!!'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $resources  int $user_id
     * @return \Illuminate\Http\Response
     */
    public function show($resources, $user_id)
    {
        $results = $this->voteCounterService->getBattlesByIdWithScore($user_id, $resources);

        if (empty($results)) {
            return $this->responseNotFound();
        }
        return $this->responseOk($results);
    }

}
