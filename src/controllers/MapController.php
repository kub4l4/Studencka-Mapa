<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Point.php';
require_once __DIR__ . '/../repository/MapRepository.php';


class MapController extends AppController
{

    private $message = [];
    private $mapRepository;

    public function __construct()
    {
        parent::__construct();
        $this->mapRepository = new MapRepository();
    }

    public function map()
    {
        $points = $this->mapRepository->getPoints();
        $this->render('map', ['points' => $points]);
    }

    public function index()
    {
        $points = $this->mapRepository->getPoints();
        $this->render('map', ['points' => $points]);
    }


}