<div>
    <!-- Post a Comment -->
    @auth
        <div class="mb-4">
            <textarea 
                wire:model="newComment" 
                rows="3" 
                class="w-full rounded-lg border-gray-300" 
                placeholder="Write your comment..."></textarea>

            @error('newComment') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror

            <button 
                wire:click="postComment" 
                class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg">
                Post Comment
            </button>
        </div>
    @endauth

    <!-- Display Comments -->
    <div class="space-y-4">
        @forelse ($comments as $comment)
            <div class="border rounded-lg p-4">
                <p class="font-semibold">{{ $comment->user->name }}</p>
                <p class="text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
                <p class="mt-2">{{ $comment->content }}</p>
            </div>
        @empty
            <p>No comments yet. Be the first to comment!</p>
        @endforelse
    </div>
</div>
