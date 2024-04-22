<?php

namespace App\Filament\Client\Resources;

use App\Filament\Client\Resources\CommandResource\Pages;
use App\Filament\Client\Resources\CommandResource\RelationManagers;
use App\Filament\Client\Resources\CommandResource\Widgets\ShippingStatusView;
use App\Models\Client\Command;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommandResource extends Resource
{
    protected static ?string $model = Command::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("hello to this")
                    ->schema([
                        TextInput::make("abdou")
                            ->required()
                            ->placeholder("hello abdou"),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),
                TextColumn::make('payment_method')
                    ->label('Payment_method'),
                TextColumn::make('created_at')
                    ->label('Date'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCommands::route('/'),
            'create' => Pages\CreateCommand::route('/create'),
            'edit' => Pages\EditCommand::route('/{record}/edit'),
            'view' => Pages\ViewCommand::route('/view/{record}')
            //'discover' => Pages\DiscoverPage::route('/discover/{record}')
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ShippingStatusView::class,
        ];
    }
}