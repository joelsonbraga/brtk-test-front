<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'uuid' => $faker->unique()->uuid,
        'cpf' => \Illuminate\Support\Str::random(11),
        'name' => $faker->name,
        'email' => $faker->unique()->email(),
        'phone' => $faker->phoneNumber,
    ];
});

