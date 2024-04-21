<?php

namespace App\View\Components\Parts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */


     
     
     
    public function __construct(public string $type = "text",
                                public string $ph = "tap something...",
                                public int $n = 1,
                                public string $name = "somename",
                                public $value = "",
                                public bool $inline = false,
                                public string $id = "")
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.parts.input');
    }
}
