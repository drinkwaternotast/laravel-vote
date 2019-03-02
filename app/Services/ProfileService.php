<?php

namespace App\Services;

use App\Repositories\ProfilesRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Util;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileService extends Service
{

    protected $ProfilesRepo;
    protected $Util;

    public function __construct(ProfilesRepositoryInterface $ProfilesRepo, Util $Util)
    {
        $this->ProfilesRepo = $ProfilesRepo;
        $this->Util = $Util;
    }

    public function getProfileById($id)
    {
        $profile = $this->ProfilesRepo->getProfileById($id);

        if ($profile) {
            return $this->Util->omitOverStr($profile);
        }
        return $profile;

    }

    public function getForm()
    {
        return [
            'comment'     => '',
            'image'       => '',
            'facebook'    => '',
            'twitter'     => ''
        ];
    }

    public function save($params)
    {
        // check if it already exist in profile table.
        return $this->ProfilesRepo->save($params);
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
        $filePath = 'profiles/' . $imageFileName;

        // Upload photos to S3
        $s3 = Storage::disk('s3');
        $s3->put($filePath, $imageData, 'public');

        return Storage::disk('s3')->url($filePath);
    }

    public function updateProfile($params)
    {
        return $this->ProfilesRepo->updateProfile($params);
    }
}
