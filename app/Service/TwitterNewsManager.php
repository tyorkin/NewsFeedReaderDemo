<?php

namespace Service;

use Config;
use Model\Media;
use Model\News;
use NewsFeedReader\Client\SimpleClient;
use NewsFeedReader\Provider\TwitterProvider;

class TwitterNewsManager extends Service
{
    const MAX_NEWS = 25;


    /**
     * @var string $username
     *
     * @return News[]
     */
    public function getNews($username = '')
    {
        try {
            $client = new SimpleClient();
            /** @var TwitterProvider $twitterNewsProvider */
            $twitterNewsProvider = new TwitterProvider($client);
            $credentials = [
                "consumer_key" => Config::TWITTER_CONSUMER_KEY,
                "consumer_secret" => Config::TWITTER_CONSUMER_SECRET,
                "access_token" => Config::TWITTER_ACCESS_TOKEN,
                "access_token_secret" => Config::TWITTER_ACCESS_TOKEN_SECRET,
            ];
            $twitterNewsProvider->setCredentials($credentials);
            $params = ['count' => self::MAX_NEWS];
            if ($username) {
                $params['screen_name'] = $username;
            }
            $newsData = $twitterNewsProvider->requestNewsFeed($params);
            $newsArray = $this->handleNews($newsData);
        } catch (\Exception $e) {
            $error = ['error' => 'Error receiving news'];
            return $error;
        }
        return $newsArray;
    }

    /**
     * @var array $newsData
     *
     * @return News[]
     */

    protected function handleNews($newsData)
    {
        $newsArray = [];
        foreach ($newsData as $news) {
            $newsObject = new News();
            $newsObject->username = $news->user->name;
            $newsObject->text = $news->text;
            $newsObject->createdAt = date('r', strtotime($news->created_at));
            $mediaObject = new Media();
            if (isset($news->entities)
                && isset($news->entities->media)
                && is_array($news->entities->media)
                && isset($news->entities->media[0])
            ) {
                $mediaObject = new Media();
                $mediaObject->url = $news->entities->media[0]->media_url;
                $mediaObject->type = $news->entities->media[0]->type;

            }
            $newsObject->media = $mediaObject;
            $newsArray[] = $newsObject;
        }

        return $newsArray;
    }
}