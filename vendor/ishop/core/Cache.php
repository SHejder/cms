<?php


namespace ishop;


class Cache
{

    use TSingletone;

    /**
     * @param string $key
     * @param array $data
     * @param int $time
     * @return bool
     */
    public function set(string $key, array $data, int $time = 3600):bool
    {
        if($time)
        {
            $content['data'] = $data;
            $content['end_time'] = time() + $time;
            if(file_put_contents(CACHE.'/'.md5($key).'.txt', serialize($content)))
            {
                return true;
            }

        }
        return false;
    }

    /**
     * @param string $key
     * @return array|bool
     */
    public function get(string $key):mixed
    {
        $file = CACHE.'/'.md5($key).'txt';
        if(file_exists($file))
        {
            $content = unserialize(file_get_contents($file));
            if(time() <= $content['end_time'])
            {
                return $content;
            }
            unlink($file);
        }
        return false;
    }

    /**
     * @param string $key
     */
    public function delete(string $key):void
    {
        $file = CACHE.'/'.md5($key).'txt';
        if(file_exists($file))
        {
            unlink($file);
        }
    }

}