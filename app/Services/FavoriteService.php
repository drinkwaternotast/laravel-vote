<?php

namespace App\Services;

use App\Repositories\FavoritesRepositoryInterface;
use Image;

class FavoriteService extends Service
{

    protected $favoritesRepo;

    public function __construct(FavoritesRepositoryInterface $favoritesRepo)
    {
        $this->favoritesRepo = $favoritesRepo;
    }

    public function addFavorite($params)
    {
        return $this->favoritesRepo->addFavorite($params);
    }

    public function deleteFavorite($params)
    {
        return $this->favoritesRepo->deleteFavorite($params);
    }

    public function getFavoritesByid($id)
    {
        return $this->favoritesRepo->getFavoritesByid($id);
    }

}
