<?php
/**
 * @version sofortüberweisung.de 3.03 - $Date: 2011-08-12 11:17:39 +0200 (Fr, 12 Aug 2011) $
 * @author Payment Network AG (integration@payment-network.com)
 * @link http://www.payment-network.com/
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 2 of the License
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307
 * USA
 *
 ***********************************************************************************
 * this file contains code based on:
 * (c) 2000 - 2001 The Exchange Project
 * (c) 2001 - 2003 osCommerce, Open Source E-Commerce Solutions
 * (c) 2003 - 2011 Zen-Cart
 * Released under the GNU General Public License
 ***********************************************************************************
 *
 * $Id: pn_sofortueberweisung.php 118 2010-04-09 15:22:39Z thoma $
 * $Id: pn_sofortueberweisung.php 119 2011-08-12 11:18:39Z webchills $
 *
 */

define('PN_SU_VERSION', 'pn_zen_3.0.3');
include_once((IS_ADMIN_FLAG === true ? DIR_FS_CATALOG_MODULES : DIR_WS_MODULES) .'payment/pn/classPnSofortueberweisung.php');

class pn_sofortueberweisung {
	var $code, $title, $description, $enabled, $pnSofortueberweisung;

	// class constructor
	function pn_sofortueberweisung() {
		global $order;

		$this->code = 'pn_sofortueberweisung';
		$this->version = PN_SU_VERSION;
		$this->title = MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_TITLE;
		$this->description = MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION;
		$this->sort_order = MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SORT_ORDER;
		$this->enabled = ((MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS == 'True') ? true : false);

		if (is_object($order)) {
			$this->update_status();
        }
			
		//if old installation and notification password not set we need to upgrade the database
		if (defined('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS')	&& (MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS == 'True')
		&& !defined('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_NOTIFICATION_PASSWORD'))
			$this->_upgrade();

		$this->pnSofortueberweisung = new classPnSofortueberweisung(MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_PASSWORD, MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM);
	}

