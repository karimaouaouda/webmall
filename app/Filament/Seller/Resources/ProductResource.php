<?php

namespace App\Filament\Seller\Resources;

use App\Filament\Seller\Resources\ProductResource\Pages;
use App\Filament\Seller\Resources\ProductResource\RelationManagers;
use App\Models\Shop\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Ancestor;
use Guava\FilamentNestedResources\Concerns\NestedRelationManager;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\FontFamily;
use Filament\Tables\Filters\Filter;

class ProductResource extends Resource
{

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Shop';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('shop_unique_name')
                    ->default(auth('seller')->user()->shop->unique_name ?? "condor"),

                TextInput::make('slug')->placeholder('product slug')
                    ->required(),

                RichEditor::make('description')->placeholder('product description')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('available_qte')->placeholder('avalaible quantity')
                    ->type('number')
                    ->required(),
                
                TextInput::make('price')->placeholder('price')
                    ->type('number')
                    ->required(),

                TextInput::make('welcome_solde')->placeholder('price')
                    ->type('number')
                    ->required(),

                TextInput::make('solde')->placeholder('price')
                    ->type('number')
                    ->required(),

                TextInput::make('sensitive_qte')->placeholder('price')
                    ->type('number')
                    ->required(),
                
                Select::make('sub_category_id')
                    ->label('category')
                    ->relationship('subCategory', 'name')
                    ->searchable()
                    ->required(),

                Section::make('Media')->description('upload media that describe the product')
                    ->schema([

                        FileUpload::make('video')
                            ->label('upload video for product'),


                        FileUpload::make('pic')
                            ->label('upload images for product')
                            ->multiple(),

                    ]),
            ]); 
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->prefix('#'),
                
                TextColumn::make('slug')
                    ->label('product name')
                    ->sortable(),

                TextColumn::make('description')
                    ->label('product description')
                    ->extraCellAttributes(['style' => 'max-width:350px;overflow: hidden;'])
                    ->extraAttributes(['style' => 'text-overflow: ellipsis;']),

                TextColumn::make('price')
                    ->label('product price'),
            ])
            ->filters([
                Filter::make('big price')
                    ->query(function(Builder $builder): Builder{
                        return $builder->where('price', '>', '600');
                    }),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            'view' => Pages\View::route('/view/{record}')
        ];
    }
}
