<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\TagsRepositoryInterface;
use App\DataAccess\Eloquent\Tag;
use DB;

class TagsRepository extends BaseRepository implements TagsRepositoryInterface
{
    /**
     * Insert tag data in photo_tag table.
     */
    public function createTag($created_photo_id, $tagData)
    {
            DB::table('photo_tag')->insert([
                'photo_id' => $created_photo_id,
                'tag_id'   => $tagData['tag_id'],   
            ]);
    }

    /**
     * Insert tag data in photo_tag table.
     */
    public function getTagIdsByPhotoId($photo_id)
    {
        return DB::table('photo_tag')
            ->where('photo_id',$photo_id)
            ->pluck('tag_id')->all();
    }

    /**
     * resister a photo_id to the favorite table.
     */
    public function getExpectedTags($tagName)
    {
        return $this->table->where(function($query) use($tagName) {
                    $query->orWhere('tag','like',$tagName.'%')
                        ->orWhere('tag_en','like',$tagName.'%')
                        ->orWhere('character','like',$tagName.'%');
                })->orderBy('id')->get();
    }

    /**
     * resister a photo_id to the favorite table.
     */
    public function getExpectedTitles($tagName)
    {
        return DB::table('titles')
            ->where(function($query) use ($tagName){
                $query->orWhere('title_jp','like',$tagName.'%')
                    ->orWhere('title_en','like',$tagName.'%');
            })->get();
    }

    /**
     * Get title_ids by input
     */
    public function getExpectedTitleIds($tagName)
    {
        return DB::table('titles')
            ->where(function($query) use ($tagName){
                $query->orWhere('title_jp','like',$tagName.'%')
                    ->orWhere('title_en','like',$tagName.'%');
            })->pluck('title_id')->all();
    }

    /**
     * Get title_ids by input
     */
    public function getTagsWithTitleSearch(array $title_ids)
    {
        return DB::table('title_character')            
            ->whereIn('title_character.title_id', $title_ids)
            ->join('titles','titles.title_id','=','title_character.title_id')
            ->join('characters','characters.character_id','=','title_character.character_id')
            ->get();
    }

    /**
     * Get character_ids by input
     */
    public function getExpectedCharacterIds($tagName)
    {
        return DB::table('characters')
            ->where('character','like',$tagName.'%')
            ->pluck('character_id')->all();
    }

    /**
     * Get Tags by input
     */
    public function getTagsWithCharacterSearch(array $character_ids)
    {
        return DB::table('title_character')            
            ->whereIn('title_character.character_id', $character_ids)
            ->join('titles','titles.title_id','=','title_character.title_id')
            ->join('characters','characters.character_id','=','title_character.character_id')
            ->get();
    }

    /**
     * resister a photo_id to the favorite table.
     */
    public function getCharacterAndTitleByInput($tagName)
    {
        return DB::table('characters')
                ->join('titles','characters.title_id','=','titles.title_id')
                ->where(function($query) use ($tagName){
                    $query->orWhere('titles.title_jp','like',$tagName.'%')
                        ->orWhere('titles.title_en','like',$tagName.'%')
                        ->orWhere('characters.character','like',$tagName.'%');
                })->get();

    }
    
}
