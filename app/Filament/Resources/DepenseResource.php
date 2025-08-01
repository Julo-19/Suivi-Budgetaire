<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepenseResource\Pages;
use App\Filament\Resources\DepenseResource\RelationManagers;
use App\Models\Depense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepenseResource extends Resource
{
    protected static ?string $model = Depense::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('categorie_id')
                ->relationship('categorie', 'nom')
                ->searchable()
                ->preload()
                ->required(),

                Forms\Components\Select::make('personnel_id')
                ->relationship('personnel', 'name')
                ->searchable()
                ->preload()
                ->required(),

                Forms\Components\TextInput::make('libelle')
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('montant')
                ->required()
                ->suffix('FCFA')
                ->maxLength(255),

                Forms\Components\DatePicker::make('date_depense')
                ->required(),

                Forms\Components\TextInput::make('mois')
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('annee')
                ->label('Année')
                ->required()
                ->numeric()
                ->minValue(1900)
                ->maxValue(2100),

            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('categories.nom'),
                Tables\Columns\TextColumn::make('personnel.name'),
                Tables\Columns\TextColumn::make('libelle'),
                Tables\Columns\TextColumn::make('montant')
                ->suffix(' FCFA'), 
                Tables\Columns\TextColumn::make('date_depense'),
                Tables\Columns\TextColumn::make('mois'),
                Tables\Columns\TextColumn::make('annee'),
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
            'index' => Pages\ListDepenses::route('/'),
            'create' => Pages\CreateDepense::route('/create'),
            'edit' => Pages\EditDepense::route('/{record}/edit'),
        ];
    }
}
