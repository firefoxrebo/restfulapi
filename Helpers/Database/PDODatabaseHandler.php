<?php
namespace RESTAPI\Helpers\Database;

class PDODatabaseHandler extends DatabaseHandler
{

    private static $_instance;
    private static $_handler;

    private function __construct(){
        self::init();
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array(&self::$_handler, $name), $arguments);
    }

    protected static function init()
    {
        try {
            self::$_handler = new \PDO(
                'mysql:hostname=' . DATABASE_HOST_NAME . ';dbname=' . DATABASE_DB_NAME . ';charset=UTF8',
                DATABASE_USER_NAME, DATABASE_PASSWORD, array(
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING
                )
            );
        } catch (\PDOException $e) {

        }
    }

    public static function getInstance()
    {
        if(self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}