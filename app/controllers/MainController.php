<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 030 30.12.18
 * Time: 11:04
 */

namespace app\controllers;



use ishop\Cache;
use RedBeanPHP\R;

class MainController extends AppController {


    public function indexAction(){

        $posts = R::findAll('test');
        $this->setMeta('test', 'test_desc');
        $cache = Cache::instance();
        $cache->set('test',$posts);
        $this->set(compact('posts'));
    }
}