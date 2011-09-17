<?php

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
<td colspan ='3'>Are you sure you want to log in as:</td>
</tr>
<tr>
<td align='left'><b><? echo ENTRY_FIRST_NAME; ?> </b> <? echo $first_name; ?></td>
<td align='left' colspan='2'><b><? echo ENTRY_LAST_NAME; ?> </b><? echo $last_name; ?></td>
</tr>
<tr>
<td colspan ='3' align='left'><b><? echo ENTRY_COMPANY; ?></b><? echo $c_company; ?></td>
</tr>
<tr>
<td colspan='3' align='left'><b><? echo ENTRY_STREET_ADDRESS; ?></b><? echo $c_address; ?></td>
</tr>
<tr>
<td align='left'><b><? echo ENTRY_CITY; ?></b><? echo $c_city; ?></td><td><b><? echo ENTRY_STATE; ?></b><? echo $c_state; ?></td><td> <b><? echo ENTRY_POST_CODE; ?>:</b><? echo $c_zipcode; ?></td>
</tr>
<tr>
<td align='left' colspan='3'><b><? echo ENTRY_TELEPHONE_NUMBER; ?></b><? echo $c_telephone; ?></td>
</tr>
<tr>
<td align='left' colspan='3'><b><? echo ENTRY_EMAIL_ADDRESS; ?></b><? echo $email; ?></td>
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
<input type='submit' value='Place Order' />
<input type='button' value='Cancel Order' onclick='window.close()'>
</form>
</td>
</tr>
</table></div>
";
?>
