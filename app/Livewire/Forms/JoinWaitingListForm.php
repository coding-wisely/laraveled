<?php

namespace App\Livewire\Forms;

use App\Models\JoinWaitingList;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JoinWaitingListForm extends Form
{
    #[Validate(['required', 'email', 'max:254'])]
    public $email = '';

    public function store()
    {
        $this->validate();

        $existing = JoinWaitingList::where('email', $this->email)->first();

        if ($existing) {
            return 'already_subscribed';
        } else {
            JoinWaitingList::create($this->pull()); // Use $this->form here
            return true;
        }
    }
}
