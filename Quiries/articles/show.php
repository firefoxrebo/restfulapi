<?php
use RESTAPI\Classes\ArticleModel;
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

if(!isset($_GET['article_id'])) {
    exit(json_encode(['error' => 'missing parameter article_id']));
}

$articleId = InputFilter::filterInt($_GET['article_id']);
$article = ArticleModel::getByPK($articleId);

if( false !== $article ) {
    echo json_encode($article, JSON_PRETTY_PRINT);
} else {
    echo json_encode(['message' => 'no article to show']);
}