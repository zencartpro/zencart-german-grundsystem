<?php
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}
define('MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE', 'Sofort.');
require_once(dirname(__FILE__) . '/../../../../ext/modules/payment/sofort/controller/Notification.php');
$controller = new Notification(array_merge($_POST, $_GET), file_get_contents('php://input'));
$controller->notificationAction();