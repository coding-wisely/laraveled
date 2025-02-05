<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'approved' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNotNull('approved')),
            'unapproved' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('approved')),
        ];
    }
}
