<div class="max-w-full">
    <!-- Post a Comment -->
    <div class="py-4" x-data="{ newComment: @entangle('newComment').defer }">
    <!-- Livewire Flux Input -->
        <flux:textarea 
            x-model="newComment"
            wire:model.defer="newComment" 
            placeholder="Write your comment..." 
            class="w-full"
        />

        <!-- Livewire Flux Button -->
        <div class="flex justify-start mt-3">
            <flux:button 
                wire:click="postComment"
                color="danger"
                x-bind:disabled="newComment.trim() === ''"
            >
                Post Comment
            </flux:button>
        </div>
    </div>


    <!-- Display Comments -->
    <div class="space-y-6">
        @foreach ($this->comments as $comment)
            <div class=" border rounded-lg p-4">
                <!-- Parent Comment -->
                <div class="flex items-start space-x-4">
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h4 class="text-sm font-semibold ">{{ $comment->user?->name ?: 'Anonymous' }}</h4>
                            <span class="text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mt-2  text-sm">{{ $comment->content }}</p>

                        <div class="mt-4" x-data="{ showReplyBox: false, replyText: '' }">
                            @auth
                                <flux:link 
                                    @click="showReplyBox = !showReplyBox"
                                    class="text-xs cursor-pointer">
                                    Reply
                                </flux:link>

                                <!-- Reply Box -->
                                <div x-show="showReplyBox" class="mt-3" x-cloak>
                                    <flux:textarea 
                                        x-model="replyText" 
                                        placeholder="Write your reply..."></flux:textarea>
                                    <flux:button 
                                        @click="$wire.submitReply({{ $comment->id }}, replyText); showReplyBox=false;"
                                        class="mt-2">
                                        Post Reply
                                    </flux:button>
                                </div>
                            @else
                                <flux:link 
                                    wire:click="handleRedirectToLogin"
                                    class="text-xs cursor-pointer">
                                    Login to Reply
                                </flux:link>
                            @endauth
                            <!-- Show Replies Button -->
                            @if ($comment->childrenRecursive->isNotEmpty())
                                <flux:link 
                                    wire:click="toggleReplies({{ $comment->id }})"
                                    class="text-xs cursor-pointer ml-2">
                                    {{ $showReplies[$comment->id] ?? false ? 'Hide Replies' : 'Show Replies' }} ({{ $comment->childrenRecursive->count() }})
                                </flux:link>
                            @endif
                        </div>

                        <!-- Replies Section -->
                        @if (isset($showReplies[$comment->id]) && $showReplies[$comment->id])
                            <div class="mt-2 space-y-4">
                                @foreach ($comment->childrenRecursive as $child)
                                    <div >
                                        <div class="flex items-start space-x-4">
                                            <div class="flex-1">
                                                <span class="text-xs">Replying to {{ $comment->user?->name ?: 'Anonymous' }}</span>
                                                <div class="flex items-center justify-between">
                                                    <h4 class="text-sm font-semibold">{{ $child->user?->name ?: 'Anonymous' }}</h4>
                                                    <span class="text-xs ">{{ $child->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="mt-2 text-sm">{{ $child->content }}</p>

                                                <div class="mt-2" x-data="{ showNestedReplyBox: false, nestedReplyText: '' }">
                                                    @auth
                                                        <flux:link 
                                                            @click="showNestedReplyBox = !showNestedReplyBox"
                                                            class="text-xs cursor-pointer">
                                                            Reply
                                                        </flux:link>

                                                        <div x-show="showNestedReplyBox" class="mt-3" x-cloak>
                                                            <flux:textarea 
                                                                x-model="nestedReplyText" 
                                                                placeholder="Write your reply..."></flux:textarea>
                                                            <flux:button 
                                                                @click="$wire.submitReply({{ $child->id }}, nestedReplyText); showNestedReplyBox=false;"
                                                                class="mt-2">
                                                                Post Reply
                                                            </flux:button>
                                                        </div>
                                                    @else
                                                        <flux:link 
                                                            wire:click="handleRedirectToLogin"
                                                            class="text-xs cursor-pointer"
                                                            >
                                                            Login to Reply
                                                        </flux:link>
                                                    @endauth
                                                
                                                    @if ($child->children->isNotEmpty())
                                                        <flux:link 
                                                            wire:click="toggleReplies({{ $child->id }})"
                                                            class="ml-3 cursor-pointer text-xs">
                                                            {{ $showReplies[$child->id] ?? false ? 'Hide Replies' : 'Show Replies' }} ({{ $child->children->count() }})
                                                        </flux:link>
                                                    @endif

                                                    @if (isset($showReplies[$child->id]) && $showReplies[$child->id])
                                                        <div class="mt-4 space-y-4 border-gray-200">
                                                            @foreach ($child->children as $grandchild)
                                                                <div >
                                                                    <div class="flex items-start">
                                                                        <div class="flex-1">
                                                                        <span class="text-xs">Replying to {{ $child->user?->name ?: 'Anonymous' }}</span>

                                                                            <div class="flex items-center justify-between">
                                                                                <h4 class="text-sm font-semibold">{{ $grandchild->user?->name ?: 'Anonymous' }}</h4>
                                                                                <span class="text-xs ">{{ $grandchild->created_at->diffForHumans() }}</span>
                                                                            </div>
                                                                            <p class="mt-2  text-sm">{{ $grandchild->content }}</p>
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
