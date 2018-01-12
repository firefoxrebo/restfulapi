<?php
use RESTAPI\Classes\TopicModel;
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

// Get all topics alongside their articles
$topics = TopicModel::getAll();

// output json
if( false !== $topics ) {
    echo json_encode($topics, JSON_PRETTY_PRINT);
} else {
    echo json_encode(['message' => 'no topics to show']);
}