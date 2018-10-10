<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Laravolt\Avatar\Facade as Avatar;

class User extends Authenticatable implements HasMedia
{
    public $table = 'users';

    use HasSlug,
        Notifiable,
        SoftDeletes,
        HasMediaTrait;


    protected $dates = ['deleted_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'bio'
    ];


    public function avatar()
    {
        if($this === auth()->user()) {
            $profilePicture = auth()->user()->getMedia('avatar');
        } else {
            $profilePicture = $this->getMedia('avatar');
        }

        if($profilePicture->count() > 0) {
            $profilePictureUrl = asset($profilePicture[0]->getUrl());
        } else {
            $profilePictureUrl = Avatar::create($this->first_name, $this->last_name)->toBase64();
        }

        return $profilePictureUrl;
    }


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
    ];

    public static $updateRules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'bio' => 'required',
    ];

    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('email')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10)
            ->nonQueued();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
    
}
