<?php
namespace RESTAPI\Helpers;

/**
 * Class Helper
 * @package RESTAPI\Helpers
 * @Author Mohammed Yehia
 */
class Helper
{
    /**
     * @return bool true if the authorization key is valid, false otherwise
     */
    public static function requestIsAuthorized ()
    {
        $authorization = @getallheaders()['Authorization'];
        $authorization = str_replace('key=', '', $authorization);
        return $authorization === API_AUTHORIZATION_KEY;
    }

}