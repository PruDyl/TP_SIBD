<?php

class Controller {
    protected $viewpath;
    protected $template;

    public function __construct() {
    }

    protected function render($view, $params = []) {
      var_dump($params);
      require_once($this->viewpath.$view.'.php');
      //require_once($this->viewpath.'template/'.$this->template.'.php');
    }
}