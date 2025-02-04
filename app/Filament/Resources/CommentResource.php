<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction as ActionsViewAction;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('project_id')
                    ->relationship('project', 'title')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                DateTimePicker::make('approved')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.title')->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('approved')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])->defaultSort('created_at', 'desc')
            ->filters([

            ])
            ->actions([
                ActionsViewAction::make(),
                Action::make('approve')
                    ->label('Approve')
                    ->action(fn (Comment $record) => $record->update(['approved' => now()]))
                    ->requiresConfirmation()
                    ->modalHeading(fn (Comment $record) => new HtmlString("Approve Comment by {$record->user->name}"))
                    ->modalContent(fn (Comment $record) => new HtmlString(
                        '<div class="text-2xl font-semibold text-center p-4 text-black">'
                         ."<em> \"{$record->content}\" </em>"
                        .'</div>'
                    ))
                    ->hidden(fn (Comment $record) => $record->approved !== null),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
        ];
    }
}
