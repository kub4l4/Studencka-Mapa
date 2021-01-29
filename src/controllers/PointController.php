<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Point.php';
require_once __DIR__ . '/../repository/PointRepository.php';


class PointController extends AppController
{

    private $message = [];
    private $pointRepository;

    public function __construct()
    {
        parent::__construct();
        $this->pointRepository = new PointRepository();
    }

    public function map()
    {
        $points = $this->pointRepository->getPoints();
        $this->render('map', ['points' => $points]);
    }






}