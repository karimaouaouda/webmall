<?php

namespace App\View\Components\Guest\Landing;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Categories extends Component
{
    /**
     * Create a new component instance.
     */

    public function __construct(public  $shops = [], public  $products = [])
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.guest.landing.categories');
    }
}
