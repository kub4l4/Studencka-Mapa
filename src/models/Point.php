<?php


class Point
{
    private $dlugosc;
    private $szerokosc;


    public function __construct($dlugosc, $szerokosc)
    {
        $this->dlugosc = $dlugosc;
        $this->szerokosc = $szerokosc;
    }
    public function getDlugosc()
    {
        return $this->dlugosc;
    }

    public function setDlugosc($dlugosc): void
    {
        $this->dlugosc = $dlugosc;
    }

    public function getSzerokosc()
    {
        return $this->szerokosc;
    }

    public function setSzerokosc($szerokosc): void
    {
        $this->szerokosc = $szerokosc;
    }


}