<?php

class TabsInTabs{
    function TabsInTabs()
    {
        if (function_exists ('add_shortcode') )
        {
            /* ДОбалвляємо шорткоди */
            add_shortcode('tabintabs', array (&$this, 'in_main_tabs') );
            add_shortcode('tabintab', array (&$this, 'main_block_tabs') );

             /* Добавляємо кнопу в меню для редагування тексту */
            add_filter( 'mce_buttons_3', array(&$this, 'mce_buttons') );
            add_filter( 'mce_external_plugins', array(&$this, 'mce_external_plugins') );
            /* Добавляэмо в адмын меню */
            add_action('admin_menu',  array (&$this, 'admin') );
        }
    } /* end  function TabsInTabs*/

function in_main_tabs ($atts, $content = null)
    {
        return "<b><span style='white-space: nowrap; display: inline !important;'><a href='http://$content.livejournal.com/profile'><img src='http://p-stat.livejournal.com/img/userinfo.gif' alt='[info]' width='17' height='17' style='vertical-align: bottom; border: 0; padding-right: 1px;vertical-align:middle; margin-left: 0; margin-top: 0; margin-right: 0; margin-bottom: 0;' /></a><a href='http://$content.livejournal.com/'><b>$content</b></a></span></b>";
    }/*end  in_main_tabs */
    /* Вивід основного блоку в яуиму будуть поміщатися таби */
function main_block_tabs ($atts, $content = null)
    {
        return "<div class='mainTabsBlock'>$content</div>";
    }/* end in_main_tabs */
/* добавляэмо кнопку в панель редагування */

	// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
	function mce_external_plugins($plugin_array)
	{
		$plugin_array['tabintab'] = plugins_url ('/TabbsForW3D/assets/js/editor_plugin.js', __FILE__ );
		return $plugin_array;
	}
    function mce_buttons($buttons)
    {
        array_push($buttons, "tabintab");
        return $buttons;
    }

}/* end class TabsInTabs*/

?>