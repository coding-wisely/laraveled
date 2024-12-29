<?php

namespace App\Livewire\Forms;

use App\Models\JoinWaitingList;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JoinWaitingListForm extends Form
{
    #[Validate(['required', 'email', 'max:254'])]
    public $email = '';

    public function store(): void
    {
        $this->validate();
        JoinWaitingList::updateOrCreate($this->pull());
    }
}
