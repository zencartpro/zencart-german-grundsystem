<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_login_as_customer_default.php 2012-03-04 15:07:26Z webchills $
 */
$email = $_POST['email_addr'];
$pass = $_POST['password'];
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$c_company = $_POST['company'];
$c_id = $_POST['cid'];
$c_address = $_POST['address'];
$c_city = $_POST['city'];
$c_state = $_POST['cstate'];
$c_zipcode = $_POST['zipcode'];
$c_telephone = $_POST['phone'];
$url = $_POST['s_url'];
$token = $_SESSION['securityToken'];
$url .= "index.php?main_page=login&amp;action=process";
?>

<div align='center'>
<table border='0'>
<tr>
<td colspan ='3'><?php echo ARE_YOU_SURE_TO_LOGIN_AS; ?></td>
</tr>
<tr>
<td align='left'><b><?php echo ENTRY_FIRST_NAME; ?> </b><?php echo $first_name; ?></td>
<td align='left' colspan='2'><b><?php echo ENTRY_LAST_NAME; ?> </b><?php echo $last_name; ?></td>
</tr>
<tr>
<td colspan ='3' align='left'><b><?php echo ENTRY_COMPANY; ?></b><?php echo $c_company; ?></td>
</tr>
<tr>
<td colspan='3' align='left'><b><?php echo ENTRY_STREET_ADDRESS; ?></b><?php echo $c_address; ?></td>
</tr>
<tr>
<td align='left'><b><?php echo ENTRY_CITY; ?></b><?php echo $c_city; ?></td><td> <b><?php echo ENTRY_POST_CODE; ?>:</b><?php echo $c_zipcode; ?></td>
</tr>
<tr>
<td align='left' colspan='3'><b><?php echo ENTRY_TELEPHONE_NUMBER; ?></b><?php echo $c_telephone; ?></td>
</tr>
<tr>
<td align='left' colspan='3'><b><?php echo ENTRY_EMAIL_ADDRESS; ?></b><?php echo $email; ?></td>
</tr>
<tr>
<td align='center' colspan='3'>
<?php
echo "
<form name='form1' action='$url' method='post'>
<input type='hidden' name='email_address' id='login-email-address' value='$email' />
<input type='hidden' name='password' id='login-password' value='$pass' />
<input type='hidden' name='password' id='login-password' value='$pass' />
<input type='hidden' name='securityToken' id='securityToken' value='$token' />
<input type='submit' value='Login' />
<input type='button' value='Abbrechen' onclick='window.close()'>
</form>
</td>
</tr>
</table></div>
";
?>
