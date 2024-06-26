<?php

namespace App\Filament\Resources\SellerResource\Pages;

use App\Enums\IdentityStatus;
use App\Enums\ShopStatus;
use App\Filament\Resources\SellerResource;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewSeller extends ViewRecord
{
    protected static string $resource = SellerResource::class;




    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('verify')
                ->label('verify seller id')
                ->visible(function(){
                    return !$this->record->hasVerifiedID();
                })
                ->form([
                    TextInput::make('name')
                        ->readOnly()
                        ->default(fn () => $this->record->name),

                    TextInput::make('email')
                        ->readOnly()
                        ->default(fn () => $this->record->email),

                    \Filament\Forms\Components\Actions::make([
                        Action::make('view id card')
                            ->openUrlInNewTab()
                            ->url( env('APP_URL') . '/storage/'. (
                                $this->record->identity ?
                                    $this->record->identity->id_path :
                                    '')
                            ),
                    ]),

                    Placeholder::make('separator')
                        ->label('set a status to seller identity :'),

                    Select::make('status')
                        ->label('shop status after reviewing')
                        ->live()
                        ->options([
                            IdentityStatus::Accepted->value => IdentityStatus::Accepted->value,
                            IdentityStatus::Rejected->value => IdentityStatus::Rejected->value,
                        ]),

                    Hidden::make('admin_id')
                        ->default(auth('seller')->id()),

                    Textarea::make('admin_note')
                        ->label('why you reject ?')
                        ->visible(function(Get $get){
                            return $get('status') == ShopStatus::Rejected->value;
                        })
                        ->required(function(Get $get){
                            return $get('status') == IdentityStatus::Rejected->value;
                        })
                ])
                ->action(function(Form $form){
                    $states = $form->getStateExcept([]);

                    if( $states['status'] == IdentityStatus::Rejected->value ){
                        if( empty($states['admin_note']) ){
                            return false;
                        }

                        $this->record->identity->status = IdentityStatus::Rejected->value;

                        $this->record->identity->admin_note = $states['admin_note'];

                        Notification::make()
                            ->title('your id card is rejected')
                            ->body($states['admin_note'])
                            ->sendToDatabase($this->record);
                    }else{
                        $this->record->id_verified_at = now();
                        $this->record->save();
                        $this->record->identity->status = IdentityStatus::Accepted->value;
                    }
                    $this->record->identity->processed_by = auth('admin')->id();

                    $this->record->identity->save();

                    return true;
                })

        ];
    }
}
