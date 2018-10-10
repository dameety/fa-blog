<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindBySlugCriteria.
 *
 * @package namespace App\Criteria;
 */
class FindBySlugCriteria implements CriteriaInterface
{
    private $slug;

    public function __construct($slug)
    {
        $this->slug = $slug;
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
        $model= $model->where('slug','=', $this->slug );
        return $model;
    }
}
