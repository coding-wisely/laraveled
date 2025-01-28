<div class="max-w-full">
    <!-- Post a Comment -->
    <div x-data="{ newComment: @entangle('newComment') }" class="p-4">
        <textarea 
            x-model="newComment" 
            wire:model.defer="newComment" 
            rows="3" 
            class="w-full p-3 border rounded-lg text-sm"
            placeholder="Write your comment..."></textarea>

        <button 
            @auth
                wire:click="postComment"
            @else
                wire:click="handleRedirectToLogin"
            @endauth
            class="mt-3 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium"
            :disabled="!newComment.trim()">
            Post Comment
        </button>
    </div>

    <!-- Display Comments -->
    <div class="space-y-6">
        @foreach ($this->comments as $comment)
            <div class="bg-gray-50 border rounded-lg p-4">
                <!-- Parent Comment -->
                <div class="flex items-start space-x-4">
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h4 class="text-sm font-semibold text-gray-800">{{ $comment->user?->name ?: 'Anonymous' }}</h4>
                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mt-2 text-gray-600 text-sm">{{ $comment->content }}</p>

                        <div class="mt-4" x-data="{ showReplyBox: false, replyText: '' }">
                            @auth
                                <button 
                                    @click="showReplyBox = !showReplyBox"
                                    class="text-xs text-red-500 hover:underline">
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
                                        class="mt-2 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-medium">
                                        Reply
                                    </button>
                                </div>
                            @else
                                <button 
                                    wire:click="handleRedirectToLogin"
                                    class="text-xs text-red-500 hover:underline">
                                    Login to Reply
                                </button>
                            @endauth
                        </div>

                        <!-- Show Replies Button -->
                        @if ($comment->childrenRecursive->isNotEmpty())
                            <button 
                                wire:click="toggleReplies({{ $comment->id }})"
                                class="mt-3 text-xs text-gray-500 hover:underline">
                                {{ $showReplies[$comment->id] ?? false ? 'Hide Replies' : 'Show Replies' }} ({{ $comment->childrenRecursive->count() }})
                            </button>
                        @endif

                        <!-- Replies Section -->
                        @if (isset($showReplies[$comment->id]) && $showReplies[$comment->id])
                            <div class="mt-4 space-y-4 pl-6  border-gray-200">
                                @foreach ($comment->childrenRecursive as $child)
                                    <div class="bg-gray-50 border rounded-lg p-4">
                                        <div class="flex items-start space-x-4">
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between">
                                                    <h4 class="text-sm font-semibold text-gray-800">{{ $child->user?->name ?: 'Anonymous' }}</h4>
                                                    <span class="text-xs text-gray-500">{{ $child->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="mt-2 text-gray-600 text-sm">{{ $child->content }}</p>

                                                <!-- Nested Child Reply Button -->
                                                <div class="mt-4" x-data="{ showNestedReplyBox: false, nestedReplyText: '' }">
                                                    @auth
                                                        <button 
                                                            @click="showNestedReplyBox = !showNestedReplyBox"
                                                            class="text-xs text-red-500 hover:underline">
                                                            Reply
                                                        </button>

                                                        <!-- Nested Reply Box -->
                                                        <div x-show="showNestedReplyBox" class="mt-3" x-cloak>
                                                            <textarea 
                                                                x-model="nestedReplyText" 
                                                                class="w-full p-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                                placeholder="Write your reply..."></textarea>
                                                            <button 
                                                                @click="$wire.submitReply({{ $child->id }}, nestedReplyText); showNestedReplyBox=false;"
                                                                class="mt-2 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-medium">
                                                                Reply
                                                            </button>
                                                        </div>
                                                    @else
                                                        <button 
                                                            wire:click="handleRedirectToLogin"
                                                            class="text-xs text-red-500 hover:underline">
                                                            Login to Reply
                                                        </button>
                                                    @endauth
                                                

                                                    @if ($child->children->isNotEmpty())
                                                        <button 
                                                            wire:click="toggleReplies({{ $child->id }})"
                                                            class="mt-3 text-xs text-gray-500 hover:underline">
                                                            {{ $showReplies[$child->id] ?? false ? 'Hide Replies' : 'Show Replies' }} ({{ $child->children->count() }})
                                                        </button>
                                                    @endif

                                                    @if (isset($showReplies[$child->id]) && $showReplies[$child->id])
                                                        <div class="mt-4 space-y-4 pl-6  border-gray-200">
                                                            @foreach ($child->children as $grandchild)
                                                                <div class="bg-gray-50 border rounded-lg p-4">
                                                                    <div class="flex items-start space-x-4">
                                                                        <div class="flex-1">
                                                                            <div class="flex items-center justify-between">
                                                                                <h4 class="text-sm font-semibold text-gray-800">{{ $grandchild->user?->name ?: 'Anonymous' }}</h4>
                                                                                <span class="text-xs text-gray-500">{{ $grandchild->created_at->diffForHumans() }}</span>
                                                                            </div>
                                                                            <p class="mt-2 text-gray-600 text-sm">{{ $grandchild->content }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
