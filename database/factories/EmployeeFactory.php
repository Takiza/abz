<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
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

$factory->define(Employee::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);

    return [
        'name' => $faker->name($gender),
        'email' => $faker->unique()->safeEmail,
        'emp_date' => $faker->date(),
        'phone' => $faker->e164PhoneNumber,
        'wage' => $faker->randomFloat(2, 8000, 100000),
        'photo' => $faker->imageUrl(300, 400, 'people', true, $gender, false), // хоть подпишу :(
        'position_id' => rand(1, 5),
        'director_id' => 1
    ];
});
