<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class  TechnologiesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('technologies')->insert([
            // Laravel Ecosystem
            ['name' => 'Laravel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Livewire', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Inertia.js', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Filament', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nova', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Breeze', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jetstream', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Passport', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sanctum', 'created_at' => now(), 'updated_at' => now()],

            // Frontend Tools
            ['name' => 'Vue.js', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'React', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alpine.js', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'TailwindCSS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bootstrap', 'created_at' => now(), 'updated_at' => now()],

            // Databases
            ['name' => 'MySQL', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PostgreSQL', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SQLite', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MongoDB', 'created_at' => now(), 'updated_at' => now()],

            // Caching and Queues
            ['name' => 'Redis', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Memcached', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'RabbitMQ', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SQS', 'created_at' => now(), 'updated_at' => now()],

            // Search Tools
            ['name' => 'Elasticsearch', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Meilisearch', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Algolia', 'created_at' => now(), 'updated_at' => now()],

            // DevOps & Deployment
            ['name' => 'Docker', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Forge', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Envoyer', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'GitHub Actions', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'GitLab CI/CD', 'created_at' => now(), 'updated_at' => now()],

            // API and REST Tools
            ['name' => 'Swagger', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Postman', 'created_at' => now(), 'updated_at' => now()],

            // Testing
            ['name' => 'PestPHP', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PHPUnit', 'created_at' => now(), 'updated_at' => now()],

            // Miscellaneous
            ['name' => 'Stripe', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PayPal', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
};
