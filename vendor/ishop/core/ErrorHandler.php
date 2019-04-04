<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 026 26.12.18
 * Time: 20:44
 */

namespace ishop;


class ErrorHandler{
    /**
     * ErrorHandler constructor.
     */
    public function __construct()
    {

        if(DEBUG){

            error_reporting(-1);

        } else {

            error_reporting(0);

        }
        set_exception_handler([$this, 'exceptionHandler']);

    }

    /**
     * @param \Exception $e
     */
    public function exceptionHandler(\Exception $e):void
    {

        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение',$e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    /**
     * @param string $messege
     * @param string $file
     * @param string $line
     */
    protected function logErrors(string $messege = '', string $file = '', string $line = ''):void
    {

        error_log("[". date('Y-m-d H:i:s') . "] Текст ошибки:
        {$messege} | Файл: {$file} | Строка: {$line}\n=====================\n",
            3, ROOT . '/tmp/errors.log');

    }

    /**
     * @param string $errno
     * @param string $errstr
     * @param string $errfile
     * @param string $errline
     * @param int $responce
     */
    protected function displayError(string $errno, string $errstr, string $errfile, string $errline, int $responce = 404):void
    {

        http_response_code($responce);
        if ($responce == 404 && !DEBUG){

            require WWW . '/errors/404.php';
            die;

        } else if(DEBUG){

            require WWW . '/errors/dev.php';

        } else {

            require WWW . '/errors/prod.php';

        }

        die;

    }
}