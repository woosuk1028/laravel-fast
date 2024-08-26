<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public $width;
    public $name;
    public $value;
    public $rows;
    public $placeholder;
    public $disabled;
    public $attributes;

    /**
     * Create a new component instance.
     */
    public function __construct($width, $name, $value = null, $rows = 3, $placeholder = '', $disabled = '', $attributes = [])
    {
        $this->width = $width;
        $this->name = $name;
        $this->value = $value;
        $this->rows = $rows;
        $this->placeholder = $placeholder;
        $this->disabled = $disabled;
        $this->attributes = $attributes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.textarea');
    }
}
