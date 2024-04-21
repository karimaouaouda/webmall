<?php

namespace App\Filament\Client\Resources;

use App\Filament\Client\Resources\CommandResource\Pages;
use App\Filament\Client\Resources\CommandResource\RelationManagers;
use App\Models\Client\Command;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
            'index' => Pages\ListCommands::route('/'),
            'create' => Pages\CreateCommand::route('/create'),
            'edit' => Pages\EditCommand::route('/{record}/edit'),
        ];
    }
}
