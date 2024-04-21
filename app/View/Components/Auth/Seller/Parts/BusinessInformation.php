<?php

namespace App\View\Components\Auth\Seller\Parts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BusinessInformation extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('auth.seller.parts.business-information');
    }
}
