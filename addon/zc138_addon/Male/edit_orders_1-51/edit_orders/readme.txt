NAME:
=====
Edit Orders

VERSION:
========
1.51 - 6/22/2008 - 1.5 and 1.51 Changes by Scott Turner

AUTHORS:
========
Kathleen
Igor Couto
Scot http://www.ecdiscounts.com
Josh Beauregard http://www.sanguisdevelopment.com
Numinix Technology http://www.numinix.com
Scott Turner http://birdingdepot.com

DESCRIPTION:
============
Edit Orders is an Admin modification that allows store owners to add or remove products from a customer's order.

INSTALLATION:
=============
1. Upload files to your store directory;
2. Make the following changes to admin/orders.php:
	
	Find:
		$contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit', 'NONSSL') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=delete', 'NONSSL') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
	Replace With:
		$contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ORDER_EDIT, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit', 'NONSSL') . '">' . zen_image_button('button_details.gif', IMAGE_DETAILS) . '</a> <a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=delete', 'NONSSL') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
	
	Find:
		$contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit', 'NONSSL') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a>');
	Replace With:
		$contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ORDER_EDIT, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit', 'NONSSL') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a>');

USE:
====
In ADMIN->CUSTOMERS->ORDERS->EDIT make necessary changes to customers' order (i.e. to delete a product, change quantity to 0) and then click UPDATE.

VERSION HISTORY:
================
v 1.0.0 01/07/2007 - Kathleen
1. Ported from OSC for Zen Cart v1.2
v 1.1.0 02/16/2007 - Igor Couto
1. Bug fix;
2. Updated readme.txt;
v 1.2.0 10/01/2007 - Chris Barnhill
1. Added additional payment options;
2. Updated how credit card numbers are displayed;
v 1.2.5 10/15/2007 - san
1. Bug fix;
2. Removed functions;
3. Code optimization;
v 1.2.6 11/12/2007 - numinix
1. Re-added functions (required);
2. Re-added missing installation instructions;
3. Re-wrote readme.txt;
v 1.5 5/24/08 - Scott Turner
NOTE: 1.5 - Works With Zen Cart 1.3.8
1. Fixed Issues with Adding a Product With Attributes
2. Adding Products with Attributes Will Automatically Recalculate Price
3. Fixed Issue with Deleting a Product (Thanks zc_tester)
4. Fixed Issue with Editing a Product Attribute (Thanks zc_tester)
5. Added Ability to Edit Product Attributes Price Increases/Decreases
  -- NOTE: This will not change the unit price - this must be edited manually.
6. Corrected PHP tags
7. Fixed Problems with Status/Comments Updates & Emails
v 1.51 6/22/08 - Scott Turner
1. Fixed problems with emails when HTML emails are enabled.
