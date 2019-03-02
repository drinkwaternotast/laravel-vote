<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PhotoService;
use App\Services\TagService;
use App\Http\Requests\PhotoRequest;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    use ApiControllerTrait;

    /** @var photoService */
    protected $photoService;
    protected $tagService;

    /**
     * @param PhotoService   $photoService
     * @param TagService   $tagService
     *
     */
    public function __construct(PhotoService $photoService, TagService $tagService)
    {
        $this->photoService = $photoService;
        $this->tagService = $tagService;
        $this->middleware('auth:api',['except' => ['index']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = $this->photoService->getAllUsersPhotos();

        return $this->responseOk($results);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->photoService->getForm();

        return $this->responseFormed($form);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // decouple validation from controller
        $this->validate($request, [
            'tag_data' => 'required',
            'image' => 'required|image|max:2000',
            'description' => 'max:3000'
        ]);
        $request->user_id = $request->user()->id;

        // Resize and save image for profile into Amazon S3
        $original_path = $this->photoService->moveImage($request->image);
        $request->original_path = $original_path;

        // Save data and get created photo ID from photos table
        $created_photo_id = $this->photoService->createPhoto($request);

        // Insert tag data in photo_tag table(upt to 2 tags).
        $this->tagService->createTag($created_photo_id, $request->tag_data);

        return response()
            ->json([
                'saved' => true,
                'message' => 'You have successfully uploaded!'
            ]);
    }

    /**
     * Display the specified resource.Everyone can see the photos by posting user_id.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $user_id)
    {
        // Attach isPrivateFlag with return if requested user_id is own id.
        $request->user()->id == $user_id ? $isPrivate = true : $isPrivate = false;

        $photos = $this->photoService->getPhotosById($user_id, $isPrivate);

        return $this->responseOk($photos);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $photo_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($photo_id, Request $request)
    {
        $photos = $this->photoService->getPhotoByPhotoId($photo_id);
        if (!$photos) {
            return $this->responseNotFound();
        }

        $user_id = $this->photoService->getUserByPhotoId($photo_id);
        if (!$request->user()->id == $user_id) {
            return $this->responseBadRequest('AuthError','It\'s not your photo...');
        }

        $this->photoService->deletePhotoByPhotoId($photo_id);

        return response()
            ->json([
                'deleted' => true,
                'message' => 'You have successfully deleted!'
            ]);
    }
}
