<?php
/**
 * Common Template - tpl_header.php
 *
 * this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * make a directory /templates/my_template/privacy<br />
 * copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_header.php<br />
 * to override the global settings and turn off the footer un-comment the following line:<br />
 * <br />
 * $flag_disable_header = true;<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */

 
class displayHeaderInfo {
    function displayHeaderInfo(){
        global $template, $current_page_base;
        $this->template = $template;
        $this->current_page_base = $current_page_base;
        $this->sA = array();
        $this->sA = array_merge($this->sA, $this->displayLogo());
        $this->sA = array_merge($this->sA, $this->displaySearch());
        $this->sA = array_merge($this->sA, $this->displayAccount());
        $this->sA = array_merge($this->sA, $this->displayCartLink());
        $this->sA = array_merge($this->sA, $this->displayAddHeaderLinks());
        $this->sA = array_merge($this->sA, $this->displayLanguages());
        $this->sA = array_merge($this->sA, $this->displayCurrencies());
        return $this->sA;
    }
    
    function displayLogo(){
        $sA = array();
        global $template;
        $sA['linkLogo'] = HTTP_SERVER . DIR_WS_CATALOG;
        $sA['textLogo'] = $template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . HEADER_LOGO_IMAGE;
        $sA['textLogo'] = $template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . 'transparent.png';
        $sa['altLogo'] = HEADER_ALT_TEXT;
        return $sA;
    }
    function displaySearch(){
        $sA = array();    
        $content = "";
        $sA['search']['action'] = zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false);
        $sA['search']['main_page'] = FILENAME_ADVANCED_SEARCH_RESULT;
        $sA['search']['session'] = zen_hide_session_id();
        $sA['search']['search_text'] = HEADER_SEARCH_DEFAULT_TEXT;
        $sA['search']['search_button'] = HEADER_SEARCH_BUTTON;
        $sA['search']['search_button_grafik'] = $this->template->get_template_dir(BUTTON_IMAGE_SEARCH, DIR_WS_TEMPLATE, $this->current_page_base, 'buttons/' . $_SESSION['language'] . '/') . BUTTON_IMAGE_SEARCH;
        return $sA;
    }
    function displayAccount() {
        $sA = array();
        if ($_SESSION['customer_id']) {
            $sA['linkLogoff'] = zen_href_link(FILENAME_LOGOFF,  '', 'SSL');
            $sA['textLogoff'] = HEADER_TITLE_LOGOFF;
            $sA['linkAccount'] = zen_href_link(FILENAME_ACCOUNT, '', 'SSL');
            $sA['textAccount'] = HEADER_TITLE_MY_ACCOUNT;
            $sA['account'] = true;
        } else {
            if (STORE_STATUS == '0') {
                $sA['linkLogin'] = zen_href_link(FILENAME_LOGIN, '', 'SSL');
                $sA['textLogin'] = HEADER_TITLE_LOGIN;
                $sa['account'] = false;
            } 
        }
        return $sA;
    }

    function displayCartLink(){
        $sA = array();
        $sA['cart'] = false;
        if ($_SESSION['cart']->count_contents() != 0) { 
            $sA['linkCart'] = zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL');
            $sA['textCart'] = HEADER_TITLE_CART_CONTENTS;
            $sA['linkCheckout'] = zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL');
            $sA['textCheckout'] = HEADER_TITLE_CHECKOUT;
            $sA['cart'] = true;
        }
        return $sA;
    }

    function displayAddHeaderLinks(){
        $sA = array();  
        $sA['linkPrivacy'] = zen_href_link('page&id=16&chapter=0', '', 'NONSSL');
        $sA['textPrivacy'] = BOX_INFORMATION_PRIVACY;
        $sA['linkShipping'] = zen_href_link('page&id=15&chapter=0', '', 'NONSSL');
        $sA['textShipping'] = BOX_INFORMATION_SHIPPING;
        return $sA;  
    }
    function displayLanguages(){
        $lng = new language();  
        global $request_type;
        $sA = array();   
        foreach ($lng->catalog_languages as $key => $value) {
            $content .= '<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('language', 'currency')) . 'language=' . $key, $request_type) . '">' . zen_image(DIR_WS_LANGUAGES .  $value['directory'] . '/images/' . $value['image'], $value['name']) . '</a>&nbsp;&nbsp;';
            $lng_cnt ++;
            if ($lng_cnt >= MAX_LANGUAGE_FLAGS_COLUMNS) {
              $lng_cnt = 0;
              $content .= '<br />';
            }
        }
        $sA['languages'] = $content;
        return $sA;
    }
    function displayCurrencies(){
        $sA = array();   
        global $request_type;
        $curr = new currencies();
        $currencies_array = array();
        foreach ($curr->currencies as $key => $value) {
            $currencies_array[] = array('id' => $key, 'text' => $value['title']);   
        }
        $content .= zen_draw_form('currencies_form', zen_href_link('index', '', 'NONSSL', false), 'get');
        $content .= zen_draw_pull_down_menu('currency', $currencies_array, $_SESSION['currency'], 'onchange="this.form.submit();"') . $hidden_get_variables . zen_hide_session_id();
        $content .= '</form>';
        $sA['curriencies'] = $content;
        return $sA;
    }
 
}
  // Display all header alerts via messageStack:
  if ($messageStack->size('header') > 0) {
    echo $messageStack->output('header');
  }
  if (isset($_GET['error_message']) && zen_not_null($_GET['error_message'])) {
  echo htmlspecialchars(urldecode($_GET['error_message']));
  }
  if (isset($_GET['info_message']) && zen_not_null($_GET['info_message'])) {
   echo htmlspecialchars($_GET['info_message']);
} else {

}
// smarty
$val = new displayHeaderInfo();
$tmpl['search'] = $smarty->checkTemplate('search.tpl.html');
$smarty->assign('val', $val->sA);
$smarty->assign('tmpl', $tmpl);
$smarty->caching = true;
#$smarty->display('../../template_default/smarty_templates/header.tpl.html','LOGIN');
###$smarty->display($smarty->checkTemplate('header.tpl.html'),'HEADER');
$smarty->rldisplay($smarty->checkTemplate('header.tpl.html'), true, 'HEADER');
#$smarty->display($smarty->checkTemplate('search.tpl.html'),'SEARCH');

?>


<!--bof-header logo and navigation display-->
<?php
if (!isset($flag_disable_header) || !$flag_disable_header) {
?>

<!-- EOF HEADER_TABLE  -->

<!--bof-optional categories tabs navigation display-->
<?php require($template->get_template_dir('tpl_modules_categories_tabs.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_categories_tabs.php'); ?>
<!--eof-optional categories tabs navigation display-->

<!--bof-header ezpage links-->
<?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
<?php require($template->get_template_dir('tpl_ezpages_bar_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_header.php'); 
?>
<?php } ?>
<!--eof-header ezpage links-->
</div>
</div>
</div>
<?php } ?>
