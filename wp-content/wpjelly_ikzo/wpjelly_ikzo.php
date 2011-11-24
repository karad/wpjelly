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
    require_once(dirname(__FILE__) . '/mb_str_replace.function.php');
    $content = mb_str_replace('。', 'もねぇ！　', $content);
    return $content;
}

add_filter('the_content','wpjelly_plugin_filter_ikzo');

?>