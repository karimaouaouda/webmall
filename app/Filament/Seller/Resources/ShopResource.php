<?php

namespace App\Filament\Seller\Resources;

use App\Filament\Seller\Resources\ShopResource\Pages;
use App\Filament\Seller\Resources\ShopResource\RelationManagers;
use App\Models\Shop;
use App\View\Components\Parts\Step;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShopResource extends Resource
{
    protected static ?string $model = Shop::class;

    protected static ?string $label = "shop information";

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function canCreate(): bool
    {
        return !auth('seller')->user()->has_shop;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('business information')
                        ->schema([
                            Forms\Components\Section::make()
                                ->heading('business public information')
                                ->description('information will be shown to ever one in our app')
                                ->schema([
                                    Forms\Components\Hidden::make('seller_id')
                                        ->default(auth('seller')->id())->required(),
                                    Forms\Components\TextInput::make('unique_name')
                                        ->placeholder('shop unique name')
                                        ->label('shop unique name')
                                        ->columnSpan(2)
                                        ->hintIconTooltip('heroicon-o-exclamation-circle')
                                        ->hint('this unique name will used as subdomain ( unique_name.webmall.test )')
                                        ->required(),

                                    Forms\Components\TextInput::make('name')
                                        ->placeholder('shop name')
                                        ->label('shop name')
                                        ->columnSpan(2)
                                        ->hint('this is the name will be shown in shop profile and products')
                                        ->required(),

                                    Forms\Components\RichEditor::make('description')
                                        ->placeholder('shop description')
                                        ->maxLength(300)
                                        ->columnSpan(2)
                                        ->extraAttributes([
                                            'style' => "min-height : 250px"
                                        ])
                                        ->required(),
                                ]),
                        ]),
                    Forms\Components\Wizard\Step::make('business media appearence')
                        ->schema([
                            Forms\Components\FileUpload::make('logo')
                                ->label('shop logo')
                                ->image()
                                ->columnSpan(2)
                                ->imageEditor()
                                ->circleCropper()
                                ->disk('local')
                                ->directory(function(){
                                    $seller_id = auth('seller')->id();
                                    return "sellers/seller_{$seller_id}/shop/images";
                                })
                                ->nullable(),

                            Forms\Components\FileUpload::make('cover')
                                ->label('shop cover')
                                ->columnSpan(2)
                                ->image()
                                ->disk('public')
                                ->directory(function(){
                                    $seller_id = auth('seller')->id();
                                    return "sellers/seller_{$seller_id}/shop/images";
                                })
                                ->nullable(),
                        ])
                ])->columnSpan(2)
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
            'index' => Pages\ListShops::route('/'),
            'create' => Pages\CreateShop::route('/create'),
            'edit' => Pages\EditShop::route('/{record}/edit'),
            'view' => Pages\ViewShop::route('/{record}/view')
        ];
    }
}
