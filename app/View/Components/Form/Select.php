<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $width;
    public $name;
    public $label;
    public $disabled;
    public $options;
    public $selected;
    public $errors;

    /**
     * Create a new component instance.
     */
    public function __construct($width, $name, $label, $options, $disabled = "", $selected = null, $errors = null)
    {
        $this->width = $width;
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->disabled = $disabled;
        $this->selected = $selected;
        $this->errors = $errors;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.select');
    }
}
