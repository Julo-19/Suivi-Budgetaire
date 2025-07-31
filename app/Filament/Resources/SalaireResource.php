<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalaireResource\Pages;
use App\Filament\Resources\SalaireResource\RelationManagers;
use App\Models\Salaire;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\TextEntry;

class SalaireResource extends Resource
{
    protected static ?string $model = Salaire::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('personnel_id')
                ->relationship('personnel', 'name')
                ->searchable()
                ->preload()
                ->required(),
                Forms\Components\Select::make('mois')
                ->options([
                    'janvier' => 'Janvier',
                    'fevrier' => 'Fevrier',
                    'mars' => 'Mars',
                    'avril' => 'Avril',
                    'mai' => 'Mai',
                    'juin' => 'Juin',
                    'juillet' => 'Juillet',
                    'aout' => 'Aout',
                    'septembre' => 'Septembre',
                    'octobre' => 'Octobre',
                    'novembre' => 'Novembre',
                    'decembre' => 'Decembre',
                ]),

                Forms\Components\TextInput::make('net_a_payer')
                ->label('Salaire')
                ->numeric()
                ->suffix('FCFA')
                ->required()

    

                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('personnel.name')
                ->label('Nom du personnel'),
                Tables\Columns\TextColumn::make('mois'),
                Tables\Columns\TextColumn::make('net_a_payer')
                ->label('Salaire')
                ->suffix(' FCFA'), 
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
            'index' => Pages\ListSalaires::route('/'),
            'create' => Pages\CreateSalaire::route('/create'),
            'edit' => Pages\EditSalaire::route('/{record}/edit'),
        ];
    }

}
