<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/News.php';


class NewsRepository extends Repository
{
    public function getNews(string $id): ?News
    {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM public.news WHERE id_news =:id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $news = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($news == false) {
            return null;//dodac exeption
        }

        return new News(
            $news['title'],
            $news['description'],
            $news['image']
        );
    }

    public function addNews(News $news): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
        INSERT INTO news (title, description, created_at, id_assigned_by, image)
        values (?,?,?,?,?)
    ');

        $assignedById = 2; // TODO pobrac z sesji, kto to dodaje
        $stmt->execute([
            $news->getTitle(),
            $news->getDescription(),
            $date->format('Y-m-d'),
            $assignedById,
            $news->getImage()
        ]);
    }

    public function getAllNews(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
        SELECT * FROM news
        ');

        $stmt ->execute();

        $newsAll = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($newsAll as $news){
            $result[] = new News(
                $news['title'],
                $news['description'],
                $news['image']
            );
        }
        return $result;
    }

    public function getPostByTitle(string $searchString)
    {
        $searchString = '%'.strtolower($searchString).'%';

        $stmt = $this->database->connect()->prepare('
        SELECT * FROM news WHERE lower(title) like :search OR lower(description) like :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
