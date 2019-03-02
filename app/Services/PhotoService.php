<?php

namespace App\Services;

use App\Repositories\PhotosRepositoryInterface;
use Illuminate\Contracts\Filesystem\Filesystem;
use Image;
use Storage;

class PhotoService extends Service
{

    protected $photosRepo;

    public function __construct(PhotosRepositoryInterface $photosRepo)
    {
        $this->photosRepo = $photosRepo;
    }

    public function getAllUsersPhotos()
    {
        return $this->photosRepo->allUsersPhotos();
    }

    public function getForm()
    {
        return [
            'tag_data'    => '',
            'image'       => '',
            'description' => ''
        ];
    }

    public function createPhoto($params)
    {
        return $this->photosRepo->createPhoto($params);
    }

    public function getPhotosById($id, $isPrivate)
    {
        return $this->photosRepo->getPhotosById($id, $isPrivate);
    }

    public function getPhotoByPhotoId($photo_id)
    {
        return $this->photosRepo->getPhotoByPhotoId($photo_id);
    }

    public function getUserByPhotoId($photo_id)
    {
        return $this->photosRepo->getUserByPhotoId($photo_id);
    }

    public function getUserByPhotoIds(array $photo_ids)
    {
        $ret = $this->photosRepo->getUserByPhotoIds($photo_ids);

        $user_ids =[
            'user1' => $ret[0]->user_id ?? null,
            'user2' => $ret[1]->user_id ?? null
        ];

        return $user_ids;

    }

    public function moveImage($file)
    {
        //Resize image with Intervention Image
        $Resource = Image::make($file)->resize(360, null, function ($constraint) {
          $constraint->aspectRatio();
        });

        // Need below code to save Intervention instance into S3 (nanikore!!)
        $imageData = $Resource->stream()->detach();

        $imageFileName = str_random(32).'.'.$file->extension();
        $filePath = 'images/' . $imageFileName;

        // Upload photos to S3
        $s3 = Storage::disk('s3');
        $s3->put($filePath, $imageData, 'public');

        return Storage::disk('s3')->url($filePath);
    }

    public function deletePhotoByPhotoId($photo_id)
    {
        return $this->photosRepo->deletePhotoByPhotoId($photo_id);
    }

}
