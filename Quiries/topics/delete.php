<?php
use RESTAPI\Classes\TopicModel;
use RESTAPI\Helpers\InputFilter;
use RESTAPI\Helpers\Helper;

require_once '..' . DIRECTORY_SEPARATOR . 'init.php';

// Set appropriate headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Check if the request is authorized (has a valid authorization key)
if(!Helper::requestIsAuthorized()) {
    exit(json_encode(['error' => '400 Bad Request']));
}

if(!isset($_GET['topic_id'])) {
    exit(json_encode(['error' => 'missing parameter topic_id']));
}

$topicId = InputFilter::filterInt($_GET['topic_id']);
$topic = TopicModel::getByPK($topicId);

if( false !== $topic && $topic->delete() ) {
    echo json_encode(['message' => 'Topic deleted successfully']);
} else {
    echo json_encode(['error' => 'No topic to delete']);
}