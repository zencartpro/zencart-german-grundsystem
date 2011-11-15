<?php
/**
* Template designed by 12leaves.com
* 12leaves.com - Free ecommerce templates and design services
* 
* @copyright Copyright 2008-2009 12leaves.com
* @copyright Portions Copyright 2010 webchills.at
* @copyright Copyright 2003-2011 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id: tpl_top_nav.php 653 2010-09-26 10:38:54Z webchills $
*/    
?>

<div id="top_nav">
<div id="tab_nav">
<!--<div class="top-nav-left"></div>-->
<div class="top-nav-right"></div>
	<ul class="list-style-none">
		<li class="home-link"><a href="<?php echo '' . HTTP_SERVER . DIR_WS_CATALOG;?>"></a></li>

<?php
if ($current_page_base == 'products_new') {	$active	= 'tab_active'; 
	} else { $active = 'tab_nonactive';
}?>
		<li class="<?php echo $active;?>"><a href="index.php?main_page=products_new"><?php echo TOP_MENU_NEW_PRODUCTS;?></a></li>

<?php
if ($current_page_base == 'specials') { $active = 'tab_active'; 
	} else { $active = 'tab_nonactive';
}?>
		<li class="<?php echo $active;?>"><a href="index.php?main_page=specials"><?php echo TOP_MENU_SPECIALS;?></a></li>

<?php
if ($current_page_base == 'account' || $current_page_base == 'login' || $current_page_base == 'account_edit' || $current_page_base == 'address_book' || $current_page_base == 'account_password' || $current_page_base == 'account_newsletters' || $current_page_base == 'account_notifications') { $active = 'tab_active'; 
	} else { $active = 'tab_nonactive';
}?>
		<li class="<?php echo $active;?>"><a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo TOP_MENU_MY_ACCOUNT;?></a></li>

<?php
if ($current_page_base == 'shopping_cart') { $active = 'tab_active'; 
	} else { $active = 'tab_nonactive';
}?>
		<li class="<?php echo $active;?>"><a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL'); ?>"><?php echo TOP_MENU_VIEW_CART;?></a></li>
	</ul>
</div>


<div id="login_logout_section" class="float-right">
    <ul class="list-style-none inline-list">
<?php if ($_SESSION['customer_id']) { ?>
	<li>
		<?php echo HEADER_TITLE_WELCOMEUSER; ?> <?php echo $_SESSION['customer_first_name'];?> <?php echo $_SESSION['customer_last_name'];?>
	</li>
    <li><a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a></li>
	</ul>
<?php
      } else {
        if (STORE_STATUS == '0') {
?>
    <li><a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGIN; ?></a>
	<?php echo HEADER_OR; ?>
    <a href="<?php echo zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_TITLE_REGISTER; ?></a></li>
    </ul>
<?php } } ?>



</div>
</div>

<!-- tools section -->
<div id="tools_wrapper" class="align-center">
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td class="td-search-header">
		<div class="search-header float-left">
            <?php require($template->get_template_dir('tpl_search_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_search_header.php');?>
    		<div class="advanced_search float-left">
                <a href="<?php echo zen_href_link(FILENAME_ADVANCED_SEARCH, '', 'NONSSL'); ?>"><?php echo HEADER_ADVANCED_SEARCH; ?></a>
            </div>
		</div>
		</td>
		<td>
		<!-- header cart section -->
		<table class="align-center cart-header">
		<tr>
			<td>
			<?php require($template->get_template_dir('tpl_shopping_cart_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_shopping_cart_header.php'); 
			echo $content;
			?>		
			</td>
			<?php if ($_SESSION['cart']->count_contents() != 0) { ?>
			<td>&nbsp;|</td>
			<td class="blue-link">
				<a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><?php echo HEADER_TITLE_CHECKOUT; ?></a>
			</td>
			<?php }?>
		</tr>
		</table>
		<!-- /header cart section -->


		</td>
		<td class="td-languages">
			<div class="languages-wrapper">
				
					<?php require($template->get_template_dir('tpl_header_currencies.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_header_currencies.php'); 
					echo $content;?>
					<label class="float-right"><?php echo HEADER_CURRENCY;?></label>



					<?php require($template->get_template_dir('tpl_header_languages.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_header_languages.php'); 
					echo $content;?>
					<label class="float-right"><? echo HEADER_LANGUAGES;?></label>

				<div class="clearBoth"></div>
			</div>
    	</td>
	</tr>
	</table>
</div>
<div class="dotted-line line-header"></div>
<!-- /tools section -->

