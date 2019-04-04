<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 030 30.12.18
 * Time: 11:13
 */

namespace ishop\base;


abstract class Controller{

    public $route;
    public $controller;
    public $view;
    public $model;
    public $prefix;
    public $layout;
    public $data = [];
    public $meta = [];

    /**
     * Controller constructor.
     * @param array $route
     */
    public function __construct(array $route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
        $this->model = $route['controller'];
    }

    /**
     * @throws \Exception
     */
    public function getView():void
    {

        $viewOdject = new View($this->route, $this->layout, $this->view, $this->meta);
        $viewOdject->render($this->data);
    }

    /**
     * @param array $data
     */
    public function set(array $data):void
    {
        $this->data = $data;
    }

    /**
     * @param string $title
     * @param string $desc
     */
    public function setMeta(string $title = '', string $desc = ''):void
    {
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;

    }

}