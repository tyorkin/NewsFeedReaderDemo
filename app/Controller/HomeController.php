<?php

namespace Controller;

use Service\TwitterNewsManager;

class HomeController extends BaseController
{
    public function indexAction()
    {
        return $this->view('index');
    }

    public function getNewsAction()
    {

        $username = isset($_GET['username']) ? $_GET['username'] : '';
        $provider = isset($_GET['provider']) ? (int)$_GET['provider'] : 0;

        switch ($provider) {
            case 1:
                $news = $this->getTwitterNews($username);
                break;
            default:
                $news = ['error' => 'Unknown provider'];
        }
        if (isset($news['error'])) {
            http_response_code(500);
        }

        echo json_encode($news);

        return;
    }

    private function getTwitterNews($username)
    {
        /** @var TwitterNewsManager $newsManager */
        $newsManager = TwitterNewsManager::getInstance();

        $news = $newsManager->getNews($username);

        return $news;
    }
}