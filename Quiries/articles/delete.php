<?php
use RESTAPI\Classes\ArticleModel;
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

if(!isset($_GET['article_id'])) {
    exit(json_encode(['error' => 'missing parameter article_id']));
}

$articleId = InputFilter::filterInt($_GET['article_id']);
$article = ArticleModel::getByPK($articleId);

if( false !== $article && $article->current()->delete() ) {
    echo json_encode(['message' => 'Article deleted successfully']);
} else {
    echo json_encode(['error' => 'No article to delete']);
}