<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    public $route, $path, $text, $icon;
    /**
     * Create a new component instance.
     */
    public function __construct($route, $path, $text, $icon = '')
    {
        $this->route = $route;
        $this->path = $path;
        $this->text = $text;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu-item');
    }
}
