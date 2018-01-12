<?php
use RESTAPI\Classes\ArticleModel;
use RESTAPI\Classes\AuthorModel;
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

if(is_null($data) || !isset($data->title) || !isset($data->author_id) || !isset($data->topic_id) || !isset($data->content)) {
    exit(json_encode(['error' => 'missing topic data']));
}

$topic = TopicModel::getByPK($data->topic_id);

if(false === $topic) {
    exit(json_encode(['error' => 'Topic doesn\'t exists']));
}

$author = AuthorModel::getByPK($data->author_id);

if(false === $author) {
    exit(json_encode(['error' => 'Author doesn\'t exists']));
}

$article = new ArticleModel();
$article->AuthorId = $author->AuthorId;
$article->TopicId = $topic->TopicId;
$article->ArticleTitle = $data->title;
$article->ArticleContent = $data->content;


if( $article->save() ) {
    echo json_encode(['message' => 'Article created successfully']);
} else {
    echo json_encode(['error' => 'Article has not been created. Please check your request parameters and try again']);
}