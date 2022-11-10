<?php
/**
 * This file is inserted at the start of the body tag, just above the header menu, and loads most of the admin javascript components
 *
 * Zen Cart German Specific
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: javascript_loader.php 2022-11-10 17:17:32Z webchills $
 */
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="includes/javascript/jquery.min.js"><\/script>');</script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<!--<script src="includes/javascript/bootstrap.min.js"></script>-->

<script src="includes/javascript/datepicker-de.js"></script>
<script>
// init datepicker defaults with localization
  jQuery(function () {
    jQuery.datepicker.setDefaults(jQuery.extend({}, jQuery.datepicker.regional["<?php echo $_SESSION['languages_code'] == 'en' ? '' : $_SESSION['languages_code']; ?>"], {
      dateFormat: '<?php echo DATE_FORMAT_DATE_PICKER; ?>',
      changeMonth: true,
      changeYear: true,
      showOtherMonths: true,
      selectOtherMonths: true,
      showButtonPanel: true
    }));
  });
</script>

<?php if (file_exists($jsFile = 'includes/javascript/' . basename($PHP_SELF, '.php') . '.js')) { ?>
<script src="<?php echo $jsFile; ?>"></script>
<?php
}
if (file_exists($jsFile = 'includes/javascript/' . basename($PHP_SELF, '.php') . '.php')) {
    echo "\n";
    require 'includes/javascript/' . basename($PHP_SELF, '.php') . '.php';
}
$directory_array = $template->get_template_part('includes/javascript/', '/^' . basename($PHP_SELF, '.php') . '_/', '.js');
foreach ($directory_array as $key => $value) {
    echo "\n";
?>
<script src="includes/javascript/<?php echo $value; ?>"></script>
<?php
}
$directory_array = $template->get_template_part('includes/javascript/', '/^' . basename($PHP_SELF, '.php') . '_/', '.php');
foreach ($directory_array as $key => $value) {
    echo "\n";
    require 'includes/javascript/' . $value;
}

if (file_exists(DIR_WS_INCLUDES . 'keepalive_module.php')) {
    echo "\n";
    require(DIR_WS_INCLUDES . 'keepalive_module.php');
}
echo "\n";
require DIR_FS_CATALOG . 'includes/templates/template_default/jscript/jscript_framework.php';
