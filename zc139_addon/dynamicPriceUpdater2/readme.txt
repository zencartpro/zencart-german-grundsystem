Dynamic Price Updater v2.0a
-=-=-=-=-=-=-=-=-=-=-=-=-=-

Thank you for choosing the new, improved DPU!  The module has been completely rewritten (except for one or two JS functions)

Installation
------------

Simply upload the 3 files included (they are in the correct folder structure) and job done!  For reference the 3 file paths are:

dpu_ajax.php
includes/classes/dynamic_price_updater.php
includes/modules/pages/product_info/jscript_ajax_updater.php

NOTE: If you have the original Updater installed please insert an underscore (_) at the beginning of the filename

If you have SSH you could always wget the zip from http://chrome.me.uk/DPUv2.zip and unzip it directly into the catalog folder (there is no containing folder in the zip)

Update!
-------

The Updater is now capable of displaying the weight of the customers product.  Simply create a DIV or SPAN element with the ID of 'productWeight' and the Updater will automatically populate if for you

Also there is a rudimentary sidebox feature that I'm developing.  It's turned off by default but if you would like to try it out follow these instructions

- Open dpu_ajax.php and navigate to line 9
- Change define('DPU_SHOW_SIDEBOX', false); to define('DPU_SHOW_SIDEBOX', true);
- Open includes/modules/pages/product_info/jscript_ajax_updater.php and navigate to line 15
- change define('DPU_SIDEBOX_ELEMENT_ID', 'false'); define('DPU_SIDEBOX_ELEMENT_ID', 'MYID');
	- MYID should be the ID of the existing sidebox that you would like the Updater sidebox to appear *above* (e.g. manufacturers)
	
Check out the comments in /dpu_sjax.php for ways to customise the sidebox display

Settings
--------

While I've tried to keep the settings fairly simple and generic but if necessary there are a few settings.  They are distributed in two files:

dpu_ajax.php - This file has settings to control whether the currency symbols should be included (defaults to yes), whether the quantity should be shown (defaults to yes) and how the quantity should be formatted (defaults to just brackets)

includes/modules/pages/product_info/jscript_ajax_updater.php - This file has settings that should not have to be changed although if the price doesn't update you might want to check the DPU_PRICE_ELEMENT_ID setting as if your template has the price in an element (e.g. div) with a different ID this setting needs altering

Support
-------

As always support is located on the Zen Cart forums at:

http://www.zen-cart.com/forum/showthread.php?t=70577

Or you can contact me at my email address.  I would prefer support queries be kept to the forum, though, as then others may benefit from any solutions/suggestions

Credits
-------

Thanks to Thomas Achache to for giving me the inspiration for the mechanism

Thanks to web28 for the idea of preventing loading under certain circumstances

Thanks to Matt (lankeeyankee) for testing and correcting my inevitable mistakes

Copyright
---------

(c) 2009-infinitum_baby! Dan Parry (Chrome)
Email: admin@chrome.me.uk
URL: http://chrpme.me.uk
Other Zen Cart modules: The original Dynamic Price Updater, some image thing that never really worked properly and had a silly name ;)

Out...