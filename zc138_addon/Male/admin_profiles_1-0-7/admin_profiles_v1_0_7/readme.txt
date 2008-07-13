Admin Profiles
==============

Admin Profiles, or AP to its friends, and it seems to have many, is a well-established and stable add-on for Zen Cart. Below you can find information about how each version developed. Support for it is exclusively via the Zen Cart forum, Kuroi Web Design is pleased to have donated it to the Zen Cart community, but does answer question sent to our work address or emails (please don't embarass us by trying).

The Future
==========

For the future we are considering a "Pro" version aimed squarely at Zen Cart users running real businesses, who need a greater level of protection and more functionality than the current free version can offer. We are indebted to the guys at www.digitalscrapbookpages.com who funded some work into exploring, for example, how Admin Profiles could be extended to restrict contributors (in their case designers) to being able to access and amend only the products that they had added. Other ideas that we have in mind or have been suggested to us, include: restricting access by user name and IP address, genuine "profiles" for quicker addition of new users, doing away with the need to amend box files (indeed we have in mind being able to add Zen Cart mods with a single click!)

Of course, there's a fair bit of work involved in this, and we'll only do it there's sufficient interest and we're meeting your needs. If you would like to be kept up-to-date about this development, please send an email to ap@kuroiwebdesign.com to register your interest (with no obligation) and tell us what you would like it to do. (Please note that support for the existing version of Admin Profiles will continue to be available only via the Zen Cart Forum Support thread at http://www.zen-cart.com/forum/showthread.php?p=534818 and will not be available via this email address)


The Past
========

version 1.0.0
-------------

This first release of the Admin Profiles extension for Zen Cart is specifically targeted at Zen Cart v1.3. It has not been tested with, and is not compatible with, earlier versions of Zen Cart. Parts have been built upon Admin Levels, but much of the code has been re-written and there are significant extensions to it. It has been re-named because the intention is to extend it further in ways that allow a great deal of flexibility when allowing and restricting access to the Admin functions, flexibility that is not necessarily based on levels!

Specific features for this release are:
- all functionality from Admin Levels
- seamless integration with Zen Cart 1.3 Admin Settings page
- ability to choose whether Admin menu items are hidden or visible for individual users
- much improved facility for editing permissions and navigating between profiles for different users
- based on the Zen Cart 1.3 code e.g. includes the fix to prevent admin functions being called erroneously from elsewhere
- clearer, maintainable code
- minimal intrusion into Zen Cart 1.3 core code

Version 1.0.1
-------------

Includes bug fixes to admin_control.php:
1. to properly support the TABLE_ADMIN constant to deal with the database prefix issue
2. to correct the embarassing use of absolute file paths (sorry folks)

Version 1.0.2
-------------

1. Fix to admin_profiles.php to insert config functions for 3rd party mods into admin_files table
2. Adjustment to install sql to include 3rd party mods header
3. Display third party mods in a section at the bottom of the Admin Profiles page
4. Force order in which Admin Profiles headings are displayed
5. Package now includes upgrade sql and instructions

Note: From version 1.0.2 The "admin control" page will automatically appear under 3rd party mods. This page is part of
Admin Profiles and controls access to pages. Like all entities with this much power, it chooses not
to apply its own controls to itself. So you can use it for checking practice, it will just ignore you.
This is a feature not a bug!

Version 1.0.3
-------------

This is the biggest overhaul since the launch of v1.0.0. Much of the work has gone on under the hood, redundant and repetitious code has been stripped from the core functions and much of the rest has been re-written and commented for greater maintainability. Improvements that you can see when using Admin Profiles are:
1. Menus visible to the user whose access profile is being edited now have a coloured tint
2. Admin Profiles no longer cares whether files have a .php suffix or not
3. Extra buttons have been added to allow whole sections of pages to be checked or unchecked with a single click

Version 1.0.4
-------------

A minor update to address compatibility issues with the User Tracking mod.
For the User Tracking mod, use the specialized _dhtml file in the "extras - user tracking" folder of this ZIP, and run the enclosed .SQL via your preferred method.
The only file "updated" from v1.0.3 was the functions/admin_profiles.php file.
Technical change: added support for an extra parameter to be passed from the _dhtml files when using configuration groups as menu options.

Version 1.0.5
-------------

A minor update for Zen Cart release 1.3.5.
The install instructions have been updated and the admin.php & admin/languages/english.php with patches pre-applied for version 1.3.5 have been added to release package. See the install.text file for more information about when these may be used.

Version 1.0.6
-------------

A minor release to update the two files in extras and the installation instructions to be 100% compatible with Zen Cart 1.3.6. There are no functional changes.

Version 1.0.7
-------------

A fairly minor release to:
- incorporate corrections to box files built into Zen Cart 1.3.8.
- add a proper "page denied" page
- ensure that the Admin password forgotten function works for everybody
- slim down and makes minor corrections to the installation instructions
- remove user tracking extras (just one example of a 3rd party add-on needing box file changes and causing confusion)
If you're already running Admin Profiles 1.0.6 on Zen Cart 1.3.8 without problems, I wouldn't bother upgrading!


_____________________________________________________________________________

Zen Cart Open Source E-commerce - Admin Profiles

Copyright (c) 2006-2008 kuroi Ltd  http://www.kuroiwebdesign.co.uk
Portions Copyright (c) 2004 Jonathan Kontuk
Portions Copyright (c) 2003 osCommerce, 2003 Zen Cart

This contribution is subject to version 2.0 of the GPL license,
that is bundled with this package in the file LICENSE, and is
available through the world-wide-web at the following url:
http://www.zen-cart.com/license/2_0.txt.
If you did not receive a copy of the Zen Cart license and are unable
to obtain it through the world-wide-web, please send a note to
license@zen-cart.com so we can mail you a copy immediately.

These files submitted for public distribution to Zen Cart
http://www.zen-cart.com/index.php?main_page=product_contrib_info&cPath=40_41&products_id=86
_____________________________________________________________________________