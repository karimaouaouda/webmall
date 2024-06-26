<?php

namespace App\Filament\Seller\Resources;

use App\Filament\Seller\Resources\VisitResource\Pages;
use App\Filament\Seller\Resources\VisitResource\RelationManagers;
use App\Models\Analytics\Visit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisitResource extends Resource
{
    protected static ?string $model = Visit::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    protected static ?string $navigationGroup = 'Strategy';

    public static function canView(Model $record): bool
    {
        return false;
    }

    public static function canViewAny(): bool
    {
        return true;
    }


    public static function getNavigationIcon(): string|Htmlable|null
    {
        return 'heroicon-o-lock-closed';
    }

    protected static ?string $navigationBadgeTooltip = "can not enter";

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
            'index' => Pages\ListVisits::route('/'),
            'create' => Pages\CreateVisit::route('/create'),
            'edit' => Pages\EditVisit::route('/{record}/edit'),
        ];
    }
}
