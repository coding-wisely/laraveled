<?php

namespace App\Filament\Resources\TechnologyResource\Pages;

use App\Filament\Resources\TechnologyResource;
use App\Models\Technology;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateTechnology extends CreateRecord
{
    protected static string $resource = TechnologyResource::class;

    protected function beforeValidate(): void
    {
        if (Technology::where('name', ucfirst($this->data['name']))->exists()) {
            Notification::make()
                ->title('Name already exists')
                ->danger()
                ->body('The name you entered already exists. Please enter a different name.')
                ->send();

            $this->halt();
        }
    }
}
