<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Point.php';


class MapRepository extends Repository
{
    public function getPoint(string $id): ?Point
    {
        $stmt = $this->database->connect()->prepare('
      SELECT * FROM public.map_punkty mp
          left join map_jednostki mj on mp.id_jednostka = mj.id_jednostka
          left join map_budynki mb on mp.id_budynek = mb.id_budynek
          left join map_typy mt on mp.id_typ = mt.id_typ
      WHERE id_punkt =:id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $point = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($point == false) {
            return null;//dodac exeption
        }

        return new Point(
            $point['id_punkt'],
            $point['dlugosc'],
            $point['szerokosc'],
            $point['jednostka'],
            $point['typ'],
            $point['budynek'],
            $point['opis'],
            $point['tytul'],
            $point['zdjecie']
        );
    }


    public function getPoints(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
      SELECT * FROM public.map_punkty mp
          left join map_jednostki mj on mp.id_jednostka = mj.id_jednostka
          left join map_budynki mb on mp.id_budynek = mb.id_budynek
          left join map_typy mt on mp.id_typ = mt.id_typ
        ');

        $stmt->execute();

        $points = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($points as $point) {
            $result[] = new Point(
                $point['id_punkt'],
                $point['dlugosc'],
                $point['szerokosc'],
                $point['jednostka'],
                $point['typ'],
                $point['budynek'],
                $point['opis'],
                $point['tytul'],
                $point['zdjecie']
            );
        }
        return $result;
    }

    public function getJednostkiList(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
      SELECT * FROM public.map_punkty mp
          left join map_jednostki mj on mp.id_jednostka = mj.id_jednostka
          left join map_budynki mb on mp.id_budynek = mb.id_budynek
          left join map_typy mt on mp.id_typ = mt.id_typ
        ');

        $stmt->execute();

        $points = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($points as $point) {
            $result[] = new Point(
                $point['id_punkt'],
                $point['dlugosc'],
                $point['szerokosc'],
                $point['jednostka'],
                $point['typ'],
                $point['budynek'],
                $point['opis'],
                $point['tytul'],
                $point['zdjecie']
            );
        }
        return $result;
    }

}