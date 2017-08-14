<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\components\helpers;

use yii\helpers\StringHelper as BaseStringHelper;

/**
 * StringHelper
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Alex Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class StringHelper extends BaseStringHelper
{
	/**
     * Returns a string in a URL friendly format. This function is
     * recommended to be used on non-multibyte character sets. So 
     * this is not recommended for UTF-8, since certain PHP 
     * functions (like strtolower) should not be used on multibyte
     * strings.
     * @param string $str The input string.
     * @return string The URL friendly string.
     */
    public static function generateSlug($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
        return 'n-a';
        }

        return $text;

        // $str = trim(mb_strtolower($str));
        // $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        // $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        // $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        // $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        // $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        // $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        // $str = preg_replace('/(đ)/', 'd', $str);
        // $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        // $str = preg_replace('/([\s]+)/', '-', $str);
        // return $str;
    }
}
