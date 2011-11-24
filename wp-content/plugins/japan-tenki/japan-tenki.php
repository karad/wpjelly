<?php
/*
Plugin Name: Japan Tenki
Plugin URI: http://wp3.jp/
Description: This plugin can display a weather forecast and expected temperature of today, tomorrow, the day after tomorrow of the Japan 142 areas.
Author: Kunitoshi Hoshino
Version: 1.1
Author URI: http://wp3.jp/
License: GNU General Public License version 2 or any later version.
*/

/*
Copyright (C) 2011 Kunitoshi Hoshino
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

/*
Special Thanks
Hitoshi Omagari (jim0912) : I had him teach a source code.
http://www.warna.info/
Wataru Okamoto (wokamoto) : I had him teach a source code.
http://wokamoto.wordpress.com/
Hisayoshi Hattori (odyssey) : I had him teach English.
http://www.odysseygate.com/
*/



//This source code is for a short code.
function commu_tenki($atts, $content = null) {
	
	extract(shortcode_atts(array('area' => '1'), $atts));
	
	//This code retrieves the XML for the API Livedoor weather.
	$req1 = "http://weather.livedoor.com/forecast/webservice/rest/v1?city=".$area."&day=today";
	$req2 = "http://weather.livedoor.com/forecast/webservice/rest/v1?city=".$area."&day=tomorrow";
	$req3 = "http://weather.livedoor.com/forecast/webservice/rest/v1?city=".$area."&day=dayaftertomorrow";
	
	//This code parses the XML.
	$xml1 = simplexml_load_file ($req1);
	$xml2 = simplexml_load_file ($req2);
	$xml3 = simplexml_load_file ($req3);
	
	//Short codes are replaced by parts of the RETURN.
	if (empty($xml1->temperature->max->celsius)){
	return
	'<div class="japantenki">'.
	"<div class=\"japantenki1\">今日<br/><img src='".$xml1->image->url."'/><br/>".$xml1->telop."<br/><font color=#ff0000>-℃</font>/<font color=#0000ff>-℃</font></div>".
	"<div class=\"japantenki2\">明日<br/><img src='".$xml2->image->url."'/><br/>".$xml2->telop."<br/><font color=#ff0000>".$xml2->temperature->max->celsius."℃</font>/<font color=#0000ff>".$xml2->temperature->min->celsius."℃</font></div>".
	"<div class=\"japantenki3\">明後日<br/><img src='".$xml3->image->url."'/><br/>".$xml3->telop."<br/><font color=#ff0000>".$xml3->temperature->max->celsius."℃</font>/<font color=#0000ff>".$xml3->temperature->min->celsius."℃</font></div>".
	'<br clear="all">'.
	'</div>'
	;
	}
	elseif (empty($xml2->temperature->max->celsius)){
	return
	'<div class="japantenki">'.
	"<div class=\"japantenki1\">今日<br/><img src='".$xml1->image->url."'/><br/>".$xml1->telop."<br/><font color=#ff0000>".$xml1->temperature->max->celsius."℃</font>/<font color=#0000ff>".$xml1->temperature->min->celsius."℃</font></div>".
	"<div class=\"japantenki2\">明日<br/><img src='".$xml2->image->url."'/><br/>".$xml2->telop."<br/><font color=#ff0000>-℃</font>/<font color=#0000ff>-℃</font></div>".
	"<div class=\"japantenki3\">明後日<br/><img src='".$xml3->image->url."'/><br/>".$xml3->telop."<br/><font color=#ff0000>".$xml3->temperature->max->celsius."℃</font>/<font color=#0000ff>".$xml3->temperature->min->celsius."℃</font></div>".
	'<br clear="all">'.
	'</div>'
	;
	}
	else
	{
	return
	'<div class="japantenki">'.
	"<div class=\"japantenki1\">今日<br/><img src='".$xml1->image->url."'/><br/>".$xml1->telop."<br/><font color=#ff0000>".$xml1->temperature->max->celsius."℃</font>/<font color=#0000ff>".$xml1->temperature->min->celsius."℃</font></div>".
	"<div class=\"japantenki2\">明日<br/><img src='".$xml2->image->url."'/><br/>".$xml2->telop."<br/><font color=#ff0000>".$xml2->temperature->max->celsius."℃</font>/<font color=#0000ff>".$xml2->temperature->min->celsius."℃</font></div>".
	"<div class=\"japantenki3\">明後日<br/><img src='".$xml3->image->url."'/><br/>".$xml3->telop."<br/><font color=#ff0000>".$xml3->temperature->max->celsius."℃</font>/<font color=#0000ff>".$xml3->temperature->min->celsius."℃</font></div>".
	'<br clear="all">'.
	'</div>'
	;
	}
}
add_shortcode("tenki","commu_tenki");



