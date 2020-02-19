<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movie;
use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
    	
        'title' => $faker->title,
        'year' =>numberBetween($min = 1910, $max = 2010),
        'director' => $faker->name,
        'rent'=>boolean($chanceOfGettingTrue = 50),
        'synopsis'=>$faker->text(),
        'poster' =>imageUrl($width = 400, $height = 320)

        //
    ];
});
