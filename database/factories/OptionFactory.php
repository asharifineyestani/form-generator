<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\Afracode\Form\App\Models\Option::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->name,
        'price' => $faker->randomDigit,
        'media_path' => 'https://unsplash.it/200?random',
    ];
});
