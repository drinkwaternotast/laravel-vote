<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;
use App\Services\PhotoService;
use App\Services\TagService;

class SearchController extends Controller
{
    use ApiControllerTrait;

    /** @var searchService
     *  @var photoService
     *  @var tagService
     */
    protected $searchService;
    protected $photoService;
    protected $tagService;

    /**
     * @param SearchService   $searchService
     * @param PhotoService   $photoService
     * @param TagService   $tagService
     */
    public function __construct(
        TagService $tagService, 
        SearchService $searchService, 
        PhotoService $photoService
    )
    {
        $this->searchService = $searchService;
        $this->photoService = $photoService;
        $this->tagService = $tagService;
        // $this->middleware('auth:api');
    }

    /**
     * Display all resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllTags()
    {
        $tag = $this->tagService->getAllTags();

        return $this->responseOk($tag);
    }

    /**
     * Display the specified resource in "Cosplayer Page".
     *
     * @param  int  $tagName
     * @return \Illuminate\Http\Response
     */
    public function getTagsAsSuggest($tagName)
    {
        $tag = $this->tagService->getTagsAsSuggest($tagName);

        return $this->responseOk($tag);
    }

    /**
     * Get tag formed "Character/Title" by Title or Character
     *
     * @param  int  $tagName
     * @return \Illuminate\Http\Response
     */
    public function getAppropriateTagAsSuggestByInput($tagName)
    {
        $tag = $this->tagService->getCharacterAndTitleByInput($tagName);

        return $this->responseOk($tag);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getDataByInputedTags($title_id, $tag_id = null)
    {
        if ($tag_id == 'AllChar') {
            $photos = $this->searchService->getPhotosByTitleId($title_id);

            return $this->responseOk($photos);
        }
        return $this->searchService->getPhotosByTagId($tag_id);
    }

}
