<?php

/*
Plugin Name: Odnoklasniki Share Button
Version: 1.0
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


		add_option('in_general', '0');
		add_option('position', '1');
		add_option('size', '1');
		add_option('text', 'Класс!');

		
add_action('wp_head', 'odnoklasniki_head');

function odnoklasniki_head() {

echo '<link rel="stylesheet" href="http://stg.odnoklassniki.ru/share/odkl_share.css"><script src="http://stg.odnoklassniki.ru/share/odkl_share.js" type="text/javascript"></script>';

}
		
		
		
add_action('admin_menu', 'odno_add_tools_menu');


function odno_add_tools_menu() {

add_options_page('Odnoklasniki Share Button', 'Odnoklasniki Share Button', 'manage_options', '', 'tp_manage_menu');

}


function tp_manage_menu(){

 
     if($_REQUEST['do'] == 'save')
     {
          update_option('in_general', $_REQUEST['in_general']);
          update_option('position', $_REQUEST['position']);
          update_option('size', $_REQUEST['size']);
          update_option('text', $_REQUEST['text']);
          echo '<div id="message" class="updated"><p><strong>Параметры изменились</strong></p></div>';
     }


echo '<form action="" method="post">
    <table class="form-table" border="0">
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
          <td width="360">Положение</td>
          <td><input type="radio" name="position" value="1" ';

if (get_option('position', '')==1) echo 'checked';

echo '> Сверху <br>
		<input type="radio" name="position" value="0" ';
if (get_option('position', '')==0) echo 'checked';
echo '> Снизу  
	</td>
     </tr>

	<tr>
          <td width="360">Размер</td>
          <td><input type="radio" name="size" value="1" ';

if (get_option('size', '')==1) echo 'checked';

echo '> Большой <br>
		<input type="radio" name="size" value="0" ';
if (get_option('size', '')==0) echo 'checked';
echo '> Маленький  
	</td>
     </tr>

	<tr>
          <td width="360">Текст кнопки</td>
          <td>
		<input type="text"  name="text"  value="' . get_option('text', '') . '">
	</td>
     </tr> 
	</table>
	<input type="hidden" name="do" value="save">
	<br>
	<input type="submit" name="submit" value="Сохранить" class="button-primary">
     </form>

';
}
//end setting

function add_post_odnoklasniki_content($content) {
	if (get_option('in_general', '')==1)	{
		if(!is_feed() ) {
			if(get_option('position', '')==1){
				if(get_option('size', '')==1){	
$content= "<div id=\"odno\"><a onclick=\"ODKL.Share(this);return false;\" class=odkl-klass href=" . get_permalink() . ">' . get_option('text', '') . '</a></div>" . $content;
				}
				if(get_option('size', '')==0){	
$content= "<div id=\"odno\"><a onclick=\"ODKL.Share(this);return false;\" class=odkl-klass-s href=" . get_permalink() . "></a></div>" . $content;
				}
			}
			if(get_option('position', '')==0){
				if(get_option('size', '')==1){	
$content= $content .  "<div id=\"odno\"><a onclick=\"ODKL.Share(this);return false;\" class=odkl-klass href=" . get_permalink() . ">' . get_option('text', '') . '</a></div>" ;
				}
				if(get_option('size', '')==0){	
$content= $content . "<div id=\"odno\"><a onclick=\"ODKL.Share(this);return false;\" class=odkl-klass-s href=" . get_permalink() . "></a></div>" ;
				}
			}
		}
	}
	if (get_option('in_general', '')==0)	{
		if(!is_feed() && !is_home() ) {
			if(get_option('position', '')==1){
				if(get_option('size', '')==1){	
$content= "<div id=\"odno\"><a onclick=\"ODKL.Share(this);return false;\" class=odkl-klass href=" . get_permalink() . ">' . get_option('text', '') . '</a></div>" . $content;
				}
				if(get_option('size', '')==0){	
$content= "<div id=\"odno\"><a onclick=\"ODKL.Share(this);return false;\" class=odkl-klass-s href=" . get_permalink() . "></a></div>" . $content;
				}
			}
			if(get_option('position', '')==0){
				if(get_option('size', '')==1){	
$content= $content .  "<div id=\"odno\"><a onclick=\"ODKL.Share(this);return false;\" class=odkl-klass href=" . get_permalink() . ">' . get_option('text', '') . '</a></div>" ;
				}
				if(get_option('size', '')==0){	
$content= $content . "<div id=\"odno\"><a onclick=\"ODKL.Share(this);return false;\" class=odkl-klass-s href=" . get_permalink() . "></a></div>" ;
				}
			}
		}
	}
	



  
  
  return $content;
}

add_filter('the_content', 'add_post_odnoklasniki_content');



?>