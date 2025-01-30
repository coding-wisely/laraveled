<div class="max-w-full" x-data="{ commentText: localStorage.getItem('commentText') || '' }">
    <div class="py-4">
        <flux:textarea 
            x-model="commentText"
            placeholder="Write your comment..." 
            class="w-full"
            @input="localStorage.setItem('commentText', commentText)"
        />

        <div class="flex justify-start mt-3">
            @auth
                <flux:button 
                    @click="$wire.postComment(commentText).then(() => { 
                        commentText = ''; 
                        localStorage.removeItem('commentText'); 
                    })"
                    color="danger"
                >
                    Post Comment
                </flux:button>
            @else
                <flux:button 
                    @click="localStorage.setItem('commentText', commentText); $wire.handleRedirectToLogin()"
                    color="danger"
                >
                    Login to Comment
                </flux:button>
            @endauth
        </div>
    </div>

    <div class="space-y-6">
        @foreach ($this->comments as $comment)
            @include('livewire.comment-reply', ['comment' => $comment])
        @endforeach
    </div>
</div>