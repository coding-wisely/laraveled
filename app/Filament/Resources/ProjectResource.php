<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->rules('string|max:255'),

                Group::make([
                    Forms\Components\RichEditor::make('description')
                        ->required()
                        ->rules('string')
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('short_description')
                        ->required()
                        ->rules('string|max:255'),
                ])->columnSpanFull(),

                Forms\Components\TextInput::make('website_url')
                    ->required()
                    ->rules('string|max:255'),

                Forms\Components\TextInput::make('github_url')
                    ->required()
                    ->rules('string|max:255'),

                Section::make([
                    Forms\Components\Select::make('technologies')
                        ->multiple()
                        ->relationship('technologies', 'name')
                        ->required()
                        ->rules('array'),

                    Forms\Components\Select::make('categories')
                        ->multiple()
                        ->relationship('categories', 'name')
                        ->required()
                        ->rules('array'),

                    Forms\Components\Select::make('tags')
                        ->multiple()
                        ->preload()
                        ->relationship('tags', 'name')
                        ->rules('array'),

                ])->columns(3)->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('media')
                    ->multiple()
                    ->image()
                    ->panelLayout('grid')
                    ->maxFiles(3)
                    ->maxSize(1024 * 3024)
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                SpatieMediaLibraryImageColumn::make('media')
                    ->collection('projects')
                    ->circular()
                    ->label('Image'),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('website_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('github_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('short_description')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('views')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_featured'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
