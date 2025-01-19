<?php

use Flux\Flux;
use function Livewire\Volt\{form, on, state};

use App\Livewire\Forms\JoinWaitingListForm;

// Define state variables
state([
    'showForm' => true,
    'message' => '',
]);

// Attach the form
form(JoinWaitingListForm::class);

// Save function
$save = function () {
    $subscribed = $this->form->store();

    if ($subscribed === 'already_subscribed') {

        Flux::toast(
            heading: 'You are already subscribed',
            text: 'Dont worry! We will notify you when we launch!',
            variant: 'warning',
        );
        $this->showForm = false;

        // Schedule clearing the message
    } elseif ($subscribed) {
        Flux::toast(
            heading: 'Thank you',
            text: 'We will notify you when we launch!',
            variant: 'success',
        );
        $this->showForm = false;
    } else {
        Flux::toast(
            heading: 'Whooops!',
            text: 'We broke something! Sorry! Please try again later.',
            variant: 'danger',
        );
    }
};

?>


<div class="absolute flex !w-screen border-gray-50 bg-transparent top-0 justify-center !z-50" style="height: 2100px">
    <div @click.away="isFocused = true; $nextTick(() => $refs.email.focus())"
         class="fixed top-24 bg-gray-600 z-50 shadow-md p-2 w-full max-w-lg md:rounded-lg">
        <div>
                <form wire:submit="save">
                    <flux:input.group>
                        <flux:input
                            autocomplete="off"
                            x-ref="email"
                            placeholder="Email to notify you when we launch"
                            size="sm"
                            autofocus
                            wire:model="form.email"
                            class:input="!text-white !bg-laravel-800 !pl-3 !border-gray-50 !overflow-hidden placeholder:!text-white placeholder:pl-1 placeholder:text-sm focus:placeholder:!text-gray-50 border focus:!border-gray-300 focus:!bg-gray-700 focus:ring-0"
                            type="email"
                        />
                        <flux:button
                            icon="envelope"
                            size="sm"
                            class="!bg-laravel-600 !text-gray-100 !border-gray-50 focus:border-gray-300 focus:bg-gray-700 focus:!ring-0"
                            wire:click="save">
                            I want to be Laraveled
                        </flux:button>
                    </flux:input.group>
                </form>

        </div>
    </div>
</div>
