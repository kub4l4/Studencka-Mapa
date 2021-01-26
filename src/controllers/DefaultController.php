<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render('map');
    }

    public function projects()
    {
        $this->render('projects');
    }
    public function map()
    {
        $this->render('map');
    }
}