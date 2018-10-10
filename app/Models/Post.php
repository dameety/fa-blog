<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Cviebrock\EloquentTaggable\Taggable;

class Post extends Model implements HasMedia
{
    use HasSlug,
        Taggable,
        SoftDeletes,
        HasMediaTrait;

    const DRAFT = 'draft';
    const PUBLISHED = 'published';

    public $table = 'posts';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'body',
        'title',
        'status',
        'excerpt',
        'reading_duration',
        'is_featured',
        'is_slidable',
        'slug'
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($post) {
            $post->reading_duration = self::calculateReadTime($post->body);
        });

        static::updated(function ($post) {
            $post->reading_duration = self::calculateReadTime($post->body);
        });
    }

    private static function calculateReadTime($postBody)
    {
        $word_count = str_word_count(strip_tags($postBody));

        $minutes = floor($word_count / 200);
        $seconds = floor($word_count % 200 / (200 / 60));

        $str_minutes = ($minutes == 1) ? "minute" : "minutes";
        $str_seconds = ($seconds == 1) ? "second" : "seconds";

        if ($minutes == 0) {
            return "{$seconds} {$str_seconds}";
        }
        else {
            return "{$minutes} {$str_minutes}, {$seconds} {$str_seconds}";
        }
    }

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'status' => 'string',
        'excerpt' => 'string',
        'is_featured' => 'boolean',
        'is_slidable' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */

    public static $rules = [
        'body' => 'required',
        'title' => 'required',
        'excerpt' => 'required',
        'image' => 'required'
    ];

    public static $updateRules = [
        'body' => 'required',
        'title' => 'required',
        'excerpt' => 'required'
    ];

    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