	// class methods
	function update_status() {
		global $order, $db;

		if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ZONE > 0) ) {
			$check_flag = false;
			$check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
			while (!$check->EOF) {
				if ($check->fields['zone_id'] < 1) {
					$check_flag = true;
					break;
				} elseif ($check->fields['zone_id'] == $order->billing['zone_id']) {
					$check_flag = true;
					break;
				}
				$check->MoveNext();
			}

			if ($check_flag == false) {
				$this->enabled = false;
			}
		}
        // BOF country-check
        // added by zen-cart.at
        if($this->enabled != false){
            $dest_country = $order->billing['country']['iso_code_2'];
            $country_zones = split("[,]", MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_COUNTRIES);
            if (in_array($dest_country, $country_zones)) {
                $this->enabled = true;
            } else {
                $this->enabled = false;
            }
        }
        // EOF country-check
	}

	function javascript_validation() {
		return false;
	}

	function selection() {

    		$language = $_SESSION['language'];

		$title = MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT;
		switch (MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_IMAGE) {
			case 'Logo & Text':
				$image = zen_image(sprintf('includes/templates/template_default/buttons/%s/sofortueberweisung_logo.gif', $language), MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT);
				$title = str_replace('{{image}}', $image, sprintf(MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE, MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_TEXT));
				break;
			case 'Logo':
				$image = zen_image(sprintf('includes/templates/template_default/buttons/%s/sofortueberweisung_logo.gif', $language), MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT);
				$title = str_replace('{{image}}', $image, sprintf(MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE, ''));
				break;
			case 'Infographic':
				$image = zen_image(sprintf('includes/templates/template_default/buttons/%s/sofortueberweisung_info.gif', $language), MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT);
				$title = str_replace('{{image}}', $image, sprintf(MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE, ''));
				break;
		}
		return array('id' => $this->code,
                   'module' => $this->title,
                   'fields' => array(array('title' => $title)));
	}

	function pre_confirmation_check() {
		return false;
	}

	function confirmation() {
		return array('title' => MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_CONFIRMATION);
	}

	function process_button() {
		return false;
	}

	function before_process() {
		return false;
	}

	function after_process() {
		global $order, $insert_id, $currencies, $cart, $language, $order_total_modules, $zco_notifier;

		$customer_id = $_SESSION['customer_id'];
		$currency = $_SESSION['currency'];

		$parameter= array();
		$amount = number_format($order->info['total'] * $currencies->get_value($currency), 2, '.','');

		$reason_1 = str_replace('{{order_id}}', $insert_id, MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_REASON_1);
		$reason_2 = str_replace('{{order_id}}', $insert_id, MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_REASON_2);

		$reason_1 = str_replace('{{customer_id}}', $customer_id, $reason_1);
		$reason_2 = str_replace('{{customer_id}}', $customer_id, $reason_2);

		$reason_2 = str_replace('{{order_date}}', strftime(DATE_FORMAT_SHORT), $reason_2);
		$reason_2 = str_replace('{{customer_name}}', $order->customer['firstname'] . ' ' . $order->customer['lastname'], $reason_2);
		$reason_2 = str_replace('{{customer_company}}', $order->customer['company'], $reason_2);
		$reason_2 = str_replace('{{customer_email}}', $order->customer['email_address'], $reason_2);


		$user_variable_0 = zen_output_string($insert_id);
		$user_variable_1 = zen_output_string($customer_id);

		$session = '&' . session_name() . '=' . session_id();

		if (ENABLE_SSL == true)
			$server = HTTPS_SERVER;
		else
			$server = HTTP_SERVER;

		$server = str_replace('https://', '', $server);
		$server = str_replace('http://', '', $server);

		$catalog = DIR_WS_CATALOG . 'index.php?main_page=';

		// success return url:
		$user_variable_2 = $server . $catalog . FILENAME_CHECKOUT_SUCCESS . '&transaction=-TRANSACTION-' . $session;
		// cancel return url:
		$user_variable_3 = $server . $catalog . 'sofortueberweisung_abort' . $session;
		// notification url:
		//obsolete with new projects, but still used by old projects
		$user_variable_4 = $server . DIR_WS_CATALOG . 'extras/pn_sofortueberweisung/callback.php';

		$user_variable_5 = zen_output_string($cart->cartID);

		$_SESSION['cart']->reset(true);
		// unregister session variables used during checkout
		unset($_SESSION['sendto']);
		unset($_SESSION['billto']);
		unset($_SESSION['shipping']);
		unset($_SESSION['payment']);
		unset($_SESSION['comments']);

		$order_total_modules->clear_posts();//ICW ADDED FOR CREDIT CLASS SYSTE
		// This should be before the zen_redirect:
		$zco_notifier->notify('NOTIFY_HEADER_END_CHECKOUT_PROCESS');

		$url = $this->pnSofortueberweisung->getPaymentUrl(MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_USER_ID, 
			MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_ID, $amount, $currency,
			$reason_1 , $reason_2 , $user_variable_0 , $user_variable_1 , 
			$user_variable_2 , $user_variable_3 , $user_variable_4 , $user_variable_5 );
		
		zen_redirect($url);

		require(DIR_WS_INCLUDES . 'application_bottom.php');

	}

	function get_error() {
		$error = array('title' => MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_ERROR_HEADING,
                     'error' => MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_ERROR_MESSAGE);

		return $error;
	}

	function check() {
		global $db;

		if (!isset($this->_check)) {
			$check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS'");
			$this->_check = $check_query->RecordCount();
		}
		return $this->_check;
	}

	function autoinstall() {

		global $pn_sofortueberweisung_pw;
		
		$backlink = zen_href_link(FILENAME_MODULES, 'set=payment&module=pn_sofortueberweisung&action=install');

		if (ENABLE_SSL == 'true') {
			$successLink = 'https://-USER_VARIABLE_2-';
			$cancelLink = 'https://-USER_VARIABLE_3-';
			$notificationLink = HTTPS_SERVER . DIR_WS_CATALOG . 'extras/pn_sofortueberweisung/callback.php';
		}
		else {
			$successLink = 'http://-USER_VARIABLE_2-';
			$cancelLink = 'http://-USER_VARIABLE_3-';
			$notificationLink = HTTP_SERVER . DIR_WS_CATALOG . 'extras/pn_sofortueberweisung/callback.php';
		}
		
		$html = $this->pnSofortueberweisung->getAutoInstallPage(STORE_NAME, HTTP_SERVER . DIR_WS_CATALOG, 
						STORE_OWNER_EMAIL_ADDRESS, DEFAULT_LANGUAGE, DEFAULT_CURRENCY,
						$cancelLink, $successLink, $notificationLink, $backlink, 15);

		//read generated values
		$_SESSION['pn_sofortueberweisung_pw'] = $this->pnSofortueberweisung->password;
		$_SESSION['pn_sofortueberweisung_pw2'] = $this->pnSofortueberweisung->password2;							
		$_SESSION['pn_sofortueberweisung_hashfunction'] = $this->pnSofortueberweisung->hashfunction;		

		return $html;
	}

	function install() {
		global $db;

		if (isset($_GET['autoinstall']) && ($_GET['autoinstall'] == '1')) {
			// Module already installed
			if (defined('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS') && (MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS == 'True')) {
				zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module=pn_sofortueberweisung', 'SSL'));
			}
			print $this->autoinstall();
			exit();
		} else {

			$error = false;
			$defaultLang = '';
			$languages = zen_get_languages();
			foreach ($languages as $language) {
				if ($language['code'] == DEFAULT_LANGUAGE) {
					$defaultLang = $language['directory'];
					break;
				}
			}
			$defaultLangFile = '../' . DIR_WS_LANGUAGES . $defaultLang . '/modules/payment/' . $this->code . '.php';
			$englishLangFile = '../' . DIR_WS_LANGUAGES . 'english/modules/payment/' . $this->code . '.php';

			if (file_exists($defaultLangFile))
				require_once($defaultLangFile);
			else {
				if  (file_exists($englishLangFile))
					require_once($englishLangFile);
				else 
					$error = true;
			}

			if ($error)
				printf('Failed to install module %s. Language files missing!<br>', $this->code);
			else {
					
				$user_id = (!empty($_GET['user_id'])) ? zen_db_prepare_input($_GET['user_id']) : '10000';
				$project_id = (!empty($_GET['project_id'])) ? zen_db_prepare_input($_GET['project_id']) : '500000';

				$project_password = '';
				if (isset($_SESSION['pn_sofortueberweisung_pw'])) {
					$project_password = $_SESSION['pn_sofortueberweisung_pw'];
					unset($_SESSION['pn_sofortueberweisung_pw']);
				}
				
				$notification_password = '';
				if (isset($_SESSION['pn_sofortueberweisung_pw2'])) {
					$notification_password = $_SESSION['pn_sofortueberweisung_pw2'];
					unset($_SESSION['pn_sofortueberweisung_pw2']);
				}

				$hashfunction = 'md5';
				if (isset($_SESSION['pn_sofortueberweisung_hashfunction'])) {
					$hashfunction = $_SESSION['pn_sofortueberweisung_hashfunction'];
					unset($_SESSION['pn_sofortueberweisung_hashfunction']);
				}
								
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS', 'True', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS_DESC."', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_USER_ID_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_USER_ID', '" . (int)$user_id . "', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_USER_ID_DESC."', '6', '2', now());");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_ID_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_ID', '" . (int)$project_id . "', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_ID_DESC."', '6', '3', now());");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_PASSWORD_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_PASSWORD', '" . zen_db_input($project_password) . "', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_PASSWORD_DESC."', '6', '4', now());");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_NOTIFICATION_PASSWORD_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_NOTIFICATION_PASSWORD', '" . zen_db_input($notification_password) . "', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_NOTIFICATION_PASSWORD_DESC."', '6', '5', now());");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM', '" . zen_db_input($hashfunction) . "', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM_DESC."', '6', '6', now(), 'zen_draw_pull_down_menu(\'configuration[MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM]\', array (array (\'id\' => \'md5\', \'text\' => \'md5\'),array (\'id\' => \'sha1\', \'text\' => \'sha1\'),array (\'id\' => \'sha256\', \'text\' => \'sha256\'),array (\'id\' => \'sha512\', \'text\' => \'sha512\')),');");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SORT_ORDER_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SORT_ORDER', '1', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SORT_ORDER_DESC."', '6', '7', now())");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ZONE_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ZONE', '0', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ZONE_DESC."', '6', '8', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TMP_STATUS_ID_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TMP_STATUS_ID', '".DEFAULT_ORDERS_STATUS_ID."', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TMP_STATUS_ID_DESC."', '6', '9', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ORDER_STATUS_ID_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ORDER_STATUS_ID', '".DEFAULT_ORDERS_STATUS_ID."', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ORDER_STATUS_ID_DESC."', '6', '10', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_UNC_STATUS_ID_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_UNC_STATUS_ID', '".DEFAULT_ORDERS_STATUS_ID."', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_UNC_STATUS_ID_DESC."', '6', '11', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_REASON_1_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_REASON_1', 'Nr. {{order_id}} Kd-Nr. {{customer_id}}', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_REASON_1_DESC."', '6', '12', 'zen_cfg_select_option(array(\'Nr. {{order_id}} Kd-Nr. {{customer_id}}\',\'-TRANSACTION-\'), ', now())");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_REASON_2_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_REASON_2', '".zen_db_input(STORE_NAME)."', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_REASON_2_DESC."', '6', '13', now());");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_IMAGE_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_IMAGE', 'Logo & Text', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_IMAGE_DESC."', '6', '14', 'zen_cfg_select_option(array(\'Infographic\',\'Logo & Text\',\'Logo\'), ', now())");
        // BOF country-check
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_COUNTRIES_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_COUNTRIES', 'AT,DE,BE,NL,GB,CH', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_COUNTRIES_DESC."', '6', '15', now());");
        // EOF country-check
            
            }

		} // normal install
	}

	function remove() {
		global $db;
		$db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
	}

	function keys() {
		return array('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS',
      	      	'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_USER_ID',
      	      	'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_ID',
      	      	'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_PASSWORD',
				'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_NOTIFICATION_PASSWORD',
				'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM',
      	      	'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ZONE',
      	      	'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_REASON_1',
      	      	'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_REASON_2',
      	      	'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_IMAGE',
      	      	'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ORDER_STATUS_ID',
      	      	'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_UNC_STATUS_ID',
      	      	'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TMP_STATUS_ID',
      	      	'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SORT_ORDER',
                'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_COUNTRIES');  // country-check
	}

	
	/**
	 * if old installation and notification password not set we need to upgrade the database
	 */
	function _upgrade() {
		global $db;
		
		$check_query = $db->Execute("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_NOTIF_PASSWORD'");
		if(!($check_query->RecordCount())) {
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_NOTIFICATION_PASSWORD_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_NOTIFICATION_PASSWORD', '', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_NOTIFICATION_PASSWORD_DESC."', '6', '1', now());");
				$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function) values ('".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM_TITLE."', 'MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM', 'sha1', '".MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM_DESC."', '6', '1', now(), 'zen_draw_pull_down_menu(\'configuration[MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM]\', array (array (\'id\' => \'md5\', \'text\' => \'md5\'),array (\'id\' => \'sha1\', \'text\' => \'sha1\'),array (\'id\' => \'sha256\', \'text\' => \'sha256\'),array (\'id\' => \'sha512\', \'text\' => \'sha512\')),');");
				
		}
	}	

}
?>
