<?php

namespace App\Repositories;

interface FavoritesRepositoryInterface

{
    /**
     * Get all photos.
     *
     * @param $params object photo_id, user_id
     * @return Illuminate\Database\Eloquent
     */
    public function addFavorite($params);

    /**
     * Get all photos.
     *
     * @param $params object photo_id, user_id
     * @return Illuminate\Database\Eloquent
     */
    public function deleteFavorite($params);

    /**
     * Get your favorites.
     *
     * @param $params user_id
     * @return Illuminate\Database\Eloquent
     */
    public function getFavoritesByid($id);

    /**
     * Get favorites count by photo_id.
     *
     * @param $params photo_id
     * @return Illuminate\Database\Eloquent
     */
    public function getFavoriteCountByPhotoId($id);

}
