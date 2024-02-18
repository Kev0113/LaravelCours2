<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OpinionResource\Pages;
use App\Filament\Resources\OpinionResource\RelationManagers;
use App\Models\Opinion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OpinionResource extends Resource
{
    protected static ?string $model = Opinion::class;

    protected static ?string $modelLabel = 'Avis';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('text')
                    ->label('Commentaire')
                    ->required(),
                Forms\Components\TextInput::make('rate')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->label('Note')
                    ->required(),
                Forms\Components\BelongsToSelect::make('user_id')
                    ->label('Utilisateur')
                    ->relationship('user', 'name')
                    ->preload(),
                Forms\Components\BelongsToSelect::make('event_id')
                    ->label('Evenement')
                    ->relationship('event', 'title')
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('text')
                    ->label('Commentaire'),
                Tables\Columns\TextColumn::make('rate')
                    ->label('Note'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User Name'),
                Tables\Columns\TextColumn::make('event.title')
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
            'index' => Pages\ListOpinions::route('/'),
            'create' => Pages\CreateOpinion::route('/create'),
            'edit' => Pages\EditOpinion::route('/{record}/edit'),
        ];
    }
}
