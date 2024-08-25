<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputField extends Component
{
    public $name, $text, $value, $required, $readonly, $type;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $text, $value = '', $required = false, $readonly = false, $type = 'text')
    {

        $this->name = $name;
        $this->text = $text;
        $this->value = $value;
        $this->required = $required ? 'required' : '';
        $this->readonly = $readonly ? 'readonly' : '';
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-field');
    }
}
