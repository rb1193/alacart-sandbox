<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shop\Product\Database\ProductTranslation;
use Faker\Generator as Faker;

$factory->define(ProductTranslation::class, function (Faker $faker) {
    return [
        'description' => $faker->paragraph(3),
        'name' => $faker->sentence(3),
        'locale' => 'en',
    ];
});
