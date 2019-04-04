<?php


namespace ishop;


class Db
{
    use TSingletone;

    protected function __construct()
    {
        $db = require_once CONFIG . '/db.php';
    }
}