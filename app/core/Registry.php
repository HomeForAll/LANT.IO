<?php

class Registry
{
    private static $variables = [];
    private static $models = [];

    /**
     * @param string $name - Имя переменной
     * @param $value - Значение
     */
    public static function set($name, $value)
    {
        self::$variables[$name] = $value;
    }

    public static function get($name)
    {
        return isset(self::$variables[$name]) ? self::$variables[$name] : null;
    }

    public static function del($name)
    {
        unset(self::$variables[$name]);
        array_values(self::$variables);
    }

    public static function model($name)
    {
        $name = strtolower($name);
        $name = ucfirst($name);
        
        if (!isset(self::$models[$name]) || empty(self::$models[$name])) {
            $model = $name . 'Model';

            self::$models[$name] = new $model;
            return self::$models[$name];
        } else {
            return self::$models[$name];
        }
    }
}