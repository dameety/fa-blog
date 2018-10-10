<?php

namespace App\Repositories;

use App\Models\Newsletter;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class NewsletterRepository
 * @package App\Repositories
 * @version August 17, 2018, 6:03 pm UTC
 *
 * @method Newsletter findWithoutFail($id, $columns = ['*'])
 * @method Newsletter find($id, $columns = ['*'])
 * @method Newsletter first($columns = ['*'])
*/
class NewsletterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Newsletter::class;
    }
}
