<?php
/**
 * class.widerruf_downloads.php
 *
 * @copyright Portions Copyright 2003-2015 Zen Cart Development Team
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: class.widerruf_downloads.php 2015-04-14 15:32:00 webchills $
 */

/**
 * Observer class used to check if checkbox for downloads has been ticked in order confirmation
 *
 */
 
class widerruf_downloads extends base {

  function __construct() {
    $this->attach($this, array('NOTIFY_HEADER_START_CHECKOUT_PROCESS'));
  }

  function update(&$class, $eventID, $paramsArray = array()) {
  	 global $messageStack;
    if ($eventID == 'NOTIFY_HEADER_START_CHECKOUT_PROCESS') {
      if (DISPLAY_WIDERRUF_DOWNLOADS_ON_CHECKOUT_CONFIRMATION == 'true') {  
  if (!isset($_POST['widerruf_downloads']) || ($_POST['widerruf_downloads'] != '1')) {
  	if (!isset($_SESSION['widerruf_downloads'])) {
  $_SESSION['widerruf_downloads'] = 'notaccepted';
}
  	
  
    zen_redirect(zen_href_link(FILENAME_CHECKOUT_CONFIRMATION));
     
  }
}
    }
  }
} 
 
 

