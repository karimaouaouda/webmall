<?php

namespace App\Filament\Seller\Resources;

use App\Filament\Seller\Resources\AnalyticResource\Pages;
use App\Filament\Seller\Resources\AnalyticResource\RelationManagers;
use App\Models\Analytics\Visit;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnalyticResource extends Resource
{
    protected static ?string $model = Visit::class;


    public static function canAccess(): bool
    {
        $user = Filament::auth()->user();
        return $user->has_shop && $user->shop->isPublished();
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = "Shop";

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
            'index' => Pages\ListAnalytics::route('/'),
            'create' => Pages\CreateAnalytic::route('/create'),
            'edit' => Pages\EditAnalytic::route('/{record}/edit'),
        ];
    }
}
