<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name'           => $faker->name,
        'slack_token'    => Str::Uuid(),
        'slack_user_id'  => str_random(9),
        'avatar'         => 'https://bsblog.casareal.co.jp/img/recruit.png',
        'remember_token' => str_random(10),
    ];
});
