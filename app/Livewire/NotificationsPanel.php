<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationsPanel extends Component
{
    public Collection $notifications;

    public $isOpen = false;

    public function mount()
    {
        $this->notifications = collect();

        if (Auth::check()) {
            $this->notifications = Auth::user()->unreadNotifications()->latest()->get();
        }
    }

    public function updatedIsOpen($value)
    {
        if ($value && Auth::check()) {
            $this->notifications = Auth::user()->unreadNotifications()->latest()->get();
        }
    }

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
        }
        $this->notifications = Auth::user()->unreadNotifications()->latest()->get();
    }

    public function markAllAsRead()
    {
        if (Auth::check()) {
            Auth::user()->unreadNotifications()->update(['read_at' => now()]);
            $this->notifications = Auth::user()->unreadNotifications()->latest()->get();
        }
    }

    public function render()
    {
        return view('livewire.notifications-panel');
    }
}
