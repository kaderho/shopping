<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Produit::class, function (Faker $faker) {
    return [
        'nom' => 'HP, Omen '.$faker->numberBetween(1, 150),
        'label' => $faker->slug(1),
        'prix' => $faker->numberBetween(100000, 900000),
        'description' => $faker->paragraph(10),
        'details' => $faker->paragraph(2),
        'photo' => 'imagesProduits/hCvNDY07PGBtAbsiuEHOGwRxhxBbb4bwaKJ9M9UU.jpeg',
    ];
});
