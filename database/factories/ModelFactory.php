<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define( App\Product::class, function( Faker\Generator $faker ){
	return [
		'name' => $faker->words( 3, true ),
		'price' => $faker->randomNumber(3),
		'discount_percent' => $faker->randomNumber(2),
		'instock_quantity' => $faker->randomNumber(3),
		'description' => $faker->paragraph,
	];
} );

$factory->define( App\Category::class, function( Faker\Generator $faker ){
	return [
		'title' => $faker->words( 3, true ),
		'description' => $faker->paragraph,
	];
} );

