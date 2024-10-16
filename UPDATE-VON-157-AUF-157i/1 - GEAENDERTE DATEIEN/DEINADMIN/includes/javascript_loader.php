<?php
/**
 * This file is inserted at the start of the body tag, just above the header menu, and loads most of the admin javascript components
 *
 * Zen Cart German Specific (158 code in 157 / zencartpro adaptations)
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: javascript_loader.php 2024-02-16 16:18:32Z webchills $
 */
?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha384-1H217gwSVyLSIfaLxHbE7dRb3v4mYCKbpQvzx0cegeju1MVsGrX5xXxAvs/HgeFs" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="includes/javascript/jquery.min.js"><\/script>');</script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<!--<script src="includes/javascript/bootstrap.min.js"></script>-->
<script src="includes/javascript/backtotop.js"></script>
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
    jQuery('[data-toggle="tooltip"]').tooltip({
        html: true,
        container: 'body'
    });
  });
</script>
<?php
$searchBoxScriptArray = [
    'specials',
    'coupon_admin',
    'reviews',
    'featured',
    'customers',
    'category_product_listing',
    'downloads_manager',
];
$searchBoxJs = 'includes/javascript/searchBox.js';
if (in_array(basename($PHP_SELF, '.php'), $searchBoxScriptArray) && file_exists($searchBoxJs)) {
    ?>
    <script defer src="<?= $searchBoxJs; ?>"></script>
    <?php
}
?>

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

foreach ($installedPlugins as $plugin) {
    $relativeDir = $plugin->getRelativePath();
    $absoluteDir = $plugin->getAbsolutePath();
    $directory_array = $template->get_template_part($absoluteDir . 'admin/includes/javascript/', '/^global_jscript/', '.php');
    foreach ($directory_array as $key => $value) {
        require $absoluteDir . 'admin/includes/javascript/' . $value;
    }
    $directory_array = $template->get_template_part($absoluteDir . 'admin/includes/javascript/', '/^global_jscript/', '.js');
    foreach ($directory_array as $key => $value) {
        echo "\n";
        ?>
        <script src="<?php echo $relativeDir; ?>admin/includes/javascript/<?php echo $value; ?>"></script>
        <?php
    }
    if (file_exists($absoluteDir . 'admin/includes/javascript/' . basename($PHP_SELF, '.php') . '.php')) {
        echo "\n";
        require $absoluteDir . 'admin/includes/javascript/' . basename($PHP_SELF, '.php') . '.php';
    }
    if (file_exists($absoluteDir . 'admin/includes/javascript/' . basename($PHP_SELF, '.php') . '.js')) {
        echo "\n";
?>
        <script src="<?php echo $relativeDir ?>admin/includes/javascript/<?php echo basename($PHP_SELF, '.php') . '.js'; ?>"></script>
<?php 
    }
    $directory_array = $template->get_template_part($absoluteDir . 'admin/includes/javascript/', '/^' . basename($PHP_SELF, '.php') . '_/', '.js');
    foreach ($directory_array as $key => $value) {
        echo "\n";
        ?>
        <script src="<?php echo $relativeDir; ?>admin/includes/javascript/<?php echo $value; ?>"></script>
        <?php
    }
    $directory_array = $template->get_template_part($absoluteDir . 'admin/includes/javascript/', '/^' . basename($PHP_SELF, '.php') . '_/', '.php');
    foreach ($directory_array as $key => $value) {
        echo "\n";
        require $absoluteDir . 'admin/includes/javascript/' . $value;
    }}
if (file_exists(DIR_WS_INCLUDES . 'keepalive_module.php')) {
    echo "\n";
    require(DIR_WS_INCLUDES . 'keepalive_module.php');
}
echo "\n";
require DIR_FS_CATALOG . 'includes/templates/template_default/jscript/jscript_framework.php';
