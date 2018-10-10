<?php

use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(\App\Models\Post::class, function (Faker $faker) {

    $status = array_random([Post::DRAFT, Post::PUBLISHED]);

    return [
        'status' => array_random([
            Post::DRAFT,
            Post::PUBLISHED,
        ]),
        'body' => $faker->text($maxNbChars = 500),
        'title' => $faker->text($maxNbChars = 50),
        'excerpt' => $faker->text($maxNbChars = 230),
        'published_at' => $status === Post::PUBLISHED ? Carbon::now() : null,
        'author_id' => function() {
            return factory(\App\Models\User::class)->create()->id;
        }

    ];
});
