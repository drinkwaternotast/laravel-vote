<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use App\Services\BattleService;
use App\Services\PhotoService;

class HomeController extends Controller
{
    use ApiControllerTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomeService $homeService, PhotoService $photoService, BattleService $battleService)
    {
        $this->homeService = $homeService;
        $this->battleService = $battleService;
        $this->photoService = $photoService;
        // $this->middleware('auth:api');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Favorite users photos area
        $PopularPhotos = $this->homeService->getPopularPhotos();

        $Top = $PopularPhotos[0];
        $Others = array_slice($PopularPhotos->toArray(), 1);

        // Top User Information
        $TopUserPhotos = $this->photoService->getPhotosById($PopularPhotos[0]->user_id, false)->items();

        // Random photos area
        $RandomPhotos = $this->homeService->getRandomPhotos();

        // New Members photos area
        $NewMembers = $this->homeService->getNewMembersPhotos();

        //RankedUsers PopularPhotos
        return compact('TopUserPhotos','RandomPhotos','NewMembers','Top','Others');
    }
}