// I was able to use the short cord in widget areas.
add_filter('widget_text', 'do_shortcode');



function commu_tenki_CSS(){
	$url = WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__));
	$css = $url.'/style.css';
	echo '<link rel="stylesheet" type="text/css" media="all" href="'.$css.'">';
}
add_action("wp_head","commu_tenki_CSS");





//This source code to display the menu of the control panel.
add_action('admin_menu', 'commu_tenki_menu');
function commu_tenki_menu() {
	add_options_page('日本の天気', '日本の天気', 8, __FILE__, 'commu_tenki_menu_display');
}

function commu_tenki_menu_display() {

?>

<div class="wrap">
<h2>日本の天気</h2>

「Japan Tenki」プラグインは、全国142ヶ所の今日・明日・明後日の天気予報と予想気温をWordPressに表示することができます。<br />
<br />
<b>表示方法</b><br />
「Japan Tenki」プラグインは、プラグインを有効化しただけでは天気予報と予想気温は表示されません。<br />
プラグインを有効後、以下のいずれかの方法により、天気予報と予想気温が表示されます。<br />
<br />
<b>（１）ショートコードが使える部分で表示させたい場合</b><br />
WordPressの本文記事中などショートコードが使える部分では、<br />
[tenki area="63"]<br />
と書きますと、今日・明日・明後日の天気予報と予想気温が、自動で表示されます。<br />
（なお、ウィジェットエリアでもショートコードが使えるように対応していますので、ウィジェットエリアのテキストに [tenki area="63"] と書いても表示されます。）<br />
<br />
<b>（２）ショートコードが使えない部分で表示させたい場合</b><br />
WordPressのテーマに直接書く場合などショートコードが使えない部分では、このプラグインを有効化した後、<br />
&lt;?php echo do_shortcode('[tenki area="63"]'); ?&gt;<br />
と書きますと、今日・明日・明後日の天気予報と予想気温が、自動で表示されます。<br />
<br />
なお、「63」は東京の番号です。全国142ヶ所の各地域のareaの数字は、以下の表を参照ください。<br />
上に書きました例ですと、「63」を各地域の数字に変えていただければ、その地域の天気予報と予想気温が表示されます。<br />
<br />
<b>（例）[tenki area="63"]と書いた場合 ＝ 東京の今日・明日・明後日の天気予報と最高気温・最低気温が表示されます。</b><br />
<br />
<?php echo do_shortcode('[tenki area="63"]'); ?>
<br />
ショートコードの前後には、自分で自由に情報を入れられるように、あえてタイトル文字なども入れていません。<br />
上の例ですと、<br />
東京の天気&lt;br /&gt;<br />
[tenki area="63"]<br />
のように、「東京の天気」などの文字は自分で自由に追加しましょう。<br />
<br />
また、PHPのif文で条件分岐をすることで、47都道府県の情報を自由に出すこともできます。<br />
<b>（例）<a href="http://www.japan-aquarium.com/" target="_blank">水族館コミュニティ</a></b><br />
<br />
その他、ご意見やご要望、不明点などがありましたら、このプラグインの作者である、株式会社コミュニティコムの星野邦敏まで、ご連絡ください。<br />
以下のブログまたはTwitterにご連絡いただけますとスムーズです。<br />
このプラグインを使ったサイト事例などもご連絡をいただけましたら、ご紹介させていただきます。<br />
<b><a href="http://wp3.jp/" target="_blank">WordPress（ワードプレス）コミュニティ</a></b><br />
<b><a href="http://twitter.com/#!/khoshino" target="_blank">Twitter @khoshino</a></b><br />
<br />



<div class="commu-tenki-clear">　</div>

<b>全国142ヶ所のareaの数字</b><br />
<table class="commu-tenki-left">
<tr>
<td class="commu-tenki-th" colspan="3">
<b>北海道地方</b>
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="16">
北海道
</td>
<td class="commu-tenki-td3">
稚内
</td>
<td class="commu-tenki-td">
[tenki area="1"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
旭川
</td>
<td class="commu-tenki-td">
[tenki area="2"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
留萌
</td>
<td class="commu-tenki-td">
[tenki area="3"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
札幌
</td>
<td class="commu-tenki-td">
[tenki area="4"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
岩見沢
</td>
<td class="commu-tenki-td">
[tenki area="5"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
倶知安
</td>
<td class="commu-tenki-td">
[tenki area="6"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
網走
</td>
<td class="commu-tenki-td">
[tenki area="7"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
北見
</td>
<td class="commu-tenki-td">
[tenki area="8"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
紋別
</td>
<td class="commu-tenki-td">
[tenki area="9"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
根室
</td>
<td class="commu-tenki-td">
[tenki area="10"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
釧路
</td>
<td class="commu-tenki-td">
[tenki area="11"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
帯広
</td>
<td class="commu-tenki-td">
[tenki area="12"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
室蘭
</td>
<td class="commu-tenki-td">
[tenki area="13"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
浦河
</td>
<td class="commu-tenki-td">
[tenki area="14"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
函館
</td>
<td class="commu-tenki-td">
[tenki area="15"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
江差
</td>
<td class="commu-tenki-td">
[tenki area="16"]
</td>
</tr>
</table>



<table class="commu-tenki-left">
<tr>
<td class="commu-tenki-th" colspan="3">
<b>東北地方</b>
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="3">
青森県
</td>
<td class="commu-tenki-td3">
青森
</td>
<td class="commu-tenki-td">
[tenki area="17"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
むつ
</td>
<td class="commu-tenki-td">
[tenki area="18"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
八戸
</td>
<td class="commu-tenki-td">
[tenki area="19"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
秋田県
</td>
<td class="commu-tenki-td3">
秋田
</td>
<td class="commu-tenki-td">
[tenki area="20"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
横手
</td>
<td class="commu-tenki-td">
[tenki area="21"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="3">
岩手県
</td>
<td class="commu-tenki-td3">
盛岡
</td>
<td class="commu-tenki-td">
[tenki area="22"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
宮古
</td>
<td class="commu-tenki-td">
[tenki area="23"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
大船渡
</td>
<td class="commu-tenki-td">
[tenki area="24"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
宮城県
</td>
<td class="commu-tenki-td3">
仙台
</td>
<td class="commu-tenki-td">
[tenki area="25"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
白石
</td>
<td class="commu-tenki-td">
[tenki area="26"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="4">
山形県
</td>
<td class="commu-tenki-td3">
山形
</td>
<td class="commu-tenki-td">
[tenki area="27"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
米沢
</td>
<td class="commu-tenki-td">
[tenki area="28"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
酒田
</td>
<td class="commu-tenki-td">
[tenki area="29"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
新庄
</td>
<td class="commu-tenki-td">
[tenki area="30"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="3">
福島県
</td>
<td class="commu-tenki-td3">
福島
</td>
<td class="commu-tenki-td">
[tenki area="31"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
小名浜
</td>
<td class="commu-tenki-td">
[tenki area="32"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
若松
</td>
<td class="commu-tenki-td">
[tenki area="33"]
</td>
</tr>
</table>



<table class="commu-tenki-left">
<tr>
<td class="commu-tenki-th" colspan="3">
<b>関東地方</b>
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
茨城県
</td>
<td class="commu-tenki-td3">
水戸
</td>
<td class="commu-tenki-td">
[tenki area="54"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
土浦
</td>
<td class="commu-tenki-td">
[tenki area="55"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
栃木県
</td>
<td class="commu-tenki-td3">
宇都宮
</td>
<td class="commu-tenki-td">
[tenki area="56"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
大田原
</td>
<td class="commu-tenki-td">
[tenki area="57"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
群馬県
</td>
<td class="commu-tenki-td3">
前橋
</td>
<td class="commu-tenki-td">
[tenki area="58"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
みなかみ
</td>
<td class="commu-tenki-td">
[tenki area="59"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="3">
埼玉県
</td>
<td class="commu-tenki-td3">
さいたま
</td>
<td class="commu-tenki-td">
[tenki area="60"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
熊谷
</td>
<td class="commu-tenki-td">
[tenki area="61"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
秩父
</td>
<td class="commu-tenki-td">
[tenki area="62"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="4">
東京都
</td>
<td class="commu-tenki-td3">
東京
</td>
<td class="commu-tenki-td">
[tenki area="63"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
大島
</td>
<td class="commu-tenki-td">
[tenki area="64"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
八丈島
</td>
<td class="commu-tenki-td">
[tenki area="65"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
父島
</td>
<td class="commu-tenki-td">
[tenki area="66"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="3">
千葉県
</td>
<td class="commu-tenki-td3">
千葉
</td>
<td class="commu-tenki-td">
[tenki area="67"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
銚子
</td>
<td class="commu-tenki-td">
[tenki area="68"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
館山
</td>
<td class="commu-tenki-td">
[tenki area="69"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
神奈川県
</td>
<td class="commu-tenki-td3">
横浜
</td>
<td class="commu-tenki-td">
[tenki area="70"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
小田原
</td>
<td class="commu-tenki-td">
[tenki area="71"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
山梨県
</td>
<td class="commu-tenki-td3">
甲府
</td>
<td class="commu-tenki-td">
[tenki area="75"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
河口湖
</td>
<td class="commu-tenki-td">
[tenki area="76"]
</td>
</tr>
</table>



<div class="commu-tenki-clear">　</div>



<table class="commu-tenki-left">
<tr>
<td class="commu-tenki-th" colspan="3">
<b>信越・北陸地方</b>
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
富山県
</td>
<td class="commu-tenki-td3">
富山
</td>
<td class="commu-tenki-td">
[tenki area="44"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
伏木
</td>
<td class="commu-tenki-td">
[tenki area="45"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
石川県
</td>
<td class="commu-tenki-td3">
金沢
</td>
<td class="commu-tenki-td">
[tenki area="46"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
輪島
</td>
<td class="commu-tenki-td">
[tenki area="47"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
福井県
</td>
<td class="commu-tenki-td3">
福井
</td>
<td class="commu-tenki-td">
[tenki area="48"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
敦賀
</td>
<td class="commu-tenki-td">
[tenki area="49"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="4">
新潟県
</td>
<td class="commu-tenki-td3">
新潟
</td>
<td class="commu-tenki-td">
[tenki area="50"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
長岡
</td>
<td class="commu-tenki-td">
[tenki area="51"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
高田
</td>
<td class="commu-tenki-td">
[tenki area="52"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
相川
</td>
<td class="commu-tenki-td">
[tenki area="53"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="3">
長野県
</td>
<td class="commu-tenki-td3">
長野
</td>
<td class="commu-tenki-td">
[tenki area="72"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
松本
</td>
<td class="commu-tenki-td">
[tenki area="73"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
飯田
</td>
<td class="commu-tenki-td">
[tenki area="74"]
</td>
</tr>
</table>



<table class="commu-tenki-left">
<tr>
<td class="commu-tenki-th" colspan="3">
<b>東海地方</b>
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="4">
静岡県
</td>
<td class="commu-tenki-td3">
静岡
</td>
<td class="commu-tenki-td">
[tenki area="34"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
網代
</td>
<td class="commu-tenki-td">
[tenki area="35"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
三島
</td>
<td class="commu-tenki-td">
[tenki area="36"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
浜松
</td>
<td class="commu-tenki-td">
[tenki area="37"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
愛知県
</td>
<td class="commu-tenki-td3">
名古屋
</td>
<td class="commu-tenki-td">
[tenki area="38"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
豊橋
</td>
<td class="commu-tenki-td">
[tenki area="39"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
岐阜県
</td>
<td class="commu-tenki-td3">
岐阜
</td>
<td class="commu-tenki-td">
[tenki area="40"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
高山
</td>
<td class="commu-tenki-td">
[tenki area="41"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
三重県
</td>
<td class="commu-tenki-td3">
津
</td>
<td class="commu-tenki-td">
[tenki area="42"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
尾鷲
</td>
<td class="commu-tenki-td">
[tenki area="43"]
</td>
</tr>
</table>



<table class="commu-tenki-left">
<tr>
<td class="commu-tenki-th" colspan="3">
<b>近畿地方</b>
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
滋賀県
</td>
<td class="commu-tenki-td3">
大津
</td>
<td class="commu-tenki-td">
[tenki area="77"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
彦根
</td>
<td class="commu-tenki-td">
[tenki area="78"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
京都府
</td>
<td class="commu-tenki-td3">
京都
</td>
<td class="commu-tenki-td">
[tenki area="79"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
舞鶴
</td>
<td class="commu-tenki-td">
[tenki area="80"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="1">
大阪府
</td>
<td class="commu-tenki-td3">
大阪
</td>
<td class="commu-tenki-td">
[tenki area="81"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
兵庫県
</td>
<td class="commu-tenki-td3">
神戸
</td>
<td class="commu-tenki-td">
[tenki area="82"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
豊岡
</td>
<td class="commu-tenki-td">
[tenki area="83"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
奈良県
</td>
<td class="commu-tenki-td3">
奈良
</td>
<td class="commu-tenki-td">
[tenki area="84"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
風屋
</td>
<td class="commu-tenki-td">
[tenki area="85"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
和歌山県
</td>
<td class="commu-tenki-td3">
和歌山
</td>
<td class="commu-tenki-td">
[tenki area="86"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
潮岬
</td>
<td class="commu-tenki-td">
[tenki area="87"]
</td>
</tr>
</table>



<div class="commu-tenki-clear">　</div>



<table class="commu-tenki-left">
<tr>
<td class="commu-tenki-th" colspan="3">
<b>中国地方</b>
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
岡山県
</td>
<td class="commu-tenki-td3">
岡山
</td>
<td class="commu-tenki-td">
[tenki area="88"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
津山
</td>
<td class="commu-tenki-td">
[tenki area="89"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
広島県
</td>
<td class="commu-tenki-td3">
広島
</td>
<td class="commu-tenki-td">
[tenki area="90"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
庄原
</td>
<td class="commu-tenki-td">
[tenki area="91"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="3">
島根県
</td>
<td class="commu-tenki-td3">
松江
</td>
<td class="commu-tenki-td">
[tenki area="92"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
浜田
</td>
<td class="commu-tenki-td">
[tenki area="93"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
西郷
</td>
<td class="commu-tenki-td">
[tenki area="94"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
鳥取県
</td>
<td class="commu-tenki-td3">
鳥取
</td>
<td class="commu-tenki-td">
[tenki area="95"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
米子
</td>
<td class="commu-tenki-td">
[tenki area="96"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="4">
山口県
</td>
<td class="commu-tenki-td3">
下関
</td>
<td class="commu-tenki-td">
[tenki area="97"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
山口
</td>
<td class="commu-tenki-td">
[tenki area="98"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
柳井
</td>
<td class="commu-tenki-td">
[tenki area="99"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
萩
</td>
<td class="commu-tenki-td">
[tenki area="100"]
</td>
</tr>
</table>



<table class="commu-tenki-left">
<tr>
<td class="commu-tenki-th" colspan="3">
<b>四国地方</b>
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
徳島県
</td>
<td class="commu-tenki-td3">
徳島
</td>
<td class="commu-tenki-td">
[tenki area="101"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
日和佐
</td>
<td class="commu-tenki-td">
[tenki area="102"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="1">
香川県
</td>
<td class="commu-tenki-td3">
高松
</td>
<td class="commu-tenki-td">
[tenki area="103"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="3">
愛媛県
</td>
<td class="commu-tenki-td3">
松山
</td>
<td class="commu-tenki-td">
[tenki area="104"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
新居浜
</td>
<td class="commu-tenki-td">
[tenki area="105"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
宇和島
</td>
<td class="commu-tenki-td">
[tenki area="106"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="3">
高知県
</td>
<td class="commu-tenki-td3">
高知
</td>
<td class="commu-tenki-td">
[tenki area="107"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
室戸
</td>
<td class="commu-tenki-td">
[tenki area="108"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
清水
</td>
<td class="commu-tenki-td">
[tenki area="109"]
</td>
</tr>
</table>



<table class="commu-tenki-left">
<tr>
<td class="commu-tenki-th" colspan="3">
<b>九州地方・南西諸島地方</b>
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="4">
福岡県
</td>
<td class="commu-tenki-td3">
福岡
</td>
<td class="commu-tenki-td">
[tenki area="110"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
八幡
</td>
<td class="commu-tenki-td">
[tenki area="111"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
飯塚
</td>
<td class="commu-tenki-td">
[tenki area="112"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
久留米
</td>
<td class="commu-tenki-td">
[tenki area="113"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="4">
大分県
</td>
<td class="commu-tenki-td3">
大分
</td>
<td class="commu-tenki-td">
[tenki area="114"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
中津
</td>
<td class="commu-tenki-td">
[tenki area="115"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
日田
</td>
<td class="commu-tenki-td">
[tenki area="116"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
佐伯
</td>
<td class="commu-tenki-td">
[tenki area="117"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="4">
長崎県
</td>
<td class="commu-tenki-td3">
長崎
</td>
<td class="commu-tenki-td">
[tenki area="118"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
佐世保
</td>
<td class="commu-tenki-td">
[tenki area="119"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
厳原
</td>
<td class="commu-tenki-td">
[tenki area="120"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
福江
</td>
<td class="commu-tenki-td">
[tenki area="121"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="2">
佐賀県
</td>
<td class="commu-tenki-td3">
佐賀
</td>
<td class="commu-tenki-td">
[tenki area="122"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
伊万里
</td>
<td class="commu-tenki-td">
[tenki area="123"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="4">
熊本県
</td>
<td class="commu-tenki-td3">
熊本
</td>
<td class="commu-tenki-td">
[tenki area="124"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
阿蘇乙姫
</td>
<td class="commu-tenki-td">
[tenki area="125"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
牛深
</td>
<td class="commu-tenki-td">
[tenki area="126"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
人吉
</td>
<td class="commu-tenki-td">
[tenki area="127"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="4">
宮崎県
</td>
<td class="commu-tenki-td3">
宮崎
</td>
<td class="commu-tenki-td">
[tenki area="128"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
延岡
</td>
<td class="commu-tenki-td">
[tenki area="129"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
都城
</td>
<td class="commu-tenki-td">
[tenki area="130"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
高千穂
</td>
<td class="commu-tenki-td">
[tenki area="131"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="4">
鹿児島県
</td>
<td class="commu-tenki-td3">
鹿児島
</td>
<td class="commu-tenki-td">
[tenki area="132"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
鹿屋
</td>
<td class="commu-tenki-td">
[tenki area="133"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
種子島
</td>
<td class="commu-tenki-td">
[tenki area="134"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
名瀬
</td>
<td class="commu-tenki-td">
[tenki area="135"]
</td>
</tr>
<tr>
<td class="commu-tenki-td2" rowspan="7">
沖縄県
</td>
<td class="commu-tenki-td3">
那覇
</td>
<td class="commu-tenki-td">
[tenki area="136"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
名護
</td>
<td class="commu-tenki-td">
[tenki area="137"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
久米島
</td>
<td class="commu-tenki-td">
[tenki area="138"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
南大東島
</td>
<td class="commu-tenki-td">
[tenki area="139"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
宮古島
</td>
<td class="commu-tenki-td">
[tenki area="140"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
石垣島
</td>
<td class="commu-tenki-td">
[tenki area="141"]
</td>
</tr>
<tr>
<td class="commu-tenki-td3">
与那国島
</td>
<td class="commu-tenki-td">
[tenki area="142"]
</td>
</tr>
</table>

<div class="commu-tenki-clear">　</div>

なお、「Japan Tenki」プラグインは、<a href="http://weather.livedoor.com/weather_hacks/webservice.html" target="_blank">livedoor Weather Hacks</a>から情報を取得しています。<br />
利用規約などに関しては、<a href="http://weather.livedoor.com/weather_hacks/qa.html" target="_blank">Q&A - livedoor Weather Hacks</a>をご覧ください。<br />

</div>

<?php
}



function commu_tenki_menu_CSS(){
	$url = WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__));
	$cssmenu = $url.'/stylemenu.css';
	echo '<link rel="stylesheet" type="text/css" media="all" href="'.$cssmenu.'">';
}
add_action("admin_head","commu_tenki_menu_CSS");
