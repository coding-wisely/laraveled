<?php
use App\Models\Project;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Technology;

it('associates a project with categories, tags, and technologies', function () {
    $project = Project::factory()->create();
    $categories = Category::factory()->count(3)->create();
    $tags = Tag::factory()->count(3)->create();
    $technologies = Technology::factory()->count(3)->create();

    $project->categories()->attach($categories);
    $project->tags()->attach($tags);
    $project->technologies()->attach($technologies);

    // Assert associations
    $this->assertCount(3, $project->categories);
    $this->assertCount(3, $project->tags);
    $this->assertCount(3, $project->technologies);
});
it('filters projects by category', function () {
    $category = Category::factory()->create(['name' => 'SaaS']);
    $project = Project::factory()->create();
    $project->categories()->attach($category);

    $response = $this->get('/projects?category=SaaS');

    $response->assertStatus(200);
    $response->assertSee($project->title);
});
