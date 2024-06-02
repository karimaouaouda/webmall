<?php

namespace App\Observers;

use App\Models\Address;
use App\Models\Auth\Seller;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class SellerObserver
{
    /**
     * Handle the Seller "created" event.
     */
    public function created(Seller $seller): void
    {
        $info = [
            'addressable_type' => Seller::class ,
            'addressable_id' => $seller->id,
            'country' => 'algeria',
            'city' => null,
            'province' => null,
            'postal_code' => null,
            'street_line' => null
        ];

        $address = new Address($info);

        $address->save();

        Notification::make()
            ->title("complete setting your account")
            ->icon("heroicon-o-exclamation-circle")
            ->actions([
                Action::make('complete')
                    ->icon("heroicon-o-arrow-top-right-on-square")
                    ->label('complete now')
                    ->action(function(){
                        return redirect()->to( Config::get('app.domains.seller') . '/dashboard/settings' );
                    })
            ])
            ->toDatabase($seller);
    }

    /**
     * Handle the Seller "updated" event.
     */
    public function updated(Seller $seller): void
    {
        //
    }

    /**
     * Handle the Seller "deleted" event.
     */
    public function deleted(Seller $seller): void
    {
        //
    }

    /**
     * Handle the Seller "restored" event.
     */
    public function restored(Seller $seller): void
    {
        //
    }

    /**
     * Handle the Seller "force deleted" event.
     */
    public function forceDeleted(Seller $seller): void
    {
        //
    }
}
