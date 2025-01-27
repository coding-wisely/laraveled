<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Project::class)
                ->constrained('projects')
                ->onDelete('cascade');
            $table->foreignIdFor(User::class)->nullable();
            $table->string('session_id')->nullable();
            $table->unsignedTinyInteger('rating');
            $table->timestamps();

            // Ensure unique ratings for both users and guests
            $table->unique(['project_id', 'user_id', 'session_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
