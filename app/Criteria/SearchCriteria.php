<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SearchCriteria.
 *
 * @package namespace App\Criteria;
 */
class SearchCriteria implements CriteriaInterface
{
    private $searchValue;

    public function __construct($searchValue)
    {
        $this->searchValue = $searchValue;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
//        $query->where(function($query) use ($searchValue) {
//            $query->where('budget', 'like', '%' . $searchValue . '%')
//                ->orWhere('status', 'like', '%' . $searchValue . '%');
//        });

        $searchValue = $this->searchValue;

        $model = $model->where(function($query) use ($searchValue) {
            $query->where('title', 'like', '%' . $searchValue . '%')
                ->orWhere('status', 'like', '%' . $searchValue . '%');
        });
//            ->where('user_id','=', auth()->user()->id );


        return $model;
    }
}
