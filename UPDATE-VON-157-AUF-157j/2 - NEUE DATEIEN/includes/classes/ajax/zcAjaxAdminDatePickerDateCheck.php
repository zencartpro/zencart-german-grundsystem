<?php
/**
 * zcAjaxAdminDateCheck
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: zcAjaxAdminDatePickerDateCheck.php 2023-11-14 20:32:42Z webchills $
 */
class zcAjaxAdminDatePickerDateCheck extends base
{
    /**
     * check.  Checks a 'datepicker' date for validity
     *
     */
    public function check()
    {
        // -----
        // Deny access unless running under the admin.
        //
        if (!defined('IS_ADMIN_FLAG') || IS_ADMIN_FLAG !== true || !isset($_POST['date_to_check'])) {
            return 'false';
        }

        // -----
        // If the submitted date is an empty string, that's valid.
        //
        $date_raw = $_POST['date_to_check'];
        if ($date_raw === '') {
            return 'true';
        }

        if (DATE_FORMAT_DATE_PICKER !== 'yy-mm-dd') {
            $local_fmt = zen_datepicker_format_fordate();
            $dt = DateTime::createFromFormat($local_fmt, $date_raw);
            $date_raw = false;
            if (!empty($dt)) {
              $date_raw = $dt->format('Y-m-d');
            }
        }
        return ($date_raw !== false && zcDate::validateDate($date_raw) === true) ? 'true' : 'false';
    }
}
