<?php

namespace App\Filament\Seller\Resources;

use App\Enums\CommandStatus;
use App\Filament\Seller\Resources\CommandResource\Pages;
use App\Filament\Seller\Resources\CommandResource\RelationManagers;
use App\Models\Client\Command;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class CommandResource extends Resource
{
    protected static ?string $model = Command::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Shop';

    public static function canAccess(): bool
    {
        $user = Filament::auth()->user();
        return $user->has_shop && $user->shop->isPublished();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }


    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where(
            'shop_unique_name',
            '=',
                auth('seller')->user()->shop->unique_name
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('command id')
                    ->searchable()
                    ->prefix('#'),

                Tables\Columns\TextColumn::make('created_at')
                    ->badge()
                    ->label('placed_at'),

                Tables\Columns\TextColumn::make('products')
                    ->formatStateUsing(function(Model $model){
                        return count( $model->products );
                    }),

                Tables\Columns\SelectColumn::make('status')
                    ->options(
                        CommandStatus::assoc()
                    )
                    ->label('command status')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(CommandStatus::assoc())
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCommands::route('/'),
            'create' => Pages\CreateCommand::route('/create'),
            'edit' => Pages\EditCommand::route('/{record}/edit'),
        ];
    }
}
