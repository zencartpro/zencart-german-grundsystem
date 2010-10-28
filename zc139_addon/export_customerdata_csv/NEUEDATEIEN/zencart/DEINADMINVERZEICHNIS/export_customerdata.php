<?php
/**
 * export_customerdata
 *
 * @package Export Customer Data as CSV
 * @copyright Copyright 2010, webchills www.webchills.at
 * @copyright Portions Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: export_customerdata.php 675 2010-10-27 10:46:10 webchills $
 */
require('includes/application_top.php');
?>


<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>

</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><img src="export_customerdata/openoffice.jpg" width="158" height="54"/></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="100%" valign="top">
          <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="main">
            <tr>
              <td align="left" valign="top">
                <?php echo TEXT_EXPORT_CUSTOMERDATA_OVERVIEW; ?>
                <br class="clearBoth" />
                <a href="export_customerdata/export_customer_data_all_csv.php"><img src="export_customerdata/csv_download.gif" border="0" alt="Download csv" title="Download csv"/>
        </a>
       
                
                
              </td>
              <td width="158px" align="right" valign="top">
                <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="smallText"><?php echo TEXT_EXPORT_CUSTOMERDATA_INFO; ?> </td>
                  </tr>
                  
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
<!-- body_text_eof //-->
    </table>
    </td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>



