<?php

namespace App\Livewire;

use App\Models\Bookmark as ModelsBookmark;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Bookmarks')]
class ListBookmark extends Component
{
    public $bookmarks;

    public function mount()
    {
        $this->bookmarks = ModelsBookmark::where('user_id', Auth::id())
            ->with('bookmarkable')
            ->get();
    }

    public function render()
    {
        return view('livewire.list-bookmark');
    }
}
