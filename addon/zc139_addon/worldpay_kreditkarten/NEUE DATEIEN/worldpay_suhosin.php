<?php
////////////////////////////////////////////
// Worldpay payment module V2.0+
// Copyright Philip Clarke 2008
// Diagnostic check to see if Suhosin PHP hardening module is encrypting
// Sessions. Must be installed in web root.
////////////////////////////////////////////

header('Content-type: text/plain');
if(@ini_get('suhosin.session.encrypt') == '1' || strtolower(@ini_get('suhosin.session.encrypt')) == 'on'){
        echo 1 ;
        exit;
}
echo 0;
?>