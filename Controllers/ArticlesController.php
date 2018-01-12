<?php

namespace RESTAPI\Controllers;

use RESTAPI\Classes\TopicModel;
use RESTAPI\Classes\ArticleModel;
use RESTAPI\Classes\AuthorModel;
use RESTAPI\Helpers\Helper;
use RESTAPI\Helpers\InputFilter;

class ArticlesController extends AbstractController
{

    use InputFilter;

    /**
     * @api {get} /topics/list/:id Show a list of articles related to a specific topic
     * @apiName ListArticles
     * @apiGroup Articles
     *
     * @apiParam {Number} id Topic unique ID.
     * @example refer to Tests/http/articles/list.http file
     * @apiSuccess {JSON} the list of articles related toa specific topic.
     */
    public function listAction()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: access");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Credentials: true");
        header('Content-Type: application/json');

        // Check if the request is authorized (has a valid authorization key)
        if(!Helper::requestIsAuthorized()) {
            exit(json_encode(['error' => '400 Bad Request']));
        } elseif (!isset($this->_params[0])) {
            exit(json_encode(['error' => 'missing parameter topic_id']));
        }

        $topicId = $this->filterInt($this->_params[0]);
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
    }

    /**
     * @api {get} /topics/show/:id Show an article
     * @apiName ShowArticle
     * @apiGroup Articles
     *
     * @apiParam {Number} id Article unique ID.
     * @example refer to Tests/http/articles/show.http file
     * @apiSuccess {JSON} the requested article to show.
     */
    public function showAction()
    {
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

        if(!isset($this->_params[0])) {
            exit(json_encode(['error' => 'missing parameter article_id']));
        }

        $articleId = $this->filterInt($this->_params[0]);
        $article = ArticleModel::getByPK($articleId);

        if( false !== $article ) {
            echo json_encode($article, JSON_PRETTY_PRINT);
        } else {
            echo json_encode(['message' => 'no article to show']);
        }
    }

    /**
     * @api {post} /topics/create Creates a new article
     * @apiName CreateArticle
     * @apiGroup Articles
     *
     * @apiParam {JSON} post_request_data.
     * @example refer to Tests/http/articles/create.http file
     * @apiSuccess {JSON} a message of success or failure.
     */
    public function createAction()
    {
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
    }

    /**
     * @api {post} /topics/delete Deletes an article
     * @apiName DeleteArticle
     * @apiGroup Articles
     *
     * @apiParam {JSON} post_request_data.
     * @example refer to Tests/http/articles/delete.http file
     * @apiSuccess {JSON} a message of success or failure.
     */
    public function deleteAction()
    {
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

        if(is_null($data) || !isset($data->id)) {
            exit(json_encode(['error' => 'missing parameter id']));
        }

        $articleId = $this->filterInt($data->id);
        $article = ArticleModel::getByPK($articleId);

        if( false !== $article && $article->current()->delete() ) {
            echo json_encode(['message' => 'Article deleted successfully']);
        } else {
            echo json_encode(['error' => 'No article to delete']);
        }
    }
}