<?php
/*
Plugin Name: キッズデータ
Plugin URI:
Description: 子どもの名前、生年月日と性別を入力すると、子どもの情報を表示するウィジェットができます。
Version: 1.0
Author: Shinichi Nishikawa
*/


// 設定画面へのリンクを出し、設定画面表示の関数を指定する
function kd_child_info_admin() {
     add_submenu_page('profile.php', '子どものプロフィール', '子どものプロフィール', 'add_users', __FILE__, 'kd_child_info_admin_output');
}
add_action('admin_menu', 'kd_child_info_admin');

// 設定画面を出す
function kd_child_info_admin_output() {
	if ( !empty($_POST['posted']) && $_POST['posted'] == 'yes' ) {
		check_admin_referer('kids_my_love');
		// 入力値を保存する処理
		update_option('child_name_1', strip_tags(stripslashes($_POST['child_name_1'])));
		update_option('birth_year_1', intval($_POST['birth_year_1']));
		update_option('birth_month_1', intval($_POST['birth_month_1']));
		update_option('birth_day_1', intval($_POST['birth_day_1']));
		if ( $_POST['sex_1'] == 'boy' || $_POST['sex_1'] == 'girl' ) {
			update_option('sex_1', $_POST['sex_1']);			
		}
	}
	
	if( !empty($_POST['posted']) && $_POST['posted'] == 'yes') : ?><div class="updated"><p><strong>お子さんのプロフィールを保存しました</strong></p></div><?php endif; ?>
	<div class="wrap">
	     <div class="kids-data icon32"></div><h2>お子さんのプロフィール編集</h2>
	     <form action="" method="post">
	           <table class="form-table">
					<tr valign="top">
					<th scope="row"><label for="child_name_1">お名前（ニックネーム）</label></th>
					<td><input type="text" name="child_name_1" id="child_name_1" value="<?php echo form_option('child_name_1'); ?>" class="regular-text code" /></td>
					</tr>
					<tr valign="top">
						<th scope="row">お誕生日/出産予定日</th>
						<td>
						<select name="birth_year_1" id="birth_year_1">
						<?php
						$years = array(
							array('value' => '2001', 'text'=>'2001'),
							array('value' => '2002', 'text'=>'2002'),
							array('value' => '2003', 'text'=>'2003'),
							array('value' => '2004', 'text'=>'2004'),
							array('value' => '2005', 'text'=>'2005'),
							array('value' => '2006', 'text'=>'2006'),
							array('value' => '2007', 'text'=>'2007'),
							array('value' => '2008', 'text'=>'2008'),
							array('value' => '2009', 'text'=>'2009'),
							array('value' => '2010', 'text'=>'2010'),
							array('value' => '2011', 'text'=>'2011'),
							array('value' => '2012', 'text'=>'2012'),
						);
						foreach ($years as $year) : ?>
							<option value="<?php echo esc_attr($year['value']); ?>" <?php if(get_option('birth_year_1') == $year['value']){ echo ' selected="selected"'; } ?>><?php echo esc_attr($year['text']); ?></option>
						<?php endforeach; ?>
						</select>年
						<select name="birth_month_1" id="birth_month_1">
						<?php 
						$months = array(
							array('value' => '01', 'text' => '01'),
							array('value' => '02', 'text' => '02'),
							array('value' => '03', 'text' => '03'),
							array('value' => '04', 'text' => '04'),
							array('value' => '05', 'text' => '05'),
							array('value' => '06', 'text' => '06'),
							array('value' => '07', 'text' => '07'),
							array('value' => '08', 'text' => '08'),
							array('value' => '09', 'text' => '09'),
							array('value' => '10', 'text' => '10'),
							array('value' => '11', 'text' => '11'),
							array('value' => '12', 'text' => '12')
						);
						foreach ($months as $month) : ?>
							<option value="<?php echo esc_attr($month['value']); ?>" <?php if(get_option('birth_month_1') == $month['value']){ echo ' selected="selected"'; } ?>><?php echo esc_attr($month['text']); ?></option>
						<?php endforeach; ?>
						</select>月

						<select name="birth_day_1" id="birth_day_1">
						<?php 
						$days = array(
							array('value' => '01', 'text' => '01'),
							array('value' => '02', 'text' => '02'),
							array('value' => '03', 'text' => '03'),
							array('value' => '04', 'text' => '04'),
							array('value' => '05', 'text' => '05'),
							array('value' => '06', 'text' => '06'),
							array('value' => '07', 'text' => '07'),
							array('value' => '08', 'text' => '08'),
							array('value' => '09', 'text' => '09'),
							array('value' => '10', 'text' => '10'),
							array('value' => '11', 'text' => '11'),
							array('value' => '12', 'text' => '12'),
							array('value' => '13', 'text' => '13'),
							array('value' => '14', 'text' => '14'),
							array('value' => '15', 'text' => '15'),
							array('value' => '16', 'text' => '16'),
							array('value' => '17', 'text' => '17'),
							array('value' => '18', 'text' => '18'),
							array('value' => '19', 'text' => '19'),
							array('value' => '20', 'text' => '20'),
							array('value' => '21', 'text' => '21'),
							array('value' => '22', 'text' => '22'),
							array('value' => '23', 'text' => '23'),
							array('value' => '24', 'text' => '24'),
							array('value' => '25', 'text' => '25'),
							array('value' => '26', 'text' => '26'),
							array('value' => '27', 'text' => '27'),
							array('value' => '28', 'text' => '28'),
							array('value' => '29', 'text' => '29'),
							array('value' => '30', 'text' => '30'),
							array('value' => '31', 'text' => '31')
						);
						foreach ($days as $day) : ?>
							<option value="<?php echo esc_attr($day['value']); ?>" <?php if(get_option('birth_day_1') == $day['value']){ echo ' selected="selected"'; } ?>><?php echo esc_html($day['text']); ?></option>
						<?php endforeach; ?>
						</select>日
						</td>
					</tr>
					<tr>
						<th scope="row">性別</th>
						<td>
							<label for="boy"><input type="radio" name="sex_1" value="boy" id="boy" <?php if(get_option('sex_1') == 'boy' ){ echo ' checked="checked"'; } ?> />男の子</label>
							<label for="girl"><input type="radio" name="sex_1" value="girl" id="girl" <?php if(get_option('sex_1') == 'girl' ){ echo ' checked="checked"'; } ?> />女の子</label>
						</td>
					</tr>
	           </table>
	           <input type="hidden" name="posted" value="yes" />
	           <?php wp_nonce_field('kids_my_love'); ?>
	           <p class="submit"><input type="submit" name="Submit" class="button-primary" value="子ども情報を保存" /></p>
	     </form>
	</div>
	<?php
}

