<?php

use Database\Seeders\TagsSeeder;

it('seeds the tags table correctly', function () {
    // Run the seeder
    $this->seed(TagsSeeder::class);

    // Assert that tags exist in the database
    $this->assertDatabaseCount('tags', 31); // Adjust count based on total tags
    $this->assertDatabaseHas('tags', ['name' => 'Laravel']);
    $this->assertDatabaseHas('tags', ['name' => 'Vue.js']);
});
