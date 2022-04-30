<?php

class Helpers {

    public function input($id, $label, $type) {
        $html = "<div class='form-group mb-3'>";
        $html .= "<label for='{$id}' class='form-label'>{$label}</label>";
        $html .= "<input type='{$type}' name='{$id}' id='{$id}' class='form-control'>";
        $html .= "</div>";
        return $html;
    }

    public function textarea($id, $label) {
        $html = "<div class='form-group mb-3'>";
        $html .= "<label for='{$id}' class='form-label'>{$label}</label>";
        $html .= "<textarea name='{$id}' id='{$id}' class='form-control'></textarea>";
        $html .= "</div>";
        return $html;
    }

    public function button($type, $name, $class, $text) {
        return "<button type='{$type}' name='{$name}' class='btn btn-{$class}'>{$text}</button>";
    }

    public function select($id, $label, $options = array()) {
        $html = "<div class='form-group mb-3'>";
        $html .= "<label for='{$id}' class='form-label'>{$label}</label>";
        $html .= "<select name='{$id}' id='{$id}' class='form-select'>";
        foreach ($options as $key => $value) {
            $html .= "<option value='{$key}'>{$value}</option>";
        }
        $html .= "</select>";
        $html .= "</div>";
        return $html;
    }

}