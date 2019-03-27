<?php
/**
 * Created by PhpStorm.
 * User: moskito
 * Date: 20/05/2016
 * Time: 05:19 PM
 */
namespace app\custom;

use yii\helpers\Html;
use yii\helpers\Url;

class GlypIcon extends Html
{
   
    public static function aglyp($text,$icon, $url = null, $options = [])
    {
        if ($url !== null||$url!="") {
            $options['href'] = Url::to($url);
        }
        return static::tagglyp('a',$icon, $text, $options);
    }

    public static function tagglyp($name,$icon, $content = '', $options = [])
    {
        $glyp = " <span class='glyphicon $icon'></span> ";
        if ($name === null || $name === false) {
            return $content;
        }
        $html = "<$name" . static::renderTagAttributes($options) . '>';
        return isset(static::$voidElements[strtolower($name)]) ? $html : "$html$glyp$content</$name>";
    }
}