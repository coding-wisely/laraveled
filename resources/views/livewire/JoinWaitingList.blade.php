<?php

use function Livewire\Volt\{form, state};

use App\Livewire\Forms\JoinWaitingListForm;

state([
    'showForm' => true
]);

form(JoinWaitingListForm::class);

$save = function () {
    $this->form->validate();
    $this->form->store();
    $this->showForm = false;
};

?>
<div
    class="fixed bg-gray-800 z-50 bottom-16 left-1/2 transform -translate-x-1/2 shadow-md p-4 w-full max-w-lg rounded-lg border border-gray-200">
    <div>
        <div>
            @if ($this->showForm)
                <flux:input.group>
                    <flux:input
                        placeholder="Please enter your email address"
                        wire:model="email"
                        type="email"
                        />
                    <flux:button
                        icon="envelope"
                        wire:click="save">I want to get Laraveled
                    </flux:button>
                </flux:input.group>
                <flux:error name="form.email"/>
            @else
                <div class="text-center p-2 ease-in-out duration-300">
                    We will let you know when we launch!
                </div>
            @endif
        </div>
    </div>
</div>

