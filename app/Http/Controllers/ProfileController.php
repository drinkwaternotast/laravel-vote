<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Services\ProfileService;
use App\User;
// use App\Http\Requests\ProfileRequest;


class ProfileController extends Controller
{
    use ApiControllerTrait;

    /** @var profileService */
    protected $profileService;

    /**
     * @param ProfileService $profileService
     * 
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
        $this->middleware('auth:api',['except' => ['show']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $form = $this->profileService->getForm();

        return $this->responseFormed($form);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // decouple validation from controller
        $this->validate($request, [
            'image'       => 'image|max:2000',
            'comment'     => 'required|max:200',
            'facebook'    => '',
            'twitter'     => ''
        ]);

        $request->user_id = $request->user()->id;

        if (!$request->hasfile('image') && $request->file('image')->isValid()) {
            return $this->responseBadRequest('Error', 'Image not uploaded!');
        }
        // Resize and save image for profile into Amazon S3
        $imagePath = $this->profileService->moveImage($request->image);
        $request->image = $imagePath;

        // save data in profiles table
        $this->profileService->save($request);

        return response()
            ->json([
                'saved' => true,
                'message' => 'You have successfully created profile!'
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
    // 1. check if requested user is logined user or not -> do it in Vuejs
    // 2. if its logined user, then check if he has an own profile -> Laravel
    // 3. return will be as follow (return will be 200, not 404)
    // json{" profile => {...}, situation => 'create' or 'update' "}
    // switch pattern in Vuejs with if sentense.
        $profile = $this->profileService->getProfileById($id);
        
        if ($profile) {
            return response()
                ->json([
                    'profile'   => $profile,
                    'isRegistered' => true
                ]);
        }
        return response()
            ->json([
                'profile'   => $profile,
                'isRegistered' => false
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id, Request $request)
    {
        if ($request->user()->id == $id) {
            $form = $this->profileService->getProfileById($id);
        }

        return $this->responseFormed($form);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {        
        // dd($request->all());
        $this->validate($request, [
            'user_id'     => 'required|exists:profiles,user_id',
            'comment'     => 'required|max:255',
            'image'       => 'image|max:600',
            'facebook'    => '',
            'twitter'     => ''
        ]);

        if (!$request->user()->id == $id) {
            return $this->responseBadRequest('AuthError','Invalid ID...');
        }

        if ($request->hasfile('image') && $request->file('image')->isValid()) {
            // Resize and save image for profile into Amazon S3
            $imagePath = $this->profileService->moveImage($request->image);
            $request->image = $imagePath;
        }
        // update data in profiles table
        $this->profileService->updateProfile($request);

        return response()
            ->json([
                'saved' => true,
                'id' => $request->user()->id,
                'message' => 'You have successfully updated profile!'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //
    }
}
