Contribution:  User Tracking
Version:  user_tracking_for_zen 1.3.6.2
Designed for: Zen Cart v1.2 Release
Converted into Zen by: Dave Kennelly dave@open-operations.com
License: under the GPL - See attached License for info.
Support:  Only given via the forums, please.

========================================================
assembled: reza:02/15/2007, 
----------------
I have not changed any thing in this contribution. when I got problem after installation of user tracker version 1.3.6 on zen 1.3.7 and reading all comments of the forum, I found that most of the peoples got the same problems due to the separation of original package and upgraded package. for This I decided to put all together for zen 1.3.7.

with thanks to Jeff and Woodymon for their supports in the forum. please address your donations to them. 

rapid , fresh installation procedure:
1- the files in the contribution are arranges to zen 1.3.7 directory, just put them in the appropriate places
2- install sql patch file, preferabely by phpMyAdmin than add sql patch of zen ( as recommended in the forum)
3- File Modifications: 
   3-1- add the following to the end of /includes/templates/ YOUR TEMPLATE /common/tpl_footer.php

            <?php if (ZEN_CONFIG_USER_TRACKING == 'true') { zen_update_user_tracking(); } ?>

   3-2- add if you want to track admin pages viewed add the following to the end of /admin/includes/footer.php

            <?php if (ADMIN_CONFIG_USER_TRACKING == 'true') { zen_update_user_tracking(); } ?>

4- go to admin of zen, in admin/configuration and or in admin/tools you should see user tracking config, by clicking on this you should see:
 User Tracking Configuration  
 
Title Value Action  
User Tracking Visitors true   
User Tracking (ADMIN) true   
User Tracking (exclude this IP-Address) your IP   
User Tracking (Session Limit) 50   
User Tracking (your favorite WHOIS URL) http://www.dnsstuff.com/tools/whois.ch?ip=   
User Tracking (Show Product Category when tracking product clicks) true   
 User Tracking Visitors 
 

Check the Customers/Guests behaviour ? (each click will be recorded) 

Date Added: 09/02/2003 
Last Modified: 03/03/2003 
5- in admin/tools click on user tracking, you should see:

User Tracking Start: 

This tool allows for you to see the click patterns of the users through your site, organized by sessions. This data can be very valuable to those looking for how to improve your site by watching how customers actually use it. You can surf back and forth through the days by using the link below.
SELECT VIEW: Back to Feb 15, 2007 

Now displaying the latest 50 sessions of this 24 hour period. You can also purge all records past the last 72 hours of data.

Delete all info from IP-Address your IP purge all records 

 
There have been 0 page views in this 24 hour period. 
Session ID  User Shopping Cart  

6- troubelshootings:
6-1- first check again if all files are correctly located in the zen directories.
6-2- go to phpmyadmin, in table, configuration, delete all values related to user tracker , in table configuration-group, delete the table user tracking
6-3- try install sql package with alternative methode (if the first time was phpmyadmin, so this time do with zen admin add sql patch tools)
6-4- chack again if you have added two modifications to tpl.footer.php and footer.php
6-5- still problem, take a look at forum and submitt your question.
 




----------------
Updated: JTD:11/27/06 - jeffdripps@isegames.com

Modified the user_tracking.sql by extending the size of the last_page_url field from 64 characters to 128 characters as this was previously too short and would often truncate URL link data. 

Truncated the session_id field from 128 characters to 32 characters as this was wasted space.

Below is the commands necessary for the sql patch tool to alter the table to the new format described in the user_tracking.sql and described above:

ALTER TABLE `user_tracking` CHANGE `session_id` `session_id` VARCHAR(32); 
ALTER TABLE `user_tracking` CHANGE `last_page_url` `last_page_url` VARCHAR(128); 
ALTER TABLE `user_tracking` ADD `customers_host_address` varchar(64) NOT NULL;


Changed the script itself into a form and added a popup date selection menu so you can select a specific date to begin the listing.

Fixed the functions to work with sql 5.x and for longer last_page_url field writes.

Added a missing country flag or two.

Included the latest GeoIP.dat file.

Updated language defines for the popup additions.

History:
updated: 02/15/2007- assembling upgraded user tracking 1.3.6.2 with the original 1.3.6
Updated: 11/28/06 - fixed omission and errors in sql.
Updated: 11/29/06 - Added customers_host_address field support
Updated: 11/30/06 - Revised the report query and listing to begin at midnight on the requested day rather than (the current time - 24 hours) as was the case previously. This just seems more useful and intuitive.
Updated: 12/01/06 - Added Support for displaying product name, (borrowed from Pinghead version) as per Woody's suggestion.
Updated: 12/01/06 - Added Support for recording all page titles when tracking admin.
Updated: 12/04/06 - Added Configuration key and code for disabling category output when tracking product clicks.


Please let me know if you find bugs or omissions?

Thanks,
Jeff
jeffdripps@isegames.com

==========================================================



WHAT DOES THIS MODULE DO?

This module tracks your visitors hits on your site and displays pages visited by user session in admin
========================================================

History:

12/12/2004 - Initial Release


========================================================

FILES TO OVER-WRITE

none

========================================================

File Modifications: 2

add the following to the end of /includes/templates/ YOUR TEMPLATE /common/tpl_footer.php

<?php if (ZEN_CONFIG_USER_TRACKING == 'true') { zen_update_user_tracking(); } ?>

add if you want to track admin pages viewed add the following to the end of /admin/includes/footer.php

<?php if (ADMIN_CONFIG_USER_TRACKING == 'true') { zen_update_user_tracking(); } ?>

========================================================

Database Modifications:

A new database table needs to be created to store your site visits.

========================================================

INSTALLATION:

All files are arranged in the correct Zen Cart v1.2.x - 1.3.x structure.
Just upload to your server as they are without any editing required.
upload the included user_tracking.sql using the Zen-cart SQL Patches Tool
Make the file modifications above.

========================================================

USE:
Admin/Tools/User Tracking displays your users visits
Admin/Tools/User Manager Config allows some user manager configuration