class ChildInfo extends WP_Widget {
    /** constructor */
    function ChildInfo() {

          $widget_ops = array(
               'description' => 'お子さんの誕生日のカウントダウンやイベントなどを表示します。'
          );

        parent::WP_Widget(false, $name = '子供情報', $widget_ops);    
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {         
        extract( $args );
        ?>
              <?php echo $before_widget; ?>
                  <?php 
                        //年齢を求める
                        $now = date('Ymd');//今
						$birth_year_1 = (int)get_option('birth_year_1');
						$birth_month_1 = (int)get_option('birth_month_1');
						$birth_day_1 = (int)get_option('birth_day_1');
						$birthday = date('Ymd', mktime(0, 0, 0, $birth_month_1, $birth_day_1, $birth_year_1) );//誕生日
						$age =  ($now - $birthday);
                        $age =  floor($age/10000);//年齢

                        //月齢（年齢は無視して何ヶ月か）を求める
                        $m = date('m') - $birth_month_1;
                        if ( $birth_day_1 > date('j') ) {
                        	$m--;
                        }
                        if ( $m < 0 ) {
                        	$m = $m+12;
                        }

                        //性別で敬称を変える
                         if ( get_option('sex_1') == 'boy' ) {
                        	$sex = 'くん';
                        } else {
                        	$sex = 'ちゃん';
                        }

                       // 生後日数を求める関数
                       function get_days_baby_lived($birthday_life, $today_life) {
							$u_date_of_birth = strtotime($birthday_life);  //日付前をUNIXタイム化
							$u_date_today = strtotime($today_life);  //日付後をUNIXタイム化
							$days_baby_lived = ($u_date_today-$u_date_of_birth)/86400 + 1;  //差を24（時間）×60（分）×60（秒）で割る
							return $days_baby_lived;
						}
						$days_baby_lived = get_days_baby_lived($birthday,$now);

						// 次の誕生日までの日数をカウントダウンする関数
						function kids_birthday_countdown($birth_month_1,$birth_day_1) {
							$coming_birth_month = $birth_month_1;
							$coming_birth_day = $birth_day_1;
							$one_day_length = 60 * 60 * 24;
							$this_year = date('Y');
							$now = time();
							$the_day = mktime(0, 0, 0, $coming_birth_month, $coming_birth_day, $this_year);
							if ($now < $the_day) {
								$remain_day = ceil (($the_day - $now) / $one_day_length);
								return $remain_day;
							} elseif ( date ('Ymd', $now) == date ('Ymd', $the_day) ) {
								$remain_day = 0;
								return $remain_day;
							} else {
								$next_year = ++$this_year ;
								$the_day = mktime(0, 0, 0, $coming_birth_month, $coming_birth_day, $next_year);
								$remain_day = ceil (($the_day - $now) / $one_day_length);
								return $remain_day;
							}
						}
						
                       
                        //タイトル
                        $title = esc_html(get_option('child_name_1')).$sex.'（'.$age.'才'.$m.'ヶ月）';

                        echo $before_title . $title . $after_title; ?>

                        <ul>
                        	<li><?php echo (int)$birth_year_1; ?>年<?php echo (int)$birth_month_1; ?>月<?php echo (int)$birth_day_1; ?>日生まれ</li>
                        	<li>生後<?php echo $days_baby_lived; ?>日目</li>
                        	<li>次のお誕生日まであと<?php echo kids_birthday_countdown($birth_month_1,$birth_day_1); ?>日</li>
                        </ul>
              <?php echo $after_widget;
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {                   
        return $new_instance;
    }
    
} // class ChildInfo

add_action('widgets_init', create_function('', 'return register_widget("ChildInfo");'));

function kidsdatastyle() {
	$kids_bg_img_path = plugins_url() . '/kids-data/kids-bg-img.png';
	echo "
	<style type=\"text/css\">
		.kids-data {
			background: url('{$kids_bg_img_path}') no-repeat scroll center center transparent;
			width: 42px;
		}
	</style>
	";
}
add_action('admin_head', 'kidsdatastyle');