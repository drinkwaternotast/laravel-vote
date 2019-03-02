<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\FavoritesRepositoryInterface;
use App\DataAccess\Eloquent\Favorite;
use DB;

class FavoritesRepository extends BaseRepository implements FavoritesRepositoryInterface
{
    /**
     * resister a photo_id to the favorite table.
     *
     * @param $data object photo_id, user_id
     * @return Illuminate\Database\Eloquent
     */
    public function addFavorite($params)
    {
        $favorite = Favorite::firstOrCreate([
            'photo_id' => $params->photo_id, 'user_id' => $params->user_id ],[
            'photo_id' => $params->photo_id, 'user_id' => $params->user_id
        ]);
        
        return $favorite;
    }

    /**
     * Get your favorites.
     *
     * @param $user_id
     * @return Illuminate\Database\Eloquent
     */
    public function getFavoritesByid($id)
    {
        return $this->table
            ->select('favorites.id as favorite_id','photos.user_id as owner_id','favorites.user_id','users.name','favorites.photo_id','original_path')
            ->join('photos', 'favorites.photo_id', '=', 'photos.id')
            ->join('users','users.id','=','photos.user_id')
            ->where('favorites.user_id',$id)
            ->whereNull('photos.deleted_at')
            ->paginate(8);
    }

    /**
     * Get favorites count by photo_id.
     *
     * @param $photo_id
     * @return Illuminate\Database\Eloquent
     */
    public function getFavoriteCountByPhotoId($id)
    {
        $favorite = $this->table
            ->join('photos', 'favorites.photo_id', '=', 'photos.id')
            ->select(DB::raw('count(*) as COUNT'))
            ->where('favorites.photo_id',$id)
            ->groupBy('favorites.photo_id')
            ->get('COUNT');
        
        return $favorite;
    }

    /**
     * delete a photo_id in the favorite table.
     *
     * @param int $favorite_id
     * @return Illuminate\Database\Eloquent
     */
    public function deleteFavorite($favorite_id)
    {
        $favorite = $this->table
            ->where('id', $favorite_id)
            ->delete();
        
        return $favorite;
    }

}
