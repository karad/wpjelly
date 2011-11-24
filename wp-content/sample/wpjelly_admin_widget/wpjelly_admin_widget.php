<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/*
Plugin Name: WPJELLY-PLUGIN-ADMIN-WIDGET
Plugin URI: http://greative.jp/
Description: "入力システム用プラグイン：現在の忙しさウィジェット"
Author: Kazuhiro Hara
Version: 0.1
Author URI: http://greative.jp/
*/

add_action('admin_menu', 'wpjelly_plugin_admin_widget_add_menu');

/**
 * メニューの設定
 */
function wpjelly_plugin_admin_widget_add_menu() {
	$hookname = add_submenu_page(
		'edit.php',
		'サンプルウィジェット',
		'サンプルウィジェット',
		'manage_options',
		__FILE__,
		'wpjelly_admin_widget');
}

/**
 * メニューからいけるリンク先コンテンツ
 */
function wpjelly_admin_widget() {
	$str =  <<< EOF
<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div>
<h2>現在の忙しさウィジェット</h2>
<p>現在の忙しさをアピールしましょう！</p>
EOF;
    // ここに挿入1
	$str .=  <<< EOF
<form action="" method="post">
<select name="admin_widget" id="admin_widget">
EOF;
    // ここに挿入2-1
    // ここに挿入2-2
    // ここに挿入2-3
    $str .= '</select>';
    // ここに挿入3
	$str .=  <<< EOF
<input type="hidden" name="posted" value="yes" />
<p class="submit"><input type="submit" name="Submit" class="button-primary" value="保存" /></p>
</form>
</div>
EOF;
	echo $str;
}

// ここに挿入4

// ここに挿入5


?>