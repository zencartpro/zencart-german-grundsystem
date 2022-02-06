<?php
/**
 * Observer class used to detect spam input
 * Zen Cart German Specific 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: auto.non_captcha_observer.php 2022-02-05 19:57:16Z webchills $
 */

class zcObserverNonCaptchaObserver extends base
{
    /**
     * Set to the number of days before auto-changing field names according to Antispam settings in admin
     * @var integer
     */
    protected $max_days = SPAM_CHANGE_DAYS; 

    public function __construct()
    {
        $this->attach($this, [
            'NOTIFY_NONCAPTCHA_CHECK',
            'NOTIFY_CREATE_ACCOUNT_CAPTCHA_CHECK',
            'NOTIFY_CONTACT_US_CAPTCHA_CHECK',
            'NOTIFY_REVIEWS_WRITE_CAPTCHA_CHECK',
        ]);

    }

    public function updateNotifyCreateAccountCaptchaCheck(&$class, $eventID, $paramsArray)
    {       
       
        $this->testURLSpam();  // test for a url with in this name
        $this->testAntiSpamFields();
        $this->rotateHoneypotFieldNames();
        
    }

    public function updateNotifyContactUsCaptchaCheck(&$class, $eventID, $paramsArray)
    {
        // sanitize the name field more aggressively
        $GLOBALS['name'] = zen_db_prepare_input(zen_sanitize_string($_POST['contactname']));

        $this->testURLSpam();  // test for a url with in this name
        $this->testAntiSpamFields();
        $this->rotateHoneypotFieldNames();
        
    }

    public function updateNotifyReviewsWriteCaptchaCheck(&$class, $eventID, $paramsArray)
    {
        $this->testURLSpam();  // test for a url with in this name
        $this->testAntiSpamFields();
        $this->rotateHoneypotFieldNames();
        
    }

    // generic fallback notifier watcher
    public function update(&$class, $eventID, $paramsArray)
    {
        $this->testURLSpam();  // test for a url with in this name
        $this->testAntiSpamFields();
        $this->rotateHoneypotFieldNames();
       
    }

    protected function testAntiSpamFields()
    {
        if (defined('SPAM_TEST_TEXT') && defined('SPAM_TEST_USER')) {
            $GLOBALS['antiSpam'] = isset($_POST[SPAM_TEST_TEXT]) ? zen_db_prepare_input($_POST[SPAM_TEST_TEXT]) : '';
            $GLOBALS['antiSpam'] .= isset($_POST[SPAM_TEST_USER]) ? zen_db_prepare_input($_POST[SPAM_TEST_USER]) : '';
        }
    }    

    protected function rotateHoneypotFieldNames()
    {
        global $db;

        $check_date = $db->Execute("SELECT date_format(date_added, '%Y-%m-%d') as last_changed_date FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SPAM_TEST_TEXT' ");

        $now = time(); //current date-time
        $last_changed_date = strtotime($check_date->fields['last_changed_date']);
        $datediff = $now - $last_changed_date;

        $days_since = round($datediff / (60 * 60 * 24));

        if ($days_since >= $this->max_days) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';  //do numbers, lower case, upper case

            $spam_text = $this->generate_random_string($permitted_chars, 10);  // setting 10 as the length for the field name
            $spam_user = $this->generate_random_string($permitted_chars, 10);
            $spam_iq = $this->generate_random_string($permitted_chars, 10);

            $db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET date_added = now(), configuration_value = '" . $spam_text . "'  WHERE configuration_key = 'SPAM_TEST_TEXT'");
            $db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET date_added = now(), configuration_value = '" . $spam_user . "'  WHERE configuration_key = 'SPAM_TEST_USER'");
            $db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET date_added = now(), configuration_value = '" . $spam_iq . "'  WHERE configuration_key = 'SPAM_TEST_IQ'");
        }
    }

    protected function generate_random_string($input, $strength = 16)
    {
        $function = PHP_VERSION_ID >= 70000 ? 'random_int' : 'mt_rand';
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[$function(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }
    
    protected function testURLSpam()
    {
        // The Regular Expression filter
        $reg_exUrl = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
        
        // The Text you want to filter for urls, most common input fields used
        $text = '';
        //create account, no account, one page checkout, regester account, ask a question, contact us 
        $text .= (!empty($_POST['firstname']) ? $_POST['firstname'] .  ' ' : '');
        $text .= (!empty($_POST['lastname']) ? $_POST['lastname'] .  ' ' : '');
        $text .= (!empty($_POST['contactname']) ? $_POST['contactname'] .  ' ' : '');
        $text .= (!empty($_POST['company']) ? $_POST['company'] .  ' ' : '');
        $text .= (!empty($_POST['street_address']) ? $_POST['street_address'] .  ' ' : '');
        $text .= (!empty($_POST['suburb']) ? $_POST['suburb'] .  ' ' : '');
        $text .= (!empty($_POST['city']) ? $_POST['city'] .  ' ' : '');
        $text .= (!empty($_POST['enquiry']) ? $_POST['enquiry'] .  ' ' : '');
      
        //reviews
        $text .= (!empty($_POST['review_text']) ? $_POST['review_text'] .  ' ' : '');
        //password hint -- subject fields
        $text .= (!empty($_POST['passwordhintA']) ? $_POST['passwordhintA'] .  ' ' : '');
        $text .= (!empty($_POST['subject']) ? $_POST['subject'] : '');

        // Check if there is a url in the text
        if(preg_match($reg_exUrl, $text, $url)) {
        // We have a url where it should not be 
        //$url holds the url you could have a log here.. not a good idea
        zen_redirect(zen_href_link(FILENAME_CREATE_ACCOUNT_SUCCESS, '', 'SSL'));
        }
        // if no urls in the text strip and return
        $text = '';
        return ;
    
    }

}

