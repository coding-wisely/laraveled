<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentSection extends Component
{
    public $comments;        // Parent comments with children

    public $projectId;       // Project ID for the comments

    public $newComment = ''; // Content of the new parent comment

    public $replyContent = '';

    public $replyTo = null;  // ID of the comment being replied to

    public $showReplies = []; // Tracks which comments have their replies shown

    protected $rules = [
        'newComment' => 'required|min:3',
    ];

    public function mount($projectId)
    {
        $this->projectId = $projectId;
        $this->loadComments();
    }

    private function loadComments()
    {
        $this->comments = Comment::where('project_id', $this->projectId)
            ->whereNull('parent_id')
            ->with(['children.user', 'user']) // Eager load user and children relationships
            ->orderBy('id', 'desc')
            ->get();
    }

    public function postComment()
    {
        $this->validateOnly('newComment');

        // Create a new parent comment
        Comment::create([
            'project_id' => $this->projectId,
            'content' => $this->newComment,
            'user_id' => Auth::id(),
            'approved' => now(),
        ]);

        $this->newComment = ''; // Clear input field
        $this->loadComments(); // Reload comments
    }

    public function submitReply($commentId, $replyText)
    {
        // Create a new reply
        Comment::create([
            'project_id' => $this->projectId,
            'content' => $replyText,
            'user_id' => Auth::id(),
            'parent_id' => $commentId,
            'approved' => now(),
        ]);

        $this->replyContent = '';
        $this->loadComments();
    }

    public function toggleReplies(int $commentId, bool $alwaysShow = false)
    {
        $this->loadComments();
        if (! isset($this->showReplies[$commentId])) {
            $this->showReplies[$commentId] = true; // Show replies for the first time
        } else {
            if ($alwaysShow) {
                $this->showReplies[$commentId] = true; // Always show replies
            } else {
                $this->showReplies[$commentId] = ! $this->showReplies[$commentId]; // Toggle visibility
            }
        }
    }

    public function render()
    {
        return view('livewire.comment-section');
    }
}
