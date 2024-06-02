<?php

namespace App\Filament\Seller\Resources;

use App\Filament\Clusters\Settings;
use App\Filament\Seller\Resources\ProductResource\Pages;
use App\Models\Shop\Product;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Builder;

use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Model;

class ProductResource extends Resource
{

    protected static ?string $model = Product::class;

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
                Wizard::make([
                    Wizard\Step::make('product base informations')
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

                            TextInput::make('solde')->placeholder('solde')
                                ->type('number')
                                ->required(),

                            TextInput::make('sensitive_qte')->placeholder('sensitive quantity')
                                ->type('number')
                                ->required(),
                        ]),

                    Wizard\Step::make('media appearence')
                        ->schema([
                            FileUpload::make('video_path')
                                ->disk('public')
                                ->directory(function(){
                                    $seller_id = auth('seller')->id();
                                    return "/sellers/seller_{$seller_id}/shop/products/videos";
                                })
                                ->maxFiles(1)
                                ->minFiles(1)
                                ->required()
                                ->label('upload video for product'),


                            FileUpload::make('images')
                                ->label('upload images for product')
                                ->disk('public')
                                ->directory(function(){
                                    $seller_id = auth('seller')->id();
                                    return "/sellers/seller_{$seller_id}/shop/products/images";
                                })
                                ->multiple()
                                ->minFiles(2)
                                ->maxFiles(7)
                                ->required(),
                        ]),

                    Wizard\Step::make('SEO Engine Informations')
                        ->schema([
                            Select::make('sub_category_name')
                                ->label('category')
                                ->relationship('subCategory', 'name')
                                ->searchable()
                                ->required(),
                        ]),
                ])
                    ->label('create your product')
                    ->columnSpan(2),
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
