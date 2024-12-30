<?php

use function Livewire\Volt\{form, state};

use App\Livewire\Forms\JoinWaitingListForm;

state([
    'showForm' => true,
    'message' => '',
]);

form(JoinWaitingListForm::class);

$save = function () {
    $subscribed = $this->form->store(); // Assuming store returns true if successful, false otherwise or if already subscribed

    if ($subscribed === 'already_subscribed') {
        $this->message = 'You are already subscribed. We will notify you when we launch!';
        $this->showForm = false;
    } elseif ($subscribed) {
        $this->message = 'We will let you know when we launch!';
        $this->showForm = false;
    } else {
        // Handle other potential outcomes, like validation errors
        $this->message = 'An error occurred. Please try again later.';
    }

};

?>

<div class="fixed bg-gray-900 z-50 bottom-16 shadow-md p-4 w-full max-w-lg rounded-lg border border-gray-500">
    <div>
        @if ($showForm)
            <flux:input.group>
                <flux:input
                    placeholder="Please enter your email address"
                    size="sm"
                    wire:model="form.email"
                    class:input="!bg-zinc-800 !text-gray-300 !placeholder:text-xs border-gray-200 focus:border-gray-300 focus:bg-gray-700 focus:ring-0"
                    class="!bg-zinc-800  border-gray-200 focus:border-gray-300 focus:bg-white focus:ring-0"
                    type="email"
                />
                <flux:button
                    icon="envelope"
                    size="sm"
                    class="!bg-zinc-800 !text-gray-300 border-gray-200 focus:border-gray-300 focus:bg-gray-700 focus:ring-0"
                    wire:click="save">I want to be Laraveled
                </flux:button>
            </flux:input.group>
        @else
            <div class="text-center p-2 ease-in-out duration-300">
                {{ $message }}
            </div>
        @endif
    </div>
</div>
