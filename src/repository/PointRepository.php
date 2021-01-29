<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Point.php';


class PointRepository extends Repository
{
    public function getPoint(string $id): ?Point
    {
        $stmt = $this->database->connect()->prepare('
      SELECT * FROM public.map_punkty mp
          left join map_jednostki mj on mp.id_jednostki = mj.id_jednostka
          left join map_budynki mb on mp.id_budynku = mb.id_budynek
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
            $point['dlugosc'],
            $point['szerokosc'],
        );
    }


    public function getPoints(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
        SELECT * FROM public.map_punkty
        ');

        $stmt->execute();

        $points = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($points as $point) {
            $result[] = new Point(
                $point['dlugosc'],
                $point['szerokosc'],
            );
        }
        return $result;
    }

}