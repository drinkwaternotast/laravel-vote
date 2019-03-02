<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FanService;

class FanController extends Controller
{
    use ApiControllerTrait;
    /*
     * @var fanService
     */
    protected $fanService;

    /**
     * @param FanService  $fanService
     *
     */
    public function __construct(FanService $fanService)
    {
        $this->fanService = $fanService;
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fans = $this->fanService->getFans($request->user()->id);

        return $this->responseOK($fans);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Check if its not your ID.
        $request->user_id = $request->user()->id;

        if ($request->fan_id == $request->user_id) {
            return $this->responseMethodNotAllowed('You can not bookmark yourself');
        }

        $this->fanService->addFan($request);
        
        return response()
            ->json([
                'registered' => true,
                'message' => 'Image added successfully in your fan list!!'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $fan = $request->user()->fans()
            ->findOrFail($id);

        $this->fanService->deleteFan($fan->id);

        return response()
            ->json([
                'deleted' => true,
                'message' => 'You have removed selected user in your fan list!!'
            ]);
    }
}
