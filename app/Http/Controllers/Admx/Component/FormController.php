<?php

namespace App\Http\Controllers\Admx\Component;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function __construct()
    {

    }

    public function generateSelect($data, $errors)
    {
        $html = '<label for="'.$data['name'].'">'.($data['label'] ?? '').'</label>';
        if ($errors->has($data['name'])) {
            $html .= '<span class="text-danger">'.$errors->first($data['name']).'</span>';
        }
        $html .= '<select id="'.$data['name'].'" name="'.$data['name'].'" class="form-control"'.(!empty($data['disabled']) ? ' disabled' : '').'>';
        foreach ($data['options'] as $key => $value) {
            $selected = (old($data['name'], $data['selected'] ?? '') == $key) ? ' selected' : '';
            $html .= "<option value=\"$key\"$selected>$value</option>";
        }
        $html .= '</select>';

        return $html;
    }

    public function generateInput($data, $errors)
    {
        $html = '<label for="'.$data['name'].'">'.($data['label'] ?? '').'</label>';
        if ($errors->has($data['name'])) {
            $html .= '<span class="text-danger">'.$errors->first($data['name']).'</span>';
        }
        $html .= '<input type="'.$data['type'].'" id="'.$data['name'].'" name="'.$data['name'].'" class="form-control"';
        $html .= ' value="'.($data['value'] ?? '').'"';
        $html .= isset($data['placeholder']) ? ' placeholder="'.$data['placeholder'].'"' : '';
        $html .= '>';

        return $html;
    }
}
