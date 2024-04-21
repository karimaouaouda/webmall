<?php

namespace App\View\Components\Main;

use App\Models\Shop\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    /**
     * Create a new component instance.
     */

    

    public function __construct(public Product $model)
    {
        
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.product-card');
    }
}
