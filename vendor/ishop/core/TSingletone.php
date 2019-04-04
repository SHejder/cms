<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 026 26.12.18
 * Time: 18:32
 */

namespace ishop;


trait TSingletone {

    private static $instance;

    /**
     * @return object
     */
    public static function instance (): object
    {
        if(self::$instance === null){
            self::$instance = new self;
        }

        return self::$instance;
    }


}