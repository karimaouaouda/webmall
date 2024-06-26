<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SellerResource\Pages;
use App\Filament\Resources\SellerResource\RelationManagers;
use App\Models\Auth;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class SellerResource extends Resource
{
    protected static ?string $model = Auth\Seller::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\TextInput::make('email'),
                Forms\Components\TextInput::make('id_verified_at'),
                Forms\Components\TextInput::make('email_verified_at'),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->prefix("#")
                    ->label('seller id'),

                Tables\Columns\TextColumn::make('name')
                    ->label('seller name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->prefix("#")
                    ->label('seller email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('id_verified_at')
                    ->badge()
                    ->default('no')
                    ->formatStateUsing(function($state){
                        return $state != 'no' ? "verified" : 'not verified';
                    })
                    ->color(function(Model $model){
                        return $model->id_verified_at ? Color::Green : Color::Red;
                    })
                    ->label('identity verification'),


            ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_verified_at')
                    ->options([
                        'verified' => 'verified',
                        null => 'not verified'
                    ])
                    ->getSearchResultsUsing(function($state){
                        return match ($state) {
                            'verified' => DB::table('sellers')->whereNotNull('id_verified_at'),
                            default => DB::table('sellers')->where('id_verified_at', '=', null),
                        };
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make()

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
            'index' => Pages\ListSellers::route('/'),
            'create' => Pages\CreateSeller::route('/create'),
            'edit' => Pages\EditSeller::route('/{record}/edit'),
            'view' => Pages\ViewSeller::route('/{record}/view')
        ];
    }
}
