<?php

class Controller {
    protected $viewpath;
    protected $template;

    public function __construct() {
    }

    protected function render($view, $params = []) {
      require_once($this->viewpath.$view.'.php');
    }
}