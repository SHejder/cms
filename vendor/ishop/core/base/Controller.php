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

    public function __construct($route){
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
        $this->model = $route['controller'];
    }

    public function getView(){
        $viewOdject = new View($this->route, $this->layout, $this->view, $this->meta);
        $viewOdject->render($this->data);
    }

    public function set($data){
        $this->data = $data;
    }

    public function setMeta($title = '', $desc = ''){
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;

    }

}