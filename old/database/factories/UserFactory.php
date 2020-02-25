<?php

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

$factory->define(App\Models\Submission::class, function(Faker $faker) {
    return [
        'birthday' => $faker->dateTimeThisYear(),
        'occurrences'   => mt_rand(1, 3),
    ];
})->afterCreating(App\Models\Submission::class, function ($submission, Faker $faker) {
    factory(App\Models\ExchangeRate::class)->create([
        'submission_id' => $submission->id,
    ]);
});

$factory->define(App\Models\ExchangeRate::class, function(Faker $faker) {
    $submission = App\Models\Submission::inRandomOrder()->first() ??
                    factory(App\Models\Submission::class)->create();

    return [
        'submission_id' => $submission->id,
        'hong_kong_dollar' => $faker->randomFloat(),
    ];
});
