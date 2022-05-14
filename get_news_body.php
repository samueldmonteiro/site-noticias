<?php

use Src\Dao\NewsDaoMysql;
use Src\Utils\Filter;

require_once("vendor/autoload.php");
require_once("config/globals.php");

$newsDao = new NewsDaoMysql($pdo);

$newsId = Filter::id($_POST['news-id']);

$newsItem = $newsDao->findById($newsId);

if($newsItem){
    die(json_encode($newsItem->getBody()));
}
