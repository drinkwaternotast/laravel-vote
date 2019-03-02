<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PhotoService;
use App\Services\StageService;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\DataAccess\Eloquent\Stage;

class StageController extends Controller
{
    use ApiControllerTrait;

    protected $stageService;
    protected $photoService;

    public function __construct(PhotoService $photoService, StageService $stageService){

        $this->stageService = $stageService;
        $this->photoService = $photoService;
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stages = $this->stageService->getCurrentStageById($request->user()->id);

        return $this->responseOK($stages);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $owner = $this->photoService->getUserByPhotoId($request->photo_id);
        $owner === $request->user()->id ? $request->owner = "1" : $request->owner = "0";

        $request->user_id = $request->user()->id;
        $this->stageService->createStage($request);

        $form = $this->stageService->getCurrentStageById($request->user_id);
        return $this->responseOK($form);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
