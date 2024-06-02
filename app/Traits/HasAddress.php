<?php

namespace App\Traits;

use App\Models\Address;

trait HasAddress
{
    public function hasAddress(){
        return $this->address->city != null;
    }

    public function address(){
        return $this->morphOne(Address::class, 'addressable');
    }
}
