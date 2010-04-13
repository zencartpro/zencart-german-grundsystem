<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */

  require('includes/application_top.php');

  $admin_name = "";
  $admin_pass = "";
  $pass_message = "";
  $message = false;
  if (isset($_POST['submit'])) {
    $admin_name = zen_db_prepare_input($_POST['admin_name']);
    $admin_pass = zen_db_prepare_input($_POST['admin_pass']);
    if ($admin_name == '' && $admin_pass == '') sleep(4);
    $sql = "select admin_id, admin_name, admin_pass from " . TABLE_ADMIN . " where admin_name = '" . zen_db_input($admin_name) . "'";
    $result = $db->Execute($sql);
    if ((!isset($_SESSION['securityToken']) || !isset($_POST['securityToken'])) || ($_SESSION['securityToken'] !== $_POST['securityToken'])) {
      $message = true;
      $pass_message = ERROR_SECURITY_ERROR;
    }
    if (!isset($result->fields) || !($admin_name == $result->fields['admin_name'])) {
      $message = true;
      $pass_message = ERROR_WRONG_LOGIN;
    }
    if (!isset($result->fields) || !zen_validate_password($admin_pass, $result->fields['admin_pass'])) {
      $message = true;
      $pass_message = ERROR_WRONG_LOGIN;
    }
    // BEGIN LOGIN SLAM PREVENTION
    if ($message == TRUE) {
      if (!isset($_SESSION['login_attempt'])) $_SESSION['login_attempt'] = 0;
      $_SESSION['login_attempt']++;
      if ($_SESSION['login_attempt'] > 6) {
        zen_session_destroy();
        sleep(15);
        zen_redirect(zen_href_link(FILENAME_DEFAULT, '', 'SSL'));
      } else {
        sleep(4);
      }
    }   // END CC SLAM PREVENTION
    if ($message == false) {
      unset($_SESSION['login_attempt']);
      $_SESSION['admin_id'] = $result->fields['admin_id'];
      if (SESSION_RECREATE == 'True') {
        zen_session_recreate();
      }
      zen_redirect(zen_href_link(FILENAME_DEFAULT, '', 'SSL'));
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
<meta name="robot" content="noindex, nofollow" />
</head>
<body id="login" onload="document.getElementById('admin_name').focus()">
<form name="login" action="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>" method="post">
  <fieldset>
    <legend><?php echo HEADING_TITLE; ?></legend>
    <label class="loginLabel" for="admin_name"><?php echo TEXT_ADMIN_NAME; ?></label>
<input style="float: left" type="text" id="admin_name" name="admin_name" value="<?php echo zen_output_string($admin_name); ?>" />
<br class="clearBoth" />
    <label  class="loginLabel" for="admin_pass"><?php echo TEXT_ADMIN_PASS; ?></label>
<input style="float: left" type="password" id="admin_pass" name="admin_pass" value="<?php echo zen_output_string($admin_pass); ?>" />
<br class="clearBoth" />
    <?php echo $pass_message; ?>
    <input type="hidden" name="securityToken" value="<?php echo $_SESSION['securityToken']; ?>">
    <input type="submit" name="submit" class="button" value="Login" />
    <?php echo '<a style="float: right;" href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?>
  </fieldset>
</form>
</body>
</html>
<?php require('includes/application_bottom.php'); ?>
