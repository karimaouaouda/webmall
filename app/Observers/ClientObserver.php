<?php

namespace App\Observers;

use App\Models\Auth\Client;
use App\Models\Client\Cart;

class ClientObserver
{
    /**
     * Handle the Client "created" event.
     */
    public function created(Client $client): void
    {
        //when a client created, a cart must created

        $cart = new Cart([
            'client_id' => $client->id
        ]);

        $cart->save();
    }

    /**
     * Handle the Client "updated" event.
     */
    public function updated(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "deleted" event.
     */
    public function deleted(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "restored" event.
     */
    public function restored(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "force deleted" event.
     */
    public function forceDeleted(Client $client): void
    {
        //
    }
}
