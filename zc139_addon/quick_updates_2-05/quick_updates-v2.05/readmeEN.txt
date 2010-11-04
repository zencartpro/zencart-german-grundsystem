

========================================================

WHAT DOES THIS MODULE DO?

Quick Updates is an administration component for the Zencart eCommerce system. 
It enables you to edit and update multiple products via one screen. 

Features include: 

- Presents all of your products and prices into a "form" which is then updatable all in one go. 
- Allows you to select products based on Category or Manufacturer. 
- Allows you to globally increase or decrease the price for a range of products. 
- Preview the changes before committing 
- Configuration options to select which feilds to display on the form
- Allows you to copy products very quickly

========================================================

FILES TO OVER-RIDE

none

========================================================

File Modifications:

None.

========================================================

Database Modifications:

New configuration entries added to the zen_configuration table if you want 
to be able to edit which fields are displayed.


========================================================

INSTALLATION:

1. Copy/FTP the files and directories in the zencart_root folder to the root of 
   your Zen Cart installation, making sure to preserve the file structure.
2. Go to "Tools->Install SQL Patches" in your Zen Cart administration area. 
   Click the "browse" button and locate the "quick_update.sql" file  
   contained in this release. Click the upload button and your system should now be 
   ready to go!
   
(note: if the upload produces errors try to copy and paste to the textarea)

========================================================

USAGE:

1) Always backup your database before doing any updates!

2) Just try it

========================================================

NOTES:

1) Also take a look at admin/includes/extra_configures/quick_updates.php, some setting have been added to this (some of which should be moved to the admin some day..)

2) The CSS Popups do not work well in IE6, and probably never will. It's caused by IE6 bugs\flaws. If you think you really *have* to use IE6 for some reason you probably better switch "Use popup edit" to false (quick_updates admin setting).
The recommended browser to use is Firefox. But I have done a quick test with IE7, and the CSS popups seems to look ok in IE7 as well.

3) To make the products_purchase_price and margin feature work "products_purchase_price" (i.e. DECIMAL 15,4) and "products_margin" (i.e. DECIMAL 15,2) need to be added to your products tabel.