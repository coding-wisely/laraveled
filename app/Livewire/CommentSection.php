<?php

namespace App\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentSection extends Component
{
    public $comments;

    public $projectId;

    public $newComment = '';

    public $replyTo = null;

    public $showReplies = [];

    protected $rules = [
        'newComment' => 'required|min:3',
    ];

    public function mount($projectId)
    {
        $this->projectId = $projectId;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = Comment::where('project_id', $this->projectId)
            ->whereNull('parent_id')
            ->with(['childrenRecursive.user', 'user']) // Load all nested replies recursively
            ->orderBy('id', 'desc')
            ->get();
    }

    public function postComment()
    {
        $this->validate();

        Comment::create([
            'content' => $this->newComment,
            'user_id' => Auth::id(),
            'project_id' => $this->projectId,
        ]);

        $this->newComment = '';
        $this->replyTo = null;
        $this->loadComments();
    }

    public function submitReply($commentId, $replyText)
    {
        Comment::create([
            'project_id' => $this->projectId,
            'content' => $replyText,
            'user_id' => Auth::id(),
            'parent_id' => $commentId,
            'approved' => now(),
        ]);

        $this->newComment = '';
        $this->loadComments();
    }

    public function toggleReplies(int $commentId, bool $alwaysShow = false)
    {
        $this->loadComments();
        if (! isset($this->showReplies[$commentId])) {
            $this->showReplies[$commentId] = true;
        } else {
            if ($alwaysShow) {
                $this->showReplies[$commentId] = true; // Always show replies
            } else {
                $this->showReplies[$commentId] = ! $this->showReplies[$commentId]; // Toggle visibility
            }
        }
    }

    public function replyTo($commentId)
    {
        $this->replyTo = $commentId;
    }

    public function render()
    {
        return view('livewire.comment-section', [
            'comments' => $this->comments,
        ]);
    }
}
