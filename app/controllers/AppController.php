<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 030 30.12.18
 * Time: 11:21
 */

namespace app\controllers;


use app\models\AppModel;
use ishop\base\Controller;

class AppController extends Controller
{
    /**
     * AppController constructor.
     * @param string $route
     */
    public function __construct(string $route)
    {
        parent::__construct($route);
        new AppModel();
    }
}