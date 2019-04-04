<?php


namespace ishop\base;


use ishop\Db;

abstract class Model
{
    public $atributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {
        Db::instance();
    }

}