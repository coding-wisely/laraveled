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

                <div class="mt-2" x-data="{ showReplyBox: false, replyText: '' }">
                    <button 
                        @click="showReplyBox = !showReplyBox"
                        class="text-sm text-blue-500 hover:underline">
                        Reply
                    </button>

                    <div x-show="showReplyBox" class="mt-2">
                        <textarea 
                            x-model="replyText" 
                            class="w-full border rounded p-2 text-sm"
                            placeholder="Write your reply..."></textarea>
                        <button 
                            @click="$wire.submitReply({{ $comment->id }}, replyText); showReplyBox=false; $wire.toggleReplies({{ $comment->id }}, true)"
                            class="mt-1 px-3 py-1 bg-blue-500 text-white rounded text-sm">
                            Submit Reply
                        </button>
                    </div>
                </div>

                @if ($comment->children->isNotEmpty())
                    <button 
                        wire:click="toggleReplies({{ $comment->id }})"
                        class="mt-4 text-sm text-gray-500 hover:underline">
                        {{ $showReplies[$comment->id] ?? false ? 'Hide Replies' : 'Show Replies' }}
                    </button>
                @endif

                @if (isset($showReplies[$comment->id]) && $showReplies[$comment->id])
                    <div class="mt-4 ml-6 border-l pl-4">
                        @foreach ($comment->children as $reply)
                            <div class="mt-2">
                                <p class="font-semibold">{{ $reply->user->name }}</p>
                                <p class="text-gray-600">{{ $reply->created_at->diffForHumans() }}</p>
                                <p class="mt-2">{{ $reply->content }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <p>No comments yet. Be the first to comment!</p>
        @endforelse
    </div>
</div>