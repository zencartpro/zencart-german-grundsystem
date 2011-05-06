Add-On: Login Box v1.6
Designed for: Zen Cart v1.3.x
Created by: Linda McGrath ZenCart@WebMakers.com
http://www.thewebmakerscorner.com

Updated to Zen Cart 1.3 standard (XHTML compliant) 2006/06/07  Rick Suffolk
Updated to include use of "my Account" menu after login 2006/08/13 Ian Manson
Updated to include support for securityToken introduced in v1.3.8  2007/12/10
Updated for changes and compatibility with 1.3.9h.


As a way to keep new add-ons in development and allowing for the support of existing ones,
donations are always appreciated, but never required, for the use of this add-on. PayPal@WebMakers.com

========================================================

HISTORY AND CREATION:

The original concept of the Login Box I attribute to Aubrey Kilian <aubrey@mycon.co.za>

Login Box takes advantage of the Zen Cart Magic Smart Technologies based on the use of autoloading language files that can be unique per template or identical for all templates based on installation.

In addition, installation is further assisted with the automatic self loading of sideboxes via the Layout Controller.


========================================================

NOTES:

The Login Box will only show when not logged in and when not on the Login, Create Account or Forgotten Password pages.

Update: Menu consisting of "my account links etc to be displayed while logged in.

========================================================

NEW FILES:

/catalog/includes/modules/sideboxes/login_box.php
/catalog/includes/templates/template_default/sideboxes/tpl_login_box.php
/catalog/includes/languages/english/extra_definitions/login_box_defines.php



========================================================

INSTALLATION:

The files are arranged in the same structure as Zen Cart 

These can all be uploaded via FTP to your server as they are without any editing required.

You can just FTP the whole /includes directory to your site.

Go to the Admin ...
Go to Tools ...
Go to Layout Controller ...

The Login Box will automatically be found and installed.

Next configure it for the Left or Right Column and the Sort Order. 0 will put it at the Top.

Turn the box on.

You are done!



========================================================
New v1.6
Updated for minor changes in 1.3.9

New v1.5
Added securityToken introduced in v1.3.8

New v1.4
Changed to display a menu of "MY ACCOUNT" type items when logged in.

New v1.3
Re-written tpl_login_box.php for XHTML compliance


========================================================
========================================================


========================================================

MANUAL INSTALLATION ...

========================================================

COPY PROGRAM FILES:

If you want all templates to use the Login Box ...

login_box.php to /catalog/includes/modules/sideboxes/login_box.php


If you want a specific templates to use the Login Box ...

login_box.php to /catalog/includes/modules/sideboxes/TEMPLATE_DIRECTORY/login_box.php



========================================================

COPY TEMPLATE PROGRAM FILES:

Copy the tpl_login.php file to the /catalog/includes/templates/TEMPLATE_DIRECTORY/sideboxes directory where you want to use the Login Box

and
copy the tpl_login_box.php to /catalog/includes/templates/template_default/sideboxes/tpl_login_box.php



========================================================

COPY LANGUAGE FILES:

layout_box.php to /catalog/includes/languages/english/extra_definitions/login_box_defines.php


If you want different definitions for a specific template you can edit this file and copy to the template directory, example:

layout_box.php to /catalog/includes/languages/english/extra_definitions/TEMPLATE_DIRECTORY/login_box_defines.php



========================================================

TO ACTIVATE THE LOGIN BOX:

After uploading the files, follow the next 3 steps.

Go to Admin ...
Go to Tools ...
Go to Layout Controller ...

The Login Box will automatically be added to the current template.

You can then configure it for the Left/Right or Single Columns and the sort order.

If you want to add it to a different template than the template_default ...

Upload the file tpl_login_box.php into the /includes/templates/TEMPLATE_DIRECTORY/sideboxes directory.

Next, switch the currently selected template to the new template and go back to the Layout Controller to configure the box layout and turn it on.

If you would like custom text for the Login Box, you can place a copy of the login_box_defines.php language file into the /extra_definitions/TEMPLATE_DIRECTORY folder and it will override the default definition file when that template is active.

