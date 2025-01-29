<div class="max-w-full">
    <div class="py-4" x-data="{ newComment: @entangle('newComment').defer || '' }">
        <flux:textarea 
            x-model="newComment"
            wire:model.defer="newComment" 
            placeholder="Write your comment..." 
            class="w-full"
        />

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

    <div class="space-y-6">
        @foreach ($this->comments as $comment)
            @include('livewire.comment-reply', ['comment' => $comment])
        @endforeach
    </div>
</div>
