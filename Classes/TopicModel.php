<?php
namespace RESTAPI\Classes;

class TopicModel extends AbstractModel
{
    public $TopicId;
    public $TopicTitle;

    public static $tableName = 'topics';

    protected static $tableSchema = array(
        'TopicTitle'         => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'TopicId';

    public static function getByPK($pk)
    {
        $topic = self::getOne(
            'select t1.TopicId, t1.TopicTitle, GROUP_CONCAT(t2.AuthorName SEPARATOR "@@") ArticleAuthors, 
                  GROUP_CONCAT(t3.ArticleTitle SEPARATOR "@@") ArticleTitles,
                  GROUP_CONCAT(t3.ArticleId SEPARATOR "@@") ArticleIds,
                  GROUP_CONCAT(t3.AuthorId SEPARATOR "@@") ArticleAuthorIds, 
                  GROUP_CONCAT(t3.ArticleContent SEPARATOR "@@") ArticleContents from ' . self::$tableName . ' t1 
                  left join articles t3 on t3.TopicId = t1.TopicId left join authors t2 on t3.AuthorId = t2.AuthorId
                  WHERE t1.TopicId = ' . $pk . ' 
                  GROUP BY t1.TopicId'
        );
        if(false !== $topic) {

            if($topic->ArticleAuthors === null) goto noArticles;

            $topicAuthors = explode('@@', $topic->ArticleAuthors);
            $articleTitles = explode('@@', $topic->ArticleTitles);
            $articleContents = explode('@@', $topic->ArticleContents);
            $articleIds = explode('@@', $topic->ArticleIds);
            $articleAuthorIds = explode('@@', $topic->ArticleAuthorIds);

            $topic->Articles = [];
            for( $i = 0, $ii = count($topicAuthors); $i < $ii; $i++ ) {
                $article = new ArticleModel();
                $article->ArticleId = $articleIds[$i];
                $article->AuthorId = $articleAuthorIds[$i];
                $article->ArticleTitle = $articleTitles[$i];
                $article->ArticleContent = $articleContents[$i];
                $article->AuthorName = $topicAuthors[$i];
                unset($article->TopicId);
                $topic->Articles[] = $article;
            }

            noArticles:
            unset($topic->ArticleAuthors);
            unset($topic->ArticleTitles);
            unset($topic->ArticleContents);
            unset($topic->ArticleIds);
            unset($topic->ArticleAuthorIds);

            return $topic;
        }
        return false;
    }

    public static function getAll()
    {
        $topics = self::get(
            'select t1.TopicId, t1.TopicTitle, GROUP_CONCAT(t2.AuthorName SEPARATOR "@@") ArticleAuthors, 
                  GROUP_CONCAT(t3.ArticleTitle SEPARATOR "@@") ArticleTitles,
                  GROUP_CONCAT(t3.ArticleId SEPARATOR "@@") ArticleIds,
                  GROUP_CONCAT(t3.AuthorId SEPARATOR "@@") ArticleAuthorIds, 
                  GROUP_CONCAT(t3.ArticleContent SEPARATOR "@@") ArticleContents from ' . self::$tableName . ' t1 
                  left join articles t3 on t3.TopicId = t1.TopicId left join authors t2 on t3.AuthorId = t2.AuthorId 
                  GROUP BY t1.TopicId'
        );
        if(false !== $topics) {
            foreach ($topics as $topic) {

                if($topic->ArticleAuthors === null) goto noArticles;

                $topicAuthors = explode('@@', $topic->ArticleAuthors);
                $articleTitles = explode('@@', $topic->ArticleTitles);
                $articleContents = explode('@@', $topic->ArticleContents);
                $articleIds = explode('@@', $topic->ArticleIds);
                $articleAuthorIds = explode('@@', $topic->ArticleAuthorIds);

                $topic->Articles = [];
                for( $i = 0, $ii = count($topicAuthors); $i < $ii; $i++ ) {
                    $article = new ArticleModel();
                    $article->ArticleId = $articleIds[$i];
                    $article->AuthorId = $articleAuthorIds[$i];
                    $article->ArticleTitle = $articleTitles[$i];
                    $article->ArticleContent = $articleContents[$i];
                    $article->AuthorName = $topicAuthors[$i];
                    unset($article->TopicId);
                    $topic->Articles[] = $article;
                }

                noArticles:
                unset($topic->ArticleAuthors);
                unset($topic->ArticleTitles);
                unset($topic->ArticleContents);
                unset($topic->ArticleIds);
                unset($topic->ArticleAuthorIds);
            }
            return $topics;
        }
        return false;
    }
}