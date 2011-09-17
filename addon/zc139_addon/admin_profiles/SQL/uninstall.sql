# @package Admin Profiles
# @copyright Copyright 2006-2010 Kuroi Web Design
# @copyright Portions Copyright 2003 Zen Cart Team
# @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
# @version $Id: uninstall_admin_profiles.sql 357 2010-05-23 18:50:07Z kuroi $

DROP TABLE IF EXISTS admin_menu_headers;
DROP TABLE IF EXISTS admin_visible_headers;
DROP TABLE IF EXISTS admin_files;
DROP TABLE IF EXISTS admin_allowed_pages;