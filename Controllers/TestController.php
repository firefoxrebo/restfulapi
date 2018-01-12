<?php
namespace RESTAPI\Controllers;

class TestController extends AbstractController
{
    public function listTopicsAction()
    {
        $ch = curl_init('http://restapi.test/topics/list');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: key=AAAAV-VAFJg:APA91bGcvvfbXFMuDvP-QxafH35cFt5AvZzXTh1AVflW84T48_U_07NAMZ0HqtMlPbcIoLL4DnycWKNbh_t2CWAerPdRLYBJz_up9CejHBuid3elQ7enPh_F274K8ROirchIh8031r_'
        ));
        $result = curl_exec($ch);
        header('Content-Type: application/json');
        echo $result;
    }

    public function showTopicAction()
    {
        $ch = curl_init('http://restapi.test/topics/show/2');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: key=AAAAV-VAFJg:APA91bGcvvfbXFMuDvP-QxafH35cFt5AvZzXTh1AVflW84T48_U_07NAMZ0HqtMlPbcIoLL4DnycWKNbh_t2CWAerPdRLYBJz_up9CejHBuid3elQ7enPh_F274K8ROirchIh8031r_'
        ));
        $result = curl_exec($ch);
        header('Content-Type: application/json');
        echo $result;
    }

    public function createTopicAction()
    {
        $data = array("title" => "Economy");
        $data_string = json_encode($data);

        $ch = curl_init('http://restapi.test/topics/create');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'Authorization: key=AAAAV-VAFJg:APA91bGcvvfbXFMuDvP-QxafH35cFt5AvZzXTh1AVflW84T48_U_07NAMZ0HqtMlPbcIoLL4DnycWKNbh_t2CWAerPdRLYBJz_up9CejHBuid3elQ7enPh_F274K8ROirchIh8031r_'
            )
        );

        $result = curl_exec($ch);
        header('Content-Type: application/json');
        echo $result;
    }

    public function deleteTopicAction()
    {
        $data = array("id" => 5);
        $data_string = json_encode($data);

        $ch = curl_init('http://restapi.test/topics/delete');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'Authorization: key=AAAAV-VAFJg:APA91bGcvvfbXFMuDvP-QxafH35cFt5AvZzXTh1AVflW84T48_U_07NAMZ0HqtMlPbcIoLL4DnycWKNbh_t2CWAerPdRLYBJz_up9CejHBuid3elQ7enPh_F274K8ROirchIh8031r_'
            )
        );

        $result = curl_exec($ch);
        header('Content-Type: application/json');
        echo $result;
    }

    public function listArticlesForTopicAction()
    {
        $ch = curl_init('http://restapi.test/articles/list/1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: key=AAAAV-VAFJg:APA91bGcvvfbXFMuDvP-QxafH35cFt5AvZzXTh1AVflW84T48_U_07NAMZ0HqtMlPbcIoLL4DnycWKNbh_t2CWAerPdRLYBJz_up9CejHBuid3elQ7enPh_F274K8ROirchIh8031r_'
        ));
        $result = curl_exec($ch);
        header('Content-Type: application/json');
        echo $result;
    }

    public function showArticleAction()
    {
        $ch = curl_init('http://restapi.test/articles/show/2');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: key=AAAAV-VAFJg:APA91bGcvvfbXFMuDvP-QxafH35cFt5AvZzXTh1AVflW84T48_U_07NAMZ0HqtMlPbcIoLL4DnycWKNbh_t2CWAerPdRLYBJz_up9CejHBuid3elQ7enPh_F274K8ROirchIh8031r_'
        ));
        $result = curl_exec($ch);
        header('Content-Type: application/json');
        echo $result;
    }

    public function createArticleAction()
    {
        $data = [
            "title" => "Zidan is announcing new deals this winter: Part3",
            "content" => "This is the content",
            "author_id" => 3,
            "topic_id" => 3
        ];

        $data_string = json_encode($data);

        $ch = curl_init('http://restapi.test/articles/create');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'Authorization: key=AAAAV-VAFJg:APA91bGcvvfbXFMuDvP-QxafH35cFt5AvZzXTh1AVflW84T48_U_07NAMZ0HqtMlPbcIoLL4DnycWKNbh_t2CWAerPdRLYBJz_up9CejHBuid3elQ7enPh_F274K8ROirchIh8031r_'
            )
        );

        $result = curl_exec($ch);
        header('Content-Type: application/json');
        echo $result;
    }

    public function deleteArticleAction()
    {
        $data = array("id" => 19);
        $data_string = json_encode($data);

        $ch = curl_init('http://restapi.test/articles/delete');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'Authorization: key=AAAAV-VAFJg:APA91bGcvvfbXFMuDvP-QxafH35cFt5AvZzXTh1AVflW84T48_U_07NAMZ0HqtMlPbcIoLL4DnycWKNbh_t2CWAerPdRLYBJz_up9CejHBuid3elQ7enPh_F274K8ROirchIh8031r_'
            )
        );

        $result = curl_exec($ch);
        header('Content-Type: application/json');
        echo $result;
    }
}