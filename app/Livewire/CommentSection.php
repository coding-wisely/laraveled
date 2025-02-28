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
        $project = Project::find($this->projectId);
        $isOwner = Auth::check() && Auth::id() === $project->user_id;

        $this->comments = Comment::where('project_id', $this->projectId)
            ->whereNull('parent_id')
            ->when(! $isOwner, function ($query) {
                $query->whereNotNull('approved');
            })
            ->with(['user', 'children.user', 'children.children.user', 'parent.user'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function postComment(string $commentText)
    {
        $comment = Comment::create([
            'content' => $commentText,
            'user_id' => Auth::id(),
            'project_id' => $this->projectId,
        ]);

        $isOwner = Auth::check() && Auth::id() === Project::whereId($this->projectId)->first()->user_id;

        $text = $isOwner ? 'Your comment has been posted.' : 'Your comment has been posted. It will be visible once approved by the admin.';

        Flux::toast(
            heading: 'Comment posted',
            text: $text,
            variant: 'success',
        );

        $this->loadComments();
    }

    public function submitReply($commentId, $replyText)
    {
        $comment = Comment::create([
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
