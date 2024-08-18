<?php
/**
 * Zen Cart German Specific (158 code in 157 /zencartpro adaptations)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: home.php 2023-12-18 15:21:29Z webchills $
 */
$version_check_index=true;
require('includes/application_top.php');

$languages = zen_get_languages();
$languages_array = array();
$languages_selected = DEFAULT_LANGUAGE;
for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
                               'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $_SESSION['language']) {
        $languages_selected = $languages[$i]['code'];
    }
}

if (STORE_NAME == '' || STORE_OWNER =='' || STORE_OWNER_EMAIL_ADDRESS =='' || STORE_NAME_ADDRESS =='') {
    require('index_setup_wizard.php');
} else {
    require('index_dashboard.php');
}
?>
    <footer class="homeFooter">
        <!-- The following copyright announcement is in compliance
        to section 2c of the GNU General Public License, and
        thus can not be removed, or can only be modified
        appropriately.

        Please leave this comment intact together with the
        following copyright announcement. //-->

        <div class="copyrightrow"><a href="https://www.zen-cart-pro.at" rel="noopener" target="_blank"><img src="images/small_zen_logo.gif" alt="Zen Cart - deutsche Version" /></a><br><br>E-Commerce Engine Copyright &copy; 2003-<?php echo date('Y'); ?> <a href="https://www.zen-cart-pro.at" rel="noopener" target="_blank">Zen Cart - deutsche Version</a></div><div class="warrantyrow">Zen Cart is derived from: Copyright &copy; 2003 osCommerce<br>This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;<br>without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE<br>and is redistributable under the <a href="https://www.zen-cart-pro.at/license/3_0.txt" rel="noopener" target="_blank">GNU General Public License</a><br>
        </div>
    </footer>
<?php
$zco_notifier->notify('NOTIFY_ADMIN_FOOTER_END');
?>
    </body>
    </html>
<?php require('includes/application_bottom.php');
