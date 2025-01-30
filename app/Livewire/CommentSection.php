<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Project;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CommentSection extends Component
{
    public $comments;

    public $projectId;

    public $showReplies = [];

    public function mount($projectId)
    {

        $this->projectId = $projectId;
        $this->loadComments();
    }

    public function handleRedirectToLogin()
    {
        Session::put('url.intended', route('projects.show', Project::whereId($this->projectId)->first()->uuid));

        return redirect()->route('login');
    }

    public function loadComments()
    {
        $this->comments = Comment::where('project_id', $this->projectId)
            ->whereNull('parent_id')
            // ->whereNotNull('approved') need to uncomment this later once we are happy with the testing to show only approved ones
            ->with(['user', 'children.user', 'children.children.user', 'parent.user'])
            ->orderBy('id', 'desc')
            ->get();

    }

    public function postComment(string $commentText)
    {
        Comment::create([
            'content' => $commentText,
            'user_id' => Auth::id(),
            'project_id' => $this->projectId,
        ]);

        Flux::toast(
            heading: 'Comment posted',
            text: 'Your comment has been posted.',
            variant: 'success',
        );

        $this->loadComments();
    }

    public function submitReply($commentId, $replyText)
    {
        Comment::create([
            'project_id' => $this->projectId,
            'content' => $replyText,
            'user_id' => Auth::id(),
            'parent_id' => $commentId,
        ]);

        $this->loadComments();
    }

    public function toggleReplies(int $commentId, bool $alwaysShow = false)
    {
        $this->loadComments();
        if (! isset($this->showReplies[$commentId])) {
            $this->showReplies[$commentId] = true;
        } else {
            if ($alwaysShow) {
                $this->showReplies[$commentId] = true;
            } else {
                $this->showReplies[$commentId] = ! $this->showReplies[$commentId];
            }
        }
    }

    public function render()
    {
        return view('livewire.comment-section', [
            'comments' => $this->comments,
        ]);
    }
}
