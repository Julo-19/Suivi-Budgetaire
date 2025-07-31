<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EntretientResource\Pages;
use App\Filament\Resources\EntretientResource\RelationManagers;
use App\Models\Entretient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EntretientResource extends Resource
{
    protected static ?string $model = Entretient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListEntretients::route('/'),
            'create' => Pages\CreateEntretient::route('/create'),
            'edit' => Pages\EditEntretient::route('/{record}/edit'),
        ];
    }
}
