<?php

namespace App\Http\Controllers\Ajax;

use Response;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends AppBaseController
{

    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request)
    {
        if($request->has('new_password')) {
            $current_password = bcrypt($request->password);

            if(auth()->user()->password != $current_password) {
                return $this->sendError( 'Current password does not match');
            }
            $data = $request->only('first_name', 'last_name', 'bio', 'new_password');
        } else {
            $data = $request->only('first_name', 'last_name', 'bio');
        }

        $d = array_merge($data, ['password' => bcrypt($request->new_password)]);

        $user = $this->userRepository->update($d, auth()->user()->id);

        if($request->has('avatar')) {
            $user->addMediaFromBase64($request->avatar)->toMediaCollection('avatar');
        }

        return $this->sendResponse($user, 'Profile update successful.');
    }

}
