<?php

namespace App\View\Components\Form\TextArea;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class First extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $label,
        public string $icon
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.text-area.first');
    }
}
