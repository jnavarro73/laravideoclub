<?php



use App\Movie;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Str;

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
    	
        'title' => $faker->title,
        'year' => $faker->numberBetween($min = 1910, $max = 2010),
        'director' => $faker->name,
        'rent'=> $faker->boolean($chanceOfGettingTrue = 50),
        'synopsis'=> $faker->text(),
        'poster' => $faker->imageUrl($width = 400, $height = 320)

        //
    ];
});



/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define('App\Valoracion', function (Faker $faker) {
    return [
        'origen' => $faker->randomElement($array = array ('Desconocido','IMDB','tomatoes')),
        'valoracion' => $faker->randomFloat(2,0,100) ,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
       
    ];
});


