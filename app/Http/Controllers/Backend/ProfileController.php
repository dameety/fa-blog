<?php

namespace App\Http\Controllers\Backend;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;

class ProfileController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        return view('backend.users.profile', [
            'user' => $user,
            'avatar' => auth()->user()->avatar()
        ]);
    }
}
