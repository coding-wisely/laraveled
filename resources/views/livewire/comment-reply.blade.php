@if ($comment->parent_id == null)
    <div class="border rounded-lg p-4">
@endif

    <!-- Comment Content -->
    <div class="flex items-start space-x-4">
        <div class="flex-1">
            @if ($comment->parent_id)
                <span class="text-xs">
                    Replying to {{ $comment->parent->user?->name ?: 'Anonymous' }}
                </span>
            @endif

            <div class="flex items-center justify-between">
                <h4 class="text-sm font-semibold">{{ $comment->user?->name ?: 'Anonymous' }}</h4>
                <span class="text-xs">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <p class="mt-2 text-sm">{{ $comment->content }}</p>

            <div class="mt-4" x-data="{ showReplyBox: false, replyText: '' }">
                @auth
                    <flux:link @click="showReplyBox = !showReplyBox" class="text-xs cursor-pointer">
                        Reply
                    </flux:link>

                    <div x-show="showReplyBox" class="mt-3" x-cloak>
                        <flux:textarea x-model="replyText" placeholder="Write your reply..."></flux:textarea>
                        <flux:button @click="$wire.submitReply({{ $comment->id }}, replyText); showReplyBox=false;" class="mt-2">
                            Post Reply
                        </flux:button>
                    </div>
                @else
                    <flux:link wire:click="handleRedirectToLogin" class="text-xs cursor-pointer">
                        Login to Reply
                    </flux:link>
                @endauth

                @if ($comment->children->isNotEmpty())
                    <flux:link wire:click="toggleReplies({{ $comment->id }})" class="ml-3 cursor-pointer text-xs">
                        {{ $showReplies[$comment->id] ?? false ? 'Hide Replies' : 'Show Replies' }} ({{ $comment->children->count() }})
                    </flux:link>
                @endif
            </div>

            @if (isset($showReplies[$comment->id]) && $showReplies[$comment->id])
                <div class="mt-4 space-y-4">
                    @foreach ($comment->children as $child)
                        @include('livewire.comment-reply', ['comment' => $child])
                    @endforeach
                </div>
            @endif
        </div>
    </div>

@if ($comment->parent_id == null)
    </div>
@endif
