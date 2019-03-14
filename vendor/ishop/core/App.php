<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 026 26.12.18
 * Time: 18:22
 */

namespace ishop;


class App {

    public static $app;

    public function __construct()  {
        $query = trim($_SERVER['QUERY_STRING'],'/');
        session_start();

        self::$app = Registry::instance();

        $this->getParams();
        new ErrorHandler();
        Router::dispatch($query);

    }
    protected function getParams(){
        $params = require_once CONFIG . '/params.php';
        if (!empty($params)){
            foreach ($params as $k => $v){
                self::$app->setProperty($k, $v);
            }
        }
    }

}