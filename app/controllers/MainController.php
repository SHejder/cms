<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 030 30.12.18
 * Time: 11:04
 */

namespace app\controllers;



class MainController extends AppController {


    public function indexAction(){
        $this->setMeta('test', 'test_desc');
        $this->set(['name'=>'Иван']);
    }
}