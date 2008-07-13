-------------------------------------------------
Easypopulate v2.72-MS2 (with attributes)
-------------------------------------------------
Last updated: December 28, 2003
Author: Vijay Immanuel aka VJ <www.vjdom.com>, based on earlier releases by various developers (for more details, see history.txt)
License: GPL (please see license.txt)
-------------------------------------------------


This release includes ability to turn off product attribute data when downloading the tab-delimited file. 



DOCUMENTATION UPDATE
--------------------

To toggle attribute data download, change this config variable (in easypopulate.php): 

// change this to false, if do not want to download product attributes. If you have
// a large number of attributes, you may want to this false. Attributes adds lots of
// additional data to the export.

global $products_with_attributes;
$products_with_attributes = true; 


DOCUMENTATION
--------------

Detailed manuals can be found here: 

1. /docs/1readmeFIRST.txt (includes "quick" installation and configuration notes)
2. /docs/Easypopulate_Manual.* (complete manual in various formats)

Please do read the manuals carefully. Its worth the time!

There is no documentation for the new product attributes feature. You can find some useful information, 


The following is not required to run this contribution. This may help many with large databases.
It was submitted by UGLi 6 May 2006.  It is a SQL command you run in your SQL tool provided by
your host, such as phpMyAdmin. Copy and paste the following line in your SQL command tool:

ALTER TABLE `products` ADD INDEX `idx_products_model` ( `products_model` );



SUPPORT
--------

Support for this release is also through the same forum thread - 
http://forums.oscommerce.com/index.php?showtopic=162244

HISTORY
--------

You can find a list of releases (and contributors) here: history.txt


SAMPLE OUTPUT FILE
-------------------

The sample output tab-delimited file - sample_output_file.txt is generated from the default oscommerce product list. 


FINAL WORD
----------

Documentation is very limited right now, for the attribute handling addition. 
My thanks to all the earlier developers of Easypopulate!

Hope you find this addition useful. Good luck :)



----------------------------------------------------------------
                      "In God I Trust"
----------------------------------------------------------------
