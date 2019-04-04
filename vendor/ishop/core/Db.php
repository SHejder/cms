<?php


namespace ishop;


use RedBeanPHP\R;

class Db
{
    use TSingletone;

    /**
     * Db constructor.
     * @throws \Exception
     */
    protected function __construct()
    {
        $db = require_once CONFIG . '/db.php';
        class_alias('\RedBeanPHP\R', 'R');
        R::setup($db['dsn'],$db['user'],$db['pass']);
        R::freeze(true);
        if(DEBUG)
        {
            R::debug(true,1);
        }
        if(!R::testConnection())
        {
            throw new \Exception("No db connection", 500);
        }



    }
}