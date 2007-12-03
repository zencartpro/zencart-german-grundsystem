<?php
/**
 * cc_validation Class.
 *
 * @package classes
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: cc_validation.php 7379 2007-11-08 03:58:07Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * cc_validation Class.
 * Class to validate credit card numbers etc
 *
 * @package classes
 */
class cc_validation extends base {
  var $cc_type, $cc_number, $cc_expiry_month, $cc_expiry_year;

    function validate($number, $expiry_m, $expiry_y, $start_m = null, $start_y = null) {
    $this->cc_number = ereg_replace('[^0-9]', '', $number);

      // Check specific card-types based on first 6 digits:
      $NumberLeft6 = substr($this->cc_number, 0, 6);

      /***** SWITCH *****/
      if (( (($NumberLeft6 >= 490302) && ($NumberLeft6 <= 490309))
                || (($NumberLeft6 >= 490335) && ($NumberLeft6 <= 490339))
                || (($NumberLeft6 >= 491101) && ($NumberLeft6 <= 491102))
                || (($NumberLeft6 >= 491174) && ($NumberLeft6 <= 491182))
                || (($NumberLeft6 >= 493600) && ($NumberLeft6 <= 493699))
                ||  ($NumberLeft6 == 564182)
                || (($NumberLeft6 >= 633300) && ($NumberLeft6 <= 633349))
                || (($NumberLeft6 >= 675900) && ($NumberLeft6 <= 675999))
                ) && (ereg('[0-9]{16}|[0-9]{18}|[0-9]{19}', $this->cc_number))  and CC_ENABLED_SWITCH=='1') {
          $this->cc_type = "Switch";
      }

      /***** SOLO *****/
      elseif (( (($NumberLeft6 >= 633450) && ($NumberLeft6 <= 633460))
                || (($NumberLeft6 >= 633462) && ($NumberLeft6 <= 633472))
                || (($NumberLeft6 >= 633474) && ($NumberLeft6 <= 633475))
                ||  ($NumberLeft6 == 633477)
                || (($NumberLeft6 >= 633479) && ($NumberLeft6 <= 633480))
                || (($NumberLeft6 >= 633482) && ($NumberLeft6 <= 633489))
                ||  ($NumberLeft6 == 633498)
                || (($NumberLeft6 >= 676700) && ($NumberLeft6 <= 676799))
                ) && (ereg('[0-9]{16}|[0-9]{18}|[0-9]{19}', $this->cc_number))  and CC_ENABLED_SOLO=='1') {
          $this->cc_type = "Solo";
      }

      /***** JCB *****/
      elseif (( (($NumberLeft6 >= 352800) && ($NumberLeft6 <= 358999))
//              ||  ($NumberLeft6 == 411111)
              )
              && (ereg('[0-9]{16}', $this->cc_number))  and CC_ENABLED_JCB=='1') {
          $this->cc_type = "JCB";
      }

      /***** MAESTRO *****/
      elseif (( (($NumberLeft6 >= 493698) && ($NumberLeft6 <= 493699))
                ||  ($NumberLeft6 == 490303)
                || (($NumberLeft6 >= 633302) && ($NumberLeft6 <= 633349))
                || (($NumberLeft6 >= 675900) && ($NumberLeft6 <= 675999))
                || (($NumberLeft6 >= 500000) && ($NumberLeft6 <= 509999))
                || (($NumberLeft6 >= 560000) && ($NumberLeft6 <= 589999))
                || (($NumberLeft6 >= 600000) && ($NumberLeft6 <= 699999))
                ) && (ereg('[0-9]{16}([0-9]{3})', $this->cc_number))  and CC_ENABLED_MAESTRO=='1') {
          $this->cc_type = "Maestro";
      }

      /***** VISA *****/
      elseif (( (($NumberLeft6 >= 400000) && ($NumberLeft6 <= 499999))
                // ensure we exclude AMT only cards
                && !( (($NumberLeft6 >= 490300) && ($NumberLeft6 <= 490301))
                      || (($NumberLeft6 >= 490310) && ($NumberLeft6 <= 490334))
                      || (($NumberLeft6 >= 490340) && ($NumberLeft6 <= 490399))
                      || (($NumberLeft6 >= 490400) && ($NumberLeft6 <= 490409))
                      ||  ($NumberLeft6 == 490419)
                      ||  ($NumberLeft6 == 490451)
                      ||  ($NumberLeft6 == 490459)
                      ||  ($NumberLeft6 == 490467)
                      || (($NumberLeft6 >= 490475) && ($NumberLeft6 <= 490478))
                      || (($NumberLeft6 >= 490500) && ($NumberLeft6 <= 490599))
                      || (($NumberLeft6 >= 491103) && ($NumberLeft6 <= 491173))
                      || (($NumberLeft6 >= 491183) && ($NumberLeft6 <= 491199))
                      || (($NumberLeft6 >= 492800) && ($NumberLeft6 <= 492899))
                      || (($NumberLeft6 >= 498700) && ($NumberLeft6 <= 498799))
                      )
                ) && (ereg('[0-9]{16}|[0-9]{13}', $this->cc_number))  and CC_ENABLED_VISA=='1') {
          $this->cc_type = 'Visa';

    // traditional CC hash checks:
    } elseif (ereg('^4[0-9]{12}([0-9]{3})?$', $this->cc_number) and CC_ENABLED_VISA=='1') {
      $this->cc_type = 'Visa';
    } elseif (ereg('^5[1-5][0-9]{14}$', $this->cc_number) and CC_ENABLED_MC=='1') {
      $this->cc_type = 'MasterCard';
    } elseif (ereg('^3[47][0-9]{13}$', $this->cc_number) and CC_ENABLED_AMEX=='1') {
      $this->cc_type = 'American Express';
    } elseif (ereg('^3(0[0-5]|[68][0-9])[0-9]{11}$', $this->cc_number) and CC_ENABLED_DINERS_CLUB=='1') {
      $this->cc_type = 'Diners Club';
    } elseif (ereg('^6011[0-9]{12}$', $this->cc_number) and CC_ENABLED_DISCOVER=='1') {
      $this->cc_type = 'Discover';
    } elseif (ereg('^(3[0-9]{4}|2131|1800)[0-9]{11}$', $this->cc_number) and CC_ENABLED_JCB=='1') {
      $this->cc_type = 'JCB';
    } elseif (ereg('^5610[0-9]{12}$', $this->cc_number) and CC_ENABLED_AUSTRALIAN_BANKCARD=='1') {
      $this->cc_type = 'Australian BankCard';
    } else {
      return -1;
    }

    if (is_numeric($expiry_m) && ($expiry_m > 0) && ($expiry_m < 13)) {
      $this->cc_expiry_month = $expiry_m;
    } else {
      return -2;
    }

    $current_year = date('Y');
    if (strlen($expiry_y) == 2) $expiry_y = intval(substr($current_year, 0, 2) . $expiry_y);
    if (is_numeric($expiry_y) && ($expiry_y >= $current_year) && ($expiry_y <= ($current_year + 10))) {
      $this->cc_expiry_year = $expiry_y;
    } else {
      return -3;
    }

    if ($expiry_y == $current_year) {
      if ($expiry_m < date('n')) {
        return -4;
      }
    }

    // check the issue month & year but only for Switch/Solo cards
    if (($start_m || $start_y) && in_array($this->cc_type, array('Switch', 'Solo'))) {
      if (!(is_numeric($start_m) && ($start_m > 0) && ($start_m < 13))) {
        return -2;
      }

      if (strlen($start_y) == 2) {
        if ($start_y > 80) {
          $start_y = intval('19' . $start_y);
        } else {
          $start_y = intval('20' . $start_y);
        }
      }

      if (!is_numeric($start_y) || ($start_y > $current_year)) {
        return -3;
      }
      if (!($start_y >= ($current_year - 10))) {
        return -3;
      }
    }
    return $this->is_valid();
  }

  function is_valid() {
    $cardNumber = strrev($this->cc_number);
    $numSum = 0;

    for ($i=0; $i<strlen($cardNumber); $i++) {
      $currentNum = substr($cardNumber, $i, 1);

      // Double every second digit
      if ($i % 2 == 1) {
        $currentNum *= 2;
      }

      // Add digits of 2-digit numbers together
      if ($currentNum > 9) {
        $firstNum = $currentNum % 10;
        $secondNum = ($currentNum - $firstNum) / 10;
        $currentNum = $firstNum + $secondNum;
      }

      $numSum += $currentNum;
    }

    // If the total has no remainder it's OK
    return ($numSum % 10 == 0);
  }
}
?>