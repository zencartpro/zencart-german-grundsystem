<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: configuration_checks.php 2023-10-23 13:27:16Z webchills $
 */
 
  /**
  *   Function used for configuration checks only.
  *   @param $variable - variable to be checked
  *   @param $check_string - a json encoded array containing: 
  *     error: defined constant containing error message
  *     id: id of the filter to apply. (May be mnemonic value of int.)
  *     options: per http://php.net/manual/en/function.filter-var.php
  *   @return - NULL; failure results in redirection inline.
  */ 
function zen_validate_configuration_entry($variable, $check_string, $config_name = '')
{
    global $messageStack;

    $data = json_decode($check_string, true);

    // check inputs - error should be a defined constant in the language files
    if (empty($data['error']) || !isset($data['options']) || !is_array($data['options'])) {
        return;
    }

    if (!defined($data['error'])) {
        switch (true) {
            case (strpos($data['error'], 'TEXT_MIN_ADMIN') === 0):
                $error_msg = TEXT_MIN_GENERAL_ADMIN;
                break;
            case (strpos($data['error'], 'TEXT_MAX_ADMIN') === 0);
                $error_msg = TEXT_MAX_GENERAL_ADMIN;
                break;
            default:
                $error_msg = TEXT_DATA_OUT_OF_RANGE;
                break;
        }
    } elseif ($config_name !== '') { 
        $error_msg = sprintf(constant($data['error']), $config_name); 
    } else { 
        $error_msg = constant($data['error']);
    }

    if (defined($data['id'])) {
        $id = constant($data['id']);
    } elseif (is_integer($data['id'])) {
        $id = $data['id']; 
    } else { 
        return;
    }

    $options = $data['options']; 

    $result = filter_var($variable, $id, $options);
    if ($result === false) {
        $messageStack->add_session($error_msg, 'error');
        return false;
    }
    return true;
}
