<?php

class TabsInTabs{
    function TabsInTabs()
    {
        if (function_exists ('add_shortcode') )
        {   /* Добавляємо опції плагіна */
            add_option('tabintab_aligment', 'horizontal');  /*Положення horizontal or vertikal */
            add_option('tabintab_colunm', '4');/* скыльки буде вкладок */
            add_option('tabintab_intabs', 'false');/* чи будуть таби в табах true or false */
            /* ДОбалвляємо шорткоди */
            add_shortcode('tabintabsvalue', array (&$this, 'in_main_tabs') );
            add_shortcode('tabintabsname', array (&$this, 'tabi_ntabs_name') );
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
        return "
          <dd>
              <div class='tab-content'>$content</div>
          </dd>

        ";
    }/*end  in_main_tabs */

function tabi_ntabs_name ($atts, $content = null)
    {   extract(shortcode_atts(array(
          "id" => '1'
          ), $atts));
          if($id="1"){
          return "<dt class='selected'>$content</dt> ";
          }
          else{
          return "<dt>$content</dt> ";
          }

    }/*end  in_main_tabs */
    /* Вивід основного блоку в яуиму будуть поміщатися таби */

function main_block_tabs ($atts, $content = null)
    {
        return "<dl class='mainTabsBlock'>$content</dl>";
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

    /* Admin panel */
    function admin ()
    {
      if ( function_exists('add_options_page') )
      {
          add_options_page('Tab in tab Options',
              'Tab in tab', 8, basename(__FILE__),
              array (&$this, 'admin_form') );
      }
    }
 /* admin page */
  function admin_form()
{
    $aligmentinfo = get_option('tabintab_aligment');
    $columninfo = get_option('tabintab_colunm');
    $intabsinfo = get_option('tabintab_intabs');


    if ( isset($_POST['submit']) )
    {
       if ( function_exists('current_user_can') &&
            !current_user_can('manage_options') )
                die ( _e('Hacker?', 'tabintab') );

        if (function_exists ('check_admin_referer') )
        {
            check_admin_referer('ljusers_form');
        }

        $aligmentinfo = $_POST['$aligmentinfo'];
        $columninfo = $_POST['$columninfo'];
        $intabsinfo = $_POST['$intabsinfo'];

        update_option('tabintab_aligment', $aligmentinfo);
        update_option('tabintab_colunm', $columninfo);
        update_option('tabintab_intabs', $intabsinfo);
    }
    ?>
    <div class='wrap'>
        <h2><?php _e('Tab in tab Settings', 'tabintab'); ?></h2>

        <form name="tabintab" method="post"
            action="<?php echo $_SERVER['PHP_SELF']; ?>?page=tabintab.php&amp;updated=true">

            <!-- Имя tabintab_form используется в check_admin_referer -->
            <?php
                if (function_exists ('wp_nonce_field') )
                {
                    wp_nonce_field('tabintab_form');
                }
            ?>

            <table class="form-table">
                <tr valign="top">
                    <th >Положение вертикальное или горизонтальное:</th>

                    <td>
                        <select id="aligmentinfo" name="aligmentinfo" size="1" tabindex="0">

                         <? if($intabsinfo = "Horizontal"){
                           echo("<option value='Horizontal' selected='selected'>Горизонтальное</option> ");
                           echo("<option value='Vertikal'>Вертикальное</option> ");
                         }
                         else{
                           echo("<option value='Horizontal' >Горизонтальное</option> ");
                           echo("<option value='Vertikal' selected='selected'>Вертикальное</option> ");
                         }
                          ?>
                        </select>

                    </td>
                </tr>

                <tr valign="top">
                    <th >Число вкдалок: </th>

                    <td>
                        <input type="text" name="columninfo"
                            size="80" value="<?php echo $columninfo; ?>" />
                    </td>
                </tr>

                <tr valign="top">
                    <th >Есть ли табы в табах?: </th>

                    <td>
                   <select id="in" name="intabsinfo" size="1">
                   <? if($intabsinfo = "true"){
                     echo("<option value='true' selected='selected'>Да </option>");
                     echo("<option value='false'>Нет </option>");
                   }
                   else{
                     echo("<option value='true'>Да </option>");
                     echo("<option value='false'selected='selected'>Нет </option>");
                   }
                   ?>
                   </select>

                    </td>
                </tr>


            </table>

            <input type="hidden" name="action" value="update" />

            <input type="hidden" name="page_options"
                value="tabintab_aligment,tabintab_colunm,tabintab_intabs" />


            <p class="submit">
            <input type="submit" name="submit" value="<?php _e('Save Changes') ?>" />
            </p>
        </form>
        <div class="shortcodeTab">
        <?
           $col=(int)$columninfo;
            echo "[tabintab]";
           for($i=1;$i<=$col;$i++){
               echo "[tabintabsname id='$i']Tab$i[/tabintabsname]";
               echo "[tabintabsvalue]содержимое $i-го таба[/tabintabsvalue]";

           }
           echo "[/tabintab]";




        ?>
        </div>
    </div>
    <?
}

}/* end class TabsInTabs*/

?>