<?php

class ServiceBroker {

    private static $services = array();

    public static function get($name) {
        if( isset(self::$services[$name]) ) {
            return self::$services[$name];
        }

        if( !class_exists($name) ) {
            require_once $name . ".php";
        }
        return new $name();
    }

    public static function set($name, $value) {
        self::$services[$name] = $value;
    }
}
