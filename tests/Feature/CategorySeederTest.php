<?php

use Database\Seeders\CategoriesSeeder;

it('seeds the categories table correctly', function () {
    // Run the seeder
    $this->seed(CategoriesSeeder::class);

    // Assert that categories exist in the database
    $this->assertDatabaseCount('categories', 23); // Adjust count based on total categories
    $this->assertDatabaseHas('categories', ['name' => 'SaaS']);
    $this->assertDatabaseHas('categories', ['name' => 'Open Source']);
});
