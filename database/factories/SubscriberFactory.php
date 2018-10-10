<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Subscriber::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
    ];
});
