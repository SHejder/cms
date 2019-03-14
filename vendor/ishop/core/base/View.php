<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 030 30.12.18
 * Time: 11:25
 */

namespace ishop\base;


class View{

    public $route;
    public $controller;
    public $view;
    public $model;
    public $prefix;
    public $data = [];
    public $meta = [];
    public $layout;


    public function __construct($route, $layout = '', $view = '', $meta){
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->model = $route['controller'];
        $this->meta = $meta;
        if($layout === false){
            $this->layout = false;
        }else{
            $this->layout = $layout ?: LAYOUT;
        }
    }

    public function render($data){
        $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";
        if(is_file($viewFile)){
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        }else{
            throw new \Exception("Не найден вид {$viewFile}", 500);
        }
        if(false !== $this->layout){
           echo $layoutFile = APP . "/views/layouts/{$this->layout}.php";
        }
    }


}