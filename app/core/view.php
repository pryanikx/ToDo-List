<?php

class View {
    public function generate($contentView, $templateView, $data = null) {
        require_once "app/views/" . $templateView;
    }
}