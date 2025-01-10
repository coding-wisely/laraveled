<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'SaaS', 'description' => 'Software as a Service projects', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Open Source', 'description' => 'Open source projects', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ecommerce', 'description' => 'Online stores and commerce', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Portfolio', 'description' => 'Showcase portfolio projects', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Blog', 'description' => 'Personal or company blogs', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Educational', 'description' => 'Online learning or educational platforms', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Healthcare', 'description' => 'Projects related to healthcare and wellness', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fintech', 'description' => 'Finance and technology solutions', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Entertainment', 'description' => 'Streaming, gaming, or other entertainment platforms', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Community', 'description' => 'Forums, social networks, or community-driven platforms', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CRM', 'description' => 'Customer Relationship Management systems', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Task Management', 'description' => 'Project and task management tools', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AI/ML', 'description' => 'Artificial intelligence and machine learning projects', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dev Tools', 'description' => 'Tools for developers to streamline work', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Real Estate', 'description' => 'Projects related to real estate listings or management', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Non-Profit', 'description' => 'Projects for charitable or non-profit organizations', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Media', 'description' => 'News or media-focused platforms', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Travel', 'description' => 'Travel booking or tourism-related platforms', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Food', 'description' => 'Food delivery, recipes, or restaurant-related platforms', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Marketplace', 'description' => 'Online marketplaces for products or services', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gaming', 'description' => 'Video games or game-related projects', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Personal Development', 'description' => 'Apps or platforms focused on personal growth', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Government', 'description' => 'Government-related portals or platforms', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
};
