<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shop\Product\Database\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'sku' => Str::random(10),
    ];
});
