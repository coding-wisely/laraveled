<?php

use Database\Seeders\TechnologiesSeeder;

it('seeds the technologies table correctly', function () {
    // Run the seeder
    $this->seed(TechnologiesSeeder::class);

    // Assert that technologies exist in the database
    $this->assertDatabaseCount('technologies', 36);
    $this->assertDatabaseHas('technologies', ['name' => 'SQLite']);
    $this->assertDatabaseHas('technologies', ['name' => 'TailwindCSS']);
});
