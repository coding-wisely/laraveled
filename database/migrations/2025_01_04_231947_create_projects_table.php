<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->longText('description');
            $table->string('slug');
            $table->string('website_url');
            $table->string('github_url');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
