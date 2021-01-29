<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/News.php';
require_once __DIR__ . '/../repository/NewsRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';


class NewsController extends AppController
{

    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $message = [];
    private $newsRepository;


    public function __construct()
    {
        parent::__construct();
        $this->newsRepository = new NewsRepository();
    }

    public function news()
    {
        $news = $this->newsRepository->getAllNews();
        $this->render('news', ['news' => $news]);
    }

    public function addNews()
    {
        //czy ktos jest zalogowny
        if ($this->getCurrentLogUserID() == 0) {
            return $this->render('no-access', ['messages' => ['Please login!']]);
        }

        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
            );

            $news = new News($_POST['title'], $_POST['description'], $this->getCurrentLogUserID(), $_FILES['file']['name']);
            $this->newsRepository->addNews($news);


            return $this->render('news', [
                'news' => $this->newsRepository->getAllNews(),
                'messages' => $this->message
            ]);
        }
        return $this->render('add-news', ['messages' => $this->message]);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }

    public function search()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->newsRepository->getPostByTitle($decoded['search']));
        }
    }


}
