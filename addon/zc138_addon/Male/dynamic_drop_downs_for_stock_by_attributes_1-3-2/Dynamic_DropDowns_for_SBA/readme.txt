
Dynamic Drop Downs for Stock by Attributes
------------------------------------------


=======
NOTICE:
=======

I am not a developer and do not claim to be. I ran into a problem when helping my wife start an online store. Dynamic drop downs based on stock seem like a basic function that should be in all shopping carts. Zen Cart is lacking this but osCommerce has it via the QTPro contributed module.



==========
DONATIONS:
==========

I spent several hours on this and hope the community can improve on it until Zen Cart 1.4 is released. If you would like to donate to my efforts, please shop on my wifes childrens clothing store, www.ModernMunchkin.com.

ModernM




=========
FEATURES:
=========

(Some features not listed or still being worked on)

1. Sequenced drop downs based on attribute stock availablity.

2. Multiple drop downs with javascript out of stock notice text.

3. Single drop down with out of stock text next to attribute values that are out of stock.



=============
KNOWN ISSUES:
=============

1. The single_dropdown option does not work correctly as it does not add the item with the selected attribute. I hope to have this fixed soon. To get around this use multiple_dropdown or sequenced_dropdown options for the single attribute configuration. 

2. Multiple_drop down does not work with multiple attributes, a regular expression needs to be fixed. Use the sequenced_dropdown for more than one attribute.

2. This code is far from optimized and does not follow all the Zen Cart standards. I hope to have this cleaned up over time with the help of the community.

3. The single_radioset option is not tested.



=============
REQUIREMENTS:
=============

1. Zen Cart 1.38a (may work with older versions)

2. Stock by attributes v4.7 must be installed and working.



========
INSTALL:
========

1. Install the Stock by Attributes v4.7 module.

2. Run the new_install.sql and config.sql via Zen Cart Admin under Tools -> Install SQL  Patches.

3. Rename the folder in this packaged named YOUR_TEMPLATE to the name of your template.

4. Upload all files excluding the the *.sql files.

5. Modify "includes/database_tables.php" by adding...

define('TABLE_PRODUCTS_STOCK', 'products_with_attributes_stock');

6. Modify "includes/languages/english/YOUR_TEMPLATE/product_info.php" by adding...

define('TEXT_OUT_OF_STOCK', 'Out of stock');
define('TEXT_OUT_OF_STOCK_MESSAGE', 'The combination of options you have selected is currently out of stock.  Please select another
combination.');

7. Configure the add-on via Zen Cart Admin under Configuration -> Dynamic Drop Downs.



========
CREDITS:
========

Zen Cart Team

http://www.zen-cart.com/index.php?main_page=infopages&pages_id=14



Stock by Attributes 4.7

Maintained by: Kuroi

http://www.zen-cart.com/index.php?main_page=product_contrib_info&products_id=310



QTpro - Quantity Tracking Professional

http://www.oscommerce.com/community/contributions,888









