<div class="max-w-full mt-8">
    <!-- Post a Comment -->
    @auth
        <div class="mb-6 bg-white shadow rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-700">Leave a Comment</h3>
            <textarea 
                wire:model="newComment" 
                rows="3" 
                class="w-full mt-2 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                placeholder="Write your comment..."></textarea>
            
            @error('newComment') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror

            <button 
                wire:click="postComment" 
                class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium">
                Post Comment
            </button>
        </div>
    @endauth

    <!-- Display Comments -->
    <div class="space-y-6">
        @forelse ($this->comments as $comment)
            <div class="bg-gray-50 border rounded-lg p-4">
                <!-- Parent Comment -->
                <div class="flex items-start space-x-4">
                   
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h4 class="text-sm font-semibold text-gray-800">{{ $comment->user?->name ?: 'Anonymous' }}</h4>
                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mt-2 text-gray-600 text-sm">{{ $comment->content }}</p>

                        <!-- Reply Button -->
                        <div class="mt-4" x-data="{ showReplyBox: false }">
                            <button 
                                @click="showReplyBox = !showReplyBox"
                                class="text-sm text-blue-500 hover:underline">
                                Reply
                            </button>

                            <!-- Reply Box -->
                            <div x-show="showReplyBox" class="mt-3" x-cloak>
                                <textarea 
                                    x-model="replyText" 
                                    class="w-full p-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Write your reply..."></textarea>
                                <button 
                                    @click="$wire.submitReply({{ $comment->id }}, replyText); showReplyBox=false;"
                                    class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-medium">
                                    Reply
                                </button>
                            </div>
                        </div>

                        <!-- Show Replies Button -->
                        @if ($comment->children->isNotEmpty())
                            <button 
                                wire:click="toggleReplies({{ $comment->id }})"
                                class="mt-3 text-sm text-gray-500 hover:underline">
                                {{ $showReplies[$comment->id] ?? false ? 'Hide Replies' : 'Show Replies' }} ({{ $comment->children->count() }})
                            </button>
                        @endif

                        <!-- Replies Section -->
                        @if (isset($showReplies[$comment->id]) && $showReplies[$comment->id])
                            <div class="mt-4 space-y-4 pl-6 border-l-2 border-gray-200">
                                @foreach ($comment->children as $reply)
                                    <div class="flex items-start space-x-4">
                                      
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <h4 class="text-sm font-semibold text-gray-800">{{ $reply->user?->name ?: 'Anonymous' }}</h4>
                                                <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="mt-2 text-gray-600 text-sm">{{ $reply->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-left">No comments yet. Be the first to comment!</p>
        @endforelse
    </div>
</div>