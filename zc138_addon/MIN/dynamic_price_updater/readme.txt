Price updater
-=-=-=-=-=-=-

---===<<< IMPORTANT >>>===---

This is currently a test version of the Updater.  It includes fixes that, at this time, 28/05/08, are relatively untested

It is therefore recommended that, if you already have the Updater installed, you rename the existing file to j_script_updater.php or similar to make it easier to roll back should any unwanted situations occur

Support for this particular version of the Updater is located at http://www.zen-cart.com/forum/showthread.php?t=70577&page=17

The price updater is designed for use with products that have attributes that alter the price of a product. When a visitor chooses an attribute that adjusts the price the updater will automatically alter the displayed price to reflect this

---===<<< IMPORTANT >>>===---

If you have Lightbox installed you may encounter some issues when running the Updater... The following alterations have been shown to help

There are 2 lines that contain the code: if (prArr[i] !== null) {

This should be changed to: if (prArr[i]=='') {

The lines in question should be 270 and 335

Many thanks to lankeeyankee and clarkjarvis on the Zen Cart forums for finding the fault and fixing it, respectively

Sidebox usage
-------------

The Updater has a sidebox feature that allows the display of a price breakdown for each attribute and a total. By default this feature is set to appear above the Information sidebox. If you would like the Updater sidebox to appear anywhere else simply set _sidebox to the ID of the sidebox you would like it to appear above. For example:

var _sidebox = 'ezpages';

If you would like to disable this feature set _sidebox to false. Like so:

var _sidebox = false;

To adjust the heading that is shown on the Updater side box alter the UPDATER_SB_TITLE to the heading of your choice

The base ID of the Updater sidebox is updaterSB; CSS declarations can be attached to this ID


Quantity usage
--------------

The updater is linked into the quantities box (if there is one) in the shopping cart. The current quantity the user has specified can be displayed in 2 places. Firstly it can be displayed in the main price header, where it is placed in brackets after the price itself. Secondly it can be displayed in the sidebox where it assumes the form of, for example, My attrib - 2x £1.00

The quantity displays can be switched on and off independantly using the following commands. To disable the display in the main price header, set this value:

var showQuantity = false;

If you would like to disable the quantity display in the sidebox, use this command

var showQuantitySB = false;

All total prices displayed will take the quantity specified into account and will display the relevant price regardless of whether the quantities are displayed or not


Installation
------------

Upload the file to includes/modules/pages/product_info/ (directory structure included)

(c) D Parry (Chrome) 2007


Support
-------

Support can be found at the following locations:

http://www.zen-cart.com/forum/showthread.php?t=70577

Or by emailing:

dan@virtuawebtech.co.uk

Changelog
=========
08/02/2009 - NEW MODIFICATIONS by web28 - www.rpa-com.de
	- FIX: Problems if used attributes pictures with option=4
        - FIX: Problems with Option Price = 0.00 and using Radiobutton and Checkboxes
	- NEW: USE ZENCART CURRENCIES FORMAT
	- NEW: USE ZENCART DEFAULT  Decimal_Point, Thousands_Point
        - DELETE: GERMAN taxAddon 

02/02/2009 - NEW MODIFICATIONS by web28 - www.rpa-com.de
	- FIX Problems if used attributes pictures
	- FIX Problems with german taxAddon
	- FIX Problems to find currency symbols
	_ NEW Find the displayed products price
	

18/07.2007 - 
	- Updated seeker regex for increased currency symbol compatability
	- Linked to quantity box
	- Added displays for current quantity
	- Can now handle some sales
	- Radio and checkboxes now accepted
16/07/2007 - Adding sidebox for displaying price breakdown information

