<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    protected function beforeValidate(): void
    {
        if (Category::where('name', ucfirst($this->data['name']))->exists()) {
            Notification::make()
                ->title('Name already exists')
                ->danger()
                ->body('The name you entered already exists. Please enter a different name.')
                ->send();

            $this->halt();
        }
    }
}
