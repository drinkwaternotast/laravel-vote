<?php

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use App\Services\PhotoService;
use Illuminate\Http\Request;
use App\Http\Requests;

class FavoriteController extends Controller
{
    use ApiControllerTrait;
    /*
     * @var favoriteService
     * @var photoService
     */
    protected $favoriteService;
    protected $photoService;

    /**
     * @param FavoriteService  $favoriteservice
     * @param PhotoService  $photoService 
     *
     */
    public function __construct(
        FavoriteService $favoriteService,
        PhotoService $photoService
    )
    {
        $this->favoriteService = $favoriteService;
        $this->photoService = $photoService;
        $this->middleware('auth:api');
    }

    /**
     * Display favorite list 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $favorites = $this->favoriteService->getFavoritesByid($request->user()->id);

        return $this->responseOK($favorites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user_id = $request->user()->id;
        $owner = $this->photoService->getUserByPhotoId($request->photo_id);

        //Check if its not mine
        if (!($request->user()->id == $owner)) {
            $this->favoriteService->addFavorite($request);

            return response()
                ->json([
                    'registered' => true,
                    'message' => 'Image added successfully in your favorite list!!'
                ]);
        }
        return response()
            ->json([
                'registered' => false,
                'message' => 'This is your image...'
            ]);
    }

    /**
     * Remove the specified resource from storage by favorites.id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $favorite = $request->user()->favorites()
            ->findOrFail($id);

        $this->favoriteService->deleteFavorite($favorite->id);

        return response()
            ->json([
                'deleted' => true,
                'message' => 'You have Removed Image in your favorite list!!'
            ]);
    }
}
