<?php
namespace RESTAPI\Classes;

class ArticleModel extends AbstractModel
{
    public $ArticleId;
    public $TopicId;
    public $AuthorId;
    public $ArticleTitle;
    public $ArticleContent;

    public static $tableName = 'articles';

    protected static $tableSchema = array(
        'TopicId'         => self::DATA_TYPE_INT,
        'AuthorId'        => self::DATA_TYPE_INT,
        'ArticleTitle'    => self::DATA_TYPE_STR,
        'ArticleContent'  => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'ArticleId';

    public static function getByPK ($id)
    {
        return self::get(
            'SELECT t1.*, t2.AuthorName, t3.TopicTitle From ' . self::$tableName . ' t1
                INNER JOIN authors t2 on t2.AuthorId = t1.AuthorId
                INNER JOIN topics t3 on t3.TopicId = t1.TopicId WHERE t1.ArticleId = ' . $id
        );
    }

    public static function getArticlesForTopic (TopicModel $topic)
    {
        return self::get(
            'SELECT t1.*, t2.AuthorName, t3.TopicTitle From ' . self::$tableName . ' t1
                INNER JOIN authors t2 on t2.AuthorId = t1.AuthorId
                INNER JOIN topics t3 on t3.TopicId = t1.TopicId WHERE t1.TopicId = ' . $topic->TopicId
        );
    }
}