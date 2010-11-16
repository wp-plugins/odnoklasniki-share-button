<?php

/*
Plugin Name: Odnoklasniki Share Button
Version: 1.11
Plugin URI: http://exy.com.ua/
Description: Add Odnoklasniki Share Button
Author: ExyTab
Author URI: http://exy.com.ua/
*/

/*  Copyright 2010  Olexiy Novohatskiy  (email : myexytab@gmail.com) (twitter: @exytab)

    This plugin is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This plugin is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this plugin; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

		add_option('show', '1');
		add_option('in_general', '0');
		add_option('position', '1');
		add_option('side', 'right');
		add_option('size', 'odkl-klass');



		
add_action('wp_head', 'odnoklasniki_head');

function odnoklasniki_head() {
echo '<link rel="stylesheet" href="http://stg.odnoklassniki.ru/share/odkl_share.css"><script src="http://stg.odnoklassniki.ru/share/odkl_share.js" type="text/javascript"></script>';
}
		
		
		
add_action('admin_menu', 'odno_add_tools_menu');


function odno_add_tools_menu() {
add_options_page('Odnoklasniki Share Button', 'Odnoklasniki Share Button', 'manage_options', '', 'tp_manage_menu');
}

//setting

function tp_manage_menu(){

 echo '<div class="wrap">';
 echo '<h2>Одноклассники. Share Button. Настройка</h2>';

     if($_REQUEST['do'] == 'save')
     {
          update_option('show', $_REQUEST['show']);
          update_option('in_general', $_REQUEST['in_general']);
          update_option('position', $_REQUEST['position']);
          update_option('size', $_REQUEST['size']);
          update_option('side', $_REQUEST['side']);
          echo '<div id="message" class="updated"><p><strong>Параметры изменились</strong></p></div>';
     }


echo '<table><tr><td><form action="" method="post">
    <table class="form-table" border="0">
     <tr>

          <td width="360">Показывать кнопку?</td>
          <td><input type="radio" name="show" value="1" ';

if (get_option('show', '')==1) echo 'checked';

echo '> Да <br>
		<input type="radio" name="show" value="0" ';
if (get_option('show', '')==0) echo 'checked';
echo '> Нет  
	</td>
     </tr>
     <tr>

          <td colspan="2">(При "Нет" только загружаются библиотеки)</td>
     </tr>

     <tr>

          <td width="360">Выводить на главную страницу?</td>
          <td><input type="radio" name="in_general" value="1" ';

if (get_option('in_general', '')==1) echo 'checked';

echo '> Да <br>
		<input type="radio" name="in_general" value="0" ';
if (get_option('in_general', '')==0) echo 'checked';
echo '> Нет  
	</td>
     </tr>

	<tr>
          <td width="360">Положение:</td>
          <td><input type="radio" name="position" value="1" ';

if (get_option('position', '')==1) echo 'checked';

echo '> Сверху <br>
		<input type="radio" name="position" value="0" ';
if (get_option('position', '')==0) echo 'checked';
echo '> Снизу  <bh>
<hr>
<input type="radio" name="side" value="right" ';

if (get_option('side', '')=='right') echo 'checked';

echo '> Справа <br>
		<input type="radio" name="side" value="left" ';
if (get_option('side', '')=='left') echo 'checked';
echo '> Слева  
	</td>
     </tr>

	<tr>
          <td width="360">Размер</td>
          <td><input type="radio" name="size" value="odkl-klass" ';

if (get_option('size', '')=='odkl-klass') echo 'checked';

echo '> <img border="0" src="/wp-content/plugins/odnoklasniki/big.png"> <br>
		<input type="radio" name="size" value="odkl-klass-s" ';
if (get_option('size', '')=='odkl-klass-s') echo 'checked';
echo '> <img border="0" src="/wp-content/plugins/odnoklasniki/small.png"> 
	</td>
     </tr>

	</table>
	<input type="hidden" name="do" value="save">
	<br>
	<input type="submit" name="submit" value="Сохранить" class="button-primary">
     </form>
</td><td align="right" valign="top" width="200">
<table cellpadding="0" cellspacing="0" border="0" style="font: 0.8em Arial, sans-serif"><tr><td width="116" height="77" style="border: 0; background:url(https://img.yandex.net/i/money/top-5rub-default.gif) repeat-y; text-align:center; padding: 0;" align="center" valign="bottom"><form style="margin: 0; padding: 0 0 2px;" action="https://money.yandex.ru/donate.xml" method="post"><input type="hidden" name="to" value="41001677446224"/><input type="hidden" name="s5" value="5rub"/><input type="submit" value="Дай пять"/></form></td></tr><tr><td width="116" height="38" style="font-size:13px; color:black;padding: 0; border: 0; background:url(https://img.yandex.net/i/money/bg-default.gif) repeat-y; text-align:center; padding: 5px 0;" align="center" valign="top"><b>За плагин</b></td></tr><tr><td style="padding: 0; border:0;"><img src="https://img.yandex.net/i/money/bottom-default.gif" width="116" height="40" alt="" usemap="#button" border="0" /><map name="button"><area alt="Яндекс" coords="38,2,49,21" href="http://www.yandex.ru"><area alt="Яндекс. Деньги" coords="52,1,84,28" href="https://money.yandex.ru"><area alt="Хочу такую же кнопку" coords="17,29,100,40" href="https://money.yandex.ru/choose-banner.xml"></map></td></tr></table>
</td></tr></table>';


  echo '</div>';

}
//end setting

function add_post_odnoklasniki_content($content) {
if (get_option('show', '')==1){


	if (get_option('in_general', '')==1)	{
		if(!is_feed() ) {
			if(get_option('position', '')==1){

$content= "<div id=\"odno\"><a onclick=\"ODKL.Share(this);return false;\" style=\"float: " . get_option('side', '') . "; margin: 0px 0px 0px 5px;\" class=" . get_option('size', '') . " href=" . get_permalink() . "></a></div>" . $content;

			}
			if(get_option('position', '')==0){

$content= $content . "<div id=\"odno\"><a onclick=\"ODKL.Share(this);return false;\" style=\"float: " . get_option('side', '') . "; margin: 0px 0px 0px 5px;\" class=" . get_option('size', '') . " href=" . get_permalink() . "></a></div>" ;

			}
		}
	}
	if (get_option('in_general', '')==0)	{
		if(!is_feed() && !is_home() ) {
			if(get_option('position', '')==1){
$content= "<div id=\"odno\"><a onclick=\"ODKL.Share(this);return false;\" style=\"float: " . get_option('side', '') . "; margin: 0px 0px 0px 5px;\" class=" . get_option('size', '') . " href=" . get_permalink() . "></a></div>" . $content;

			}
			if(get_option('position', '')==0){
$content = $content . "<div id=\"odno\"><a onclick=\"ODKL.Share(this);return false;\" style=\"float: " . get_option('side', '') . "; margin: 0px 0px 0px 5px;\" class=" . get_option('size', '') . " href=" . get_permalink() . "></a></div>" ;

			}
		}
	}




 }


  
  return $content;
}

add_filter('the_content', 'add_post_odnoklasniki_content');



?>