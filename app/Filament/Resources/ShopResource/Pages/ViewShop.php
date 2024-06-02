<?php

namespace App\Filament\Resources\ShopResource\Pages;

use App\Enums\ShopStatus;
use App\Filament\Resources\ShopResource;
use App\Models\Shop;
use App\Models\Shop\Document;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Columns\ImageColumn;
use PhpParser\Comment\Doc;

class ViewShop extends ViewRecord
{
    protected static string $resource = ShopResource::class;



    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('verify')
                ->label('verify shop documents')
                ->visible(function(){
                    return $this->record->document->processed_by == null;
                })
                ->form([
                    TextInput::make('serial_number')
                        ->readOnly()
                        ->default(fn () => $this->record->document->serial_number),

                    TextInput::make('starts_at')
                        ->readOnly()
                        ->default(fn () => $this->record->document->starts_at),

                    \Filament\Forms\Components\Actions::make([
                        Action::make('view document')
                            ->openUrlInNewTab()
                            ->url( env('APP_URL') . '/storage/'. $this->record->document->document ),
                    ]),

                    Placeholder::make('separator')
                        ->label('set a status to this shop :'),

                    Select::make('status')
                        ->label('shop status after reviewing')
                        ->live()
                        ->options([
                            ShopStatus::Accepted->value => ShopStatus::Accepted->value,
                            ShopStatus::Rejected->value => ShopStatus::Rejected->value,
                        ]),

                    Hidden::make('admin_id')
                        ->default(auth('seller')->id()),

                    Textarea::make('admin_note')
                        ->label('why you reject ?')
                        ->visible(function(Get $get){
                            return $get('status') == ShopStatus::Rejected->value;
                        })
                        ->required(function(Get $get){
                            return $get('status') == ShopStatus::Rejected->value;
                        })
                ])
                ->action(function(Form $form){
                    $states = $form->getStateExcept([]);

                    if( $states['status'] == ShopStatus::Rejected->value ){
                        if( empty($states['admin_note']) ){
                            return false;
                        }

                        $this->record->document->status = ShopStatus::Rejected->value;


                        $this->record->document->admin_note = $states['admin_note'];

                        Notification::make()
                            ->title('your shop id is rejected')
                            ->body("your shop verification have been rejected")
                            ->actions([
                                \Filament\Notifications\Actions\Action::make('view')
                                    ->label('see why')
                                    ->url('/shops/' . $this->record->unique_name . '/verify/result'),
                            ])
                            ->sendToDatabase($this->record->seller);
                    }else{
                        $this->record->document->status = ShopStatus::Accepted->value;

                        Notification::make()
                            ->title('your shop id is accepted')
                            ->body("you can now publish products")
                            ->actions([
                                \Filament\Notifications\Actions\Action::make('view')
                                    ->label('publish product')
                                    ->url('/dashboard/products/create'),
                            ])
                            ->sendToDatabase($this->record->seller);
                    }
                    $this->record->document->processed_by = auth('admin')->id();
                    $this->record->document->save();

                    return true;
                })

        ];
    }

}
