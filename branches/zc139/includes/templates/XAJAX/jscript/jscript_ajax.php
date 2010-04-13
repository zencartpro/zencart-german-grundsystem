<?php
// BOF: ajax include js-files globaly
// the global xajax-js script
$xajax->printJavascript('ajax/xajax5');
// definded in includes\ajax_javascript_function.php && included via includes\auto_loaders\config.ajax.php
if(isset($ajax_js)){
  foreach ($ajax_js as $key => $value) {
    if(true==$value){
      echo '<script type="text/javascript" src="' . $key . '"></script>'."\n";
    }
  }
}
// EOF: ajax  
?>
