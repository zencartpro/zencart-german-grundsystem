*Module Name:  Group Pricing Per Item
*ORIGINAL AUTHOR: Jeremiah Peterson
*MODIFIED BY: Alex Svteos <alex.svetos@gmail.com>
*FUNCTION:  gives admin the ability to specify up to 4 (extra) different prices for each item in the catalogue. These prices are automatically associated with 4 specially named customer groups - customers belonging to a certain group, will see the price for that group.
*DATE: March 2008
*UPDATE VERSION: 1.3
*VERSION COMPATIBILITY:  tested on standard install of Zen-Cart 1.3.7 and 1.3.8

*Modifications history : 
  February 20, 2007 : fixed admin/includes/modules/products/collect_info.php hard coded table name in query (line 78)
  March 2008 : upgraded for compatibility with v1.3.8, changed tablenames to use system constants so prefix renaming is not necessary, fixed bugs, made easier to setup


!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
PLEASE READ ALL INSTRUCTIONS BEFORE ATTEMPTING TO INSTALL MODULE
PLEASE BACK UP YOUR ENTIRE SHOP AND DATABASE BEFORE STARTING
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

-----------------------------------------
1) MAKE DATABASE CHANGES
-----------------------------------------
You must apply the sql instructions contained in the file "group_pricing.sql". This can be done using the online tool in the Admin Panel - or if you are a savvy database administrator, it can be done using your favourite SQL database administration tool.

To apply the patch using the Admin Panel tool, first open the file "group_pricing.sql" in a text editor, and copy all of its contents.
Then, go to Admin Panel -> Tools -> Install SQL Patches, and paste the contents into the field there. Click the "Send" button.

If everything goes OK, you should see at the top of your page a confirmation message that says "1 statement processed."

-----------------------------------------
2) CUSTOMISE MODULE FILES
-----------------------------------------
For those who have to do the edits manually, I will provide a list of all files where the edits are required:

If you wish, replace the names "Group A", "Group B", "Group C" & "Group D":
By default, the 4 pricing groups are called "Group A", "Group B", "Group C" & "Group D". If these names are fine for you, then you can skip this step. However, if you wish, you can replace these names with any name you desire, by finding & replacing all their occurrences in 2 files of this module. To use a different name, replace all the occurences of that name in the appropriate files - which are:
    * /includes/extra_datafiles/group_price_per_item.php
    * /admin/includes/extra_datafiles/group_price_per_item.php

These are the settings you need to be changing:
  define('GROUP_PRICE_PER_ITEM1', 'Group A');
  define('GROUP_PRICE_PER_ITEM2', 'Group B');
  define('GROUP_PRICE_PER_ITEM3', 'Group C');
  define('GROUP_PRICE_PER_ITEM4', 'Group D');

BE SURE TO CHANGE **BOTH** FILES IF YOU MAKE ANY CHANGES AT ALL !!!

-----------------------------------------
3) UPLOAD AND OVERWRITE EXISTING FILES
-----------------------------------------
!!! MAKE SURE YOU HAVE BACKED UP YOUR SITE BEFORE PROCEEDING !!!
Using your favourite FTP program, upload all files inside the 'catalog' directory to your Zen Cart installation. You must overwrite the default Zen Cart files found in the same locations. 

If you have applied any other modules that have already previously changed any of these files, you may need to use a file merging program, and merge the modifications made by the other modules, before uploading - otherwise you will lose all your previous modifications.

If you decide later you no longer with to use the Group Pricing Per Item module, simply restore the overwritten files from your backup - you DID do a backup, didn't you?


-----------------------------------------
4) CREATE GROUP(S) IN ADMIN PANEL
-----------------------------------------
Lastly, go to Admin Panel -> Customers -> Group Pricing, and create the groups, using the names specified by you in step 2. You must name the groups exactly as you have specified them (for instance "Group A", "Group B", and so on). You can leave the "% Discount" field empty.

If you use any of the names you specified in step 2, under the "% Discount" column you should see "Per Item". Try editing a product in your catalogue, and you will see that you now have 2 new extra price fields, for each 'Per Item' group you've created.

NOTE: you can still create 'automatic' groups, that give a 'universal' discount by %, as per the original installation of Zen Cart. To define such a group, simply use a name NOT defined in step 2. If you use any other name for a group, you should be able to specify a percentage, which will work as original customer discount groups in Zen Cart.


-----------------------------------------
5) ASSIGN CUSTOMERS TO GROUPS!
-----------------------------------------
Customers will default to seeing the standard prices. In order to enable them to see your group pricing for an item, you must let Zen Cart know that the customer belongs to that group. To do that, go to Admin Panel -> Customers -> Customers. Select the customer from the list, and click the "Edit" button. 

At the very bottom of the customer's account details page, you will see under "Options" the "Discount Pricing Group" menu. Just select the appropriate discount group for that customer, or leave it at "--none--" for standard pricing. The group will now determine what pricing the customer will see throughout your shop.


-----------------------------------------
UNINSTALLING
-----------------------------------------
If you decide you no longer wish to use this module, you can easily remove it - provided you have your original BACKUP!:

1) restore the original files from your backup, and delete the group_price_per_item.php files in /includes/extra_datafiles and /admin/includes/extra_datafiles folder.
2) apply the database removal patch in "group_pricing_remove.sql"


-----------------------------------------
HAVE YOU ENHANCED THIS MODULE?
-----------------------------------------
If you make any changes or enhancements to this module, please notify the Zen Cart community: http://www.zen-cart.com/forum.


-----------------------------------------
THANKS
-----------------------------------------
If you wish to express your thanks for this module, please send a donation to Zen Cart via:  paypal@zen-cart.com

Many thanks, and enjoy!

