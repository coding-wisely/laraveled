<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tags')->insert([
            ['name' => 'Laravel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Livewire', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vue.js', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'React', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'TailwindCSS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Inertia.js', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Filament', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nova', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'API', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MySQL', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PostgreSQL', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Redis', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SQLite', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ecommerce', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'SaaS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Open Source', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Docker', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Testing', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Stripe', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PayPal', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Security', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Authentication', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Authorization', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AI', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Machine Learning', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fintech', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Healthcare', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Education', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Community', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Blog', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Portfolio', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
};
