<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Subscriber
 * @package App\Models
 * @version August 17, 2018, 6:56 pm UTC
 *
 * @property string email
 * @property string name
 */
class Subscriber extends Model
{
    use SoftDeletes;

    public $table = 'subscribers';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'email',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'email' => 'string',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'required'
    ];

    
}
