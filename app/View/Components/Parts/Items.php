<?php

namespace App\View\Components\Parts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Items extends Component
{
    
    /**
     * Create a new component instance.
     */
    public function __construct(public $list)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.parts.list');
    }
}
