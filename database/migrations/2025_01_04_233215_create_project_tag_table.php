<?php

use App\Models\Project;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_tag', function (Blueprint $table) {
            $table->foreignIdFor(Project::class)->constrained()->cascadeOnDelete(); // Foreign key to projects table
            $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete(); // Foreign key to tags table
            $table->primary(['project_id', 'tag_id']); // Composite primary key
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_tag');
    }
};
