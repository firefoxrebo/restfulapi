<?php

namespace RESTAPI\Controllers;

use RESTAPI\Classes\TopicModel;
use RESTAPI\Helpers\Helper;
use RESTAPI\Helpers\InputFilter;

class TopicsController extends AbstractController
{

    use InputFilter;

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
        }

        // Get all topics alongside their articles
        $topics = TopicModel::getAll();

        // output json
        if( false !== $topics ) {
            echo json_encode($topics, JSON_PRETTY_PRINT);
        } else {
            echo json_encode(['message' => 'no topics to show']);
        }
    }

    public function showAction()
    {
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
            exit(json_encode(['error' => 'missing parameter topic_id']));
        }

        $topicId = $this->filterInt($this->_params[0]);
        $topic = TopicModel::getByPK($topicId);

        if( false !== $topic ) {
            echo json_encode($topic, JSON_PRETTY_PRINT);
        } else {
            echo json_encode(['message' => 'no topic to show']);
        }
    }

    public function createAction()
    {
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
        $topic->TopicTitle = $this->filterString($data->title);

        if( $topic->save() ) {
            echo json_encode(['message' => 'Topic created successfully']);
        } else {
            echo json_encode(['error' => 'Topic has not been created. Please check your request parameters and try again']);
        }
    }

    public function deleteAction()
    {
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
            exit(json_encode(['error' => 'missing id parameter']));
        }

        $topicId = $this->filterInt($data->id);
        $topic = TopicModel::getByPK($topicId);

        if( false !== $topic && $topic->delete() ) {
            echo json_encode(['message' => 'Topic deleted successfully']);
        } else {
            echo json_encode(['error' => 'No topic to delete']);
        }
    }
}