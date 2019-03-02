<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;
use App\Services\PhotoService;
use App\Services\TagService;

class TestController extends Controller
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
    public function test($title_id, $tag_id = null)
    {
		return $this->searchService->getPhotosByTagId($tag_id);
    }

}
