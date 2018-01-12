<?php
namespace RESTAPI\Classes;

class AuthorModel extends AbstractModel
{
    public $AuthorId;
    public $AuthorName;

    public static $tableName = 'authors';

    protected static $tableSchema = array(
        'AuthorName'         => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'AuthorId';
}