<?php
use RESTAPI\Classes\ArticleModel;
use RESTAPI\Classes\TopicModel;
use RESTAPI\Helpers\Helper;
use RESTAPI\Helpers\InputFilter;

require_once '..' . DIRECTORY_SEPARATOR . 'init.php';

// Set appropriate headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Check if the request is authorized (has a valid authorization key)
if(!Helper::requestIsAuthorized()) {
    exit(json_encode(['error' => '400 Bad Request']));
} elseif (!isset($_GET['topic_id'])) {
    exit(json_encode(['error' => 'missing parameter topic_id']));
}

$topicId = InputFilter::filterInt($_GET['topic_id']);
$topic = TopicModel::getByPK($topicId);

if(false === $topic) {
    exit(json_encode(['error' => 'topic not found']));
}

$articles = ArticleModel::getArticlesForTopic($topic);

// output json
if( false !== $articles ) {
    echo json_encode($articles, JSON_PRETTY_PRINT);
} else {
    echo json_encode(['message' => 'no topics to show']);
}