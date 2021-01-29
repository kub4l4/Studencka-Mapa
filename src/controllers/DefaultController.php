<?php

require_once 'AppController.php';

class DefaultController extends AppController
{
    public function error()
    {
        $this->render('no-access');
    }
}