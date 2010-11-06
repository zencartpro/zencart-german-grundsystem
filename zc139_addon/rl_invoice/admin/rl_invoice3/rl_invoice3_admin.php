<?php
/**
 * @package rl_invoice3
 * @copyright Copyright 2005-2009 langheiter.com 
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * generates pdf-invoices; please read: http://demo.zen-cart.at/docs/rl_invoice3/
 * 
 * @version $Id: rl_invoice3_admin.php 542 2010-04-14 08:18:49Z hugo13 $
 */

chdir('../');
require_once('includes/application_top.php');
#require('./rl_invoice3/rl_invoice3_header.php');
require('rl_invoice3_header.php');


	require(DIR_WS_INCLUDES . 'footer.php');
?>
<!-- footer_eof //-->
</body>
</html>
<?php
	require(DIR_WS_INCLUDES . 'application_bottom.php');