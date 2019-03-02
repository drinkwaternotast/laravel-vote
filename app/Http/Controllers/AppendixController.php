<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PhotoService;
use App\Services\TagService;
use App\Services\VoteCounterService;

class AppendixController extends Controller
{
    use ApiControllerTrait;

    /** @var battleService */
    protected $photoService;
    protected $voteCounterService;
    protected $tagService;

    /**
     * @param BattleService $battleService
     * @param PhotoService $photoService 
     * @param TagService $tagService 
     *
     */
    public function __construct(
        PhotoService $photoService,
        VoteCounterService $voteCounterService,
        TagService $tagService
        )
    {
        $this->photoService = $photoService;
        $this->voteCounterService = $voteCounterService;
        $this->tagService = $tagService;
        // $this->middleware('auth:api');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $photo_id
     * @return \Illuminate\Http\Response
     */
    public function show($photo_id)
    {
        $photo = $this->photoService->getPhotoByPhotoId($photo_id);
        // $tags = $this->tagService->getTagsByPhotoId($photo_id);
        $history = $this->voteCounterService->getWinRatioByPhotoId($photo_id);

        return response()
            ->json([
                'photo'   => $photo,
                // 'tags'    => $tags,
                'history' => $history
            ]);
    }

}
