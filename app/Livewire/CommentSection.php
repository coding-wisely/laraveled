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

    protected $rules = [
        'newComment' => 'required|min:3',
    ];

    public function mount($projectId)
    {
        $this->projectId = $projectId;
        $this->comments = Comment::where('project_id', $projectId)
            ->whereNull('parent_id')
            ->with('children', 'user')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function replyToComment($commentId)
    {
        $this->replyTo = $commentId;
    }

    public function postComment()
    {
        $this->validate();

        Comment::create([
            'project_id' => $this->projectId,
            'content' => $this->newComment,
            'user_id' => Auth::id(),
            'parent_id' => $this->replyTo,
            'approved' => true,
        ]);

        $this->newComment = '';
        $this->replyTo = null;

        $this->comments = Comment::where('project_id', $this->projectId)
            ->whereNull('parent_id')
            ->with('children', 'user')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.comment-section', [
            'comments' => $this->comments,
        ]);
    }
}
