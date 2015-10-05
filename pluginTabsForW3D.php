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

class TabsInTabs{
    function TabsInTabs()
    {
        if (function_exists ('add_shortcode') )
        {
            add_shortcode('ljuser', array (&$this, 'user_shortcode') );
            add_shortcode('ljcomm', array (&$this, 'community_shortcode') );
        }
    } /* and  function TabsInTabs*/

function user_shortcode ($atts, $content = null)
    {
        return "<b><span style='white-space: nowrap; display: inline !important;'><a href='http://$content.livejournal.com/profile'><img src='http://p-stat.livejournal.com/img/userinfo.gif' alt='[info]' width='17' height='17' style='vertical-align: bottom; border: 0; padding-right: 1px;vertical-align:middle; margin-left: 0; margin-top: 0; margin-right: 0; margin-bottom: 0;' /></a><a href='http://$content.livejournal.com/'><b>$content</b></a></span></b>";
    }

}/* end class TabsInTabs*/

$TIT = new TabsInTabs();
?>