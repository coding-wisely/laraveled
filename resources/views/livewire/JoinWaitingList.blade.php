<?php

use function Livewire\Volt\{form, state};

use App\Livewire\Forms\JoinWaitingListForm;

state([
    'showForm' => true
]);

form(JoinWaitingListForm::class);

$save = function () {

    $this->form->store();
};

?>
<div
    class="fixed bg-gray-900 z-50 bottom-16 left-1/2 transform -translate-x-1/2 shadow-md p-4 w-full max-w-lg rounded-lg border border-gray-500">
    <div>
        <div>
            @if ($this->showForm)
                <form action="">
                    <flux:input.group>
                        <flux:input
                            placeholder="Please enter your email address"
                            wire:model="form.email"
                            class:input="!bg-zinc-800 !text-gray-300 border-gray-200 focus:border-gray-300 focus:bg-gray-700 focus:ring-0"
                            class="!bg-zinc-800  border-gray-200 focus:border-gray-300 focus:bg-white focus:ring-0"
                            type="email"
                        />
                        <flux:button
                            icon="envelope"
                            class="!bg-zinc-800 !text-gray-300 border-gray-200 focus:border-gray-300 focus:bg-gray-700 focus:ring-0"
                            wire:click="save">I want to be Laraveled
                        </flux:button>
                    </flux:input.group>
                </form>

            @else
                <div class="text-center p-2 ease-in-out duration-300">
                    We will let you know when we launch!
                </div>
            @endif
        </div>
    </div>
</div>

