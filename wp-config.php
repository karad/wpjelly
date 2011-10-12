<?php
/**
 * The base configurations of the WordPress.
 *
 * このファイルは、MySQL、テーブル接頭辞、秘密鍵、言語、ABSPATH の設定を含みます。
 * より詳しい情報は {@link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86 
 * wp-config.php の編集} を参照してください。MySQL の設定情報はホスティング先より入手できます。
 *
 * このファイルはインストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さず、このファイルを "wp-config.php" という名前でコピーして直接編集し値を
 * 入力してもかまいません。
 *
 * @package WordPress
 */

// 注意: 
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - こちらの情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'wordpress_3_2_1');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'root');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'root');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースのキャラクターセット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'dn1Gb.7pW ]cRD;C)^HVCoMk,~[tuxY<W+pPs{3Knq/^2S4#caJT =uEvNGVVYsY');
define('SECURE_AUTH_KEY',  'pM gwjRoXC@D64B4.}i<)nWtC~-({Q69ety;R#BN-a`P3Qn3J:}Pkf%~DjOJ +~%');
define('LOGGED_IN_KEY',    '88kz2OC^6B/&iWrl-0.u[#l)>>^{CEu]no/c_VJ?.$nh+>1K0j>?YkV]B8jrX#`)');
define('NONCE_KEY',        'S9AU(bL]d;l |^q|HC77HWp@g{U9;-GgbJsP%oAssr7`8(,`hV%* loS[>Zk-CxS');
define('AUTH_SALT',        '.4mC&ZWFR<(^K4ax3} BU-4;OR{pvT50b,40<MoI6=ed9oYPe2FIv+kBIn#ehF|v');
define('SECURE_AUTH_SALT', 'P)n_$/qr+Lw2.Hbx#(z1V:berM/EcXMYW#5w[ 1h^KCQ-)0LvY94i1`$lNJG>b_f');
define('LOGGED_IN_SALT',   '#l.#nd9>M.FUd^R32re~|@uLe(32u3|R2n{SZA&(x|IsX#Qx*L?bN<,:.lC+9*Y|');
define('NONCE_SALT',       '_iCd;K- AwnL,pd>R 1)-d6|>uFidnq<|ow+h+/z$>@M5QC-|7QfZ4~Ph-XTt>|K');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * ローカル言語 - このパッケージでは初期値として 'ja' (日本語 UTF-8) が設定されています。
 *
 * WordPress のローカル言語を設定します。設定した言語に対応する MO ファイルが
 * wp-content/languages にインストールされている必要があります。例えば de_DE.mo を
 * wp-content/languages にインストールし WPLANG を 'de_DE' に設定することでドイツ語がサポートされます。
 */
define('WPLANG', 'ja');

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
