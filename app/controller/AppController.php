<?php

class AppController extends Controller
{
    public function __construct()
    {
        $this->viewpath = ROOT . 'app/view/';
    }

    protected function loadModel($model)
    {
        $this->$model = new $model;
    }
}