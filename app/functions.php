<?php

use Illuminate\Support\Facades\HTML;

/**
 * @param $route
 * @param $text
 * @param string $icon
 * @return string
 * smart navigation links
 */
HTML::macro('smartRoute_link', function($route, $text, $icon = '') {
    if(Request::is($route) || Request::is($route.'/*')) {
        $active = " class='active'";
    }
    else {
        $active = "";
    }
    return '<li'.$active.'><a href="'.url($route).'">'.$icon.' '.$text.'</a></li>';
});

/**
 * @param $string
 * @return string
 * safe name, no croatian letters
 */
function safe_name($string) {
    $string = preg_replace('/&scaron;/', 's', $string);   //'š' letter fix
    $string = preg_replace('/&quot;/', '', $string);   //'"' double quote fix
    $string = preg_replace('/&#039;/', '', $string);   //''' single quote fix
    $trans = ["š" => "s", "ć" => "c", "č" => "c", "đ" => "d", "ž" => "z", " " => "_", ">" => "", "<" => "", "." => "", "," => ""];

    return strtr(mb_strtolower($string, "UTF-8"), $trans);
}

/**
 * @param $string
 * @return string
 * string like slug URL, uses @safe_name() function
 */
function string_like_slug($string){
    $trans = ["_" => "-"];

    return strtr(safe_name($string), $trans);
}

/**
 * @param $image_name
 * @return string
 * return image name without extension for alt attribute of HTML <img> tag
 */
function imageAlt($image_name){
    return substr($image_name, 0, -4);
}