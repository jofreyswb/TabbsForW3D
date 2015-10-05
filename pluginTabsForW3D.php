<?php
/*
Plugin Name: TabsInTabs(TIT)
Plugin URI: http://website3D.ru
Description: Plugin for creating Tabs and tabs in tab
Version: 1.0.0
Author: Sergey Yacishen
Author URI: http://website3D.ru
*/

/*  Copyright 2008  Jenyay  (email : jenyay.ilin@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('MSP_HELLOWORLD_DIR', plugin_dir_path(__FILE__));
define('MSP_HELLOWORLD_URL', plugin_dir_url(__FILE__));

function load_includes_file(){

    if(is_admin()) // подключаем файлы администратора, только если он авторизован
        require_once(MSP_HELLOWORLD_DIR.'includes/tabsFunctionals.php');

   /* require_once(MSP_HELLOWORLD_DIR.'includes/core.php');     */
}
load_includes_file();


$TIT = new TabsInTabs();
?>