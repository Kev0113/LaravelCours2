<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $modelLabel = 'Evénements';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titre')
                    ->required(),
                Forms\Components\TextInput::make('content')
                    ->required(),
                Forms\Components\TextInput::make('tags')
                    ->required(),
                Forms\Components\BelongsToSelect::make('category_id')
                    ->relationship('category', 'name')
                    ->preload(),
                Forms\Components\BelongsToSelect::make('user_id')
                    ->relationship('user', 'name')
                    ->preload(),
                Forms\Components\DatePicker::make('starting_date')
                    ->required(),
                Forms\Components\DatePicker::make('ending_date')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required(),
                Forms\Components\Checkbox::make('is_public')
                    ->label('Événement privé'),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content')
                    ->wrap()
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('starting_date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ending_date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tags')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
