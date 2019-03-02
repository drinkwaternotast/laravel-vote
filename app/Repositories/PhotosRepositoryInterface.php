<?php

namespace App\Repositories;

interface PhotosRepositoryInterface

{
    /**
     * Get all photos.
     *
     * @param $comment object item_id, user_id, body, username, email
     * @return Illuminate\Database\Eloquent
     */
    public function allUsersPhotos();

    /**
     * register a new photo.
     *
     * @param $data object filename, user_id
     * @return Illuminate\Database\Eloquent
     */
    public function createPhoto($data);

    /**
     * Get photos by user id.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent
     */
    public function getPhotosById($id, $isPrivateFlag);

    /**
     * Get photo by photo_id.
     *
     * @param $photo_id int
     * @return Illuminate\Database\Eloquent
     */
    public function getPhotoByPhotoId($photo_id);

    /**
     * Get photo by photo_id.
     *
     * @param $id int
     * @return Illuminate\Database\Eloquent
     */
    public function deletePhotoByPhotoId($photo_id);

    /**
     * Get photo by photo_id.
     *
     * @param $photo_id int
     * @return Illuminate\Database\Eloquent
     */
    public function getUserByPhotoId($photo_id);
    
    /**
     * Get photo by photo_id.
     *
     * @param $photo_ids array
     * @return Illuminate\Database\Eloquent
     */
    public function getUserByPhotoIds(array $photo_ids);
}
