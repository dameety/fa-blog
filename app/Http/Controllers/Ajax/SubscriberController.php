<?php

namespace App\Http\Controllers\Ajax;

use Response;
use Spatie\Newsletter\NewsletterFacade as Newsletter;
use Illuminate\Http\Request;
use App\Repositories\SubscriberRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateSubscriberRequest;
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
     * Display a listing of the Category.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $columns = ['email', 'created_at'];
        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = $this->subscriberRepository->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query = $query->scopeQuery(function($query) use ($searchValue) {
                return $query->where('name',  'like', '%' . $searchValue . '%')
                    ->orWhere('description', 'like', '%' . $searchValue . '%');
            });
        }

        $subscribers = $query->paginate($length);

        foreach($subscribers as $subscriber) {
            if(Newsletter::isSubscribed($subscriber->email)) {
                $subscriber['status'] = 'active';
            } else {
                $subscriber['status'] = 'inactive';
            }
        }

        return $this->sendResponse(['data' => $subscribers->toArray(), 'draw' => $request->input('draw')], 'Successful');
    }


    public function bulkDelete (Request $request)
    {
        try {
            foreach($request->category_ids as $id) {
                $this->subscriberRepository->delete($id);
            }
        } catch(\Exception $e) {
            $error = $e;
            return $this->sendError($e, 'Category was not deleted.');
        }

        return $this->sendResponse([], 'Categories Successfully deleted');
    }


    /**
     * Store a newly created Subscriber in storage.
     *
     * @param CreateSubscriberRequest $request
     *
     * @return Response
     */
    public function store(CreateSubscriberRequest $request)
    {
        if(! Newsletter::hasMember($request->email)) {

            try {
                Newsletter::subscribe($request->email);
            } catch (\Exception $e) {
                dd($e);
            }

            $subscriber = $this->subscriberRepository
                ->create($request->only('email'));

            return $this->sendResponse(
                $subscriber,
                'Subscription successful.'
            );

        } else {
            return $this->sendError('You are already a subscriber');
        }
    }


    /**
     * Remove the specified Subscriber from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subscriber = $this->subscriberRepository->findWithoutFail($id);
        if (empty($subscriber)) {
            return $this->sendError('Subscriber not found.');
        }

        Newsletter::delete($subscriber->email);

        $this->subscriberRepository->delete($id);

        return $this->sendResponse($id, 'Subscriber deleted successfully.');
    }
}
