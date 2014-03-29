<?php
/**
 * @author tran.duc.thang
 * BText - Base Text - extends the Text class of Phalcon, with various of features included.
 */
use Phalcon\Text;

class BText extends Text
{
    /**
     * Convert from snake_case to Words
     * For example it_is_an_example => It is an example or It Is An Example
     * @param $str string the inputed word
     * @param $ucword boolean the option to uppercase all the first character of each word or not
     * @return string the Words
     */
    public static function snakeToWords($str, $ucword=true)
    {
        $str = str_replace('_', ' ', $str);
        return $ucword ? ucwords($str) : ucfirst($str);
    }

    /**
     * Convert from CamelCase to Words
     * For example ItIsAnExample => It is an example or It Is An Example
     * @param $str string the inputed word
     * @param $uc_all boolean the option to uppercase all the first character of each word or not
     * @return string the Words
     */
    public static function camelToWords($str)
    {
        return static::snakeToWords(static::camelToSnake($str));
    }

    /**
     * Convert a snake_case string to CamelCase
     * @param $str string
     * @return string
     */
    public static function snakeToCamel($str)
    {
        return parent::camelize($str);
    }

    /**
     * Convert a CamelCase string to snake_case
     * @param $str string
     * @return string
     */
    public static function camelToSnake($str)
    {
        return parent::uncamelize($str);
    }

    /**
     * Convert a snake_case string to lowerCamelCase
     * For example it_is_an_example => itIsAnExample
     * @param $str string
     * @return string
     */
    public static function snakeToLowerCamel($str)
    {
        $str = static::snakeToCamel($str);
        return strtolower($str[0]) . substr($str, 1);
    }
}