<?php
/**
* check email fields for match*/
?>
<script type="text/javascript"><!--
function check_email_address(field_name_1, field_name_2, field_size, message_1, message_2) {
  if (form.elements[field_name_1] && (form.elements[field_name_1].type != "hidden")) {
    var email_address = form.elements[field_name_1].value;
    var email_address_confirm = form.elements[field_name_2].value;

    if (email_address == '' || email_address.length < field_size) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;
    } else if (email_address != email_address_confirm) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    }
  }
}
//--></script>