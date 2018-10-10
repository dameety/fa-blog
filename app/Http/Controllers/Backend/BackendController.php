<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

class BackendController extends AppBaseController
{
    public function index()
    {
        return view('backend.index');
    }
}
