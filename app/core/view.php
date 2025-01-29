<?php

class View {

    function generate($contentView, $templateView, $data = null) {
        require_once "app/views/" . $templateView;
    }
}