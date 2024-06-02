<?php

namespace App\View\Components\Parts;

use Closure;
use Filament\Forms\Components\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Step extends Component
{
    /**
     * Create a new component instance.
     */

    public array $options = [];

    public FileUpload $uploadComponent;

    public Closure $getClasses;
    public function __construct(public $completed, public $icon, public $action,  $options = [])
    {

        $this->uploadComponent = FileUpload::make('id_card')
                                    ->name('id_card')
                                    ->label('upload your id card')
                                    ->acceptedFileTypes(['jpg', 'png', 'webp'])
                                    ->required();
        $this->options = $this->getOptions();



        if($options != []){
            $this->options = array_merge($this->options, $options);
        }

        $this->getClasses = function($completed){
            return $completed ? $this->options['completed_bg'] : $this->options['uncompleted_bg'];
        };
    }

    protected function getOptions(): array
    {
        return [
            'completed_bg' => 'bg-sky-500 text-white',
            'uncompleted_bg' => 'bg-slate-500 text-white'
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.parts.step');
    }
}
