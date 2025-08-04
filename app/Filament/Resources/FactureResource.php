<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FactureResource\Pages;
use App\Filament\Resources\FactureResource\RelationManagers;
use App\Models\Facture;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FactureResource extends Resource
{
    protected static ?string $model = Facture::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('depense_id')
                ->relationship('depense', 'libelle')
                ->searchable()
                ->preload()
                ->required(),

                Forms\Components\TextInput::make('numero')
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('fichier')
                ->required()
                ->maxLength(255),

                Forms\Components\DatePicker::make('date')
                ->required(),

                Forms\Components\TextInput::make('montant')
                ->required()
                ->suffix('FCFA')
                ->maxLength(255),

                Forms\Components\TextInput::make('fournisseur')
                ->required()
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('depense.libelle'),
                Tables\Columns\TextColumn::make('numero'),
                Tables\Columns\TextColumn::make('fichier'),
                Tables\Columns\TextColumn::make('date'),
                Tables\Columns\TextColumn::make('montant'),
                Tables\Columns\TextColumn::make('fournisseur'),
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
            'index' => Pages\ListFactures::route('/'),
            'create' => Pages\CreateFacture::route('/create'),
            'edit' => Pages\EditFacture::route('/{record}/edit'),
        ];
    }
}
