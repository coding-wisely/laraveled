<?php

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_category', function (Blueprint $table) {
            $table->foreignIdfor(Project::class)->constrained()->cascadeOnDelete(); // Foreign key to projects table
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete(); // Foreign key to categories table
            $table->primary(['project_id', 'category_id']); // Composite primary key
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_category');
    }
};
