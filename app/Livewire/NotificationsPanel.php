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
        // Initialize as an empty collection to avoid undefined variable errors
        $this->notifications = collect();

        if (Auth::check()) {
            $this->notifications = Auth::user()->unreadNotifications()->latest()->get();
        }
    }

    /**
     * This hook is called when isOpen changes.
     */
    public function updatedIsOpen($value)
    {
        if ($value && Auth::check()) {
            // Refresh the notifications when the panel opens
            $this->notifications = Auth::user()->unreadNotifications()->latest()->get();
        }
    }

    /**
     * Mark a single notification as read.
     */
    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
        }
        // Refresh the notifications list
        $this->notifications = Auth::user()->unreadNotifications()->latest()->get();
    }

    /**
     * Mark all notifications as read.
     */
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
