<?php

namespace App\Http\Controllers;

use App\Services\VoteService;
use App\Services\PhotoService;
use App\Services\VoteCounterService;
use App\Http\Requests\VoteRequest;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    use ApiControllerTrait;
    
    /** @var voteService */
    protected $voteService;
    protected $photoService;
    protected $voteCounterService;

    /**
     * @param VoteService   $voteService
     * 
     */
    public function __construct(
        VoteService $voteService,
        PhotoService $photoService,
        VoteCounterService $voteCounterService
        )
    {
        $this->voteService = $voteService;
        $this->photoService = $photoService;
        $this->voteCounterService = $voteCounterService;
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Prohibit vote for your own photo and do it once for each of battles.
        $request->user_id = $request->user()->id;
        $owner = $this->photoService->getUserByPhotoId($request->photo_id);
        $duplicatedVote = $this->voteService->getSelfVoteHistory($request);

        if ($duplicatedVote >= 1) {
            return $this->responseMethodNotAllowed('You already voted');
        }elseif ($owner === $request->user()->id) {
            return $this->responseMethodNotAllowed('You can not vote for your own image');
        }       
        // Insert Vote History in vote table.
        $this->voteService->vote($request);
        // Update Vote Counter table.
        $this->voteCounterService->updateVote($request);

        return response()
            ->json([
                'saved' => true,
                'message' => 'You have successfully voted!'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // return $result = $this->voteService->getSelfVoteHistories($request->user()->id);
    }

}
