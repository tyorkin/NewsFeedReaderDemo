<?php
namespace Service;


abstract class Service
{
    protected static $instances = [];
    
    
    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Service The *Singleton* instance.
     */
    public static function getInstance()
    {
        $calledClass = get_called_class();

        if (!isset(self::$instances[$calledClass])) {
            self::$instances[$calledClass] = new $calledClass();
        }

        return self::$instances[$calledClass];

        
    }


    protected function __construct() {}
}

