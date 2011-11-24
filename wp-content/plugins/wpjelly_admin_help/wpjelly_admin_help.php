<?php
/**
 * @author Kazuhiro Hara
 * @version 0.1
 */
/*
Plugin Name: WPJELLY-PLUGIN-ADMIN-HELP
Plugin URI: http://greative.jp/
Description: "入力システム用プラグイン：システム操作マニュアル"
Author: Kazuhiro Hara
Version: 0.1
Author URI: http://greative.jp/
*/

add_action('admin_menu', 'wpjelly_plugin_admin_help_add_menu');

/**
 * メニューからいけるリンク先コンテンツ
 */
function wpjelly_admin_help() {
	$wpjelly_admin_help_images = WP_PLUGIN_URL . '/wpjelly_admin_help/images';
	$str =  <<< EOF
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
<h2>システム操作マニュアル</h2>
</div>

<div id="greative_manual" style="padding:20px 20px;">
<div id="greative_manual_notes">
<h3>凡例</h3>
	<p><span class="greative_manual_link">[]</span>で囲まれた箇所はボタンやリンクの名前、<br />
	<span class="greative_manual_screenname">『』</span>で囲まれた箇所は画面の名前です。<br />
	<span class="greative_manual_headline">「」</span>で囲まれた箇所は項目や見出しなどを表しています。</p>
</div>

<div id="greative_manual_id_mokuji">
<h3>目次</h3>
	<ul>
    	<li><a href="#greative_manual_id_settei">設定</a></li>
	</ul>
	<ul>
		<li><a href="#greative_manual_id_smtp_settei">Cimy Swift SMTP</a>　管理者のみ</li>
	</ul>
<hr>
</div>

<div id="greative_manual_id_settei">
<h3>設定</h3><hr>

	<h4 id="greative_manual_id_smtp_settei">Cimy Swift SMTP　管理者のみ</h4>

	<p>ここは、メールサーバ（メールを送信するためのサーバ）を設定する画面です。</p>
	<p>使用するメールサーバの情報を入力したのち<span class="greative_manual_link">[変更を保存]</span>ボタンを押し、保存してください｡</p>
	<p>設定が有効かどうかを確認するために、一旦設定を保存した後、<span class="greative_manual_headline">「テスト接続」</span>の欄にメールの到着が確認できる適当なメールアドレスを入力し、メールを送信してみてください｡<br />
	メールが到着すれば、設定は完了です｡</p>
		<img src="{$wpjelly_admin_help_images}/manual_settei_cssmtp.png" width="100%" alt="Cimy Swift SMTP" />

	<p><a href="#greative_manual_id_mokuji">目次に戻る</a></p>
	<hr>
</div>
</div>
EOF;
	echo $str;
}

/**
 * メニューの作成とプラグイン内でいけるコンテンツのスタイル設定
 */
function wpjelly_plugin_admin_help_add_menu() {
	$hookname = add_submenu_page(
		'edit.php',
		'システム操作マニュアル',
		'システム操作マニュアル',
		'manage_options',
		__FILE__,
		'wpjelly_admin_help');
    add_action('admin_print_styles', 'wpjelly_add_css_all');
    //add_action('admin_print_styles' . '-' . $hookname, 'wpjelly_add_css_help');
}

/**
 * 全体のスタイル設定
 */
function wpjelly_add_css_all() {
	$wpjelly_admin_help_images = WP_PLUGIN_URL . '/wpjelly_admin_help/css';
	wp_register_style('wpjelly_admin_help_css', $wpjelly_admin_help_images . '/wpjelly.css');
	wp_enqueue_style('wpjelly_admin_help_css');
}

/**
 * プラグインのスタイル設定
 */
function wpjelly_add_css_help() {
	$wpjelly_admin_help_images = WP_PLUGIN_URL . '/wpjelly_admin_help/css';
	wp_register_style('wpjelly_admin_help_css_help', $wpjelly_admin_help_images . '/wpjelly_help.css');
	wp_enqueue_style('wpjelly_admin_help_css_help');
}

