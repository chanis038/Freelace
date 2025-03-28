<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

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
        'p_nombre' => 'R',
        'correo'   => 'ronydeleon038@gmail.com',
        'registro' => '777',
        'password' => bcrypt('123'),
        'Perfil' => 'R', // password
        //'remember_token' => Str::random(10),
    
    ];
});


