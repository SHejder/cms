<?php
/**
 * Created by PhpStorm.
 * User: Макс
 * Date: 026 26.12.18
 * Time: 18:30
 */

namespace ishop;


class Registry
{

    use TSingletone;

    protected static $properties = [];

    /**
     * @param string $name
     * @param string $value
     */
    public function setProperty(string $name, string $value) :void
    {
        self::$properties[$name] = $value;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function getProperty(string $name):mixed
    {
        if (isset(self::$properties[$name])){
            return self::$properties[$name];
        }

        return null;
    }

    /**
     * @return array
     */
    public function getProperties():array
    {
        return self::$properties;
    }

}