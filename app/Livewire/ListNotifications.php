<?php

namespace App\Livewire;

use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class ListNotifications extends Component
{
    public $notifications;

    public function mount()
    {
        // For an admin view that shows all notifications:
        $this->notifications = DatabaseNotification::all();

        // If you want to show notifications only for the logged in user,
        // you could use:
        // $this->notifications = auth()->user()->notifications;
    }

    public function render()
    {
        return view('livewire.list-notifications');
    }
}
