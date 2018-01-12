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

$data = json_decode(file_get_contents('php://input'));

if(is_null($data) || !isset($data->title)) {
    exit(json_encode(['error' => 'missing topic data']));
}

$topic = new TopicModel();
$topic->TopicTitle = InputFilter::filterString($data->title);

if( $topic->save() ) {
    echo json_encode(['message' => 'Topic created successfully']);
} else {
    echo json_encode(['error' => 'Topic has not been created. Please check your request parameters and try again']);
}