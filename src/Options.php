<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 10/3/2019
 * Time: 4:39 PM.
 */

namespace EasyStore;

use EasyStore\Exception\RequiredOptionMissingException;

class Options
{
    protected static $options;

    public static function setOptions($options)
    {
        self::$options = array_merge(self::defaultOptions(), $options);
    }

    public static function getOptions($key = null)
    {
        if ($key === null) {
            return self::$options;
        }

        if (!isset(self::$options[$key])) {
            return;
        }

        return self::$options[$key];
    }

    protected static function defaultOptions()
    {
        return [
            'version' => '1.0',
            'timeout' => 15,
        ];
    }

    public static function validate()
    {
        if (!isset(self::$options['shop'])) {
            throw new RequiredOptionMissingException('easystore shop is required');
        }

        if (!self::endsWith(self::$options['shop'], '.easy.co')) {
            self::$options['shop'] .= '.easy.co';
        }
    }

    protected static function endsWith($string, $endString)
    {
        $len = strlen($endString);
        if ($len == 0) {
            return true;
        }

        return substr($string, -$len) === $endString;
    }
}
