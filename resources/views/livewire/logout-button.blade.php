<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};
?>

<div>
    <flux:menu.item icon="arrow-right-start-on-rectangle" wire:click="logout()">Logout</flux:menu.item>
</div>
