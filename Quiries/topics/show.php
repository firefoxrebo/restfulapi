<?php
use RESTAPI\Classes\TopicModel;
use RESTAPI\Helpers\InputFilter;
use RESTAPI\Helpers\Helper;

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
}

if(!isset($_GET['topic_id'])) {
    exit(json_encode(['error' => 'missing parameter topic_id']));
}

$topicId = InputFilter::filterInt($_GET['topic_id']);
$topic = TopicModel::getByPK($topicId);

if( false !== $topic ) {
    echo json_encode($topic, JSON_PRETTY_PRINT);
} else {
    echo json_encode(['message' => 'no topic to show']);
}