<?php

namespace App\Http\Controllers\Backend;

use Response;
use Illuminate\Http\Request;
use App\Repositories\SubscriberRepository;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;

class SubscriberController extends AppBaseController
{
    /** @var  SubscriberRepository */
    private $subscriberRepository;

    public function __construct(SubscriberRepository $subscriberRepo)
    {
        $this->subscriberRepository = $subscriberRepo;
    }

    /**
     * Display a listing of the Subscriber.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('backend.subscribers.index');
    }
}
