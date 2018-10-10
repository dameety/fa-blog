<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [

        'total_posts' =>rand(3, 32),
        'name' => $faker->text($minNbChars = 10),
        'description' => $faker->text($maxNbChars = 200),

    ];
});
