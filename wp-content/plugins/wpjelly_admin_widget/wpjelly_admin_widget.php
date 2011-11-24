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
    if ( !empty($_POST['posted']) && $_POST['posted'] === 'yes' ) {
        check_admin_referer('wpjelly_admin_widget', 'greative');
		update_option('admin_widget', strip_tags($_POST['admin_widget']));
        echo '<div class="updated"><p><strong>忙しさを保存しました</strong></p></div>';
    }
	$str .=  <<< EOF
<form action="" method="post">
<select name="admin_widget" id="admin_widget">
EOF;
    $works = array(
        array('value' => '忙しい', 'text' => '忙しい'),
        array('value' => '普通', 'text' => '普通'),
        array('value' => 'ひま', 'text' => 'ひま'),
    );
    $selected_value = get_option('admin_widget');
    foreach ($works as $work) {
        $selected = ($selected_value == $work['value']) ? ' selected="selected"' : '';
        $str .= '<option value="' . esc_attr($work['value']) . '" ' . $selected . '>' . esc_attr($work['text']) . '</option>';
    }
    $str .= '</select>';
    $str .= wp_nonce_field('wpjelly_admin_widget', 'greative', true, false);
	$str .=  <<< EOF
<input type="hidden" name="posted" value="yes" />
<p class="submit"><input type="submit" name="Submit" class="button-primary" value="保存" /></p>
</form>
</div>
EOF;
	echo $str;
}



class AdminWidget extends WP_Widget {
    function AdminWidget() {
        parent::WP_Widget(false, $name = '現在の忙しさ');
    }
    function widget($args, $instance) {
        extract( $args );
        echo $before_widget;
        echo $before_title . $widget_name . $after_title;
        $admin_widget = get_option('admin_widget');
        echo '<p>' . $admin_widget . '</p>';
        echo $after_widget;
    }
}

add_action('widgets_init', create_function('', 'return register_widget("AdminWidget");'));

?>