<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/*
Plugin Name: WPJELLY-PLUGIN-IKZO
Plugin URI: http://greative.jp/
Description: "入力システム用プラグイン：IKZO"
Author: Kazuhiro Hara
Version: 0.1
Author URI: http://greative.jp/
*/

function wpjelly_plugin_filter_ikzo($content) {
    //require_once(dirname(__FILE__) . '/mb_str_replace.function.php');
    //$content = mb_str_replace('。', 'もねぇ！　', $content);
    $content = preg_replace_callback('/(。)/', 'wpjelly_plugin_filter_ikzo_cb', $content);
    return $content;
}

function wpjelly_plugin_filter_ikzo_cb($matches) {
    $ikzo = array('テレビ','ラジオ','電気');
    $ikzo_key = array_rand($ikzo,1);
    $result = 'も' . $ikzo[$ikzo_key] . 'もねぇ！　';
    return $result;
}

add_filter('the_content','wpjelly_plugin_filter_ikzo');
add_filter('the_title','wpjelly_plugin_filter_ikzo');
add_filter('list_cats','wpjelly_plugin_filter_ikzo');
add_filter('title_edit_pre','wpjelly_plugin_filter_ikzo');


?>