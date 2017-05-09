<?php
namespace app\components\color;

/**
 * Class ColorFactory
 * @package app\components\color
 */
class ColorFactory
{
    private static $message;
    private static $_instance;


    public static function text($text)
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        self::$message = $text;
        return self::$_instance;
    }

    public function color($color)
    {
        $c = new Color();
        return $c(self::$message)->highlight($color);
    }
}