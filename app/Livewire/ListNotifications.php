<?php

namespace App\Livewire;

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ListNotifications extends Component
{
    public $notifications;

    public function mount()
    {
        // For an admin view that shows all notifications:
        $this->notifications = Auth::user()->notifications()->get();
        // If you want to show notifications only for the logged in user,
        // you could use:
        // $this->notifications = auth()->user()->notifications;
    }

    public function markAllAsRead()
    {
        if (auth()->check()) {
            auth()->user()->unreadNotifications->markAsRead();
            // Optionally, refresh the notifications list:
            $this->notifications = auth()->user()->notifications;
        }
    }

    public function markAsRead($notificationId)
    {
        if (auth()->check()) {
            $notification = auth()->user()->notifications()->where('id', $notificationId)->first();
            if ($notification && ! $notification->read_at) {
                $notification->markAsRead();
            }
            // Optionally, refresh the notifications list:
            $this->notifications = auth()->user()->notifications;

            Flux::toast(
                heading: 'Notification marked as read',
                text: 'The notification has been marked as read successfully.',
                variant: 'success'
            );
        }
    }

    public function clear($notificationId)
    {
        if (auth()->check()) {
            $notification = auth()->user()->notifications()->where('id', $notificationId)->first();
            if ($notification) {
                $notification->delete();
            }
            // Optionally, refresh the notifications list:
            $this->notifications = auth()->user()->notifications;

            Flux::toast(
                heading: 'Notification deleted',
                text: 'The notification has been deleted successfully.',
                variant: 'success'
            );
        }
    }

    public function render()
    {
        return view('livewire.list-notifications');
    }
}
