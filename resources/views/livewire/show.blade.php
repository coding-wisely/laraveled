<?php

use function Livewire\Volt\{state};
// Component state
state([
    'project' => null,
    'comments' => [],
    'comment' => '',
    'rating' => 0,
    'userRating' => 0,
]);
$addComment = function () {
    $comment = auth()->user()->comments()->create([
        'content' => state('comment'),
        'project_id' => state('project')->id,
    ]);
};
?>

<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded">
    <!-- Project Title and Description -->
    <h1 class="text-2xl font-bold">kk</h1>
    <p class="mt-4 text-gray-600">ggghhh</p>

    <!-- Comments Section -->
    <div class="mt-8">
        <h2 class="text-xl font-semibold">Leave a Comment</h2>
        <textarea wire:model="comment" class="w-full mt-2 border rounded p-2"></textarea>
        <button wire:click="addComment" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">
            Submit
        </button>
    </div>

    <!-- Display Comments -->
    <div class="mt-8">
        <h2 class="text-xl font-semibold">Comments</h2>
        <div class="mt-4 space-y-4">
            @foreach ($comments as $comment)
                <div class="p-4 bg-gray-100 rounded">
                    <p>{{ $comment->content }}</p>
                    <span class="text-sm text-gray-500">By: {{ $comment->user->name }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Rating Section -->
    <div class="mt-8">
        <h2 class="text-xl font-semibold">Rate this Project</h2>
        <div class="flex space-x-2 mt-2">
            @for ($i = 1; $i <= 5; $i++)
                <button
                    wire:click="rateProject({{ $i }})"
                    class="p-2 rounded {{ $userRating >= $i ? 'bg-yellow-400' : 'bg-gray-200' }}"
                >
                    ★
                </button>
            @endfor
        </div>
    </div>
</div>
