<?php

namespace App\Services;

use App\Exceptions\PreconditionException;
use DB;

class SearchService extends Service
{
    /**
     * get photo_ids in a form of array.
     *
     * @param  array
     * @return array
     */
    public function getPhotosByTitleId($title_id)
    {
        // get tag_id as array
        $tag_ids = DB::table('title_character')
            ->where('title_id', $title_id)
            ->pluck('tag_id')
            ->all();

        return DB::table('photos')
            ->select('users.id as user_id','photos.id as photo_id','name','original_path')
            ->join('photo_tag', 'photos.id','=', 'photo_tag.photo_id')
            ->join('users','users.id', '=', 'photos.user_id')
            ->WhereIn('tag_id', $tag_ids)
            ->groupBy('photos.id')
            ->groupBy('users.id','name','original_path')
            ->paginate(8);
    }

    /**
     * get photo_ids in a form of array.39786
     *
     * @param  array
     * @return array
     */
    public function getPhotosByTagId($tag_id)
    {
        return DB::table('title_character')
            ->select('users.id as user_id','photos.id as photo_id','name','original_path')
            ->where('title_character.tag_id', '=', $tag_id)
            ->join('photo_tag', 'title_character.tag_id', '=', 'photo_tag.tag_id')
            ->join('photos','photos.id', '=', 'photo_tag.photo_id')
            ->join('users','users.id','=', 'photos.user_id')
            ->groupBy('photos.id')
            ->groupBy('users.id','name','original_path')
            ->paginate(8);
    }
}
