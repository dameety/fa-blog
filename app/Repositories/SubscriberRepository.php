<?php

namespace App\Repositories;

use App\Models\Subscriber;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SubscriberRepository
 * @package App\Repositories
 * @version August 17, 2018, 6:56 pm UTC
 *
 * @method Subscriber findWithoutFail($id, $columns = ['*'])
 * @method Subscriber find($id, $columns = ['*'])
 * @method Subscriber first($columns = ['*'])
*/
class SubscriberRepository extends BaseRepository
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
        return Subscriber::class;
    }
}
