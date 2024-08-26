<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $width;
    public $type;
    public $name;
    public $value;
    public $disabled;
    public $placeholder;
    public $errors;
    public $attributes;

    /**
     * Create a new component instance.
     */
    public function __construct($width, $type, $name, $value = null, $disabled = "", $placeholder = null, $errors = null, $attributes = [])
    {
        $this->width = $width;
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->disabled = $disabled;
        $this->placeholder = $placeholder;
        $this->errors = $errors;
        $this->attributes = $attributes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
