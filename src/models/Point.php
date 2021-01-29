<?php


class Point
{
    private $id_punkt;
    private $dlugosc;
    private $szerokosc;
    private $jednostka;
    private $typ;
    private $budynek;
    private $opis;
    private $tytul;
    private $zdjecie;

    public function __construct($id_punkt, $dlugosc, $szerokosc, $jednostka, $typ, $budynek, $opis, $tytul, $zdjecie)
    {
        $this->id_punkt = $id_punkt;
        $this->dlugosc = $dlugosc;
        $this->szerokosc = $szerokosc;
        $this->jednostka = $jednostka;
        $this->typ = $typ;
        $this->budynek = $budynek;
        $this->opis = $opis;
        $this->tytul = $tytul;
        $this->zdjecie = $zdjecie;
    }

    public function getId_punkt()
    {
        return $this->id_punkt;
    }

    public function setId_punkt($id_punkt): void
    {
        $this->id_punkt = $id_punkt;
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

    public function getJednostka()
    {
        return $this->jednostka;
    }

    public function setJednostka($jednostka): void
    {
        $this->jednostka = $jednostka;
    }

    public function getTyp()
    {
        return $this->typ;
    }

    public function setTyp($typ): void
    {
        $this->typ = $typ;
    }

    public function getBudynek()
    {
        return $this->budynek;
    }

    public function setBudynek($budynek): void
    {
        $this->budynek = $budynek;
    }

    public function getOpis()
    {
        return $this->opis;
    }

    public function setOpis($opis): void
    {
        $this->opis = $opis;
    }

    public function getTytul()
    {
        return $this->tytul;
    }

    public function setTytul($tytul): void
    {
        $this->tytul = $tytul;
    }

    public function getZdjecie()
    {
        return $this->zdjecie;
    }

    public function setZdjecie($zdjecie): void
    {
        $this->zdjecie = $zdjecie;
    }
}