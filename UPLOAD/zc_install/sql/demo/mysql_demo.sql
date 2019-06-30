# MySQL file for Zen Cart Demo Products load
# Zen Cart German Specific
# $Id: mysql_demo.sql 70 2019-06-30 08:48:04Z webchills $
#

# Configuration Settings:
UPDATE configuration SET configuration_value='true' WHERE configuration_key='DOWNLOAD_ENABLED';

#
# Dumping data for table `address_book`
#

INSERT INTO address_book (address_book_id, customers_id, entry_gender, entry_company, entry_firstname, entry_lastname, entry_street_address, entry_suburb, entry_postcode, entry_city, entry_state, entry_country_id, entry_zone_id) VALUES (NULL, 1, 'm', 'Demofirma', 'Peter', 'Meier', 'Demogasse 17', '', '10101', 'Berlin', '', 81, 82);

#
# Dumping data for table `categories`
#

INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified, categories_status) VALUES
(1, 'categories/category_hardware.gif', 0, 1, '2019-06-18 03:18:19', '2019-06-18 00:32:17', 1),
(2, 'categories/category_software.gif', 0, 2, '2019-06-18 03:18:19', '2019-06-18 21:14:57', 1),
(3, 'categories/category_dvd_movies.gif', 0, 3, '2019-06-18 03:18:19', '2019-06-18 00:22:39', 1),
(4, 'categories/subcategory_graphic_cards.gif', 1, 0, '2019-06-18 03:18:19', NULL, 1),
(5, 'categories/subcategory_printers.gif', 1, 0, '2019-06-18 03:18:19', NULL, 1),
(6, 'categories/subcategory_monitors.gif', 1, 0, '2019-06-18 03:18:19', NULL, 1),
(7, 'categories/subcategory_speakers.gif', 1, 0, '2019-06-18 03:18:19', NULL, 1),
(8, 'categories/subcategory_keyboards.gif', 1, 0, '2019-06-18 03:18:19', NULL, 1),
(9, 'categories/subcategory_mice.gif', 1, 0, '2019-06-18 03:18:19', '2019-06-18 00:34:10', 1),
(10, 'categories/subcategory_action.gif', 3, 0, '2019-06-18 03:18:19', '2019-06-18 00:39:17', 1),
(11, 'categories/subcategory_science_fiction.gif', 3, 0, '2019-06-18 03:18:19', NULL, 1),
(12, 'categories/subcategory_comedy.gif', 3, 0, '2019-06-18 03:18:19', NULL, 1),
(13, 'categories/subcategory_cartoons.gif', 3, 0, '2019-06-18 03:18:19', '2019-06-18 00:23:13', 1),
(14, 'categories/subcategory_thriller.gif', 3, 0, '2019-06-18 03:18:19', NULL, 1),
(15, 'categories/subcategory_drama.gif', 3, 0, '2019-06-18 03:18:19', NULL, 1),
(16, 'categories/subcategory_memory.gif', 1, 0, '2019-06-18 03:18:19', NULL, 1),
(17, 'categories/subcategory_cdrom_drives.gif', 1, 0, '2019-06-18 03:18:19', NULL, 1),
(18, 'categories/subcategory_simulation.gif', 2, 0, '2019-06-18 03:18:19', NULL, 1),
(19, 'categories/subcategory_action_games.gif', 2, 0, '2019-06-18 03:18:19', NULL, 1),
(20, 'categories/subcategory_strategy.gif', 2, 0, '2019-06-18 03:18:19', NULL, 1),
(21, 'categories/gv_25.gif', 0, 4, '2019-06-18 03:18:19', '2019-06-18 00:26:06', 1),
(22, 'categories/box_of_color.gif', 0, 5, '2019-06-18 03:18:19', '2019-06-18 00:28:43', 1),
(23, 'waybkgnd.gif', 0, 500, '2019-06-18 02:26:19', '2019-06-18 23:21:35', 1),
(24, 'categories/category_free.gif', 0, 600, '2019-06-18 11:48:46', '2019-06-18 19:13:45', 1),
(25, 'sample_image.gif', 0, 515, '2019-06-18 02:39:17', '2004-01-24 01:49:12', 1),
(27, 'sample_image.gif', 49, 10, '2019-06-18 14:13:08', '2019-06-18 16:16:23', 1),
(28, 'sample_image.gif', 0, 510, '2019-06-18 17:13:47', '2019-06-18 23:54:23', 1),
(31, 'sample_image.gif', 48, 30, '2019-06-18 23:16:46', '2019-06-18 01:48:29', 1),
(32, 'sample_image.gif', 48, 40, '2019-06-18 01:34:56', '2019-06-18 01:48:36', 1),
(33, 'categories/subcategory.gif', 0, 700, '2019-06-18 02:08:31', '2004-05-20 10:35:31', 1),
(34, 'categories/subcategory.gif', 33, 10, '2019-06-18 02:08:50', '2004-05-20 10:35:57', 1),
(35, 'categories/subcategory.gif', 33, 20, '2019-06-18 02:09:01', '2019-06-18 00:07:33', 1),
(36, 'categories/subcategory.gif', 33, 30, '2019-06-18 02:09:12', '2019-06-18 00:07:41', 1),
(37, 'categories/subcategory.gif', 35, 10, '2019-06-18 02:09:28', '2019-06-18 00:22:39', 1),
(38, 'categories/subcategory.gif', 35, 20, '2019-06-18 02:09:39', '2019-06-18 00:22:46', 1),
(39, 'categories/subcategory.gif', 35, 30, '2019-06-18 02:09:49', '2019-06-18 00:22:53', 1),
(40, 'categories/subcategory.gif', 34, 10, '2019-06-18 02:17:27', '2004-05-20 10:36:19', 1),
(41, 'categories/subcategory.gif', 36, 10, '2019-06-18 02:21:02', '2019-06-18 00:23:04', 1),
(42, 'categories/subcategory.gif', 36, 30, '2019-06-18 02:21:14', '2019-06-18 00:23:18', 1),
(43, 'categories/subcategory.gif', 34, 20, '2019-06-18 02:21:29', '2019-06-18 00:21:37', 1),
(44, 'categories/subcategory.gif', 36, 20, '2019-06-18 02:21:47', '2019-06-18 00:23:11', 1),
(45, 'sample_image.gif', 48, 10, '2019-06-18 23:54:56', '2019-06-18 01:48:22', 1),
(46, 'sample_image.gif', 50, 10, '2019-06-18 00:01:48', '2019-06-18 01:39:56', 1),
(47, 'sample_image.gif', 48, 20, '2019-06-18 03:09:57', '2019-06-18 01:48:05', 1),
(48, 'sample_image.gif', 0, 1000, '2019-06-18 02:24:07', '2019-06-18 02:44:26', 1),
(49, 'sample_image.gif', 0, 1100, '2019-06-18 02:27:31', '2019-06-18 02:44:34', 1),
(50, 'sample_image.gif', 0, 1200, '2019-06-18 02:28:18', '2019-06-18 02:47:19', 1),
(51, 'sample_image.gif', 50, 20, '2019-06-18 02:33:55', '2019-06-18 01:40:05', 1),
(52, 'sample_image.gif', 49, 20, '2019-06-18 16:09:35', '2019-06-18 16:16:33', 1),
(53, 'categories/subcategory.gif', 0, 1500, '2019-06-18 23:07:41', NULL, 1),
(54, 'categories/subcategory.gif', 0, 1510, '2019-06-18 12:02:35', '2015-06-20 11:45:20', 1),
(55, 'categories/subcategory.gif', 54, 0, '2019-06-18 01:48:47', '2015-06-20 11:45:51', 1),
(56, 'categories/subcategory.gif', 54, 0, '2019-06-18 01:49:16', '2019-06-18 01:53:14', 1),
(57, 'categories/subcategory.gif', 54, 0, '2019-06-18 01:29:13', NULL, 1),
(58, 'categories/subcategory.gif', 54, 110, '2019-06-18 12:35:02', '2019-06-18 10:46:13', 1),
(60, 'categories/subcategory.gif', 54, 0, '2019-06-18 23:45:21', NULL, 1),
(61, 'categories/subcategory.gif', 54, 100, '2019-06-18 10:13:46', '2019-06-18 10:46:02', 1),
(62, 'sample_image.gif', 0, 1520, '2019-06-18 03:18:19', '2015-06-22 21:14:57', 1),
(63, 'categories/subcategory.gif', 0, 1530, '2019-06-18 03:18:19', '2019-06-18 17:45:24', 1),
(64, 'categories/subcategory.gif', 0, 1550, '2019-06-18 15:22:27', NULL, 1);

#
# Dumping data for table `categories_description`
#

INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES 
(1, 1, 'Hardware', 'We offer a variety of Hardware from printers to graphics cards and mice to keyboards.'),
(2, 1, 'Software', 'Select from an exciting list of software titles. <br /><br />Not seeing a title that you are looking for?'),
(3, 1, 'DVD Movies', 'We offer a variety of DVD movies enjoyable for the whole family.<br /><br />Please browse the various categories to find your favorite movie today!'),
(4, 1, 'Graphic Cards', ''),
(5, 1, 'Printer', ''),
(6, 1, 'Monitors', ''),
(7, 1, 'Speakers', ''),
(8, 1, 'Keyboards', ''),
(9, 1, 'Mice', 'Pick the right mouse for your individual computer needs!<br /><br />Contact Us if you are looking for a particular mouse that we do not currently have in stock.'),
(10, 1, 'Action', '<p>Get into the action with our Action collection of DVD movies!<br /><br />Don\'t miss the excitement and order your\'s today!<br /><br /></p>'),
(11, 1, 'Science Fiction', ''),
(12, 1, 'Comedy', ''),
(13, 1, 'Cartoons', 'Something you can enjoy with children of all ages!'),
(14, 1, 'Thriller', ''),
(15, 1, 'Drama', ''),
(16, 1, 'Memory', ''),
(17, 1, 'CDROM Drives', ''),
(18, 1, 'Simulation', ''),
(19, 1, 'Action', ''),
(20, 1, 'Strategy', ''),
(60, 1, 'Downloads', ''),
(58, 1, 'Real Sale', ''),
(21, 1, 'Gift Certificates', 'Send a gift certificate today!<br /><br />Gift certificates are good for anything in the store.'),
(57, 1, 'Text Prices', ''),
(56, 1, 'Attributes', ''),
(22, 1, 'Linked products', 'All of these products are &quot;Linked Products&quot;.<br /><br />This means that they appear in more than one Category.<br /><br />However, you only have to maintain the product in one place.<br /><br />The Master Product is used for pricing purposes.'),
(55, 1, 'Quantity Discounts', '<p>Discount Quantities can be set for Products or on the individual attributes.<br /><br />Discounts on the Product do NOT reflect on the attributes price.<br /><br />Only discounts based on Special and Sale Prices are applied to attribute prices.</p>'),
(23, 1, 'Test Examples', ''),
(24, 1, 'Call for price', ''),
(25, 1, 'Test 10% by attribute', ''),
(27, 1, '$5.00 off', ''),
(28, 1, 'Test 10%', ''),
(31, 1, 'Minus 10% Ausnahme', ''),
(32, 1, 'Minus 10% Price', ''),
(47, 1, 'Minus 10% Attribute', ''),
(33, 1, 'A Main Category', '<p>This is a top level category description.</p>'),
(34, 1, 'Sub category 2 A', 'This is a sublevel category description.'),
(35, 1, 'Sub category 2 B', ''),
(36, 1, 'Sub category 2 C', ''),
(37, 1, 'Sub Sub Cat 2B1', ''),
(38, 1, 'Sub Sub Cat 2B2', ''),
(39, 1, 'Sub Sub Cat 2B3', ''),
(40, 1, 'Sub Sub Cat 2A1', 'This is a sub-sub level category description.'),
(41, 1, 'Sub Sub Cat 2C1', ''),
(42, 1, 'Sub Sub Cat 2C3', ''),
(43, 1, 'Sub Sub Cat 2A2', ''),
(44, 1, 'Sub Sub Cat 2C2', ''),
(45, 1, 'Minus 10%', ''),
(46, 1, 'Set $100', ''),
(48, 1, 'Abverkauf nach %', ''),
(49, 1, 'Abverkauf Fixbetrag', ''),
(50, 1, 'Abverkauf neuer Preis', ''),
(51, 1, 'Set $100 Skip', ''),
(52, 1, '€5.00 off Skip', ''),
(53, 1, 'Big Unlinked', ''),
(54, 1, 'Special Functions', '<p>The New Products show many of the newest features that have been added to Zen Cart.<br /><br />Take the time to review these and the other Demo Products to better understand all the options and features that Zen Cart has to offer.</p>'),
(61, 1, 'Real', ''),
(62, 1, 'Music', ''),
(63, 1, 'Documents', 'Dokumente can now be added to the category tree. For example you may want to add servicing/Technical documents. Or use Dokumente as an integrated FAQ system on your site. The implemetation here is fairly spartan, but could be expanded to offer PDF downloads, links to purchaseable download files. The possibilities are endless and left to your imagination.'),
(64, 1, 'Mixed Product Types', 'This is a category with mixed product types.\r\n\r\nThis includes both products and documents. There are two types of documents - Dokumente that are for reading and Dokumente that are for reading and purchasing.');

#
# Dumping data for table `customers`
#

INSERT INTO customers (customers_gender, customers_firstname, customers_lastname, customers_dob, customers_email_address, customers_nick, customers_default_address_id, customers_telephone, customers_fax, customers_password, customers_newsletter, customers_group_pricing, customers_email_format, customers_authorization, customers_referral) VALUES 
('m', 'Peter', 'Meier', '1972-09-01 00:00:00', 'demo@zencartdemo.at', '', 1, '012345678', '', 'd95e8fa7f20a009372eb3477473fcd34:1c', '0', 0, 'TEXT', 0, '');

#
# Dumping data for table `customers_info`
#

INSERT INTO customers_info (customers_info_id, customers_info_date_of_last_logon, customers_info_number_of_logons, customers_info_date_account_created, customers_info_date_account_last_modified, global_product_notifications) VALUES
(1, '2019-06-18 09:00:00', 0, '2019-06-18 01:35:28', '2019-06-18 01:35:28', 0);

#
# Dumping data for table ezpages
#
# We start with page id 5 as 1 to 4 are reserved for IT Recht Kanzlei pages and already created during install

INSERT INTO ezpages (pages_id, alt_url, alt_url_external, status_header, status_sidebox, status_footer, status_toc, header_sort_order, sidebox_sort_order, footer_sort_order, toc_sort_order, page_open_new_window, page_is_ssl, toc_chapter, page_key) VALUES
(5,  '', '', 1, 0, 0, 1, 10, 0, 0, 10, 0, 0, 10, 0),
(6, '', '', 0, 0, 0, 1, 0, 0, 0, 30, 0, 0, 10, 0),
(7, '', '', 0, 0, 0, 1, 0, 0, 0, 40, 0, 0, 10, 0),
(8, '', '', 0, 1, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0),
(9, '', '', 0, 1, 0, 0, 0, 20, 0, 0, 0, 0, 0, 0),
(10, '', '', 1, 1, 1, 0, 50, 50, 50, 0, 0, 0, 0, 0),
(11, 'index.php?main_page=account', '', 0, 0, 1, 0, 0, 0, 10, 0, 0, 1, 0, 0),
(12, 'index.php?main_page=site_map', '', 0, 1, 1, 0, 0, 40, 20, 0, 0, 0, 0, 0),
(13, '', 'https://www.zen-cart-pro.at', 1, 0, 0, 0, 60, 0, 0, 0, 1, 0, 0, 0),
(14, 'index.php?main_page=index&cPath=21', '', 0, 1, 0, 0, 0, 60, 0, 0, 0, 0, 0, 0),
(15, 'index.php?main_page=index&cPath=3_10', '', 0, 0, 1, 0, 0, 0, 60, 0, 0, 0, 0, 0),
(16, '', 'http://www.google.at', 0, 1, 0, 0, 0, 70, 0, 0, 1, 0, 0, 0),
(17, '', '', 0, 0, 0, 1, 0, 0, 0, 20, 0, 0, 10, 0),
(18, '', '', 0, 1, 0, 1, -10, -10, -10, -10, 0, 0, 0, 0),
(19, 'index.php?main_page=contact_us', '', 1, 1, 1, 1, 44, 44, 44, 44, 0, 0, 0, 0),
(20, 'index.php?main_page=discount_coupon', '', 0, 1, 0, 1, 70, 70, 70, 70, 0, 0, 0, 0),
(21, 'index.php?main_page=unsubscribe', '', 0, 1, 0, 1, 80, 80, 80, 80, 0, 0, 0, 0),
(22, 'index.php?main_page=gv_faq', '', 0, 1, 0, 1, 60, 60, 60, 60, 0, 0, 0, 0);


#
# Dumping data for table ezpages_content
#

INSERT INTO ezpages_content (pages_id, languages_id, pages_title, pages_html_text) VALUES 
(5, 1, 'EZ Pages', 'This is the main page listed under the Link EZPages in the Header<br /><br />\r\n\r\n<strong>See: What is EZPages? Link for detailed use of EZPages</strong><br /><br />\r\n\r\nThis Link could show in the Header, Footer or Sidebox or a combination of all three locations.<br /><br />\r\n\r\nThe Chapter and TOC settings are for using this Page in combination with other Pages.<br /><br />\r\n\r\nThe other Pages can be shown either *only* with this Link in the Chapter and TOC or as their own Link in the Header, Footer or Sidebox, depending on how you would like them to appear on your site.<br /><br />\r\n\r\nThere is no true "Master" Link, other than the Links you actually have configured to display. But any Link in a Chapter can be displayed in any of the 3 locations for the Header, Footer or Sidebox or not at all, where it only appears together with the other Links in the Chapter.'),
(6, 1, 'A New Page', 'This is another page that is linked to the Chapter 10 via the Chapter number used and is sorted based on the TOC Order.<br /><br />\r\n\r\nThere is not a link to this page via the Header, Footer nor the Sidebox.<br /><br />\r\n\r\nThis page is only seen if the "main" link is selected and then it will show in the TOC listing.<br /><br />\r\n\r\nThis is a handy way to have numerous links that are related but only show one main link to get to them all.<br /><br />'),
(7, 1, 'Another New Page', 'This is yet another new page or link that is part of Chapter 10<br /><br />\r\n\r\nThe numbering of the Chapters can be done in any manner. But, by number in increments such as 10, 20, 30, etc. you can later insert pages, or links, as needed within the existing pages.<br /><br />\r\n\r\nThere is no limit to the number of pages, or links, that can be grouped together using the Chapter.<br /><br />\r\n\r\nThe display of the Previous/Next and TOC listing is a setting that can be turned on or off.'),
(8, 1, 'My Link', 'This is a single page link that will be shown in the Sidebox.<br /><br />\r\n\r\nThere are no additional pages or links associated with this page as there is no Chapter.<br /><br />\r\n\r\nLater, if you want to expand on this link you can add a Chapter and TOC settings and build a group.<br /><br />\r\n\r\nNotice that the Previous/Next and TOC automatically disable when there isn''t a Chapter. Even with a Chapter, there must be more than one (1) related link or page in the group before these will display.'),
(9, 1, 'Anything', 'The title or link names can be anything that you would like to use.<br /><br />\r\n\r\nYou decide on the content and the link name relative to that content.<br /><br />\r\n\r\nThen, define where you want the link to show: Header, Footer or Sidebox or as a combination of these three locations.<br /><br />\r\n\r\nThe content of the page can be anything you like. Be sure that your content is valid in regard to table and stylesheet rules.<br /><br />\r\n\r\nYou can even set up the links to go to Secure or Non-Secure pages as well as open in the same or a new window.<br /><br />\r\n\r\nLinks can also be setup to use internal or external links vs the HTML Content. See: examples below in the Link URL settings.'),
(10, 1, 'Shared', 'This link is a "shared" link between the Header, Footer and Sidebox.<br/><br/>The number on the order was set to 50 on all of the settings just for the sake of an easier notation on entering it.<br/><br/>The order can be the same or different for the three locations.<br/>If you wanted to really get creative, you could also have this as part of a Chapter not related to the link order.'),
(11, 1, 'My Account', ''),
(12, 1, 'Site Map', ''),
(13, 1, 'Zen Cart', ''),
(14, 1, 'Gift Certificates', ''),
(15, 1, 'Action DVDs', ''),
(16, 1, 'Google', ''),
(17, 1, 'What are EZ-Pages?', '<span style="font-weight: bold; color: rgb(255, 0, 0);">Summary</span><br /><br /><span style="font-weight: bold;">EZ-Pages</span> is a fast, easy way of creating links and additional pages.<br /><br />The additional Pages can be for:<br /><ul><li>New Pages</li><li>Internal Links</li><li>External Links</li><li>Secure or Non-Secure pages</li><li>Same or New Window</li></ul>In Addition, there is the ability to create &quot;related&quot; links in the format of a Chapter (group) and its TOC (related pages/links).<br /><br /><span style="font-weight: bold; color: rgb(255, 0, 0);">Link Naming</span><br /><br />Links are named by the Page Title. All Links need a Page Title in order to function.<br /><br />If you forget to add a Page Title, then you will not be able to add the Link.<br /><br />If you do not assign an Order for the Header, Sidebox or Footer, then the Link will not display even if you have a Page Title.<br /><br /><span style="font-weight: bold;"><span style="color: rgb(255, 0, 0);">Link Placement</span><br /><br /></span>While you have the option of adding Additional Links to the Header, Footer and Sidebox with EZ-Pages, you are not limited to these three Link locations. Links can be in one or more locations simply by enabling the Order for the Location(s) where the Link should appear..<br /><br />The Link Location Status for the Header, Footer and Sidebox is controlled simply by setting these to Yes or No for each setting. Then, set the Order in which the Link should appear for each location.<br /><br />This means that if you were to set Header to Yes 30 and Sidebox to Yes 50 then the link would appear in both the Header and Sidebox in the Order of your Links.<br /><br />The Order numbering method is up to you. Numbering using 10, 20, 30, etc. will allow you to sort the Links and add additional Links later.<br /><br />Note: a 0 value for the Order will disable the Link from displaying.<br /><br /><span style="font-weight: bold;"><span style="color: rgb(255, 0, 0);">Open in New Window and Secure Pages</span><br /></span><br />With EZ-Pages, each Link can take you to the same, main window for your shop; or, you can have the Link open a brand new New Window. In addition, there is an option for making the Link open as a Secure Page or a Non-Secure Page.<br /><br /><span style="font-weight: bold; color: rgb(255, 0, 0);">Chapter and TOC</span><br style="font-weight: bold; color: rgb(255, 0, 0);" /><br />The Chapter and TOC, or Table of Contents, are a unique method of building Multiple Links that interact together.<br /><br />While these Links still follow the rules of the Header, Footer and Sidebox placement, the difference is that only one of the Links, the Main Link, needs to be displayed anywhere on the site.<br /><br />If you had, for example, 5 related Links, you could add the first Link as the Main Link by setting its location to the Header, Footer or Sidebox and set its Order, as usual.<br /><br />Next, you need to assign a Chapter or Group number to the Link. This Chapter holds the related Links together.<br /><br />Then, set the TOC or Table of Contents setting. This is a secondary Sort Order for within the Chapter.<br /><br />Again, you can display any of the Links within a Chapter, as well as making any of these Links the Main Link. Whether the Links all show, or just one or more of the Links show, the Chapter is the key to grouping these Links together in the TOC or Previous/Next. <br /><br /><span style="font-weight: bold; font-style: italic;">NOTE: While all Links within a Chapter will display together, you can have the different Links display in the Header, Footer or Sidebox on their own. Or, you can have the additional Links only display when the Main Link or one of the Additional Links within the Chapter has been opened.</span><br style="font-weight: bold; font-style: italic;" /><br />The versitility of EZ-Pages will make adding new Links and Pages extreamly easy for the beginner as well as the advance user.<br /><br />NOTE: Browser-based HTML editors will sometimes add the opening and closing tags for the &lt;html&gt;, &lt;head&gt; and &lt;body&gt; to the file you are working on.<br /><br />These are already added to the pages via EZ-Pages.<br /><br /><span style="color: rgb(255, 0, 0); font-weight: bold;">External Link URL</span><br /><br />External Link URLs are links to outside pages not within your shop. These can be to any valid URL such as:<br /><br />http://www.sashbox.net<br /><br />You need to include the full URL path to any External Link URL. You may also mark these to open in a New Window or the Same Window.<br /><br /><span style="color: rgb(255, 0, 0); font-weight: bold;">Internal Link URL</span><br /><br />Internal Link URLs are links to internal pages within your shop. These can be to any valid URL, but should be written as relative links such as:<br /><br />index.php?main_page=index&amp;cPath=21<br /><br />The above Link would take you to the Category for categories_id 21<br /><br />While these links can be the Full URL to an Internal Link, it is best to write as a Relative Link so that if you change domains, are work on a temporary domain or an IP Address, the Link will remain valid if moved to another domain, IP Address, etc.<br /><br />Internal Links can also open in a New Window or the Same Window or be for Secure or Non-Secure Pages.<br /><br /><span style="font-weight: bold; color: rgb(255, 0, 0);">EZ-Pages Additional Pages vs Internal Links vs External Links</span><br /><br />The Type of Link that you create is based on an order of precidence, where HTML Content will superceed both the Internal Link and the External Link values.<br /><br />The External Link URL will superceed the Internal Link URL.<br /><br />If you try to set a combination of HTML Content, Internal Link and/or External Link, the Link will be flagged in the listing with a read icon to alert you to your mistake.<br /><br /><span style="font-weight: bold; color: rgb(255, 0, 0);">WARNING ...</span><br /><br />When using Editors such as TinyMCE or CKEditor, if you press enter in the HTML Content area <br /> will be added. These will be detected as &quot;content&quot; and will override any Internal Link URL or External Link URL.<br /><br /><span style="font-weight: bold; color: rgb(255, 0, 0);">Admin Only Display</span><br /><br />Sometimes, when working on EZ-Pages, you will want to be able to work on a Live Site and see the results of your work, but not allow the Customers to see this until you are done.<br /><br />There are 3 settings in the Configuration ... EZ-Pages Settings for the Header, Footer and Sidebox  Status:<br /><ul><li>OFF</li><li>ON</li><li>Admin Only</li></ul>The Admin Only setting is controlled by the IP Address(es) set in the Website Maintenance.<br /><br />This can be very handy when needing to work on a Live Site but not wanting customers to see the work in progress.<br /><br />'),
(18, 1, 'Info Page', ''),
(19, 1, 'Contact Us', ''),
(20, 1, 'Discount Coupons', ''),
(21, 1, 'Newsletter Unsubscribe', ''),
(22, 1, 'Gift Certificate FAQ', ''),
(5, 43, 'EZ Pages', 'Dies ist die Hauptseite, die unter dem Link EZ Pages im Header aufgelistet ist.<br /><br />\r\n\r\n<strong>See: Was sind EZ Pages? Link zur Verwendung von EZ Pages</strong><br /><br />\r\n\r\nDieser Link könnte in der Kopfzeile, Fußzeile oder Sidebox oder einer Kombination aus allen drei Positionen angezeigt werden.<br /><br />\r\n\r\nDie Kapitel und Inhaltsverzeichnis (TOC) Einstellungen sind dazu da, diese Seite in Kombination mit anderen Seiten zu verwenden.<br /><br />\r\n\r\nDie anderen Seiten können entweder *nur* mit diesem Link in Kapitel und Inhaltsverzeichnis gezeigt werden oder mit ihrem eigenen Link in Kopfzeile, Fußzeile oder Sidebox. Je nachdem wie Sie es eben haben wollen.<br /><br />\r\n\r\nEs gibt keinen echten "Master"-Link, außer den Links, die Sie tatsächlich für die Anzeige konfiguriert haben. Aber jeder Link in einem Kapitel kann an einer der 3 Stellen für die Kopfzeile, Fußzeile oder Sidebox oder gar nicht angezeigt werden, wo er dann nur zusammen mit den anderen Links im Kapitel erscheint.'),
(6, 43, 'Eine neue Seite', 'Dies ist eine weitere Seite, die über die verwendete Kapitelnummer mit dem Kapitel 10 verknüpft ist und nach der Inhaltsverzeichnis-Reihenfolge sortiert ist.<br /><br />\r\n\r\nThere is not a link to this page via the Header, Footer nor the Sidebox.<br /><br />\r\n\r\nDiese Seite ist nur sichtbar, wenn der Hauptlink ausgewählt ist und wird dann im Inhaltverzeichnis angezeigt.<br /><br />\r\n\r\nDies ist ein praktischer Weg, um zahlreiche Links zu haben, die verwandt sind, aber nur einen Hauptlink anzuzeigen, um zu ihnen allen zu gelangen.<br /><br />'),
(7, 43, 'Noch eine neue Seite', 'Dies ist noch eine weitere neue Seite oder ein neuer Link, der Teil von Kapitel 10 ist.<br /><br />\r\n\r\nTDie Nummerierung der Kapitel kann beliebig erfolgen. Aber nach Anzahl in Schritten wie 10, 20, 30 usw. können Sie später Seiten oder Links einfügen, wie es innerhalb der bestehenden Seiten erforderlich ist. <br /><br /><br />\r\n\r\r\n\nEs gibt keine Begrenzung der Anzahl von Seiten oder Links mit Hilfe des Kapitels.<br /><br /<br />\r\n\r\r\n\n Die Anzeige des vorherigen/nächsten und Inhaltsverzeichnis-Listen ist eine Einstellung, die ein- oder ausgeschaltet werden kann.'),
(8, 43, 'Ein Link', 'Dies ist ein einfacher Link, der in der Sidebox angezeigt wird.<br /><br />\r\n\r\nEs gibt keine zusätzlichen Seiten oder Links, die mit dieser Seite verbunden sind, da es kein Kapitel gibt.<br /><br />\r\n\r\nWenn Sie diesen Link später erweitern möchten, können Sie ein Kapitel und Inhaltsverzeichnis-Einstellungen hinzufügen und eine Gruppe bilden.<br /><br />\r\n\r\nBeachten Sie, dass die Vorherige/Nächste und die TOC Navigation automatisch deaktiviert werden, wenn es kein Kapitel gibt. Selbst mit einem Kapitel muss es mehr als einen (1) verwandten Link oder eine Seite in der Gruppe geben, bevor diese angezeigt werden.'),
(9, 43, 'Irgendetwas', 'Der Titel oder die Linknamen können alles sein, was Sie verwenden möchten.<br /><br />\r\n\r\nSie entscheiden über den Inhalt und den Linknamen in Bezug auf diesen Inhalt.<br /><br />\r\n\r\nDefinieren Sie dann, wo der Link angezeigt werden soll: Kopfzeile, Fußzeile oder Sidebox oder als Kombination dieser drei Positionen.<br /><br /><br />\r\n\r\r\n\nDer Inhalt der Seite kann beliebig sein. Stellen Sie sicher, dass Ihr Inhalt in Bezug auf Tabellen- und Stylesheet-Regeln gültig ist.<br /><br /><br />\r\n\r\n\n\nSie können sogar die Links einrichten, um zu sicheren oder nicht sicheren Seiten zu gelangen und sie im gleichen oder einem neuen Fenster zu öffnen.<br /><br /><br />\r\n\r\n\nLinks können auch eingerichtet werden, um interne oder externe Links gegenüber dem HTML-Inhalt zu verwenden. Siehe: Beispiele unten in den Einstellungen der Link URL.'),
(10, 43, 'Verteilt', 'Dieser Link ist ein "geteilter" Link zwischen Kopfzeile, Fußzeile und Sidebox.<br/><br/>Die Sortierreihenfolge wurde bei allen Einstellungen auf 50 gesetzt, nur um die Eingabe zu erleichtern.<br/><br/>Die Reihenfolge kann für die drei Positionen gleich oder unterschiedlich sein.<br/><br/>Wenn Sie wirklich kreativ werden wollen, können Sie dies auch als Teil eines Kapitels ohne Bezug zur Linkreihenfolge haben.'),
(11, 43, 'Mein Konto', ''),
(12, 43, 'Site Map', ''),
(13, 43, 'Zen Cart', ''),
(14, 43, 'Geschenkgutscheine', ''),
(15, 43, 'Action DVDs', ''),
(16, 43, 'Google', ''),
(17, 43, 'Was sind EZ-Pages?', '<span style="font-weight: bold; color: rgb(255, 0, 0);">Summary</span><br /><br /><span style="font-weight: bold;">EZ-Pages</span> is a fast, easy way of creating links and additional pages.<br /><br />The additional Pages can be for:<br /><ul><li>New Pages</li><li>Internal Links</li><li>External Links</li><li>Secure or Non-Secure pages</li><li>Same or New Window</li></ul>In Addition, there is the ability to create &quot;related&quot; links in the format of a Chapter (group) and its TOC (related pages/links).<br /><br /><span style="font-weight: bold; color: rgb(255, 0, 0);">Link Naming</span><br /><br />Links are named by the Page Title. All Links need a Page Title in order to function.<br /><br />If you forget to add a Page Title, then you will not be able to add the Link.<br /><br />If you do not assign an Order for the Header, Sidebox or Footer, then the Link will not display even if you have a Page Title.<br /><br /><span style="font-weight: bold;"><span style="color: rgb(255, 0, 0);">Link Placement</span><br /><br /></span>While you have the option of adding Additional Links to the Header, Footer and Sidebox with EZ-Pages, you are not limited to these three Link locations. Links can be in one or more locations simply by enabling the Order for the Location(s) where the Link should appear..<br /><br />The Link Location Status for the Header, Footer and Sidebox is controlled simply by setting these to Yes or No for each setting. Then, set the Order in which the Link should appear for each location.<br /><br />This means that if you were to set Header to Yes 30 and Sidebox to Yes 50 then the link would appear in both the Header and Sidebox in the Order of your Links.<br /><br />The Order numbering method is up to you. Numbering using 10, 20, 30, etc. will allow you to sort the Links and add additional Links later.<br /><br />Note: a 0 value for the Order will disable the Link from displaying.<br /><br /><span style="font-weight: bold;"><span style="color: rgb(255, 0, 0);">Open in New Window and Secure Pages</span><br /></span><br />With EZ-Pages, each Link can take you to the same, main window for your shop; or, you can have the Link open a brand new New Window. In addition, there is an option for making the Link open as a Secure Page or a Non-Secure Page.<br /><br /><span style="font-weight: bold; color: rgb(255, 0, 0);">Chapter and TOC</span><br style="font-weight: bold; color: rgb(255, 0, 0);" /><br />The Chapter and TOC, or Table of Contents, are a unique method of building Multiple Links that interact together.<br /><br />While these Links still follow the rules of the Header, Footer and Sidebox placement, the difference is that only one of the Links, the Main Link, needs to be displayed anywhere on the site.<br /><br />If you had, for example, 5 related Links, you could add the first Link as the Main Link by setting its location to the Header, Footer or Sidebox and set its Order, as usual.<br /><br />Next, you need to assign a Chapter or Group number to the Link. This Chapter holds the related Links together.<br /><br />Then, set the TOC or Table of Contents setting. This is a secondary Sort Order for within the Chapter.<br /><br />Again, you can display any of the Links within a Chapter, as well as making any of these Links the Main Link. Whether the Links all show, or just one or more of the Links show, the Chapter is the key to grouping these Links together in the TOC or Previous/Next. <br /><br /><span style="font-weight: bold; font-style: italic;">NOTE: While all Links within a Chapter will display together, you can have the different Links display in the Header, Footer or Sidebox on their own. Or, you can have the additional Links only display when the Main Link or one of the Additional Links within the Chapter has been opened.</span><br style="font-weight: bold; font-style: italic;" /><br />The versitility of EZ-Pages will make adding new Links and Pages extreamly easy for the beginner as well as the advance user.<br /><br />NOTE: Browser-based HTML editors will sometimes add the opening and closing tags for the &lt;html&gt;, &lt;head&gt; and &lt;body&gt; to the file you are working on.<br /><br />These are already added to the pages via EZ-Pages.<br /><br /><span style="color: rgb(255, 0, 0); font-weight: bold;">External Link URL</span><br /><br />External Link URLs are links to outside pages not within your shop. These can be to any valid URL such as:<br /><br />http://www.sashbox.net<br /><br />You need to include the full URL path to any External Link URL. You may also mark these to open in a New Window or the Same Window.<br /><br /><span style="color: rgb(255, 0, 0); font-weight: bold;">Internal Link URL</span><br /><br />Internal Link URLs are links to internal pages within your shop. These can be to any valid URL, but should be written as relative links such as:<br /><br />index.php?main_page=index&amp;cPath=21<br /><br />The above Link would take you to the Category for categories_id 21<br /><br />While these links can be the Full URL to an Internal Link, it is best to write as a Relative Link so that if you change domains, are work on a temporary domain or an IP Address, the Link will remain valid if moved to another domain, IP Address, etc.<br /><br />Internal Links can also open in a New Window or the Same Window or be for Secure or Non-Secure Pages.<br /><br /><span style="font-weight: bold; color: rgb(255, 0, 0);">EZ-Pages Additional Pages vs Internal Links vs External Links</span><br /><br />The Type of Link that you create is based on an order of precidence, where HTML Content will superceed both the Internal Link and the External Link values.<br /><br />The External Link URL will superceed the Internal Link URL.<br /><br />If you try to set a combination of HTML Content, Internal Link and/or External Link, the Link will be flagged in the listing with a read icon to alert you to your mistake.<br /><br /><span style="font-weight: bold; color: rgb(255, 0, 0);">WARNING ...</span><br /><br />When using Editors such as TinyMCE or CKEditor, if you press enter in the HTML Content area <br /> will be added. These will be detected as &quot;content&quot; and will override any Internal Link URL or External Link URL.<br /><br /><span style="font-weight: bold; color: rgb(255, 0, 0);">Admin Only Display</span><br /><br />Sometimes, when working on EZ-Pages, you will want to be able to work on a Live Site and see the results of your work, but not allow the Customers to see this until you are done.<br /><br />There are 3 settings in the Configuration ... EZ-Pages Settings for the Header, Footer and Sidebox  Status:<br /><ul><li>OFF</li><li>ON</li><li>Admin Only</li></ul>The Admin Only setting is controlled by the IP Address(es) set in the Website Maintenance.<br /><br />This can be very handy when needing to work on a Live Site but not wanting customers to see the work in progress.<br /><br />'),
(18, 43, 'Informationsseite', ''),
(19, 43, 'Kontakt', ''),
(20, 43, 'Aktionskupons', ''),
(21, 43, 'Newsletter abbestellen', ''),
(22, 43, 'Geschenkgutschein FAQ', '');
#
# Dumping data for table `featured`
#

INSERT INTO featured (featured_id, products_id, featured_date_added, featured_last_modified, expires_date, date_status_change, status, featured_date_available) VALUES 
(1, 34, '2019-06-18 16:34:31', '2019-06-18 16:34:31', '0001-01-01', '2019-06-18 16:34:31', 1, '0001-01-01'),
(2, 8, '2019-06-18 17:04:54', '2019-06-18 22:31:52', '2019-06-18', '2019-06-18 22:50:50', 0, '2019-06-18'),
(3, 12, '2019-06-18 17:10:49', '2019-06-18 17:10:49', '0001-01-01', '2019-06-18 17:10:49', 1, '0001-01-01'),
(4, 27, '2019-06-18 22:30:53', NULL, '0001-01-01', NULL, 1, '0001-01-01'),
(5, 26, '2019-06-18 22:31:24', NULL, '0001-01-01', NULL, 1, '0001-01-01'),
(6, 40, '2019-06-18 22:50:33', NULL, '0001-01-01', NULL, 1, '0001-01-01'),
(7, 171, '2019-06-18 15:47:22', NULL, '0001-01-01', NULL, 1, '0001-01-01'),
(8, 172, '2019-06-18 15:47:29', NULL, '0001-01-01', NULL, 1, '0001-01-01'),
(9, 168, '2019-06-18 15:47:37', NULL, '0001-01-01', NULL, 1, '0001-01-01'),
(10, 169, '2019-06-18 15:47:45', NULL, '0001-01-01', NULL, 1, '0001-01-01');

#
# Dumping data for table `group_pricing`
#

INSERT INTO group_pricing (group_id, group_name, group_percentage, last_modified, date_added) VALUES
(1, 'Gruppe 10', '10.00', NULL, '2019-06-18 00:21:04');

#
# Dumping data for table `manufacturers`
#

INSERT INTO manufacturers (manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified) VALUES (1, 'Matrox', 'manufacturers/manufacturer_matrox.gif', '2019-06-18 03:18:19', NULL),
(2, 'Microsoft', 'manufacturers/manufacturer_microsoft.gif', '2019-06-18 03:18:19', NULL),
(3, 'Warner', 'manufacturers/manufacturer_warner.gif', '2019-06-18 03:18:19', NULL),
(4, 'Fox', 'manufacturers/manufacturer_fox.gif', '2019-06-18 03:18:19', NULL),
(5, 'Logitech', 'manufacturers/manufacturer_logitech.gif', '2019-06-18 03:18:19', NULL),
(6, 'Canon', 'manufacturers/manufacturer_canon.gif', '2019-06-18 03:18:19', NULL),
(7, 'Sierra', 'manufacturers/manufacturer_sierra.gif', '2019-06-18 03:18:19', NULL),
(8, 'GT Interactive', 'manufacturers/manufacturer_gt_interactive.gif', '2019-06-18 03:18:19', NULL),
(9, 'Hewlett Packard', 'manufacturers/manufacturer_hewlett_packard.gif', '2019-06-18 03:18:19', NULL);

#
# Dumping data for table `manufacturers_info`
#

INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (1, 1, 'http://www.matrox.com', 0, NULL),
(2, 1, 'http://www.microsoft.com', 0, NULL),
(3, 1, 'http://www.warner.com', 0, NULL),
(4, 1, 'http://www.fox.com', 0, NULL),
(5, 1, 'http://www.logitech.com', 0, NULL),
(6, 1, 'http://www.canon.com', 0, NULL),
(7, 1, 'http://www.sierra.com', 0, NULL),
(8, 1, 'http://www.infogrames.com', 0, NULL),
(9, 1, 'http://www.hewlettpackard.com', 0, NULL);

#
# Dumping data for table `media_clips`
#

INSERT INTO media_clips (clip_id, media_id, clip_type, clip_filename, date_added, last_modified) VALUES (1, 1, 1, 'thehunter.mp3', '2019-06-18 20:57:43', '2019-06-18 20:57:43'),
(6, 2, 1, 'thehunter.mp3', '2019-06-18 00:45:09', '2019-06-18 00:45:09');

#
# Dumping data for table `media_manager`
#

INSERT INTO media_manager (media_id, media_name, last_modified, date_added) VALUES (1, 'Russ Tippins - The Hunter', '2019-06-18 20:57:43', '2019-06-18 20:42:53'),
(2, 'Help!', '2019-06-18 01:01:14', '2019-06-18 17:57:45');

#
# Dumping data for table `media_to_products`
#

INSERT INTO media_to_products (media_id, product_id) VALUES (1, 166),
(2, 169);

#
# Dumping data for table `media_types`
#

#INSERT INTO media_types (type_id, type_name, type_ext) VALUES (1, 'MP3', '.mp3');

#
# Dumping data for table `music_genre`
#

INSERT INTO music_genre (music_genre_id, music_genre_name, date_added, last_modified) VALUES (1, 'Rock', '2019-06-18 20:53:26', NULL),
(2, 'Jazz', '2019-06-18 20:53:45', NULL);

#
# Dumping data for table `product_music_extra`
#

INSERT INTO product_music_extra (products_id, artists_id, record_company_id, music_genre_id) VALUES (166, 1, 0, 1),
(169, 1, 1, 2);

#
# Dumping data for table `product_types_to_category`
#

INSERT INTO product_types_to_category (product_type_id, category_id) VALUES (3, 63),
(4, 63), (2, 62);

#
# Dumping data for table `products`
#

INSERT INTO products (products_id, products_type, products_quantity, products_model, products_image, products_price, products_virtual, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered, products_quantity_order_min, products_quantity_order_units, products_priced_by_attribute, product_is_free, product_is_call, products_quantity_mixed, product_is_always_free_shipping, products_qty_box_status, products_quantity_order_max, products_sort_order, products_discount_type, products_discount_type_from, products_price_sorter, master_categories_id, products_mixed_discount_quantity) VALUES 
(1, 1, '31', 'MG200MMS', 'matrox/mg200mms.gif', '299.9900', 0, '2019-06-18 12:32:17', '2019-06-18 23:57:34', NULL, '23.00', 1, 1, 1, '1', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '299.9900', 4, 1),
(2, 1, '31', 'MG400-32MB', 'matrox/mg400-32mb.gif', '499.9900', 0, '2019-06-18 12:32:17', NULL, NULL, '23.00', 1, 1, 1, '1', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '499.9900', 4, 1),
(3, 1, '500', 'MSIMPRO', 'microsoft/msimpro.gif', '49.9900', 0, '2019-06-18 12:32:17', NULL, NULL, '7.00', 1, 1, 2, '1', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '39.9900', 9, 1),
(4, 1, '12', 'DVD-RPMK', 'dvd/replacement_killers.gif', '42.0000', 0, '2019-06-18 12:32:17', NULL, NULL, '23.00', 1, 1, 3, '1', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '42.0000', 10, 1),
(5, 1, '15', 'DVD-BLDRNDC', 'dvd/blade_runner.gif', '35.9900', 0, '2019-06-18 12:32:17', '2019-06-18 00:44:28', NULL, '7.00', 1, 1, 3, '2', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '30.0000', 11, 1),
(6, 1, '8', 'DVD-MATR', 'dvd/the_matrix.gif', '39.9900', 0, '2019-06-18 12:32:17', '2019-06-18 00:48:28', NULL, '7.00', 1, 1, 3, '2', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '30.0000', 10, 1),
(7, 1, '500', 'DVD-YGEM', 'dvd/youve_got_mail.gif', '34.9900', 0, '2019-06-18 12:32:17', '2019-06-18 14:53:17', NULL, '7.00', 1, 1, 3, '5', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '34.9900', 12, 1),
(8, 1, '499', 'DVD-ABUG', 'dvd/a_bugs_life.gif', '35.9900', 0, '2019-06-18 12:32:17', '2019-06-18 14:52:54', NULL, '7.00', 1, 1, 3, '6', '1', '1', 0, 0, 0, 0, 0, 1, '0', 10, 1, 1, '35.9900', 13, 1),
(9, 1, '10', 'DVD-UNSG', 'dvd/under_siege.gif', '29.9900', 0, '2019-06-18 12:32:17', '2019-06-18 13:35:27', NULL, '7.00', 1, 1, 3, '0', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '29.9900', 10, 1),
(10, 1, '9', 'DVD-UNSG2', 'dvd/under_siege2.gif', '29.9900', 0, '2019-06-18 12:32:17', NULL, NULL, '7.00', 1, 1, 3, '1', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '29.9900', 10, 1),
(11, 1, '10', 'DVD-FDBL', 'dvd/fire_down_below.gif', '29.9900', 0, '2019-06-18 12:32:17', '2019-06-18 00:43:40', NULL, '7.00', 1, 1, 3, '0', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '29.9900', 10, 1),
(12, 1, '9', 'DVD-DHWV', 'dvd/die_hard_3.gif', '39.9900', 0, '2019-06-18 12:32:17', '2019-06-18 00:34:33', NULL, '7.00', 1, 1, 4, '6', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '39.9900', 10, 1),
(13, 1, '10', 'DVD-LTWP', 'dvd/lethal_weapon.gif', '34.9900', 0, '2019-06-18 12:32:17', '2019-06-18 00:07:35', NULL, '7.00', 1, 1, 3, '0', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '34.9900', 10, 1),
(14, 1, '9', 'DVD-REDC', 'dvd/red_corner.gif', '32.0000', 0, '2019-06-18 12:32:17', '2019-06-18 00:47:39', NULL, '7.00', 1, 1, 3, '1', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '32.0000', 15, 1),
(15, 1, '9', 'DVD-FRAN', 'dvd/frantic.gif', '35.0000', 0, '2019-06-18 12:32:17', '2019-06-18 00:43:55', NULL, '7.00', 1, 1, 3, '1', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '35.0000', 14, 1),
(16, 1, '9', 'DVD-CUFI', 'dvd/courage_under_fire.gif', '38.9900', 0, '2019-06-18 12:32:17', '2019-06-18 00:42:57', '2007-02-21 00:00:00', '7.00', 1, 1, 4, '1', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '29.9900', 15, 1),
(17, 1, '10', 'DVD-SPEED', 'dvd/speed.gif', '39.9900', 0, '2019-06-18 12:32:17', '2019-06-18 00:47:51', NULL, '7.00', 1, 1, 4, '0', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '39.9900', 10, 1),
(18, 1, '10', 'DVD-SPEED2', 'dvd/speed_2.gif', '42.0000', 0, '2019-06-18 12:32:17', NULL, NULL, '7.00', 1, 1, 4, '0', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '42.0000', 10, 1),
(19, 1, '10', 'DVD-TSAB', 'dvd/theres_something_about_mary.gif', '49.9900', 0, '2019-06-18 12:32:17', '2019-06-18 00:49:00', NULL, '7.00', 1, 1, 4, '0', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '49.9900', 12, 1),
(20, 1, '8', 'DVD-BELOVED', 'dvd/beloved.gif', '54.9900', 0, '2019-06-18 12:32:17', '2019-06-18 00:42:34', NULL, '7.00', 1, 1, 3, '2', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '54.9900', 15, 1),
(21, 1, '16', 'PC-SWAT3', 'sierra/swat_3.gif', '79.9900', 0, '2019-06-18 12:32:17', '2019-06-18 14:51:00', NULL, '7.00', 1, 1, 7, '0', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '79.9900', 18, 1),
(22, 1, '13', 'PC-UNTM', 'gt_interactive/unreal_tournament.gif', '89.9900', 0, '2019-06-18 12:32:17', '2019-06-18 00:49:29', NULL, '7.00', 1, 1, 8, '9', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '89.9900', 19, 1),
(23, 1, '16', 'PC-TWOF', 'gt_interactive/wheel_of_time.gif', '99.9900', 0, '2019-06-18 12:32:17', '2019-06-18 00:48:50', NULL, '10.00', 1, 1, 8, '0', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '99.9900', 20, 1),
(24, 1, '16', 'PC-DISC', 'gt_interactive/disciples.gif', '90.0000', 0, '2019-06-18 12:32:17', '2019-06-18 00:43:24', NULL, '8.00', 1, 1, 8, '1', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '90.0000', 20, 1),
(25, 1, '16', 'MSINTKB', 'microsoft/intkeyboardps2.gif', '69.9900', 0, '2019-06-18 12:32:17', '2019-06-18 03:02:41', NULL, '8.00', 1, 1, 2, '0', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '69.9900', 8, 1),
(26, 1, '9', 'MSIMEXP', 'microsoft/imexplorer.gif', '64.9500', 0, '2019-06-18 12:32:17', '2019-06-18 01:47:47', NULL, '8.00', 1, 1, 2, '17', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '64.9500', 9, 1),
(27, 1, '7', 'HPLJ1100XI', 'hewlett_packard/lj1100xi.gif', '499.9900', 0, '2019-06-18 12:32:17', '2019-06-18 00:45:03', NULL, '45.00', 1, 1, 9, '1', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '499.9900', 5, 1),
(28, 1, '999', 'GIFT005', 'gift_certificates/gv_5.gif', '5.0000', 1, '2019-06-18 12:32:17', '2019-06-18 02:57:18', NULL, '0.00', 1, 0, 0, '1', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '5.0000', 21, 1),
(29, 1, '985', 'GIFT 010', 'gift_certificates/gv_10.gif', '10.0000', 1, '2019-06-18 12:32:17', '2019-06-18 14:51:36', NULL, '0.00', 1, 0, 0, '15', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '10.0000', 21, 1),
(30, 1, '992', 'GIFT025', 'gift_certificates/gv_25.gif', '25.0000', 1, '2019-06-18 12:32:17', NULL, NULL, '0.00', 1, 0, 0, '8', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '25.0000', 21, 1),
(31, 1, '997', 'GIFT050', 'gift_certificates/gv_50.gif', '50.0000', 1, '2019-06-18 12:32:17', NULL, NULL, '0.00', 1, 0, 0, '4', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '50.0000', 21, 1),
(32, 1, '995', 'GIFT100', 'gift_certificates/gv_100.gif', '100.0000', 1, '2019-06-18 12:32:17', NULL, NULL, '0.00', 1, 0, 0, '5', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '100.0000', 21, 1),
(34, 1, '796', 'DVD-ABUG', 'dvd/a_bugs_life.gif', '35.9900', 0, '2019-06-18 22:03:45', '2019-06-18 14:16:01', '2005-02-21 00:00:00', '7.00', 1, 1, 3, '5', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '35.9900', 22, 1),
(36, 1, '700', 'HPLJ1100XI', 'hewlett_packard/lj1100xi.gif', '0.0000', 0, '2019-06-18 14:29:11', '2019-06-18 01:51:12', NULL, '45.00', 1, 1, 9, '0', '1', '1', 1, 0, 0, 0, 0, 1, '0', 0, 0, 0, '449.1000', 25, 1),
(100, 1, '700', 'HPLJ1100XI', 'hewlett_packard/lj1100xi.gif', '0.0000', 0, '2019-06-18 14:06:13', '2019-06-18 14:06:50', NULL, '45.00', 1, 1, 9, '0', '1', '1', 1, 0, 0, 0, 0, 1, '0', 0, 0, 0, '336.8250', 25, 1),
(39, 1, '997', 'TESTFREE', 'free.gif', '100.0000', 0, '2019-06-18 16:33:13', '2019-06-18 02:29:16', NULL, '1.00', 1, 1, 0, '3', '1', '1', 0, 1, 0, 1, 0, 1, '0', 0, 0, 0, '0.0000', 24, 1),
(40, 1, '999', 'TESTCALL', 'call_for_price.jpg', '100.0000', 0, '2019-06-18 17:42:15', '2019-06-18 13:08:08', '2007-02-21 00:00:00', '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 1, 1, 0, 1, '0', 0, 0, 0, '100.0000', 24, 1),
(41, 1, '999', 'TESTCALL', 'call_for_price.jpg', '100.0000', 0, '2019-06-18 19:13:35', '2004-09-27 13:33:33', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 1, 1, 0, 1, '0', 0, 0, 0, '81.0000', 28, 0),
(42, 1, '998', 'TESTFREE', 'free.gif', '100.0000', 0, '2019-06-18 19:14:16', '2019-06-18 19:15:00', NULL, '1.00', 1, 1, 0, '1', '1', '1', 0, 1, 0, 1, 0, 1, '0', 0, 0, 0, '0.0000', 28, 1),
(43, 1, '999', 'TESTFREEATTRIB', 'free.gif', '100.0000', 0, '2019-06-18 20:44:06', '2019-06-18 16:23:29', NULL, '0.00', 1, 1, 0, '0', '1', '1', 0, 1, 0, 1, 0, 1, '0', 0, 0, 0, '0.0000', 24, 1),
(44, 1, '999', 'TESTMINUNITSNOMIX', 'sample_image.gif', '100.0000', 0, '2019-06-18 21:38:59', '2015-05-22 13:15:41', NULL, '1.00', 1, 1, 0, '0', '4', '2', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '90.0000', 22, 1),
(46, 1, '981', 'TESTMINUNITSMIX', 'sample_image.gif', '100.0000', 0, '2019-06-18 21:53:07', '2019-06-18 02:00:50', NULL, '1.00', 1, 1, 0, '18', '4', '2', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '90.0000', 22, 1),
(47, 1, '9996', 'GIFT', 'gift_certificates/gv.gif', '0.0000', 1, '2019-06-18 22:56:57', '2004-09-29 20:11:51', NULL, '0.00', 1, 0, 0, '4', '1', '1', 1, 0, 0, 1, 0, 1, '0', 0, 0, 0, '5.0000', 21, 1),
(48, 1, '9990', 'TEST1', '1_small.jpg', '39.0000', 0, '2019-06-18 02:27:47', '2019-06-18 02:56:37', NULL, '1.00', 1, 1, 0, '10', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '39.0000', 23, 1),
(49, 1, '900', 'TEST2', '2_small.jpg', '20.0000', 0, '2019-06-18 02:28:42', '2019-06-18 23:00:27', NULL, '0.50', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '20.0000', 23, 1),
(50, 1, '1000', 'TEST3', '3_small.jpg', '75.0000', 0, '2019-06-18 02:29:37', '2019-06-18 23:01:04', NULL, '1.50', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '75.0000', 23, 1),
(51, 1, '998', 'Free1', 'b_g_grid.gif', '25.0000', 0, '2019-06-18 11:51:05', '2019-06-18 17:03:32', NULL, '10.00', 1, 1, 0, '2', '1', '1', 0, 1, 0, 1, 1, 1, '0', 0, 0, 0, '0.0000', 24, 1),
(52, 1, '997', 'Free2', 'b_p_grid.gif', '0.0000', 1, '2019-06-18 12:24:58', '2019-06-18 17:01:18', NULL, '2.00', 1, 1, 0, '2', '1', '1', 0, 1, 0, 1, 0, 1, '0', 0, 0, 0, '0.0000', 24, 1),
(53, 1, '991', 'MINUNITSMIX', 'b_c_grid.gif', '25.0000', 0, '2019-06-18 23:26:44', '2019-06-18 02:22:35', NULL, '1.00', 1, 1, 0, '6', '6', '3', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '20.0000', 23, 1),
(54, 1, '991', 'MINUNITSNOMIX', 'waybkgnd.gif', '25.0000', 0, '2019-06-18 23:19:13', '2019-06-18 02:23:08', NULL, '1.00', 1, 1, 0, '0', '6', '3', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '25.0000', 23, 1),
(55, 1, '991', 'MINUNITSMIXSALE', 'b_b_grid.gif', '25.0000', 0, '2019-06-18 11:11:46', '2019-06-18 02:26:28', NULL, '1.00', 1, 1, 0, '0', '6', '3', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '22.5000', 28, 1),
(56, 1, '991', 'MINUNITSNOMIXSALE', 'b_w_grid.gif', '25.0000', 0, '2019-06-18 11:13:08', '2019-06-18 02:26:49', NULL, '1.00', 1, 1, 0, '0', '6', '3', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '22.5000', 28, 1),
(57, 1, '998', 'TESTFREEALL', 'free.gif', '0.0000', 0, '2019-06-18 11:36:09', '2019-06-18 16:55:19', NULL, '1.00', 1, 1, 0, '1', '1', '1', 0, 1, 0, 1, 1, 1, '0', 0, 0, 0, '0.0000', 24, 1),
(59, 1, '700', 'HPLJ1100XI', 'hewlett_packard/lj1100xi.gif', '0.0000', 0, '2019-06-18 14:36:57', '2019-06-18 14:37:05', NULL, '45.00', 1, 1, 9, '0', '1', '1', 1, 0, 0, 0, 0, 1, '0', 0, 0, 0, '300.0000', 23, 1),
(60, 1, '699', 'HPLJ1100XI', 'hewlett_packard/lj1100xi.gif', '499.7500', 0, '2019-06-18 01:34:55', '2019-06-18 01:41:37', NULL, '45.00', 1, 1, 9, '1', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '449.7750', 28, 1),
(61, 1, '699', 'HPLJ1100XI', 'hewlett_packard/lj1100xi.gif', '499.7500', 0, '2019-06-18 01:44:09', '2019-06-18 01:45:45', NULL, '45.00', 1, 1, 9, '1', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 0, 0, '449.7750', 28, 1),
(101, 1, '1000', 'Test120-90off-10', 'test_demo.jpg', '0.0000', 0, '2019-06-18 14:11:32', '2019-06-18 14:17:09', NULL, '1.00', 1, 1, 0, '0', '1', '1', 1, 0, 0, 1, 0, 1, '0', 0, 0, 0, '72.0000', 47, 1),
(109, 1, '1000', 'HIDEQTYBOX', '1_small.jpg', '75.0000', 0, '2019-06-18 22:01:20', '2015-05-22 11:21:12', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '1', 0, 0, 0, '75.0000', 23, 1),
(78, 1, '1000', 'Test25-10AttrAll', 'test_demo.jpg', '0.0000', 0, '2019-06-18 01:09:46', '2019-06-18 01:30:12', NULL, '0.00', 1, 1, 0, '0', '1', '1', 1, 0, 0, 1, 0, 1, '0', 0, 0, 0, '101.2500', 25, 1),
(79, 1, '1000', 'Test25-AttrAll', 'test_demo.jpg', '0.0000', 0, '2019-06-18 01:28:52', '2019-06-18 01:33:55', NULL, '1.00', 1, 1, 0, '0', '1', '1', 1, 0, 0, 1, 0, 1, '0', 0, 0, 0, '150.0000', 23, 1),
(74, 1, '700', 'HPLJ1100XI', 'hewlett_packard/lj1100xi.gif', '0.0000', 0, '2019-06-18 15:34:49', '2019-06-18 15:35:17', NULL, '45.00', 1, 1, 9, '0', '1', '1', 1, 0, 0, 0, 0, 1, '0', 0, 0, 0, '399.2000', 23, 1),
(76, 1, '1000', 'Test25-10', 'test_demo.jpg', '100.0000', 0, '2019-06-18 23:08:33', NULL, NULL, '0.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '67.5000', 28, 1),
(80, 1, '1000', 'Test25', 'test_demo.jpg', '100.0000', 0, '2019-06-18 01:31:06', '2019-06-18 13:35:47', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '100.0000', 23, 1),
(84, 1, '999', 'Test120', 'test_demo.jpg', '120.0000', 0, '2019-06-18 15:05:10', '2019-06-18 15:27:39', NULL, '1.00', 1, 1, 0, '1', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '120.0000', 23, 1),
(82, 1, '1000', 'Test120-5', 'test_demo.jpg', '120.0000', 0, '2019-06-18 14:50:38', '2019-06-18 17:09:03', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '115.0000', 27, 1),
(83, 1, '1000', 'Test120-90-5', 'test_demo.jpg', '120.0000', 0, '2019-06-18 15:01:53', '2019-06-18 10:02:11', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '85.0000', 27, 1),
(85, 1, '1000', 'Test90', 'test_demo.jpg', '120.0000', 0, '2019-06-18 15:19:00', '2019-06-18 10:00:35', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '90.0000', 23, 1),
(88, 1, '1000', 'Test120-90-10-Skip', 'test_demo.jpg', '120.0000', 0, '2019-06-18 00:14:31', '2019-06-18 09:58:08', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '90.0000', 31, 1),
(89, 1, '1000', 'Test120-90-10-Skip', 'test_demo.jpg', '120.0000', 0, '2019-06-18 00:41:40', '2019-06-18 09:57:42', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '108.0000', 31, 1),
(95, 1, '1000', 'Test120-25-New100-Skip', 'test_demo.jpg', '120.0000', 0, '2019-06-18 02:35:44', '2019-06-18 02:37:27', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '90.0000', 51, 1),
(90, 1, '999', 'Test120-90-10', 'test_demo.jpg', '120.0000', 0, '2019-06-18 23:55:18', '2019-06-18 00:08:58', NULL, '1.00', 1, 1, 0, '1', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '81.0000', 45, 1),
(92, 1, '1000', 'Test120-90off-10', 'test_demo.jpg', '120.0000', 0, '2019-06-18 23:58:54', '2019-06-18 00:09:28', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '108.0000', 45, 1),
(93, 1, '1000', 'Test120-New100', 'test_demo.jpg', '120.0000', 0, '2019-06-18 00:02:32', '2019-06-18 00:04:25', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '100.0000', 46, 1),
(94, 1, '1000', 'Test120-25-New100', 'test_demo.jpg', '120.0000', 0, '2019-06-18 00:04:31', '2019-06-18 00:07:08', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '100.0000', 46, 1),
(96, 1, '1000', 'Test120-New100-Off-Skip', 'test_demo.jpg', '120.0000', 0, '2019-06-18 02:36:52', '2019-06-18 02:37:29', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '100.0000', 51, 1),
(97, 1, '1000', 'Test120-90-10-Price', 'test_demo.jpg', '120.0000', 0, '2019-06-18 11:26:34', '2019-06-18 11:27:24', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '108.0000', 32, 1),
(98, 1, '1000', 'Test120-90off-10-Price', 'test_demo.jpg', '120.0000', 0, '2019-06-18 11:28:16', '2019-06-18 11:29:57', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '108.0000', 32, 1),
(99, 1, '997', 'FreeShipping', 'small_00.jpg', '25.0000', 0, '2019-06-18 13:27:30', '2019-06-18 01:48:48', NULL, '5.00', 1, 1, 0, '3', '1', '1', 0, 0, 0, 1, 1, 1, '0', 0, 0, 0, '25.0000', 23, 1),
(104, 1, '1000', 'HIDEQTY', '1_small.jpg', '75.0000', 0, '2019-06-18 03:02:51', '2015-05-22 11:21:36', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 0, '0', 0, 0, 0, '75.0000', 23, 1),
(105, 1, '999', 'MAXSAMPLE-1', 'waybkgnd.gif', '50.0000', 0, '2019-06-18 14:10:59', '2019-06-18 14:36:00', NULL, '1.00', 1, 1, 0, '1', '1', '1', 0, 0, 0, 1, 0, 1, '1', 0, 0, 0, '50.0000', 22, 1),
(106, 1, '1000', 'MAXSAMPLE-3', 'waybkgnd.gif', '50.0000', 0, '2019-06-18 14:36:08', '2019-06-18 15:32:56', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '3', 0, 0, 0, '50.0000', 22, 1),
(107, 1, '995', 'FreeShippingNoWeight', 'small_00.jpg', '25.0000', 0, '2019-06-18 01:41:22', '2019-06-18 02:01:54', NULL, '0.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '25.0000', 23, 1),
(108, 1, '0', 'SoldOut', 'small_00.jpg', '25.0000', 0, '2019-06-18 01:53:20', NULL, NULL, '3.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '25.0000', 23, 1),
(110, 1, '1000', 'Test120-5SKIP', 'test_demo.jpg', '120.0000', 0, '2019-06-18 16:09:52', '2019-06-18 16:15:25', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '115.0000', 52, 1),
(111, 1, '1000', 'Test120-90-5SKIP', 'test_demo.jpg', '120.0000', 0, '2019-06-18 16:10:12', '2019-06-18 16:15:27', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '90.0000', 52, 1),
(112, 1, '998', 'Test2', '', '25.0000', 0, '2019-06-18 02:24:57', '2019-06-18 02:25:44', NULL, '1.00', 1, 1, 0, '2', '1', '1', 0, 0, 0, 1, 0, 1, '0', 2, 0, 0, '25.0000', 53, 1),
(113, 1, '994', 'Test4', '', '25.0000', 0, '2019-06-18 02:25:03', '2019-06-18 02:25:35', NULL, '1.00', 1, 1, 0, '6', '1', '1', 0, 0, 0, 1, 0, 1, '0', 4, 0, 0, '25.0000', 53, 1),
(114, 1, '998', 'Test5', '', '25.0000', 0, '2019-06-18 02:25:53', '2019-06-18 02:26:15', NULL, '1.00', 1, 1, 0, '2', '1', '1', 0, 0, 0, 1, 0, 1, '0', 5, 0, 0, '25.0000', 53, 1),
(115, 1, '999', 'Test1', '', '25.0000', 0, '2019-06-18 02:26:23', '2019-06-18 21:50:19', NULL, '1.00', 1, 1, 0, '1', '1', '1', 0, 0, 0, 1, 0, 1, '0', 1, 0, 0, '25.0000', 53, 1),
(116, 1, '997', 'Test8', '', '25.0000', 0, '2019-06-18 02:26:54', '2019-06-18 02:27:18', NULL, '1.00', 1, 1, 0, '3', '1', '1', 0, 0, 0, 1, 0, 1, '0', 8, 0, 0, '25.0000', 53, 1),
(117, 1, '995', 'Test3', '', '25.0000', 0, '2019-06-18 02:27:24', '2019-06-18 12:20:14', NULL, '1.00', 1, 1, 0, '5', '1', '1', 0, 0, 0, 1, 0, 1, '0', 3, 0, 0, '25.0000', 53, 1),
(118, 1, '999', 'Test10', '', '25.0000', 0, '2019-06-18 02:27:52', '2019-06-18 02:28:14', NULL, '1.00', 1, 1, 0, '1', '1', '1', 0, 0, 0, 1, 0, 1, '0', 10, 0, 0, '25.0000', 53, 1),
(119, 1, '1000', 'Test6', '', '25.0000', 0, '2019-06-18 02:28:22', '2019-06-18 18:26:25', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 6, 0, 0, '25.0000', 53, 1),
(120, 1, '1000', 'Test7', '', '25.0000', 0, '2019-06-18 02:29:03', '2019-06-18 02:29:23', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 7, 0, 0, '25.0000', 53, 1),
(121, 1, '999', 'Test12', '', '25.0000', 0, '2019-06-18 02:29:36', '2019-06-18 13:02:47', NULL, '1.00', 1, 1, 0, '1', '1', '1', 0, 0, 0, 1, 0, 1, '0', 12, 0, 0, '25.0000', 53, 1),
(122, 1, '998', 'Test9', '', '25.0000', 0, '2019-06-18 02:30:12', '2019-06-18 02:30:32', NULL, '1.00', 1, 1, 0, '2', '1', '1', 0, 0, 0, 1, 0, 1, '0', 9, 0, 0, '25.0000', 53, 1),
(123, 1, '999', 'Test11', '', '25.0000', 0, '2019-06-18 02:30:41', '2019-06-18 02:31:04', NULL, '1.00', 1, 1, 0, '1', '1', '1', 0, 0, 0, 1, 0, 1, '0', 11, 0, 0, '25.0000', 53, 1),
(130, 1, '1000', 'Special', '2_small.jpg', '15.0000', 0, '2019-06-18 02:19:53', '2019-06-18 00:05:34', NULL, '2.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 1, 1, '10.0000', 55, 1),
(127, 1, '1000', 'Normal', 'small_00.jpg', '15.0000', 0, '2019-06-18 01:51:35', '2019-06-18 14:23:29', NULL, '2.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 1, 0, '15.0000', 55, 1),
(131, 1, '1000', 'PERWORDREQ', '', '0.0000', 0, '2019-06-18 01:31:28', '2019-06-18 21:30:23', NULL, '1.00', 1, 1, 0, '0', '1', '1', 1, 0, 0, 1, 0, 1, '0', 0, 0, 0, '5.0000', 57, 1),
(132, 1, '997', 'GolfClub', '9_small.jpg', '0.0000', 0, '2019-06-18 12:36:12', '2019-06-18 18:04:36', NULL, '1.00', 1, 1, 0, '3', '1', '1', 1, 0, 0, 1, 0, 1, '0', 0, 0, 0, '13.0050', 58, 1),
(133, 1, '1000', 'DOWNLOAD2', '2_small.jpg', '49.9900', 0, '2019-06-18 23:51:33', '2019-06-18 00:06:58', NULL, '0.00', 1, 1, 0, '2', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '49.9900', 60, 1),
(134, 1, '1000', 'PERLETTERREQ', '', '0.0000', 0, '2019-06-18 21:23:58', '2019-06-18 21:29:50', NULL, '1.00', 1, 1, 0, '0', '1', '1', 1, 0, 0, 1, 0, 1, '0', 0, 0, 0, '5.0000', 57, 1),
(154, 1, '10000', 'ROPE', '9_small.jpg', '1.0000', 0, '2019-06-18 21:08:08', '2019-06-18 17:18:46', NULL, '0.00', 1, 1, 0, '0', '10', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '0.9000', 58, 0),
(155, 1, '1000', 'PRICEFACTOR', 'sample_image.gif', '10.0000', 0, '2019-06-18 23:03:10', '2019-06-18 17:21:04', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '10.0000', 56, 1),
(156, 1, '1000', 'PRICEFACTOROFF', 'sample_image.gif', '10.0000', 0, '2019-06-18 23:05:24', '2019-06-18 23:10:12', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '10.0000', 56, 1),
(157, 1, '1000', 'PRICEFACTOROFFATTR', 'sample_image.gif', '10.0000', 0, '2019-06-18 23:10:18', '2019-06-18 23:13:48', NULL, '1.00', 1, 1, 0, '0', '1', '1', 1, 0, 0, 1, 0, 1, '0', 0, 0, 0, '10.0000', 56, 1),
(158, 1, '1000', 'ONETIME', 'b_b_grid.gif', '45.0000', 0, '2019-06-18 23:22:08', NULL, NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '45.0000', 56, 1),
(159, 1, '10000', 'ATTQTYPRICE', 'b_c_grid.gif', '25.0000', 0, '2019-06-18 23:29:31', '2019-06-18 23:49:56', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '25.0000', 56, 1),
(160, 1, '997', 'GolfClub', '9_small.jpg', '0.0000', 0, '2019-06-18 10:14:35', '2019-06-18 10:15:16', NULL, '1.00', 1, 1, 0, '0', '1', '1', 1, 0, 0, 1, 0, 1, '0', 0, 0, 0, '14.4500', 61, 1),
(165, 1, '10000', 'ROPE', '9_small.jpg', '1.0000', 0, '2019-06-18 10:42:50', '2019-06-18 17:18:12', NULL, '0.00', 1, 1, 0, '0', '10', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '1.0000', 61, 0),
(166, 2, '10000', 'RTBHUNTER', 'sooty.jpg', '4.9900', 0, '2019-06-18 10:42:50', '2019-06-18 10:43:00', NULL, '3.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '3.0000', 62, 1),
(167, 3, '0', '', '', '0.0000', 0, '2019-06-18 10:42:50', '2019-06-18 00:39:10', NULL, '0.00', 1, 0, 0, '0', '1', '1', 0, 0, 0, 0, 0, 0, '0', 0, 0, 0, '0.0000', 63, 1),
(168, 1, '1000', 'PGT', 'samples/1_small.jpg', '3.9500', 0, '2019-06-18 15:25:32', '2019-06-18 16:26:08', NULL, '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 10, 0, 0, '3.9500', 64, 1),
(169, 2, '1000', 'PMT', 'samples/2_small.jpg', '3.9500', 0, '2019-06-18 15:27:50', '2019-06-18 16:29:01', NULL, '1.00', 1, 1, NULL, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 20, 0, 0, '3.9500', 64, 1),
(170, 3, '0', '', 'samples/3_small.jpg', '0.0000', 0, '2019-06-18 15:29:23', '2004-09-27 23:11:25', NULL, '0.00', 1, 0, 0, '0', '1', '1', 0, 0, 0, 0, 0, 0, '0', 30, 0, 0, '0.0000', 64, 1),
(171, 4, '1000', 'DPT', 'samples/4_small.jpg', '3.9500', 0, '2019-06-18 15:32:40', '2019-06-18 17:46:49', NULL, '0.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 40, 0, 0, '3.9500', 64, 1),
(172, 5, '1000', 'PFS', 'samples/5_small.jpg', '3.9500', 0, '2019-06-18 15:39:18', '2019-06-18 23:08:43', NULL, '5.00', 1, 0, 0, '0', '1', '1', 0, 0, 0, 1, 1, 1, '0', 50, 0, 0, '3.9500', 64, 1),
(173, 1, '1000', 'Book', 'b_g_grid.gif', '0.0000', 0, '2019-06-18 23:54:34', '2015-12-26 02:50:59', NULL, '0.00', 1, 1, 0, '0', '1', '1', 1, 0, 0, 1, 0, 1, '0', 0, 0, 0, '52.5000', 61, 1),
(174, 1, '999', 'TESTCALL', 'call_for_price.jpg', '0.0000', 0, '2019-06-18 13:25:44', '2019-06-18 13:28:54', '2007-02-21 00:00:00', '1.00', 1, 1, 0, '0', '1', '1', 0, 0, 1, 1, 0, 1, '0', 0, 0, 0, '0.0000', 24, 0),
(175, 1, '1000', 'Normal', '1_small.jpg', '60.0000', 0, '2019-06-18 23:32:52', '2019-06-18 17:13:20', NULL, '2.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 1, 0, '60.0000', 55, 1),
(176, 1, '1000', 'Normal', 'small_00.jpg', '100.0000', 0, '2019-06-18 16:45:25', '2019-06-18 16:47:22', NULL, '2.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 1, 0, '100.0000', 55, 1),
(177, 1, '1000', 'Special', '2_small.jpg', '100.0000', 0, '2019-06-18 16:47:45', '2019-06-18 00:05:48', NULL, '2.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 1, 1, '75.0000', 55, 1),
(179, 1, '1000', 'DOWNLOAD1', '1_small.jpg', '39.0000', 0, '2019-06-18 00:08:33', '2019-06-18 00:18:51', NULL, '0.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 1, 0, 1, '0', 0, 0, 0, '39.0000', 60, 1),
(178, 1, '1000', 'Normal', '1_small.jpg', '60.0000', 0, '2019-06-18 16:54:52', '2019-06-18 17:15:02', NULL, '2.00', 1, 1, 0, '0', '1', '1', 0, 0, 0, 0, 0, 1, '0', 0, 1, 0, '50.0000', 55, 1);
#New Products
UPDATE products SET products_date_added = NOW() WHERE products_id = 168 or products_id = 169 or products_id = 170;
UPDATE products SET products_date_added = NOW() - INTERVAL 7 DAY WHERE products_id = 171 or products_id = 172 or products_id = 166 or products_id = 133;
UPDATE products SET products_date_added = NOW() - INTERVAL 20 DAY WHERE products_id = 126 or products_id = 47 or products_id = 34;
UPDATE products SET products_date_added = NOW() - INTERVAL 50 DAY WHERE products_id = 134 or products_id = 131 or products_id = 160;
UPDATE products SET products_date_added = NOW() - INTERVAL 70 DAY WHERE products_id = 57 or products_id = 174;
UPDATE products SET products_date_added = NOW() - INTERVAL 100 DAY WHERE products_id = 6 or products_id = 19;

#Upcoming Products
UPDATE products SET products_date_available = NOW() + INTERVAL 12 DAY WHERE products_id = 16;
UPDATE products SET products_date_available = NOW() + INTERVAL 17 DAY WHERE products_id = 174;
UPDATE products SET products_date_available = NOW() + INTERVAL 27 DAY WHERE products_id = 40;
UPDATE products SET products_date_available = NOW() + INTERVAL 33 DAY WHERE products_id = 34;

#
# Dumping data for table `products_attributes`
#

INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix, products_options_sort_order, product_attribute_is_free, products_attributes_weight, products_attributes_weight_prefix, attributes_display_only, attributes_default, attributes_discounted, attributes_image, attributes_price_base_included, attributes_price_onetime, attributes_price_factor, attributes_price_factor_offset, attributes_price_factor_onetime, attributes_price_factor_onetime_offset, attributes_qty_prices, attributes_qty_prices_onetime, attributes_price_words, attributes_price_words_free, attributes_price_letters, attributes_price_letters_free, attributes_required) VALUES (1, 1, 4, 1, '0.0000', '', 10, 0, '0.0000', '', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(2, 1, 4, 2, '50.0000', '+', 20, 0, '0.0000', '', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(3, 1, 4, 3, '70.0000', '+', 30, 0, '0.0000', '', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(4, 1, 3, 5, '0.0000', '+', 10, 0, '0.0000', '', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(5, 1, 3, 6, '100.0000', '+', 20, 0, '0.0000', '', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(6, 2, 4, 3, '10.0000', '-', 30, 0, '0.0000', '', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(7, 2, 4, 4, '0.0000', '+', 40, 0, '0.0000', '', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(8, 2, 3, 6, '0.0000', '+', 20, 0, '0.0000', '', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(9, 2, 3, 7, '120.0000', '+', 30, 0, '0.0000', '', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(10, 26, 3, 8, '0.0000', '+', 20, 0, '0.0000', '', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(11, 26, 3, 9, '6.0000', '+', 10, 0, '0.0000', '', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(26, 22, 5, 10, '0.0000', '+', 10, 0, '7.0000', '-', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(27, 22, 5, 13, '0.0000', '+', 1000, 0, '0.0000', '', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(85, 34, 1, 25, '0.2000', '+', 20, 0, '0.1000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(65, 34, 13, 35, '5.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(64, 34, 13, 36, '2.0000', '+', 20, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(63, 34, 13, 34, '1.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(56, 34, 7, 0, '0.2500', '+', 0, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(55, 34, 8, 0, '0.2500', '+', 0, 0, '0.0000', '+', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(54, 34, 11, 0, '1.0000', '+', 0, 0, '0.0000', '+', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(53, 34, 9, 0, '0.7500', '+', 0, 0, '0.0000', '+', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(52, 34, 10, 0, '0.5000', '+', 0, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(410, 54, 1, 31, '0.0000', '+', 100, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_silver.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(47, 34, 6, 23, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(46, 34, 6, 22, '1.0000', '+', 20, 0, '2.0000', '+', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(45, 34, 6, 14, '36.9900', '+', 30, 0, '9.0000', '+', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(394, 50, 6, 22, '4.9900', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(393, 50, 6, 14, '19.9900', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(426, 55, 1, 15, '0.0000', '+', 50, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_blue.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(44, 34, 2, 18, '0.0000', '+', 30, 0, '0.0000', '+', 0, 1, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(43, 34, 2, 20, '0.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(425, 55, 1, 31, '0.0000', '+', 100, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_silver.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(42, 34, 2, 19, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(41, 34, 2, 21, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(40, 34, 1, 17, '0.3000', '+', 30, 0, '0.1000', '', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(39, 34, 1, 16, '0.1000', '+', 10, 0, '0.1000', '', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(38, 34, 1, 15, '0.4000', '+', 50, 0, '0.0000', '', 0, 0, 1, 'attributes/a_bugs_life_blue.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(48, 34, 5, 24, '1.0000', '+', 10, 0, '2.0000', '+', 0, 0, 1, NULL, 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(968, 100, 4, 46, '0.0000', '+', 5, 0, '0.0000', '+', 0, 1, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(422, 36, 4, 46, '0.0000', '+', 5, 0, '0.0000', '+', 0, 1, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(101, 36, 4, 3, '100.0000', '+', 30, 0, '1.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(102, 36, 4, 2, '75.0000', '+', 20, 0, '1.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(103, 36, 4, 1, '50.0000', '+', 10, 0, '1.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(104, 36, 1, 29, '519.0000', '', 80, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(105, 36, 1, 30, '499.0000', '', 90, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(106, 36, 1, 15, '539.0000', '', 50, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(967, 100, 1, 15, '539.0000', '', 50, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(966, 100, 1, 30, '499.0000', '', 90, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(965, 100, 1, 29, '519.0000', '', 80, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(964, 100, 4, 1, '50.0000', '+', 10, 0, '1.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(963, 100, 4, 2, '75.0000', '+', 20, 0, '1.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(962, 100, 4, 3, '100.0000', '+', 30, 0, '1.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(119, 43, 1, 16, '5.0000', '+', 10, 1, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(120, 43, 1, 17, '6.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(121, 43, 1, 29, '7.0000', '+', 80, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(122, 43, 2, 21, '0.0000', '+', 20, 0, '0.0000', '+', 0, 1, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(123, 43, 2, 18, '1.0000', '+', 30, 1, '0.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(124, 43, 2, 20, '2.0000', '+', 40, 0, '0.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(125, 44, 1, 16, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(126, 44, 1, 17, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(127, 44, 1, 29, '0.0000', '+', 80, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(128, 44, 2, 21, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(129, 44, 2, 18, '1.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(130, 44, 2, 20, '2.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(141, 46, 2, 18, '1.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(140, 46, 2, 21, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(139, 46, 1, 29, '0.0000', '+', 80, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(138, 46, 1, 17, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(137, 46, 1, 16, '0.0000', '+', 10, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(142, 46, 2, 20, '2.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(143, 44, 2, 37, '0.0000', '+', 5, 0, '0.0000', '+', 1, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(144, 46, 2, 37, '0.0000', '+', 5, 1, '0.0000', '+', 1, 1, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(160, 47, 14, 38, '5.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(161, 47, 14, 39, '10.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(162, 47, 14, 41, '15.0000', '+', 15, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(163, 47, 14, 43, '100.0000', '+', 100, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(164, 47, 14, 40, '25.0000', '+', 25, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(165, 47, 14, 42, '50.0000', '+', 50, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(407, 49, 1, 26, '0.0000', '+', 40, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(401, 53, 1, 26, '0.0000', '+', 40, 0, '0.0000', '+', 0, 1, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(406, 49, 6, 22, '4.9900', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(405, 49, 6, 14, '19.9900', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(86, 34, 1, 26, '0.0000', '+', 40, 0, '0.0000', '+', 0, 1, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(311, 48, 1, 26, '0.0000', '+', 40, 0, '0.0000', '+', 0, 1, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(310, 48, 6, 22, '4.9900', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(308, 48, 6, 23, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(309, 48, 6, 14, '19.9900', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(307, 48, 1, 15, '0.0000', '+', 50, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_blue.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(306, 48, 1, 31, '0.0000', '+', 100, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_silver.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(398, 53, 6, 23, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(399, 53, 6, 14, '19.9900', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(395, 50, 1, 26, '0.0000', '+', 40, 0, '0.0000', '+', 0, 1, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(390, 50, 1, 31, '0.0000', '+', 100, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_silver.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(400, 53, 6, 22, '4.9900', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(397, 53, 1, 15, '0.0000', '+', 50, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_blue.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(392, 50, 6, 23, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(391, 50, 1, 15, '0.0000', '+', 50, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_blue.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(403, 49, 1, 15, '0.0000', '+', 50, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(396, 53, 1, 31, '0.0000', '+', 100, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_silver.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(404, 49, 6, 23, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(87, 34, 1, 27, '0.0000', '+', 60, 0, '0.1000', '+', 0, 0, 1, 'attributes/a_bugs_life_purple.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(88, 34, 1, 28, '0.0000', '+', 70, 0, '0.0000', '+', 0, 0, 1, 'attributes/a_bugs_life_brown.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(89, 34, 1, 30, '0.0000', '+', 90, 0, '0.0000', '+', 0, 0, 1, 'attributes/a_bugs_life_white.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(90, 34, 1, 31, '0.0000', '+', 100, 0, '0.0000', '+', 0, 0, 1, 'attributes/a_bugs_life_silver.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(402, 49, 1, 31, '0.0000', '+', 100, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(411, 54, 1, 15, '0.0000', '+', 50, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_blue.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(412, 54, 6, 23, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(413, 54, 6, 14, '19.9900', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(414, 54, 6, 22, '4.9900', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(415, 54, 1, 26, '0.0000', '+', 40, 0, '0.0000', '+', 0, 1, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(417, 46, 13, 34, '0.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(418, 46, 13, 35, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(419, 46, 13, 36, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(420, 46, 13, 44, '0.0000', '+', 5, 0, '0.0000', '+', 0, 1, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(421, 43, 1, 45, '0.0000', '+', 5, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(427, 55, 6, 23, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(428, 55, 6, 14, '19.9900', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(429, 55, 6, 22, '4.9900', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(430, 55, 1, 26, '0.0000', '+', 40, 0, '0.0000', '+', 0, 1, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(431, 56, 1, 31, '0.0000', '+', 100, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_silver.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(432, 56, 1, 15, '0.0000', '+', 50, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_blue.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(433, 56, 6, 23, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(434, 56, 6, 14, '19.9900', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(435, 56, 6, 22, '4.9900', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(436, 56, 1, 26, '0.0000', '+', 40, 0, '0.0000', '+', 0, 1, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(449, 59, 1, 15, '539.0000', '', 50, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(448, 59, 1, 30, '499.0000', '', 90, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(447, 59, 1, 29, '519.0000', '', 80, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(446, 59, 4, 1, '50.0000', '+', 10, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(445, 59, 4, 2, '75.0000', '+', 20, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(444, 59, 4, 3, '100.0000', '+', 30, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(450, 59, 4, 46, '0.0000', '+', 5, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(451, 60, 4, 3, '100.0000', '+', 30, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(452, 60, 4, 2, '75.0000', '+', 20, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(453, 60, 4, 1, '50.0000', '+', 10, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(454, 60, 1, 29, '10.0000', '+', 80, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(455, 60, 1, 30, '0.0000', '', 90, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(456, 60, 1, 15, '20.0000', '+', 50, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(457, 60, 4, 46, '0.0000', '+', 5, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(458, 61, 4, 3, '100.0000', '+', 30, 0, '1.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(459, 61, 4, 2, '75.0000', '+', 20, 0, '1.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(460, 61, 4, 1, '50.0000', '+', 10, 0, '1.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(461, 61, 1, 29, '10.0000', '+', 80, 0, '0.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(462, 61, 1, 30, '0.0000', '', 90, 0, '0.0000', '+', 0, 1, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(463, 61, 1, 15, '20.0000', '+', 50, 0, '0.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(464, 61, 4, 46, '0.0000', '+', 5, 0, '0.0000', '+', 0, 1, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(972, 101, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(971, 101, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(970, 101, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(969, 101, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(991, 110, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(988, 109, 5, 52, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(987, 109, 5, 10, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(990, 110, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(483, 74, 4, 2, '75.0000', '+', 20, 0, '1.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(482, 74, 4, 3, '100.0000', '+', 30, 0, '1.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(484, 74, 4, 1, '50.0000', '+', 10, 0, '1.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(485, 74, 1, 29, '519.0000', '', 80, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(486, 74, 1, 30, '499.0000', '', 90, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(487, 74, 1, 15, '539.0000', '', 50, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(488, 74, 4, 46, '0.0000', '+', 5, 0, '0.0000', '+', 0, 1, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(505, 76, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(504, 76, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(503, 76, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(502, 76, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(501, 76, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(500, 76, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(499, 76, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(496, 46, 10, 0, '0.7500', '+', 0, 0, '0.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(497, 46, 9, 0, '0.5000', '+', 0, 0, '0.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(498, 46, 11, 0, '0.2500', '+', 0, 0, '0.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(506, 76, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(507, 76, 13, 36, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(508, 78, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(509, 78, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(510, 78, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(511, 78, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(512, 78, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(513, 78, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(514, 78, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(515, 78, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(516, 78, 13, 36, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(517, 79, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(518, 79, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(519, 79, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(520, 79, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(521, 79, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(522, 79, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(523, 79, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(524, 79, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(525, 79, 13, 36, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(526, 80, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(527, 80, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(528, 80, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(529, 80, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(530, 80, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(531, 80, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(532, 80, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(533, 80, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(534, 80, 13, 36, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(570, 84, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(569, 84, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(568, 84, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(567, 84, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(566, 84, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(565, 84, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(564, 84, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(563, 84, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(562, 84, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(678, 82, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(677, 82, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(676, 82, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(675, 82, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(674, 82, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(673, 82, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(694, 83, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(693, 83, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(692, 83, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(691, 83, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(690, 83, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(689, 83, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(571, 85, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(572, 85, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(573, 85, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(574, 85, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(575, 85, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(576, 85, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(577, 85, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(578, 85, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(579, 85, 13, 36, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(879, 88, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(878, 88, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(877, 88, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(876, 88, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(873, 88, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(874, 88, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(875, 88, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(895, 89, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(894, 89, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(893, 89, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(892, 89, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(889, 89, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(890, 89, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(891, 89, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(806, 90, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(805, 90, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(804, 90, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(803, 90, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(802, 90, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(801, 90, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(822, 92, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(821, 92, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(820, 92, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(819, 92, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(818, 92, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(817, 92, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(710, 93, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(709, 93, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(708, 93, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(707, 93, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(706, 93, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(705, 93, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(726, 94, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(725, 94, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(724, 94, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(723, 94, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(722, 94, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(721, 94, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(661, 84, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(662, 84, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(663, 84, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(668, 84, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(669, 84, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(671, 84, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(679, 82, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(672, 84, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(680, 82, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(681, 82, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(682, 82, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(683, 82, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(684, 82, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(685, 82, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(686, 82, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(687, 82, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(688, 82, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(695, 83, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(696, 83, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(697, 83, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(698, 83, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(699, 83, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(700, 83, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(701, 83, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(702, 83, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(703, 83, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(704, 83, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(711, 93, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(712, 93, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(713, 93, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(714, 93, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(715, 93, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(716, 93, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(717, 93, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(718, 93, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(719, 93, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(720, 93, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(727, 94, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(728, 94, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(729, 94, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(730, 94, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(731, 94, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(732, 94, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(733, 94, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(734, 94, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(735, 94, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(736, 94, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(872, 88, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(871, 88, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(870, 88, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(868, 88, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(869, 88, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(867, 88, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(866, 88, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(888, 89, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(887, 89, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(886, 89, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(884, 89, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(885, 89, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(883, 89, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(882, 89, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(807, 90, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(808, 90, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(809, 90, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(810, 90, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(811, 90, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(812, 90, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(813, 90, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(814, 90, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(815, 90, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(816, 90, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(823, 92, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(824, 92, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(825, 92, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(826, 92, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(827, 92, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(828, 92, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(829, 92, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(830, 92, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(831, 92, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(832, 92, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(865, 88, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(881, 89, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(880, 88, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(896, 89, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(897, 95, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(898, 95, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(899, 95, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(900, 95, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(901, 95, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(902, 95, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(903, 95, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(904, 95, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(905, 95, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(906, 95, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(907, 95, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(908, 95, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(909, 95, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(910, 95, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(911, 95, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(912, 95, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(913, 96, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(914, 96, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(915, 96, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(916, 96, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(917, 96, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(918, 96, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(919, 96, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(920, 96, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(921, 96, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(922, 96, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(923, 96, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(924, 96, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(925, 96, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(926, 96, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(927, 96, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(928, 96, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(929, 97, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(930, 97, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(931, 97, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(932, 97, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(933, 97, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(934, 97, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(935, 97, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(936, 97, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(937, 97, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(938, 97, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(939, 97, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(940, 97, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(941, 97, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(942, 97, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(943, 97, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(944, 97, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(945, 98, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(946, 98, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(947, 98, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(948, 98, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(949, 98, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(950, 98, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(951, 98, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(952, 98, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(953, 98, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(954, 98, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(955, 98, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(956, 98, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(957, 98, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(958, 98, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(959, 98, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(960, 98, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(973, 101, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(974, 101, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(975, 101, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(976, 101, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(977, 101, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(978, 101, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(979, 101, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(980, 101, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(981, 101, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(982, 101, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(983, 101, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(984, 101, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(992, 110, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(993, 110, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(994, 110, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(995, 110, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(996, 110, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(997, 110, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(998, 110, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(999, 110, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1000, 110, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1001, 110, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1002, 110, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1003, 110, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1004, 110, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1005, 110, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1006, 111, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_red.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1007, 111, 1, 25, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_orange.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1008, 111, 1, 17, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_yellow.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1009, 111, 2, 21, '50.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1010, 111, 2, 20, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1011, 111, 2, 18, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1012, 111, 13, 35, '75.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1013, 111, 13, 34, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1014, 111, 13, 36, '40.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1015, 111, 1, 26, '40.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, 'attributes/color_green.gif', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1016, 111, 2, 19, '40.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1017, 111, 13, 47, '50.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1018, 111, 13, 48, '0.0000', '+', 5, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1019, 111, 15, 49, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1020, 111, 15, 50, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1021, 111, 15, 51, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', NULL, NULL, '0.0000', 0, '0.0000', 0, 0),
(1027, 131, 1, 16, '5.0000', '+', 10, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 1),
(1028, 131, 1, 26, '5.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 1),
(1025, 131, 10, 0, '0.0000', '+', 0, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0500', 0, '0.0000', 0, 1),
(1029, 131, 1, 17, '5.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 1),
(1030, 131, 9, 0, '0.0000', '+', 0, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0500', 3, '0.0000', 0, 1),
(1031, 132, 16, 53, '14.4500', '+', 30, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1032, 132, 16, 54, '14.4500', '+', 40, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1033, 132, 16, 55, '14.4500', '+', 50, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1034, 132, 16, 56, '14.4500', '+', 60, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1035, 132, 16, 57, '14.4500', '+', 90, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1036, 132, 16, 58, '14.4500', '+', 200, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1037, 132, 16, 61, '14.4500', '+', 20, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1038, 132, 16, 59, '14.4500', '+', 70, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1039, 132, 16, 60, '14.4500', '+', 80, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1040, 133, 5, 10, '0.0000', '+', 10, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1041, 133, 17, 62, '0.0000', '+', 10, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1042, 133, 17, 63, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1043, 133, 5, 64, '0.0000', '+', 100, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1044, 133, 5, 52, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1045, 134, 10, 0, '0.0000', '+', 0, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0200', 0, 1),
(1046, 134, 1, 16, '5.0000', '+', 10, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 1),
(1047, 134, 1, 26, '5.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 1),
(1048, 134, 1, 17, '5.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 1),
(1049, 134, 9, 0, '0.0000', '+', 0, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0200', 3, 1),
(1050, 154, 18, 65, '0.0000', '+', 10, 0, '0.2500', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1051, 154, 18, 66, '1.5000', '+', 20, 0, '0.7500', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1052, 155, 1, 16, '0.0000', '+', 10, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '1.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1053, 155, 1, 17, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '2.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1054, 155, 1, 26, '0.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '3.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1055, 156, 1, 16, '0.0000', '+', 10, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '1.0000', '1.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1056, 156, 1, 17, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '2.0000', '1.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1057, 156, 1, 26, '0.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '3.0000', '1.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1058, 157, 1, 16, '0.0000', '+', 10, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '1.0000', '1.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1059, 157, 1, 17, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '2.0000', '1.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1060, 157, 1, 26, '0.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '3.0000', '1.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1061, 158, 1, 16, '0.0000', '+', 10, 0, '0.0000', '+', 0, 1, 1, '', 1, '5.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1062, 158, 1, 17, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '10.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1063, 158, 1, 26, '0.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '15.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1064, 159, 1, 16, '0.0000', '+', 10, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '1:11,3:10.00,6:9.00,9:8.00,12:7.00,15:6.00', '', '0.0000', 0, '0.0000', 0, 0),
(1065, 159, 1, 26, '0.0000', '+', 40, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '3:11.00,6:10.00,9:9.00,12:8.00,15:7.00', '', '0.0000', 0, '0.0000', 0, 0),
(1066, 159, 1, 17, '0.0000', '+', 30, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '3:10.50,6:9.50,9:8.50,12:7.50,15:6.50', '', '0.0000', 0, '0.0000', 0, 0),
(1071, 160, 16, 55, '14.4500', '+', 50, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1070, 160, 16, 54, '14.4500', '+', 40, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1069, 160, 16, 53, '14.4500', '+', 30, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1072, 160, 16, 56, '14.4500', '+', 60, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1073, 160, 16, 57, '14.4500', '+', 90, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1074, 160, 16, 58, '14.4500', '+', 200, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1075, 160, 16, 61, '14.4500', '+', 20, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1076, 160, 16, 59, '14.4500', '+', 70, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1077, 160, 16, 60, '14.4500', '+', 80, 0, '1.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1090, 165, 18, 65, '0.0000', '+', 10, 0, '0.2500', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1091, 165, 18, 66, '1.5000', '+', 20, 0, '0.7500', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1088, 171, 17, 63, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1089, 171, 17, 62, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1092, 172, 19, 67, '0.0000', '+', 10, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1093, 173, 5, 10, '20.0000', '', 10, 0, '0.0000', '+', 0, 0, 0, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1094, 173, 5, 64, '20.0000', '', 100, 0, '0.0000', '+', 0, 0, 0, '', 0, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1095, 173, 5, 68, '52.5000', '', 5, 0, '1.0000', '', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1096, 175, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1097, 175, 1, 26, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1098, 178, 1, 16, '100.0000', '+', 10, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1099, 178, 1, 26, '100.0000', '+', 40, 0, '0.0000', '+', 0, 0, 0, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1100, 179, 17, 63, '0.0000', '+', 20, 0, '0.0000', '+', 0, 0, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0),
(1103, 179, 17, 62, '0.0000', '+', 10, 0, '0.0000', '+', 0, 1, 1, '', 1, '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '', '', '0.0000', 0, '0.0000', 0, 0);

#
# Dumping data for table `products_attributes_download`
#

INSERT INTO products_attributes_download (products_attributes_id, products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount) VALUES (26, 'unreal.zip', 7, 3),
(1040, 'test.zip', 7, 5),
(1041, 'test2.zip', 7, 5),
(1042, 'test2.zip', 7, 5),
(1043, 'test.zip', 7, 5),
(1044, 'test.zip', 7, 5),
(1088, 'ms_word_sample.zip', 7, 5),
(1089, 'pdf_sample.zip', 7, 5),
(1093, 'test.zip', 7, 5),
(1094, 'test2.zip', 7, 5),
(1100, 'ms_word_sample.zip', 7, 5),
(1103, 'pdf_sample.zip', 7, 5);

#
# Dumping data for table `products_description`
#

INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (1, 1, 'Matrox G200 MMS', 'Reinforcing its position as a multi-monitor trailblazer, Matrox Graphics Inc. has once again developed the most flexible and highly advanced solution in the industry. Introducing the new Matrox G200 Multi-Monitor Series; the first graphics card ever to support up to four DVI digital flat panel displays on a single 8&quot; PCI board.<br /><br />With continuing demand for digital flat panels in the financial workplace, the Matrox G200 MMS is the ultimate in flexible solutions. The Matrox G200 MMS also supports the new digital video interface (DVI) created by the Digital Display Working Group (DDWG) designed to ease the adoption of digital flat panels. Other configurations include composite video capture ability and onboard TV tuner, making the Matrox G200 MMS the complete solution for business needs.<br /><br />Based on the award-winning MGA-G200 graphics chip, the Matrox G200 Multi-Monitor Series provides superior 2D/3D graphics acceleration to meet the demanding needs of business applications such as real-time stock quotes (Versus), live video feeds (Reuters & Bloombergs), multiple windows applications, word processing, spreadsheets and CAD.', 'www.matrox.com/mga/products/g200_mms/home.cfm', 0),
(2, 1, 'Matrox G400 32MB', 'Dramatically Different High Performance Graphics<br /><br />Introducing the Millennium G400 Series - a dramatically different, high performance graphics experience. Armed with the industry\'s fastest graphics chip, the Millennium G400 Series takes explosive acceleration two steps further by adding unprecedented image quality, along with the most versatile display options for all your 3D, 2D and DVD applications. As the most powerful and innovative tools in your PC\'s arsenal, the Millennium G400 Series will not only change the way you see graphics, but will revolutionize the way you use your computer.<br /><br />Key features:<ul><li>New Matrox G400 256-bit DualBus graphics chip</li><li>Explosive 3D, 2D and DVD performance</li><li>DualHead Display</li><li>Superior DVD and TV output</li><li>3D Environment-Mapped Bump Mapping</li><li>Vibrant Color Quality rendering </li><li>UltraSharp DAC of up to 360 MHz</li><li>3D Rendering Array Processor</li><li>Support for 16 or 32 MB of memory</li></ul>', 'www.matrox.com/mga/products/mill_g400/home.htm', 0),
(3, 1, 'Microsoft IntelliMouse Pro', 'Every element of IntelliMouse Pro - from its unique arched shape to the texture of the rubber grip around its base - is the product of extensive customer and ergonomic research. Microsoft\'s popular wheel control, which now allows zooming and universal scrolling functions, gives IntelliMouse Pro outstanding comfort and efficiency.', 'www.microsoft.com/hardware/mouse/intellimouse.asp', 0),
(4, 1, 'The Replacement Killers', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br />Languages: English, Deutsch.<br />Subtitles: English, Deutsch, Spanish.<br />Audio: Dolby Surround 5.1.<br />Picture Format: 16:9 Wide-Screen.<br />Length: (approx) 80 minutes.<br />Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.replacement-killers.com', 0),
(5, 1, 'Blade Runner - Director\'s Cut Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br />Languages: English, Deutsch.<br />Subtitles: English, Deutsch, Spanish.<br />Audio: Dolby Surround 5.1.<br />Picture Format: 16:9 Wide-Screen.<br />Length: (approx) 112 minutes.<br />Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.bladerunner.com', 0),
(6, 1, 'The Matrix Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br />\r\nLanguages: English, Deutsch.\r\n<br />\r\nSubtitles: English, Deutsch.\r\n<br />\r\nAudio: Dolby Surround.\r\n<br />\r\nPicture Format: 16:9 Wide-Screen.\r\n<br />\r\nLength: (approx) 131 minutes.\r\n<br />\r\nOther: Interactive Menus, Chapter Selection, Making Of.', 'www.thematrix.com', 0),
(7, 1, 'You\'ve Got Mail Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br />Languages: English, Deutsch, Spanish. <br />Subtitles: English, Deutsch, Spanish, French, Nordic, Polish. <br />Audio: Dolby Digital 5.1. <br />Picture Format: 16:9 Wide-Screen. <br />Length: (approx) 115 minutes. <br />Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.youvegotmail.com', 0),
(8, 1, 'A Bug\'s Life Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br />Languages: English, Deutsch. <br />Subtitles: English, Deutsch, Spanish. <br />Audio: Dolby Digital 5.1 / Dolby Surround Stereo. <br />Picture Format: 16:9 Wide-Screen. <br />Length: (approx) 91 minutes. <br />Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.abugslife.com', 0),
(9, 1, 'Under Siege Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br />Languages: English, Deutsch. <br />Subtitles: English, Deutsch, Spanish. <br />Audio: Dolby Surround 5.1. <br />Picture Format: 16:9 Wide-Screen. <br />Length: (approx) 98 minutes. <br />Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0),
(10, 1, 'Under Siege 2 - Dark Territory', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br />\nLanguages: English, Deutsch.\r<br />\nSubtitles: English, Deutsch, Spanish.\r<br />\nAudio: Dolby Surround 5.1.\r<br />\nPicture Format: 16:9 Wide-Screen.\r<br />\nLength: (approx) 98 minutes.\r<br />\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0),
(11, 1, 'Fire Down Below Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br />\r\nLanguages: English, Deutsch.\r\n<br />\r\nSubtitles: English, Deutsch, Spanish.\r\n<br />\r\nAudio: Dolby Surround 5.1.\r\n<br />\r\nPicture Format: 16:9 Wide-Screen.\r\n<br />\r\nLength: (approx) 100 minutes.\r\n<br />\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0),
(12, 1, 'Die Hard With A Vengeance Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br />Languages: English, Deutsch. <br />Subtitles: English, Deutsch, Spanish. <br />Audio: Dolby Surround 5.1. <br />Picture Format: 16:9 Wide-Screen. <br />Length: (approx) 122 minutes. <br />Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0),
(13, 1, 'Lethal Weapon Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br />\r\nLanguages: English, Deutsch.\r\n<br />\r\nSubtitles: English, Deutsch, Spanish.\r\n<br />\r\nAudio: Dolby Surround 5.1.\r\n<br />\r\nPicture Format: 16:9 Wide-Screen.\r\n<br />\r\nLength: (approx) 100 minutes.\r\n<br />\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0),
(14, 1, 'Red Corner Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br />\r\nLanguages: English, Deutsch.\r\n<br />\r\nSubtitles: English, Deutsch, Spanish.\r\n<br />\r\nAudio: Dolby Surround 5.1.\r\n<br />\r\nPicture Format: 16:9 Wide-Screen.\r\n<br />\r\nLength: (approx) 117 minutes.\r\n<br />\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0),
(15, 1, 'Frantic Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br />\r\nLanguages: English, Deutsch.\r\n<br />\r\nSubtitles: English, Deutsch, Spanish.\r\n<br />\r\nAudio: Dolby Surround 5.1.\r\n<br />\r\nPicture Format: 16:9 Wide-Screen.\r\n<br />\r\nLength: (approx) 115 minutes.\r\n<br />\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0),
(16, 1, 'Courage Under Fire Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br />\r\nLanguages: English, Deutsch.\r\n<br />\r\nSubtitles: English, Deutsch, Spanish.\r\n<br />\r\nAudio: Dolby Surround 5.1.\r\n<br />\r\nPicture Format: 16:9 Wide-Screen.\r\n<br />\r\nLength: (approx) 112 minutes.\r\n<br />\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0),
(17, 1, 'Speed Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br />\r\nLanguages: English, Deutsch.\r\n<br />\r\nSubtitles: English, Deutsch, Spanish.\r\n<br />\r\nAudio: Dolby Surround 5.1.\r\n<br />\r\nPicture Format: 16:9 Wide-Screen.\r\n<br />\r\nLength: (approx) 112 minutes.\r\n<br />\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0),
(18, 1, 'Speed 2: Cruise Control', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br />\nLanguages: English, Deutsch.\r<br />\nSubtitles: English, Deutsch, Spanish.\r<br />\nAudio: Dolby Surround 5.1.\r<br />\nPicture Format: 16:9 Wide-Screen.\r<br />\nLength: (approx) 120 minutes.\r<br />\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0),
(19, 1, 'There\'s Something About Mary Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br />\r\nLanguages: English, Deutsch.\r\n<br />\r\nSubtitles: English, Deutsch, Spanish.\r\n<br />\r\nAudio: Dolby Surround 5.1.\r\n<br />\r\nPicture Format: 16:9 Wide-Screen.\r\n<br />\r\nLength: (approx) 114 minutes.\r\n<br />\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0),
(20, 1, 'Beloved Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br />\r\nLanguages: English, Deutsch.\r\n<br />\r\nSubtitles: English, Deutsch, Spanish.\r\n<br />\r\nAudio: Dolby Surround 5.1.\r\n<br />\r\nPicture Format: 16:9 Wide-Screen.\r\n<br />\r\nLength: (approx) 164 minutes.\r\n<br />\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0),
(21, 1, 'SWAT 3: Close Quarters Battle Linked', 'Windows 95/98<br /><br />211 in progress with shots fired. Officer down. Armed suspects with hostages. Respond Code 3! Los Angles, 2005, In the next seven days, representatives from every nation around the world will converge on Las Angles to witness the signing of the United Nations Nuclear Abolishment Treaty. The protection of these dignitaries falls on the shoulders of one organization, LAPD SWAT. As part of this elite tactical organization, you and your team have the weapons and all the training necessary to protect, to serve, and &quot;When needed&quot; to use deadly force to keep the peace. It takes more than weapons to make it through each mission. Your arsenal includes C2 charges, flashbangs, tactical grenades. opti-Wand mini-video cameras, and other devices critical to meeting your objectives and keeping your men free of injury. Uncompromised Duty, Honor and Valor!', 'www.swat3.com', 0),
(22, 1, 'Unreal Tournament Linked', 'From the creators of the best-selling Unreal, comes Unreal Tournament. A new kind of single player experience. A ruthless multiplayer revolution.<br /><br />This stand-alone game showcases completely new team-based gameplay, groundbreaking multi-faceted single player action or dynamic multi-player mayhem. It\'s a fight to the finish for the title of Unreal Grand Master in the gladiatorial arena. A single player experience like no other! Guide your team of \'bots\' (virtual teamates) against the hardest criminals in the galaxy for the ultimate title - the Unreal Grand Master.', 'www.unrealtournament.net', 0),
(23, 1, 'The Wheel Of Time Linked', 'The world in which The Wheel of Time takes place is lifted directly out of Jordan\'s pages; it\'s huge and consists of many different environments. How you navigate the world will depend largely on which game - single player or multipayer - you\'re playing. The single player experience, with a few exceptions, will see Elayna traversing the world mainly by foot (with a couple notable exceptions). In the multiplayer experience, your character will have more access to travel via Ter\'angreal, Portal Stones, and the Ways. However you move around, though, you\'ll quickly discover that means of locomotion can easily become the least of the your worries...<br /><br />During your travels, you quickly discover that four locations are crucial to your success in the game. Not surprisingly, these locations are the homes of The Wheel of Time\'s main characters. Some of these places are ripped directly from the pages of Jordan\'s books, made flesh with Legend\'s unparalleled pixel-pushing ways. Other places are specific to the game, conceived and executed with the intent of expanding this game world even further. Either way, they provide a backdrop for some of the most intense first person action and strategy you\'ll have this year.', 'www.wheeloftime.com', 0),
(24, 1, 'Disciples: Sacred Lands Linked', 'A new age is dawning...<br /><br />Enter the realm of the Sacred Lands, where the dawn of a New Age has set in motion the most momentous of wars. As the prophecies long foretold, four races now clash with swords and sorcery in a desperate bid to control the destiny of their gods. Take on the quest as a champion of the Empire, the Mountain Clans, the Legions of the Damned, or the Undead Hordes and test your faith in battles of brute force, spellbinding magic and acts of guile. Slay demons, vanquish giants and combat merciless forces of the dead and undead. But to ensure the salvation of your god, the hero within must evolve.<br /><br />The day of reckoning has come... and only the chosen will survive.', '', 0),
(25, 1, 'Microsoft Internet Keyboard PS/2', 'The Internet Keyboard has 10 Hot Keys on a comfortable standard keyboard design that also includes a detachable palm rest. The Hot Keys allow you to browse the web, or check e-mail directly from your keyboard. The IntelliType Pro software also allows you to customize your hot keys - make the Internet Keyboard work the way you want it to!', '', 0),
(26, 1, 'Microsoft IntelliMouse Explorer', 'Microsoft introduces its most advanced mouse, the IntelliMouse Explorer! IntelliMouse Explorer features a sleek design, an industrial-silver finish, a glowing red underside and taillight, creating a style and look unlike any other mouse. IntelliMouse Explorer combines the accuracy and reliability of Microsoft IntelliEye optical tracking technology, the convenience of two new customizable function buttons, the efficiency of the scrolling wheel and the comfort of expert ergonomic design. All these great features make this the best mouse for the PC!', 'www.microsoft.com/hardware/mouse/explorer.asp', 0),
(27, 1, 'Hewlett Packard LaserJet 1100Xi Linked', 'HP has always set the pace in laser printing technology. The new generation HP LaserJet 1100 series sets another impressive pace, delivering a stunning 8 pages per minute print speed. The 600 dpi print resolution with HP\'s Resolution Enhancement technology (REt) makes every document more professional.<br /><br />Enhanced print speed and laser quality results are just the beginning. With 2MB standard memory, HP LaserJet 1100xi users will be able to print increasingly complex pages. Memory can be increased to 18MB to tackle even more complex documents with ease. The HP LaserJet 1100xi supports key operating systems including Windows 3.1, 3.11, 95, 98, NT 4.0, OS/2 and DOS. Network compatibility available via the optional HP JetDirect External Print Servers.<br /><br />HP LaserJet 1100xi also features The Document Builder for the Web Era from Trellix Corp. (featuring software to create Web documents).', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0),
(28, 1, 'Gift Certificate €  5.00', 'Purchase a Gift Certificate today to share with your family, friends or business associates!', '', 0),
(29, 1, 'Gift Certificate € 10.00', 'Purchase a Gift Certificate today to share with your family, friends or business associates!', '', 0),
(30, 1, 'Gift Certificate € 25.00', 'Purchase a Gift Certificate today to share with your family, friends or business associates!', '', 0),
(31, 1, 'Gift Certificate € 50.00', 'Purchase a Gift Certificate today to share with your family, friends or business associates!', '', 0),
(32, 1, 'Gift Certificate $100.00', 'Purchase a Gift Certificate today to share with your family, friends or business associates!', '', 0),
(34, 1, 'A Bug\'s Life "Multi Pak" Special 2003 Collectors Edition', 'A Bug\'s Life "Multi Pak" Special 2003 Collectors Edition\r\n<br />\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br />\r\nLanguages: English, Deutsch.\r\n<br />\r\nSubtitles: English, Deutsch, Spanish.\r\n<br />\r\nAudio: Dolby Digital 5.1 / Dolby Surround Stereo.\r\n<br />\r\nPicture Format: 16:9 Wide-Screen.\r\n<br />\r\nLength: (approx) 91 minutes.\r\n<br />\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.abugslife.com', 0),
(36, 1, 'Hewlett Packard - by attributes SALE', 'The Product Price is set to 0.00\r\n<br /><br />\r\n\r\nThe Product Priced by Attribute is set to YES\r\n<br /><br />\r\n\r\nThe attribute prices are defined without the price prefix of +\r\n<br /><br />\r\n\r\nThe Display Price is made up of the lowest attribute price from each Option Name group.\r\n<br /><br />\r\n\r\nIf there had been a Product Price, this would have been added together to the lowest attributes price from each of the Option Name groups to make up the display price.\r\n<br /><br />\r\n\r\nThe price prefix of the + is not used as we are not "adding" to the display price.\r\n<br /><br />\r\n\r\nThe Colors attributes are set for the discount to be applied, their prices before the discount are:<br />\r\nWhite $499.99<br />\r\nBlack $519.00<br />\r\nBlue $539.00<br />', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0),
(57, 1, 'A Free Product - All', 'This is a free product where there are no prices at all.\r\n<br /><br />\r\n\r\nThe Always Free Shipping is also turned ON.\r\n<br /><br />\r\n\r\nIf this is bought separately, the Zen Cart Free Charge payment module will show if there is no charges on shipping.\r\n<br /><br />\r\n\r\nIf other products are purchased with a price or shipping charge, then the Zen Cart Free Charge payment module will not show and the shipping will be applied accordingly.', '', 0),
(101, 1, 'TEST $120 Sale 10% Special off', 'Product is Priced by Attribute.\r\n<br /><br />\r\n\r\nAttribute Option Group: Color and Size are used for pricing by marking these as Included in Base Price.\r\n<br /><br />\r\n\r\nGift Options has everything marked included in base price also, but because None is set to $0.00 that groups lowest price is $0.00 so it is not affecting the Base Price.\r\n<br /><br />\r\n\r\nIf None was not part of this group and you did not want to include those prices, you would mark all of the Gift Option Attribute to NOT be included in the Base Price.\r\n<br /><br />\r\n\r\nProduct Product is $0.00\r\n<br /><br />\r\n\r\nSpecial does not exist\r\n<br /><br />\r\nSale Price is 10%\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(100, 1, 'Hewlett Packard - by attributes SALE with Special', 'The Product Price is set to 0.00\r\n<br /><br />\r\n\r\nThe Product Priced by Attribute is set to YES\r\n<br /><br />\r\n\r\nThe attribute prices are defined without the price prefix of +\r\n<br /><br />\r\n\r\nThe Display Price is made up of the lowest attribute price from each Option Name group.\r\n<br /><br />\r\n\r\nIf there had been a Product Price, this would have been added together to the lowest attributes price from each of the Option Name groups to make up the display price.\r\n<br /><br />\r\n\r\nThe price prefix of the + is not used as we are not "adding" to the display price.\r\n<br /><br />\r\n\r\nThe Colors attributes are set for the discount to be applied, their prices before the discount are:<br />\r\nWhite $499.99<br />\r\nBlack $519.00<br />\r\nBlue $539.00<br />', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0),
(39, 1, 'A Free Product', 'This is a free product that is also on special.\r\n<br /><br />\r\n\r\nThis should show as having a price, special price but then be free.\r\n<br /><br />\r\n\r\nWhile this is a FREE product, this does have Shipping.', '', 0),
(40, 1, 'A Call for Price Product', 'This is a Call for Price product that is also on special.\r\n<br />\r\n\r\nThis should show as having a price, special price but then be Call for Price. This means you cannot buy it.\r\n<br />', '', 0),
(41, 1, 'A Call for Price Product SALE', 'This is a Call for Price product that is also on special and has a Sale price via Sale Maker.\r\n<br /><br />\r\n\r\nThis should show as having a price, special price but then be Call for Price. This means you cannot buy it.\r\n<br /><br />\r\n\r\nThe Add to Cart buttons automatically change to Call for Price, which is defined as: TEXT_CALL_FOR_PRICE\r\n<br /><br />\r\n\r\nThis link will take the customer to the Contact Us page.\r\n<br /><br />', '', 0),
(42, 1, 'A Free Product - SALE', 'This is a free product that is also on special.\r\n<br />\r\n\r\nThis should show as having a price, special price but then be free.\r\n<br />', '', 0),
(43, 1, 'A Free Product with Attribute', 'This is a free product that is also on special.\r\n<br /><br />\r\n\r\nThis should show as having a price, special price but then be free.\r\n<br /><br />\r\n\r\nAttributes can be added that can optionally be set to free or not free\r\n<br /><br />\r\n\r\nThe Color Red attribute is priced at $5.00 but marked as a Free Attribute when the Product is Free\r\n<br /><br />\r\n\r\nThe Size Medium attribute is priced at $1.00 but marked as a Free Attribute when Product is Free', '', 0),
(44, 1, 'A Mixed OFF Product with Attribute', 'This product has attributes and a minimum qty and units.\r\n<br /><br />\r\n\r\nMixed is OFF this means you CANNOT mix attributes to make the minimums and units.\r\n<br /><br />\r\n\r\nThe Size Option Value: Select from Below ... is a Display Only Attribute. \r\n<br /><br />\r\n\r\nThis means that the product cannot be added to the Shopping Cart if that Option Value is selected. If it is still selected, then an error is triggered when the Add to Cart is pressed with a warning to the customer on what the error is.\r\n<br /><br />\r\n\r\nNo checkout is allowed when errors exist.', '', 0),
(46, 1, 'A Mixed ON Product with Attribute', 'This product has attributes and a minimum qty and units.\r\n<br /><br />\r\n\r\nMixed is ON this means you CAN mix attributes to make the minimums and units.\r\n<br /><br />\r\n\r\nSelect from Below is a Display Only Attribute. This means that it cannot be added to the cart. If it is, then an error is triggered.\r\n<br /><br />\r\n\r\nNo checkout is allowed when errors exist.', '', 0),
(47, 1, 'Geschenkgutscheine by attributes', 'Priced by Attribute Geschenkgutscheine.', '', 0),
(48, 1, 'Test 1', 'This is a test product for copying and deleting attributes.\r\n<br /><br />\r\nAll of the images for this product are in the main /images directory and /large directory.\r\n<br /><br />\r\nThe main products_image is called 1_small.jpg\r\n<br /><br />\r\nThere are additional images for this product that will auto load located in /images called:<br />\r\n1_small_01.jpg<br />\r\n1_small_02.jpg<br />\r\n1_small_03.jpg<br />\r\n<br />\r\nThe large additional images are in /images/large called:<br />\r\n1_small_01_LRG.jpg<br />\r\n1_small_02_LRG.jpg<br />\r\n1_small_03_LRG.jpg<br />\r\n\r\n<br /><br />\r\n\r\nThe naming conventions for the additional images do not require that they be numeric. Using the numberic system helps establish the sort order of the images and how they will display.\r\n<br /><br />\r\n\r\nWhat is important is that all the additional images be located in the same directory and start with the same name: 1_small and end in the same extenion: .jpg\r\n<br /><br />\r\n\r\nThe additional large images need to be located in the /large directory and use the same name plus the Large image suffix, defined in the Admin ... Images ... in this case _LRG\r\n<br /><br />', '', 0),
(49, 1, 'Test 2', 'This is a test product for copying and deleting attributes.\r\n<br /><br />\r\n\r\nThis was made using the Attribute Copy to Product in the new Admin ... Catalog ... Attribute Controller ... and copying the Attribute from the Test 1 product to Test 2.\r\n<br /><br />\r\n\r\nThis product does not have any additional images.\r\n<br /><br />\r\n\r\nIt does have a Large image located in /large\r\n<br /><br />\r\n\r\nThis uses the same name: 2_small plus the large image suffix _LRG plus the matching extension .jpg to give the new name: /images/large/2_small_LRG.jpg\r\n<br /><br />', '', 0),
(50, 1, 'Test 3', 'This is a test product for copying and deleting attributes.\r\n<br /><br />\r\n\r\nThis was made using the Attribute Copy to Product in the new Admin ... Catalog ... Attribute Controller ... and copying the attributes from the Test 2 product to Test 3.\r\n<br /><br />\r\n\r\nThis product does not have any additional images.\r\n<br /><br />\r\n\r\nIt does NOT have a Large image located in /large\r\n<br /><br />\r\n\r\nThis means that when you click on the image for enlarge, unless the original image is larger than the small image settings you will see the same image in the popup.\r\n<br /><br />', '', 0),
(51, 1, 'Free Ship & Payment Virtual weight 10', 'Free Shipping and Payment\r\n<br /><br />\r\n\r\nThe Price is set to 25.00 ... but what makes it Free is that this product has been marked as:\r\n<br />\r\nProduct is Free: Yes\r\n<br /><br />\r\n\r\nThis would allow the product to be listed with a price, but the actual charge is $0.00\r\n<br /><br />\r\n\r\nThe weight is set to 10 but could be set to 0. What really makes it truely Free Shipping is that it has been marked to be Always Free Shipping.\r\n<br /><br />\r\n\r\nAlways Free shipping is set to: Yes<br />\r\nThis will not charge for shipping, but requres a shipping address.\r\n<br /><br />\r\n\r\nBecause there is no shipping and the price is 0, the Zen Cart Free Charge comes up for the payment module and the other payment modules vanish.\r\n<br /><br />\r\n\r\nYou can change the text on the Zen Cart Free Charge module to read as you would prefer.\r\n<br /><br />\r\n\r\nNote: if you add products that incur a charge or shipping charge, then the Zen Cart Free Charge payment module will vanish and the regular payment modules will show.', '', 0),
(52, 1, 'Free Ship & Payment Virtual', 'Product Price is set to 0\r\n<br /><br />\r\n\r\nPayment weight is set to 2 ...\r\n<br /><br />\r\n\r\nVirtual is ON ... this will skip shipping address\r\n<br /><br />', '', 0),
(53, 1, 'Min and Units MIX', 'This product is purchased based on minimums and units.\r\n<br /><br />\r\n\r\nThe Min is set to 6 and the units is set to 3\r\n<br /><br />\r\n\r\nQuantity Minimums and Units are designed to more or less force the customer to make purchases of a Minimum Quantity ... and if need be, in Units.\r\n<br /><br />\r\n\r\nThis product can only be purchased if you buy at least 6 ... and after that in units of 3 ... 9, 12, 15, 18, etc.\r\n<br /><br />\r\n\r\nIf you do not purchase it in the right Quantity, you will not be able to checkout.\r\n<br /><br />\r\n\r\nWhen adding to the cart, the quantity box on the product_info page is "smart". It will adjust itself based on what is in the cart.\r\n<br /><br />\r\n\r\nThe Add to Cart buttons are also smart on New Products and Product Listing ... these also will adjust what is added to the cart.\r\n<br /><br />\r\n\r\nFor example: If there is 1 in the cart, the next use of Add to Cart will add 5 more to make the Minimum of 6. Add again and 3 more will be added to keep the Units correct.\r\n<br /><br />\r\n\r\nProduct Quantity Min/Unit Mix is for when a product has attributes.\r\n<br /><br />\r\n\r\nIf Mix is ON then a mix of attributes options may be used to make up the Quantity Minimum and Units. This means you can mix 1 blue, 3 silver and 2 green to get 6.\r\n<br /><br />\r\n\r\nIf the Mix is OFF then you may not mix 2 blue, 2 silver and 2 green to get 6.\r\n<br /><br />\r\n\r\nThis product has the Product Qty Min/Unit Mix set to ON', '', 0),
(54, 1, 'Min and Units NOMIX', 'This product is purchased based on minimums and units.\r\n<br /><br />\r\n\r\nThe Min is set to 6 and the units is set to 3\r\n<br /><br />\r\n\r\nQuantity Minimums and Units are designed to more or less force the customer to make purchases of a Minimum Quantity ... and if need be, in Units.\r\n<br /><br />\r\n\r\nThis product can only be purchased if you buy at least 6 ... and after that in units of 3 ... 9, 12, 15, 18, etc.\r\n<br /><br />\r\n\r\nIf you do not purchase it in the right Quantity, you will not be able to checkout.\r\n<br /><br />\r\n\r\nWhen adding to the cart, the quantity box on the product_info page is "smart". It will adjust itself based on what is in the cart.\r\n<br /><br />\r\n\r\nThe Add to Cart buttons are also smart on New Products and Product Listing ... these also will adjust what is added to the cart.\r\n<br /><br />\r\n\r\nFor example: If there is 1 in the cart, the next use of Add to Cart will add 5 more to make the Minimum of 6. Add again and 3 more will be added to keep the Units correct.\r\n<br /><br />\r\n\r\nProduct Quantity Min/Unit Mix is for when a product has attributes.\r\n<br /><br />\r\n\r\nIf Mix is ON then a mix of attributes options may be used to make up the Quantity Minimum and Units. This means you can mix 1 blue, 3 silver and 2 green to get 6.\r\n<br /><br />\r\n\r\nIf the Mix is OFF then you may not mix 2 blue, 2 silver and 2 green to get 6.\r\n<br /><br />\r\n\r\nThis product has the Product Qty Min/Unit Mix set to OFF', '', 0),
(55, 1, 'Min and Units MIX - Sale', 'This product is purchased based on minimums and units.\r\n<br /><br />\r\n\r\nThe Min is set to 6 and the units is set to 3\r\n<br /><br />\r\n\r\nQuantity Minimums and Units are designed to more or less force the customer to make purchases of a Minimum Quantity ... and if need be, in Units.\r\n<br /><br />\r\n\r\nThis product can only be purchased if you buy at least 6 ... and after that in units of 3 ... 9, 12, 15, 18, etc.\r\n<br /><br />\r\n\r\nIf you do not purchase it in the right Quantity, you will not be able to checkout.\r\n<br /><br />\r\n\r\nWhen adding to the cart, the quantity box on the product_info page is "smart". It will adjust itself based on what is in the cart.\r\n<br /><br />\r\n\r\nThe Add to Cart buttons are also smart on New Products and Product Listing ... these also will adjust what is added to the cart.\r\n<br /><br />\r\n\r\nFor example: If there is 1 in the cart, the next use of Add to Cart will add 5 more to make the Minimum of 6. Add again and 3 more will be added to keep the Units correct.\r\n<br /><br />\r\n\r\nProduct Quantity Min/Unit Mix is for when a product has attributes.\r\n<br /><br />\r\n\r\nIf Mix is ON then a mix of attributes options may be used to make up the Quantity Minimum and Units. This means you can mix 1 blue, 3 silver and 2 green to get 6.\r\n<br /><br />\r\n\r\nIf the Mix is OFF then you may not mix 2 blue, 2 silver and 2 green to get 6.\r\n<br /><br />\r\n\r\nThis product has the Product Qty Min/Unit Mix set to ON\r\n<br /><br />\r\n\r\nThis product has been placed on Sale via Sale Maker', '', 0),
(56, 1, 'Min and Units NOMIX - Sale', 'This product is purchased based on minimums and units.\r\n<br /><br />\r\n\r\nThe Min is set to 6 and the units is set to 3\r\n<br /><br />\r\n\r\nQuantity Minimums and Units are designed to more or less force the customer to make purchases of a Minimum Quantity ... and if need be, in Units.\r\n<br /><br />\r\n\r\nThis product can only be purchased if you buy at least 6 ... and after that in units of 3 ... 9, 12, 15, 18, etc.\r\n<br /><br />\r\n\r\nIf you do not purchase it in the right Quantity, you will not be able to checkout.\r\n<br /><br />\r\n\r\nWhen adding to the cart, the quantity box on the product_info page is "smart". It will adjust itself based on what is in the cart.\r\n<br /><br />\r\n\r\nThe Add to Cart buttons are also smart on New Products and Product Listing ... these also will adjust what is added to the cart.\r\n<br /><br />\r\n\r\nFor example: If there is 1 in the cart, the next use of Add to Cart will add 5 more to make the Minimum of 6. Add again and 3 more will be added to keep the Units correct.\r\n<br /><br />\r\n\r\nProduct Quantity Min/Unit Mix is for when a product has attributes.\r\n<br /><br />\r\n\r\nIf Mix is ON then a mix of attributes options may be used to make up the Quantity Minimum and Units. This means you can mix 1 blue, 3 silver and 2 green to get 6.\r\n<br /><br />\r\n\r\nIf the Mix is OFF then you may not mix 2 blue, 2 silver and 2 green to get 6.\r\n<br /><br />\r\n\r\nThis product has the Product Qty Min/Unit Mix set to OFF\r\n<br /><br />\r\n\r\nThis product has been put on Sale via Sale Maker.', '', 0),
(59, 1, 'Hewlett Packard - by attributes', 'The Product Price is set to 0.00\r\n<br /><br />\r\n\r\nThe Product Priced by Attribute is set to YES\r\n<br /><br />\r\n\r\nThe attribute prices are defined without the price prefix of +\r\n<br /><br />\r\n\r\nThe Display Price is made up of the lowest attribute price from each Option Name group.\r\n<br /><br />\r\n\r\nIf there had been a Product Price, this would have been added together to the lowest attributes price from each of the Option Name groups to make up the display price.\r\n<br /><br />\r\n\r\nThe price prefix of the + is not used as we are not "adding" to the display price.\r\n<br /><br />', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0),
(60, 1, 'Hewlett Packard - Sale with Attribute on Sale', 'The Product Price is set to 499.75\r\n<br /><br />\r\n\r\nA Sale Maker Discount of 10% is applied.\r\n<br /><br />\r\n\r\nThe attribute are marked to be discounted also.\r\n<br /><br />\r\n\r\nPrior to the discount being applied:<br />\r\nBlue +$20.00<br />\r\nBlack +$10.00<br />\r\nWhite $0.00\r\n<br /><br />\r\n\r\n4 meg +$50.00<br />\r\n8 meg +$75.00<br />\r\n16 meg +$100.00\r\n<br /><br />', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0),
(61, 1, 'Hewlett Packard - Sale with Attribute NOT on Sale', 'The Product Price is set to 499.75\r\n<br /><br />\r\n\r\nA Sale Maker Discount of 10% is applied.\r\n<br /><br />\r\n\r\nThe attribute are marked NOT to be discounted.\r\n<br /><br />\r\n\r\nPrior to the discount being applied:<br />\r\nBlue +$20.00<br />\r\nBlack +$10.00<br />\r\nWhite $0.00\r\n<br /><br />\r\n\r\n4 meg +$50.00<br />\r\n8 meg +$75.00<br />\r\n16 meg +$100.00\r\n<br /><br />', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0),
(111, 1, 'TEST $120 Special $90.00 Sale -$5.00 Skip', 'Product is $120\r\n<br /><br />\r\n\r\nSpecial $90.00 or 25% - Specials are Skipped\r\n<br /><br />\r\n\r\nSale is -$5.00\r\n<br /><br />\r\n\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(110, 1, 'TEST $120 Sale -$5.00 Skip', 'Product is $120\r\n<br /><br />\r\nSale is -$5.00\r\n<br /><br />\r\nSpecials are skipped\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(109, 1, 'Stückzahl verstecken - Methoden', 'This product does not show the Quantity Box when Adding to the Shopping Cart.\r\n<br /><br />\r\n\r\nWhile Quantity Box Shows is set to YES, the Product Qty Max has been set to 1\r\n\r\nThis will add only 1 to the Shopping Cart when Add to Cart is hit.\r\n<br /><br />\r\n\r\nThe reason for this is that this is a download. As a download, there is never a reason to allow more than quantity 1 to be ordered.\r\n<br /><br />\r\n\r\nNOTE: If using Quantity Box Shows set to NO, unless Qty Max is also set to 1 then each time the Add to Cart is clicked the current cart quantity is updated by 1. If Qty Max is set to 1 then no more than 1 will be able to be added to the Shopping Cart per order.\r\n<br /><br />\r\n\r\nTwo methods are available to trigger the Stückzahl verstecken.\r\n<br /><br />\r\n\r\nMethod 1: Set Quantity Box Shows to NO\r\n<br /><br />\r\n\r\nMethod 2: Set Qty Maximum to 1\r\n<br /><br />\r\n\r\nIn either case, you will only be able to add qty 1 to the shopping cart and the quantity box will not show.\r\n<br /><br />', '', 0),
(133, 1, 'Multiple Downloads', '<p>This product is set up to have multiple downloads.</p><p>The Product Price is $49.99</p><p>The attributes are setup with two Option Names, one for each download to allow for two downloads at the same time.</p><p>The first Download is listed under:</p><p>Option Name: Version<br />Option Value: Download Windows - English<br />Option Value: Download Windows - Spanish<br />Option Value: DownloadMAC - English<br /></p><p>The second Download is listed under:</p><p>Option Name: Documentation<br />Option Value: PDF - English<br />Option Value:MS Word- English</p>', '', 0),
(134, 1, 'Per letter - required', '<p>Product is priced by attribute</p><p>The Option Name Line 1 is setup as Text</p><p>The attribute is added to the product as Required</p><p>The pricing is $0.02 per letter</p><p>The Option Name Line2 is setup as Text</p><p>The attribute is added to the product as Required</p><p>The pricing is $0.02 per letter with 3 letters free</p><p>The Colors are set up as radio buttons and Red is the Default.</p>', '', 0),
(74, 1, 'Hewlett Packard - by attributes with Special% no SALE', 'The Product Price is set to 0.00 Special is set to 20%\r\n<br /><br />\r\n\r\nThe Product Priced by Attribute is set to YES\r\n<br /><br />\r\n\r\nThe attribute prices are defined without the price prefix of +\r\n<br /><br />\r\n\r\nThe Display Price is made up of the lowest attribute price from each Option Name group.\r\n<br /><br />\r\n\r\nIf there had been a Product Price, this would have been added together to the lowest attributes price from each of the Option Name groups to make up the display price.\r\n<br /><br />\r\n\r\nThe price prefix of the + is not used as we are not "adding" to the display price.\r\n<br /><br />\r\n\r\nThe Colors attributes are, their prices before the Special discount is applied:<br />\r\nWhite $499.99<br />\r\nBlack $519.00<br />\r\nBlue $539.00\r\n<br /><br />\r\n\r\nThe Specials Price is a flat $100 discount. This $100 discount is applied to all attributes marked attributes_discounted Yes.', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0),
(130, 1, 'Special Product', '<p>This is a Special product priced at $15 with a $10 Special</p><p>There are quantity discounts setup which will be discounted from the Special Price.</p><p>Discounts are added on the Products Price Manager.</p>', '', 0),
(131, 1, 'Per word - required', '<p>Product is priced by attribute</p><p>The Option Name Line 1 is setup as Text</p><p>The attribute is added to the product as Required</p><p>The pricing is $0.05 per word</p><p>The Option Name Line2 is setup as Text</p><p>The attribute is added to the product as Required</p><p>The pricing is $0.05 per word with 3 words Free</p><p>The Colors are set up as radio buttons and Red is the Default.</p>', '', 0),
(132, 1, 'Golf Clubs', '<p>Products Price is set to 0 and Products Weight is set to 1</p><p>This is marked Price by Attribute</p><p>This is priced by attribute at 14.45 per club with an added weight of 1 on the attributes.</p><p>This will make the shipping weight 1lb for the product plus 1lb for each attribute (club) added.</p><p>The attributes are sorted so the clubs read in order on the Product Info, Shopping Cart, Order, Email and Account History.</p>', '', 0),
(85, 1, 'TEST $120 Special $90', 'Product is $120\r\n<br /><br />\r\n\r\nThere is a $90.00 or 25% Special and no sale on this product.\r\n<br /><br />\r\n\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(78, 1, 'TEST 25% special 10% Sale Attribute Priced', 'Priced by Attribute - Product price is set to $0.00\r\n<br /><br />\r\nAll attributes are marked to make the price.\r\n\r\n<br /><br />\r\nProduct is $0\r\n<br /><br />\r\nSpecial is 25%\r\n<br /><br />\r\nSale is 10%\r\n<br /><br />', '', 0),
(79, 1, 'TEST 25% Special Attribute Priced', 'Priced by Attribute - Product price is set to $0.00\r\n<br /><br />\r\nAll attributes are marked to make the price.\r\n\r\n<br /><br />\r\nProduct is $0\r\n<br /><br />\r\nSpecial is 25%\r\n<br /><br />', '', 0),
(80, 1, 'TEST 25% Special', 'Product is $100.00\r\n<br /><br />\r\nSpecial is 25%\r\n<br /><br />', '', 0),
(84, 1, 'TEST $120', 'Product is $120\r\n<br /><br />\r\n\r\nThere is no special and no sale on this product.\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75<br />\r\n- Green $40\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nX-Small $40.00<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- None<br /> \r\n- Embossed Collector\'s Tin $40.00<br />\r\n- Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nFeatures: <br />\r\nQuality Design<br />\r\nCustom Handling<br />\r\nSame Day Shipping<br />\r\n<br /><br />\r\n\r\nNOTE: Select from below ... is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\n\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\n\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />\r\n\r\nNOTE: None is similar to Display Only, but this can be used when for when no option value is required.\r\n<br /><br />\r\n\r\nIts value is set the value to $0.00 and it is NOT marked Display Only. \r\n<br /><br />\r\n\r\nBecause its value is $0.00 if included in the Attribute Based Price on products Priced by Attribute, this Options group would not have any value included in the calculated price.\r\n<br /><br />\r\n\r\nNOTE: The Option Name: Featured is a READ ONLY Option Type\r\n<br /><br />\r\nThis can be for repeatative information or anything that occures on many products but functions like an attribute in setting up the information. It does not get added to the Shopping Cart nor display on the Order. They should be marked exclude from Attribute Based Price.\r\n<br /><br />', '', 0),
(82, 1, 'TEST $120 Sale -$5.00', 'Product is $120\r\n<br /><br />\r\nSale is -$5.00\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(83, 1, 'TEST $120 Special $90.00 Sale -$5.00', 'Product is $120\r\n<br /><br />\r\n\r\nSpecial $90.00 or 25%\r\n<br /><br />\r\n\r\nSale is -$5.00\r\n<br /><br />\r\n\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(76, 1, 'TEST 25% special 10% Sale', 'Product is $100.00\r\n<br /><br />\r\nSpecial is 25%\r\n<br /><br />\r\nSale is 10%\r\n<br /><br />', '', 0),
(106, 1, 'Beispiel für maximal 3 Artikel', 'This product only allows Quantity 1 because the Products Qty Maximum is set to 3.\r\n<br /><br />\r\n\r\nThis means there will be a Quantity box.\r\n<br /><br />\r\n\r\nAdd button will not add more than a total of 3 to the Shopping Cart.\r\n<br /><br />', '', 0),
(104, 1, 'Stückzahl verstecken', 'This product does not show the Quantity Box when Adding to the Shopping Cart.\r\n<br /><br />\r\n\r\nThis will add 1 to the Shopping Cart when Add to Cart is hit.\r\n<br /><br />\r\n\r\nNOTE: If using Quantity Box Shows set to NO, unless Qty Max is also set to 1 then each time the Add to Cart is clicked the current cart quantity is updated by 1. If Qty Max is set to 1 then no more than 1 will be able to be added to the Shopping Cart per order.\r\n<br /><br />\r\n\r\nBecause the Image name is: 1_small.jpg<br />\r\nand stored in the /images directory ...\r\n<br /><br />\r\n\r\nThe other matching images will show:\r\n<br /><br />\r\n/images/1_small_00.jpg<br />\r\n/images/1_small_02.jpg<br />\r\n/images/1_small_03.jpg\r\n<br /><br />\r\n\r\nThe matching large images from /images/large will show:\r\n<br /><br />\r\n/images/large/1_small_00_LRG.jpg<br />\r\n/images/large/1_small_02_LRG.jpg<br />\r\n/images/large/1_small_03_LRG.jpg\r\n<br /><br />\r\n\r\nA matching image must begin with the same exact name as the Product Image and end in the same extension.\r\n<br /><br />\r\n\r\nThese will then auto load.\r\n<br /><br />', '', 0),
(105, 1, 'A Maximum Sample of 1', 'This product only allows Quantity 1 because the Products Qty Maximum is set to 1.\r\n<br /><br />\r\n\r\nThis means there will be no Quantity box.\r\n<br /><br />\r\n\r\nAdd button will not add more than a total of 1 to the Shopping Cart.\r\n<br /><br />', '', 0),
(88, 1, 'TEST $120 Sale Special $90 Skip', 'Product is $120\r\n<br /><br />\r\nSpecial is $105\r\n<br /><br />\r\nSale Price is $90 or 25% - Skip Products with Specials\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(89, 1, 'TEST $120 Sale 10% Special off Skip', 'Product is $120\r\n<br /><br />\r\nSpecial does not exist\r\n<br /><br />\r\nSale Price is 10% - Skip Products with Specials\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(90, 1, 'TEST $120 Sale 10% Special', 'Product is $120\r\n<br /><br />\r\nSpecial is 25% or $90\r\n<br /><br />\r\nSale Price is 10%\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(92, 1, 'TEST $120 Sale 10% Special off', 'Product is $120\r\n<br /><br />\r\nSpecial does not exist\r\n<br /><br />\r\nSale Price is 10%\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(93, 1, 'TEST $120 Special off Abverkauf neuer Preis $100', 'Product is $120\r\n<br /><br />\r\nSpecial does not exist\r\n<br /><br />\r\nSale Price is New Price $100\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nAttributes are not affected by the Sale Discount Price when a New Price is used.\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(94, 1, 'TEST $120 Special 25% Abverkauf neuer Preis $100', 'Product is $120\r\n<br /><br />\r\nSpecial 25% or $90\r\n<br /><br />\r\nSale Price is New Price $100\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nAttributes are not affected by the Sale Discount Price when a New Price is used.\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(95, 1, 'TEST $120 Special 25% Abverkauf neuer Preis $100 Skip Specials', 'Product is $120\r\n<br /><br />\r\nSpecial 25% or $90\r\n<br /><br />\r\nSale Price is New Price $100\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nAttributes are not affected by the Sale Discount Price when a New Price is used.\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(96, 1, 'TEST $120 Special off Abverkauf neuer Preis $100 Skip Specials', 'Product is $120\r\n<br /><br />\r\nSpecial does not exist\r\n<br /><br />\r\nSale Price is New Price $100\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nAttributes are not affected by the Sale Discount Price when a New Price is used.\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(97, 1, 'TEST $120 Sale 10% Special - Apply to price', 'Product is $120\r\n<br /><br />\r\nSpecial is 25% or $90\r\n<br /><br />\r\nSale Price is 10%\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(98, 1, 'TEST $120 Sale 10% Special off - Apply to Price', 'Product is $120\r\n<br /><br />\r\nSpecial does not exist\r\n<br /><br />\r\nSale Price is 10%\r\n<br /><br />\r\n\r\nAttributes:<br />\r\nColor:<br />\r\n- Red $100.00<br />\r\n- Orange $50.00<br />\r\n- Yellow $75\r\n<br /><br />\r\n\r\nSize:<br />\r\nSelect from Below:<br />\r\nSmall $50.00<br />\r\nMedium $75.00<br />\r\nLarge $100.00\r\n<br /><br />\r\n\r\nGift Options:<br />\r\n- Dated Collector\'s Tin $50.00<br />\r\n- Autographed Memorabila Card $75.00<br />\r\n- Wrapping $100.00\r\n<br /><br />\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br /><br />\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br /><br />\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br /><br />', '', 0),
(99, 1, 'Free Shipping Product with Weight', 'This product has Free Shipping.\r\n<br /><br />\r\n\r\nThe weight is set to 5\r\n<br /><br />\r\n\r\nWhile the weight is set to 5, it has the Always Free Shipping set to YES and the Free Shipping Module is installed.\r\n<br /><br />', '', 0),
(107, 1, 'Free Shipping Product without Weight', 'This product has Free Shipping.\r\n<br /><br />\r\n\r\nThe weight is set to 0\r\n<br /><br />\r\n\r\nIt has the Always Free Shipping set to NO and the Free Shipping Module is installed but it will still ship for Free.\r\n<br /><br />\r\n\r\nIn the Configruation settings for Shipping/Packaging ... Order Free Shipping 0 Weight Status has been defined to be Free Shipping.\r\n<br /><br />\r\n\r\nNOTE: if that setting is changed, then this product will NOT ship for free, even though the weight is set to 0.\r\n<br /><br />', '', 0),
(108, 1, 'Ein ausverkaufter Artikel', 'This product is Sold Out because the product quantity is <= 0\r\n<br /><br />\r\n\r\nBecause the Configuration Settings in Stock are defined that Sold Out Products are not disabled and Sold Out cannot be purchased, the add to cart buttons are changed to either the large or small Sold Out image.\r\n<br /><br />\r\n\r\nIf you change the Configuration Settings in Stock, then you will be able to purchase this product, even though it is Sold Out.\r\n<br /><br />', '', 0),
(112, 1, 'Test Zwei', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0),
(113, 1, 'Test Four', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0),
(114, 1, 'Test Five', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0),
(115, 1, 'Test One', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0),
(116, 1, 'Test Eight', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0),
(117, 1, '<strong>Test<br /> Three</strong>', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0),
(118, 1, 'Test Ten', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0),
(119, 1, 'Test Six', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0),
(120, 1, 'Test Seven', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0),
(121, 1, 'Test Twelve', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0),
(122, 1, 'Test Nine', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0),
(123, 1, 'Test Eleven', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0),
(127, 1, 'Normal Product', '<p>This is a normal product priced at $15</p><p>There are quantity discounts setup which will be discounted from the Products Price.</p><p>Discounts are added on the Products Price Manager.</p>', '', 0),
(154, 1, 'Rope', '<p>Rope is sold by foot or yard with a minimum length of 10 feet or 10 yards</p><p>Product Price of $1.00<br />Product Weight of 0</p><p>Option Values:<br />per foot $0.00 weight .25<br />per yard $1.50 weight .75</p>', '', 0),
(155, 1, 'Price Factor', '<p>This product is priced at $10.00</p><p>The attributes are priced using the Price Factor</p><p>Red is $10<br />Yellow is $20<br />Green is $30</p><p>This makes the total price $10 + the price factor of the attribute.</p>', '', 0),
(156, 1, 'Price Factor Offset', '<p>This product is priced at $10.00</p><p>The attributes are priced using the Price Factor and Price Factor Offset</p><p>Red is $10 ($0)<br />Yellow is $20 ($10)<br />Green is $30 ($20)</p><p>The Price Factor Offset is set to 1 to take out the price of the Product Price then make the total price $10 + the price factor * $10 - price factor offset * $10 for the attributes.</p>', '', 0),
(157, 1, 'Price Factor Offset by Attribute', '<p>This product is priced at $10.00</p><p>It is marked Price by Attribute.</p><p>The attributes are priced using the Price Factor and Price Factor Offset. </p><p>The actual Product Price is used just to compute the Price Factor.</p><p>Red is $10 ($0)<br />Yellow is $20 ($10)<br />Green is $30 ($20)</p><p>The Price Factor Offset is set to 1 to take out the price of the Product Price then make the total price the price factor * $10 - price factor offset * $10 for the attributes.</p>', '', 0),
(158, 1, 'One Time Charge', '<p>This product is $45 with a one time charge set on the colors.</p><p>Red $5<br />Yellow is $10<br />Green is $15</p>', '', 0),
(159, 1, 'Attribute Quantity Discount', '<p>Attribute qty discounts are attribute prices based on qty ordered.</p><p>Enter them as: </p><p>Red:<br />3:10.00,6:9.00,9:8.00,12:7.00,15:6.00</p><p>Yellow<br />3:10.50,6:9.50,9:8.50,12:7.50,15:6.50</p><p>Green:<br />3:11.00,6:10.00,9:9.00,12:8.00,15:7.00</p><p>A table will also show on the page to display these discounts as well as an indicator that qty discounts are available.</p>', '', 0),
(160, 1, 'Golf Clubs', '<p>Products Price is set to 0 and Products Weight is set to 1</p><p>This is marked Price by Attribute</p><p>This is priced by attribute at 14.45 per club with an added weight of 1 on the attributes.</p><p>This will make the shipping weight 1lb for the product plus 1lb for each attribute (club) added.</p><p>The attributes are sorted so the clubs read in order on the Product Info, Shopping Cart, Order, Email and Account History.</p>', '', 0),
(165, 1, 'Rope', '<p>Rope is sold by foot or yard with a minimum length of 10 feet or 10 yards</p><p>Product Price of $1.00<br />Product Weight of 0</p><p>Option Values:<br />per foot $0.00 weight .25<br />per yard $1.50 weight .75</p>', '', 0),
(166, 1, 'Russ Tippins Band - The Hunter', '', '', 0),
(167, 1, 'Test Document', 'This is a test document', '', 0),
(168, 1, 'Sample of Product General Type', 'Product General Type are your regular products.\r\n\r\nThere are no special needs or layout issues to work with.', '', 0),
(169, 1, 'Sample of Product Musik Type', 'The Product Musik Type is specially designed for music media.\r\n\r\nThis can offer a lot more flexibility than the Product General.', '', 0),
(170, 1, 'Sample of Document General Type', 'Document General Type is used for Products that are actually Dokumente.\r\n\r\nThese cannot be added to the cart but can be configured for the Document Sidebox. If your Document Sidebox is not showing, go to the Layout Controller and turn it on for your template.', '', 0),
(171, 1, 'Sample of Document Product Type', 'Document Product Type is used for Dokumente that are also available for sale. <br /><br />You might wish to display brief peices of the Document then offer it for sale. <br /><br />This Product Type is also handy for downloadable Dokumente or Dokumente available either on CD or by download. <br /><br />The Document Product Type could be used in the Document Sidebox or the Categories Sidebox depending on how you configure its master categories id. <br /><br />This product has also been added as a linked product to the Document Category. This will allow it to show in both the Category and Document Sidebox. While not marked specifically for the master product type id related to the Product Types, it now is in a Product Type set for Document General so it will show in both boxes.', '', 0),
(172, 1, 'Beispiel für einen versandkostenfreien Artikel', '<p>Product Free Shipping can be setup to highlight the Free Shipping aspect of the product. <br /><br />These pages include a Free Shipping Image on them. <br /><br />You can define the ALWAYS_FREE_SHIPPING_ICON in the language file. This can be Text, Image, Text/Image Combo or nothing. <br /><br />The weight does not matter on Always Free Shipping if you set Always Free Shipping to Yes. <br /><br />Be sure to have the Free Shipping Module Turned on! Otherwise, if this is the only product in the cart, it will not be able to be shipped. <br /><br />Notice that this is defined with a weight of 5lbs. But because of the Always Free Shipping being set to Y there will be no shipping charges for this product. <br /><br />You do not have to use the Product Free Shipping product type just to use Always Free Shipping. But the reason you may want to do this is so that the layout of the Product Free Shipping product info page can be layout specifically for the Free Shipping aspect of the product. <br /><br />This includes a READONLY attribute for Option Name: Shipping and Option Value: Free Shipping Included. READONLY attributes do not show on the options for the order.</p>', '', 0),
(173, 1, 'Book', 'This Book is sold as a Book that is shipped to the customer or as a Download.<br /><br />\r\n\r\nOnly the Book itself is on Special. The Downloadable versions are not on Special.<br /><br />\r\n\r\nThis Book under Categories/Products is set to:<br /><br />\r\n\r\nProduct Priced by Attribute: Yes<br />\r\nProducts Price: 0.00<br />\r\nWeight: 0<br /><br />\r\n\r\nAn Option Name of: Version (type is dropdown)<br /><br />\r\nOption Values of: Book Hard Cover<br /><br />\r\nDownload: MAC English<br /><br />\r\nDownload: Windows English<br /><br />\r\n\r\nThe Attribute are set as:<br />\r\nOption Name: Version<br />\r\nOption Value: Book Hard Cover<br />\r\nPrice Prefix is blank<br />\r\nPrice: 52.50<br />\r\nWeight Prefix is blank\r\nWeight: 1<br />\r\nInclude in Base Price When Priced by Attribute Yes<br />\r\nApply Discounts Used by Product Special/Sale: Yes<br /><br />\r\n\r\nOption Name: Version<br />\r\nOption Value: Download: MAC English<br />\r\nPrice Prefix is blank<br />\r\nPrice: 20.00<br />\r\nWeight: 0\r\nInclude in Base Price When Priced by Attribute No<br />\r\nApply Discounts Used by Product Special/Sale: No<br /><br />\r\n\r\nOption Name: Version<br />\r\nOption Value: Download: Windows: English<br />\r\nPrice Prefix is blank<br />\r\nPrice: 20.00<br />\r\nWeight: 0<br />\r\nInclude in Base Price When Priced by Attribute No<br />\r\nApply Discounts Used by Product Special/Sale: No<br /><br />\r\n\r\nIt is on Special for $47.50<br /><br />', '', 0),
(174, 1, 'A Call No Price', 'This is a Call for Price product with no price<br />\r\n\r\nThis should show as having a price, special price but then be Call for Price. This means you cannot buy it.\r\n<br />', '', 0),
(175, 1, 'Qty Discounts by 1', '<p>This is a normal product priced at $60</p><p>There are quantity discounts setup which will be discounted from the Products Price.</p><p>Discounts are added on the Products Price Manager.</p><p>The Discounts are offered in increments of 1.</p><p>Note: Attribute do not inherit the Mengenrabatte discounts.</p><p>Attribute will inherit Discounts from Specials or sales. This can be customized per attribute by marking the Attribute to Include Product Price Special or Sale Discounts.</p><p>Red is $100.00 and marked to include the Price to Special discount but will not inherit the Mengenrabatte discount.</p><p>Green is $100 and marked not to include the Price to Special discount and will not inherit the Mengenrabatte discount.</p>', '', 0),
(176, 1, 'Normal Product by the dozen', '<p>This is a normal product priced at $100</p><p>There are quantity discounts setup which will be discounted from the Products Price by the dozen.</p><p>Discounts are added on the Products Price Manager.</p>', '', 0),
(177, 1, 'Special Product by the dozen', '<p>This is a Special product priced at $100 with a $75 Special</p><p>There are quantity discounts setup which will be discounted from the Special Price discounted by the dozen.</p><p>Discounts are added on the Products Price Manager.</p>', '', 0),
(178, 1, 'Qty Discounts by 1 Special', '<p>This is a normal product priced at $60 with a special of $50</p><p>There are quantity discounts setup which will be discounted from the Products Price.</p><p>Discounts are added on the Products Price Manager.</p><p>The Discounts are offered in increments of 1.</p><p>Note: Attribute do not inherit the Mengenrabatte discounts.</p><p>Attribute will inherit Discounts from Specials or sales. This can be customized per attribute by marking the Attribute to Include Product Price Special or Sale Discounts.</p><p>Red is $100.00 and marked to include the Price to Special discount but will not inherit the Mengenrabatte discount.</p><p>Green is $100 and marked not to include the Price to Special discount and will not inherit the Mengenrabatte discount.</p>', '', 0),
(179, 1, 'Single Download', '<p>This product is set up to have a single download.</p><p>The Product Price is $39.99</p><p>The attributes are setup with 1 Option Name, for the download to allow for one download but of various types.</p><p>The Download is listed under:</p><p>Option Name: Documentation<br />Option Value: PDF - English<br />Option Value: MS Word - English</p>', '', 0);

#
# Dumping data for table `products_discount_quantity`
#

INSERT INTO products_discount_quantity (discount_id, products_id, discount_qty, discount_price) VALUES (4, 127, '12', '10.0000'),
(3, 127, '9', '8.0000'),
(2, 127, '6', '7.0000'),
(1, 8, '3', '10.0000'),
(1, 127, '3', '5.0000'),
(4, 130, '12', '10.0000'),
(3, 130, '9', '8.0000'),
(2, 130, '6', '7.0000'),
(1, 130, '3', '5.0000'),
(9, 175, '9', '10.0000'),
(8, 175, '8', '9.0000'),
(7, 175, '7', '8.0000'),
(6, 175, '6', '7.0000'),
(5, 175, '5', '6.0000'),
(4, 175, '4', '5.0000'),
(3, 175, '3', '4.0000'),
(2, 175, '2', '3.0000'),
(1, 175, '10', '11.0000'),
(3, 178, '3', '4.0000'),
(2, 178, '2', '3.0000'),
(1, 178, '10', '11.0000'),
(6, 177, '36', '30.0000'),
(5, 176, '48', '30.0000'),
(4, 176, '36', '20.0000'),
(3, 176, '24', '10.0000'),
(2, 176, '12', '5.0000'),
(1, 176, '60', '40.0000'),
(5, 177, '24', '20.0000'),
(4, 177, '12', '10.0000'),
(3, 177, '6', '5.0000'),
(2, 177, '60', '50.0000'),
(1, 177, '48', '40.0000'),
(4, 178, '4', '5.0000'),
(5, 178, '5', '6.0000'),
(6, 178, '6', '7.0000'),
(7, 178, '7', '8.0000'),
(8, 178, '8', '9.0000'),
(9, 178, '9', '10.0000');

#
# Dumping data for table `products_options`
#

INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (1, 1, 'Color', 10, 2, 32, '', 32, 5, 0),
(2, 1, 'Size', 20, 0, 32, '', 32, 5, 0),
(3, 1, 'Model', 30, 0, 32, '', 32, 5, 0),
(4, 1, 'Memory', 50, 0, 32, '', 32, 5, 0),
(5, 1, 'Version', 40, 0, 32, '', 32, 5, 0),
(6, 1, 'Media Type', 60, 0, 32, '', 32, 5, 0),
(17, 1, 'Documentation', 45, 0, 32, NULL, 32, 5, 0),
(16, 1, 'Irons', 800, 3, 32, '', 32, 5, 0),
(7, 1, 'Logo Back', 310, 4, 64, '', 32, 5, 0),
(8, 1, 'Logo Front', 300, 4, 64, 'You may upload your own image file(s)', 32, 5, 0),
(9, 1, 'Line 2', 410, 1, 64, '', 40, 5, 0),
(10, 1, 'Line 1', 400, 1, 64, 'Enter your text up to 64 characters, punctuation and spaces', 40, 5, 0),
(11, 1, 'Line 3', 420, 1, 64, '', 40, 5, 0),
(12, 1, 'Line 4', 430, 1, 64, '', 40, 5, 0),
(13, 1, 'Gift Options', 70, 3, 32, 'Special Option Options Available:', 32, 5, 0),
(14, 1, 'Amount', 200, 2, 32, '', 32, 5, 0),
(15, 1, 'Features', 700, 5, 32, '&nbsp;', 32, 5, 0),
(18, 1, 'Length', 70, 0, 32, '', 32, 5, 0),
(19, 1, 'Shipping', 600, 5, 32, '', 32, 0, 0);

#
# Dumping data for table `products_options_values`
#

#Remove TEXT
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (1, 1, '4 mb', 10),
(2, 1, '8 mb', 20),
(3, 1, '16 mb', 30),
(4, 1, '32 mb', 40),
(5, 1, 'Value', 10),
(6, 1, 'Premium', 20),
(7, 1, 'Deluxe', 30),
(8, 1, 'PS/2', 20),
(9, 1, 'USB', 10),
(10, 1, 'Download: Windows - English', 10),
(13, 1, 'Box: Windows - English', 1000),
(14, 1, 'DVD/VHS Combo Pak', 30),
(15, 1, 'Blue', 50),
(16, 1, 'Red', 10),
(17, 1, 'Yellow', 30),
(18, 1, 'Medium', 30),
(63, 1, 'MS Word - English', 20),
(19, 1, 'X-Small', 10),
(62, 1, 'PDF - English', 10),
(61, 1, '2 Iron', 20),
(20, 1, 'Large', 40),
(60, 1, '8 Iron', 80),
(59, 1, '7 Iron', 70),
(21, 1, 'Small', 20),
(58, 1, 'Wedge', 200),
(57, 1, '9 Iron', 90),
(22, 1, 'VHS', 20),
(23, 1, 'DVD', 10),
(56, 1, '6 Iron', 60),
(55, 1, '5 Iron', 50),
(24, 1, '20th Century', 10),
(54, 1, '4 Iron', 40),
(53, 1, '3 Iron', 30),
(25, 1, 'Orange', 20),
(26, 1, 'Green', 40),
(27, 1, 'Purple', 60),
(28, 1, 'Brown', 70),
(29, 1, 'Black', 80),
(30, 1, 'White', 90),
(31, 1, 'Silver', 100),
(32, 1, 'Gold', 110),
(64, 1, 'Download: MAC - English', 100),
(34, 1, 'Wrapping', 40),
(35, 1, 'Autographed Memorabilia Card', 30),
(36, 1, 'Collector\'s Tin', 20),
(37, 1, 'Select from below ...', 5),
(38, 1, '$5.00', 5),
(39, 1, '$10.00', 10),
(40, 1, '$25.00', 25),
(41, 1, '$15.00', 15),
(42, 1, '$50.00', 50),
(43, 1, '$100.00', 100),
(44, 1, 'Select from below ...', 5),
(45, 1, 'NONE', 5),
(46, 1, 'None', 5),
(47, 1, 'Embossed Collector\'s Tin', 10),
(49, 1, 'Custom Handling', 20),
(48, 1, 'None', 5),
(50, 1, 'Same Day Shipping', 30),
(51, 1, 'Quality Design', 10),
(52, 1, 'Download: Windows - Spanish', 20),
(65, 1, 'per Foot', 10),
(66, 1, 'per Yard', 20),
(67, 1, 'Free Shipping Included!', 10),
(68, 1, 'Book Hard Cover', 5);

#
# Dumping data for table `products_options_values_to_products_options`
#

INSERT INTO products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) VALUES (1, 4, 1),
(2, 4, 2),
(3, 4, 3),
(4, 4, 4),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 5, 10),
(13, 5, 13),
(14, 6, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 2, 18),
(19, 2, 19),
(20, 2, 20),
(21, 2, 21),
(22, 6, 22),
(23, 6, 23),
(24, 5, 24),
(61, 8, 0),
(60, 7, 0),
(59, 12, 0),
(58, 11, 0),
(57, 10, 0),
(56, 9, 0),
(35, 1, 25),
(36, 1, 26),
(37, 1, 27),
(38, 1, 28),
(39, 1, 29),
(40, 1, 30),
(41, 1, 31),
(42, 1, 32),
(89, 5, 64),
(55, 13, 36),
(54, 13, 35),
(53, 13, 34),
(62, 2, 37),
(63, 14, 38),
(64, 14, 39),
(65, 14, 40),
(66, 14, 41),
(67, 14, 42),
(68, 14, 43),
(69, 13, 44),
(70, 1, 45),
(71, 4, 46),
(72, 13, 47),
(73, 13, 48),
(74, 15, 49),
(75, 15, 50),
(76, 15, 51),
(77, 5, 52),
(78, 16, 53),
(79, 16, 54),
(80, 16, 55),
(81, 16, 56),
(82, 16, 57),
(83, 16, 58),
(84, 16, 59),
(85, 16, 60),
(86, 16, 61),
(87, 17, 62),
(88, 17, 63),
(90, 18, 65),
(91, 18, 66),
(92, 19, 67),
(93, 5, 68);

#
# Dumping data for table `products_to_categories`
#

INSERT INTO products_to_categories (products_id, categories_id) VALUES (1, 4),
(2, 4),
(3, 9),
(4, 10),
(5, 11),
(5, 22),
(6, 10),
(6, 22),
(7, 12),
(7, 22),
(8, 13),
(8, 22),
(9, 10),
(9, 22),
(10, 10),
(11, 10),
(11, 22),
(12, 10),
(12, 22),
(13, 10),
(13, 22),
(14, 15),
(14, 22),
(15, 14),
(15, 22),
(16, 15),
(16, 22),
(17, 10),
(17, 22),
(18, 10),
(19, 12),
(19, 22),
(20, 15),
(20, 22),
(21, 18),
(21, 22),
(22, 19),
(22, 22),
(23, 20),
(23, 22),
(24, 20),
(24, 22),
(25, 8),
(26, 9),
(27, 5),
(27, 22),
(28, 21),
(29, 21),
(30, 21),
(31, 21),
(32, 21),
(34, 22),
(36, 25),
(39, 24),
(40, 24),
(41, 28),
(42, 28),
(43, 24),
(44, 22),
(46, 22),
(47, 21),
(48, 23),
(49, 23),
(50, 23),
(51, 24),
(52, 24),
(53, 23),
(54, 23),
(55, 28),
(56, 28),
(57, 24),
(59, 23),
(60, 28),
(61, 28),
(74, 23),
(76, 28),
(78, 25),
(79, 23),
(80, 23),
(82, 27),
(83, 27),
(84, 23),
(85, 23),
(88, 31),
(89, 31),
(90, 45),
(92, 45),
(93, 46),
(94, 46),
(95, 51),
(96, 51),
(97, 32),
(98, 32),
(99, 23),
(100, 25),
(101, 47),
(104, 23),
(105, 22),
(106, 22),
(107, 23),
(108, 23),
(109, 23),
(110, 52),
(111, 52),
(112, 53),
(113, 53),
(114, 53),
(115, 53),
(116, 53),
(117, 53),
(118, 53),
(119, 53),
(120, 53),
(121, 53),
(122, 53),
(123, 53),
(127, 55),
(130, 55),
(131, 57),
(132, 58),
(133, 60),
(134, 57),
(154, 58),
(155, 56),
(156, 56),
(157, 56),
(158, 56),
(159, 56),
(160, 61),
(165, 61),
(166, 62),
(167, 63),
(168, 64),
(169, 64),
(170, 64),
(171, 63),
(171, 64),
(172, 64),
(173, 61),
(174, 24),
(175, 55),
(176, 55),
(177, 55),
(178, 55),
(179, 60);

#
# Dumping data for table `record_artists`
#

INSERT INTO record_artists (artists_id, artists_name, artists_image, date_added, last_modified) VALUES (1, 'The Russ Tippins Band', 'sooty.jpg', '2019-06-18 20:53:00', NULL);

#
# Dumping data for table `record_artists_info`
#

INSERT INTO record_artists_info (artists_id, languages_id, artists_url, url_clicked, date_last_click) VALUES (1, 1, 'www.russtippins.com/', 0, NULL);

#
# Dumping data for table `record_company`
#

INSERT INTO record_company (record_company_id, record_company_name, record_company_image, date_added, last_modified) VALUES (1, 'HMV Group', NULL, '2019-06-18 14:11:52', NULL);

#
# Dumping data for table `record_company_info`
#

INSERT INTO record_company_info (record_company_id, languages_id, record_company_url, url_clicked, date_last_click) VALUES (1, 1, 'www.hmvgroup.com', 0, NULL);

#
# Dumping data for table `reviews`
#

INSERT INTO reviews (reviews_id, products_id, customers_id, customers_name, reviews_rating, date_added, last_modified, reviews_read, status) VALUES (1, 19, 0, 'Bill Smith', 5, '2019-06-18 03:18:19', '0001-01-01 00:00:00', 11, 1);

#
# Dumping data for table `reviews_description`
#

INSERT INTO reviews_description (reviews_id, languages_id, reviews_text) VALUES (1, 1, 'This really is a very funny but old movie!');

#
# Dumping data for table `salemaker_sales`
#

INSERT INTO salemaker_sales (sale_id, sale_status, sale_name, sale_deduction_value, sale_deduction_type, sale_pricerange_from, sale_pricerange_to, sale_specials_condition, sale_categories_selected, sale_categories_all, sale_date_start, sale_date_end, sale_date_added, sale_date_last_modified, sale_date_status_change) VALUES (1, 1, 'Minus 10% Sale', '10.0000', 1, '1.0000', '1000.0000', 2, '25,28,45,47,58', ',25,28,45,47,58,', '2019-06-18', '2007-02-21', '2019-06-18', '2012-05-18', '2019-06-18'),
(3, 0, 'Mice 20%', '20.0000', 1, '1.0000', '1000.0000', 2, '9', ',9,', '2019-06-18', '2012-04-21', '2019-06-18', '2019-06-18', '2012-04-25'),
(6, 1, '$5.00 off', '5.0000', 0, '0.0000', '0.0000', 2, '27', ',27,', '0001-01-01', '0001-01-01', '2019-06-18', '2019-06-18', '2019-06-18'),
(7, 1, '10% Skip Specials', '10.0000', 1, '0.0000', '0.0000', 1, '31', ',31,', '0001-01-01', '0001-01-01', '2019-06-18', '2012-05-18', '2019-06-18'),
(8, 1, '10% Apply to Price', '10.0000', 1, '0.0000', '0.0000', 0, '32', ',32,', '0001-01-01', '0001-01-01', '2019-06-18', '2012-05-18', '2019-06-18'),
(9, 1, 'New Price $100', '100.0000', 2, '0.0000', '0.0000', 2, '46', ',46,', '0001-01-01', '0001-01-01', '2019-06-18', '2019-06-18', '2019-06-18'),
(10, 1, 'New Price $100 Skip Special', '100.0000', 2, '0.0000', '0.0000', 1, '51', ',51,', '0001-01-01', '0001-01-01', '2019-06-18', '2019-06-18', '2019-06-18'),
(11, 1, '$5.00 off Skip Specials', '5.0000', 0, '0.0000', '0.0000', 1, '52', ',52,', '0001-01-01', '0001-01-01', '2019-06-18', '2019-06-18', '2019-06-18');

#
# Dumping data for table `specials`
#

INSERT INTO specials (specials_id, products_id, specials_new_products_price, specials_date_added, specials_last_modified, expires_date, date_status_change, status, specials_date_available) VALUES (1, 3, '39.9900', '2019-06-18 03:18:19', '0001-01-01 00:00:00', '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(2, 5, '30.0000', '2019-06-18 03:18:19', '0001-01-01 00:00:00', '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(3, 6, '30.0000', '2019-06-18 03:18:19', '0001-01-01 00:00:00', '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(4, 16, '29.9900', '2019-06-18 03:18:19', '0001-01-01 00:00:00', '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(5, 41, '90.0000', '2019-06-18 19:15:47', '2012-09-27 13:33:33', '2007-02-21', '0001-01-01 00:00:00', 1, '0001-01-01'),
(6, 42, '95.0000', '2019-06-18 19:15:57', '2019-06-18 13:07:27', '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(7, 44, '90.0000', '2019-06-18 21:54:50', NULL, '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(8, 46, '90.0000', '2019-06-18 21:55:01', NULL, '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(9, 53, '20.0000', '2019-06-18 23:59:03', NULL, '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(10, 39, '75.0000', '2019-06-18 02:03:59', '2012-02-21 00:36:40', '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(40, 100, '374.2500', '2019-06-18 14:07:31', NULL, '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(42, 111, '90.0000', '2019-06-18 16:14:19', NULL, '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(14, 74, '399.2000', '2019-06-18 15:35:30', '2019-06-18 17:38:43', '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(29, 78, '112.5000', '2019-06-18 01:12:14', NULL, '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(27, 59, '300.0000', '2019-06-18 01:51:50', NULL, '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(28, 76, '75.0000', '2019-06-18 23:09:36', NULL, '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(32, 85, '90.0000', '2019-06-18 15:19:59', '2019-06-18 09:59:59', '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(31, 83, '90.0000', '2019-06-18 15:03:07', '2019-06-18 10:02:25', '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(34, 88, '90.0000', '2019-06-18 00:16:22', '2019-06-18 09:59:30', '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(35, 90, '90.0000', '2019-06-18 23:57:20', NULL, '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(36, 94, '90.0000', '2019-06-18 00:07:34', NULL, '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(39, 97, '90.0000', '2019-06-18 11:29:03', NULL, '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(38, 95, '90.0000', '2019-06-18 02:39:58', NULL, '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01'),
(44, 130, '10.0000', '2012-04-28 02:46:44', NULL, '0001-01-01', NULL, 1, '0001-01-01'),
(45, 173, '47.5000', '2012-09-24 23:57:05', NULL, '2012-09-28', '2012-09-28 18:48:42', 0, '0001-01-01'),
(46, 166, '3.0000', '2019-06-18 20:24:53', NULL, '0001-01-01', NULL, 1, '0001-01-01'),
(47, 177, '75.0000', '2019-06-18 16:49:33', NULL, '0001-01-01', NULL, 1, '0001-01-01'),
(48, 178, '50.0000', '2019-06-18 16:56:46', NULL, '0001-01-01', NULL, 1, '0001-01-01'),
(50, 40, '75.0000', '2019-06-18 14:07:31', NULL, '0001-01-01', '0001-01-01 00:00:00', 1, '0001-01-01');
############ GERMAN DEMO
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (1, 43, 'Hardware', 'Wir bieten verschiedenste Hardware von Druckern, über Grafikkarten bis in zu Mäusen und Tastaturen.');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (2, 43, 'Software', 'Wählen Sie aus einer spannenden Liste von Softwaretiteln.');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (3, 43, 'DVD', 'Wir bieten eine Vielzahl von DVD-Filmen für die ganze Familie an.<br /><br />Bitte durchsuchen Sie die verschiedenen Kategorien, um Ihren Lieblingsfilm zu finden!');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (4, 43, 'Grafikkarten', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (5, 43, 'Drucker', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (6, 43, 'Monitore', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (7, 43, 'Lautsprecher', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (8, 43, 'Tastaturen', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (9, 43, 'Mäuse', 'Wählen Sie die Computermaus, die am besten zu Ihren Bedürfnissen passt!<br /><br />Kontaktieren Sie uns, wenn Sie nach einer bestimmten Maus suchen, die wir derzeit nicht auf Lager haben.');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (10, 43, 'Action', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (11, 43, 'Science Fiction', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (12, 43, 'Komödien', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (13, 43, 'Cartoons', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (14, 43, 'Thriller', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (15, 43, 'Drama', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (16, 43, 'Speicher', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (17, 43, 'CDROM Laufwerke', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (18, 43, 'Simulation', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (19, 43, 'Action', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (20, 43, 'Strategie', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (60, 43, 'Downloads', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (58, 43, 'Real Sale', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (21, 43, 'Geschenkgutscheine', 'Verschenken Sie einen Geschenkgutschein!<br /><br />Geschenkgutscheine können für alle Artikel in unserem Shop eingelöst werden.');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (57, 43, 'Textpreise', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (56, 43, 'Attribute', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (22, 43, 'Verlinkte Artikel', 'All diese Artikel sind &quot;Verlinkte Artikel&quot;.<br /><br />Das bedeutet, dass sie in mehreren Kategorien erscheinen.<br /><br />Es gibt aber in Wirklichkeit nur einen Artikel, den Sie für Preis, Artiklebeschreibung usw. bearbeiten müssen.');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (55, 43, 'Mengenrabatte', '<p>Rabatt Mengen können für Produkte oder für die einzelnen Attribute festgelegt werden.<br /><br />Rabatte auf einen Artikel wirken sich NICHT auf Attributpreise aus.<br /><br />Auf Attributpreise werden nur Rabatte basierend auf Sonderangeboten angewendet.</p>');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (23, 43, 'Testbeispiele', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (24, 43, 'Für Preis anrufen', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (25, 43, 'Test 10% per Attribut', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (27, 43, '5 € reduziert', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (28, 43, 'Test 10%', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (31, 43, 'Minus 10% Ausnahme', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (32, 43, 'Minus 10% Preis', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (47, 43, 'Minus 10% Attribut', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (33, 43, 'Eine Hauptkategorie', '<p>Dies ist ein Beschreibungstext für eine Hauptkategorie.</p>');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (34, 43, 'Unterkategorie 2 A', 'Dies ist ein Beschreibungstext für eine Unterkategorie.');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (35, 43, 'Unterkategorie 2 B', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (36, 43, 'Unterkategorie 2 C', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (37, 43, 'Sub Sub Cat 2B1', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (38, 43, 'Sub Sub Cat 2B2', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (39, 43, 'Sub Sub Cat 2B3', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (40, 43, 'Sub Sub Cat 2A1', 'This is a sub-sub level categories description.');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (41, 43, 'Sub Sub Cat 2C1', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (42, 43, 'Sub Sub Cat 2C3', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (43, 43, 'Sub Sub Cat 2A2', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (44, 43, 'Sub Sub Cat 2C2', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (45, 43, 'Minus 10%', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (46, 43, 'Set $100', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (48, 43, 'Abverkauf nach %', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (49, 43, 'Abverkauf Fixbetrag', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (50, 43, 'Abverkauf neuer Preis', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (51, 43, 'Set $100 Skip', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (52, 43, '$5.00 off Skip', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (53, 43, 'Big Unlinked', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (54, 43, 'Spezialfunktionen', '<p>Diese Artikel zeigen einige Spezialfunktionen.<br /><br />Nehmen Sie sich die Zeit, diese und die anderen Demo-Produkte genau anzusehen, um alle Optionen und Funktionen von Zen Cart besser zu verstehen.</p>');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (61, 43, 'Real', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (62, 43, 'Musik', '');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (63, 43, 'Dokumente', 'Dokumente können in den Kategoriebaum aufgenommen werden. Zum Beispiel möchten Sie möglicherweise Technische Dokumente anbieten. Oder Dokumente als ein integriertes FAQ System auf Ihrer Seite anbietene. Die Implementierung hier ist ziemlich spartanisch, könnte aber erweitert werden, um PDF-Downloads und Links zu käuflichen Download-Dateien anzubieten.');
INSERT INTO categories_description (categories_id, language_id, categories_name, categories_description) VALUES (64, 43, 'Gemischte Artikeltypen', '<p>Diese Kategorie zeigt die Verwendung verschiedener Artikeltypen</p><p>Inkludiert sind sowohl Artikel als auch Dokumentes.</p><p>Es gibt zwei Arten von Dokumenten: Kostenlose rein zum Lesen und kostenpflichtige, die gekauft werden können.');
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (1, 43, 'http://www.matrox.com', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (2, 43, 'http://www.microsoft.com', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (3, 43, 'http://www.warner.com', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (4, 43, 'http://www.fox.com', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (5, 43, 'http://www.logitech.com', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (6, 43, 'http://www.canon.com', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (7, 43, 'http://www.sierra.com', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (8, 43, 'http://www.infogrames.com', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (9, 43, 'http://www.hewlettpackard.com', 0, NULL);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (1, 43, 'Matrox G200 MMS', 'Matrox Graphics Inc. hat seine Position als Vorreiter auf dem Gebiet der Multimonitore weiter ausgebaut und damit erneut die flexibelste und fortschrittlichste Lösung der Branche entwickelt. Einführung der neuen Matrox G200 Multi-Monitor-Serie; Dies ist die erste Grafikkarte, die bis zu vier DVI-Digital-Flachbildschirme auf einer einzigen 8-Zoll-PCI-Karte unterstützt.<br/><br/>Mit der anhaltenden Nachfrage nach digitalen Flachbildschirmen am Finanzarbeitsplatz ist die Matrox G200 MMS die ultimative Lösung für flexible Lösungen. Die Matrox G200 MMS unterstützt auch die neue Digital Video Interface (DVI), die von der Digital Display Working Group (DDWG) entwickelt wurde, um die Akzeptanz von digitalen Flachbildschirmen zu erleichtern. Zu den weiteren Konfigurationen gehören die Fähigkeit zur Aufnahme von Composite-Videos und der integrierte TV-Tuner. Damit ist die Matrox G200 MMS die Komplettlösung für geschäftliche Anforderungen.<br/><br/>Basierend auf dem preisgekrönten MGA-G200-Grafikchip bietet die Matrox G200 Multi-Monitor-Serie überlegene 2D / 3D-Grafikbeschleunigung, um die anspruchsvollen Anforderungen von Geschäftsanwendungen wie Echtzeit-Aktienkursen (Versus), Live-Video-Feeds (Reuters) zu erfüllen & Bloombergs), mehrere Windows-Anwendungen, Textverarbeitung, Tabellenkalkulation und CAD.', 'www.matrox.com/mga/products/g200_mms/home.cfm', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (2, 43, 'Matrox G400 32MB', '<b>Dramatisch unterschiedliche Hochleistungsgrafik</b><br/><br/>Einführung der Millennium G400-Serie - ein völlig anderes, leistungsstarkes Grafik-Erlebnis. Die Millennium G400-Serie ist mit dem schnellsten Grafikchip der Branche ausgestattet. Sie ermöglicht eine explosionsartige Beschleunigung um zwei Schritte und bietet eine noch nie dagewesene Bildqualität sowie die vielseitigsten Anzeigeoptionen für alle Ihre 3D-, 2D- und DVD-Anwendungen. Als das leistungsstärkste und innovativste Werkzeug in Ihrem PC-Arsenal wird die Millennium G400-Serie nicht nur die Darstellung von Grafiken verändern, sondern auch die Art und Weise, wie Sie Ihren Computer verwenden, revolutionieren.<br/><br/>Hauptmerkmale:<ul><li>Neuer Matrox G400 256-Bit DualBus-Grafikchip</li><li>Explosive 3D-, 2D- und DVD-Performance</li><li>DualHead Anzeige</li><li>Hervorragende DVD- und TV-Ausgabe</li><li>3D-Umgebung-Mapped Bump Mapping</li><li>Lebendige Farbwiedergabe</li><li>UltraSharp DAC von bis zu 360 MHz</li><li>3D-Rendering-Array-Prozessor</li><li>Unterstützung für 16 oder 32 MB Speicher</li></ul>', 'www.matrox.com/mga/products/mill_g400/home.htm', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (3, 43, 'Microsoft IntelliMouse Pro', 'Every element of IntelliMouse Pro - from its unique arched shape to the texture of the rubber grip around its base - is the product of extensive customer and ergonomic research. Microsoft''s popular wheel control, which now allows zooming and universal scrolling functions, gives IntelliMouse Pro outstanding comfort and efficiency.', 'www.microsoft.com/hardware/mouse/intellimouse.asp', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (4, 43, 'The Replacement Killers', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 80 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.replacement-killers.com', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (5, 43, 'Blade Runner - Director''s Cut Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 112 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.bladerunner.com', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (6, 43, 'The Matrix Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br>\r\nLanguages: English, Deutsch.\r\n<br>\r\nSubtitles: English, Deutsch.\r\n<br>\r\nAudio: Dolby Surround.\r\n<br>\r\nPicture Format: 16:9 Wide-Screen.\r\n<br>\r\nLength: (approx) 131 minutes.\r\n<br>\r\nOther: Interactive Menus, Chapter Selection, Making Of.', 'www.thematrix.com', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (7, 43, 'You''ve Got Mail Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br />Languages: English, Deutsch, Spanish. <br />Subtitles: English, Deutsch, Spanish, French, Nordic, Polish. <br />Audio: Dolby Digital 5.1. <br />Picture Format: 16:9 Wide-Screen. <br />Length: (approx) 115 minutes. <br />Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.youvegotmail.com', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (8, 43, 'A Bug''s Life Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br />Languages: English, Deutsch. <br />Subtitles: English, Deutsch, Spanish. <br />Audio: Dolby Digital 5.1 / Dobly Surround Stereo. <br />Picture Format: 16:9 Wide-Screen. <br />Length: (approx) 91 minutes. <br />Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.abugslife.com', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (9, 43, 'Under Siege Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br />Languages: English, Deutsch. <br />Subtitles: English, Deutsch, Spanish. <br />Audio: Dolby Surround 5.1. <br />Picture Format: 16:9 Wide-Screen. <br />Length: (approx) 98 minutes. <br />Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (10, 43, 'Under Siege 2 - Dark Territory', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 98 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (11, 43, 'Fire Down Below Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br>\r\nLanguages: English, Deutsch.\r\n<br>\r\nSubtitles: English, Deutsch, Spanish.\r\n<br>\r\nAudio: Dolby Surround 5.1.\r\n<br>\r\nPicture Format: 16:9 Wide-Screen.\r\n<br>\r\nLength: (approx) 100 minutes.\r\n<br>\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (12, 43, 'Die Hard With A Vengeance Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa). <br />Languages: English, Deutsch. <br />Subtitles: English, Deutsch, Spanish. <br />Audio: Dolby Surround 5.1. <br />Picture Format: 16:9 Wide-Screen. <br />Length: (approx) 122 minutes. <br />Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (13, 43, 'Lethal Weapon Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br>\r\nLanguages: English, Deutsch.\r\n<br>\r\nSubtitles: English, Deutsch, Spanish.\r\n<br>\r\nAudio: Dolby Surround 5.1.\r\n<br>\r\nPicture Format: 16:9 Wide-Screen.\r\n<br>\r\nLength: (approx) 100 minutes.\r\n<br>\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (14, 43, 'Red Corner Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br>\r\nLanguages: English, Deutsch.\r\n<br>\r\nSubtitles: English, Deutsch, Spanish.\r\n<br>\r\nAudio: Dolby Surround 5.1.\r\n<br>\r\nPicture Format: 16:9 Wide-Screen.\r\n<br>\r\nLength: (approx) 117 minutes.\r\n<br>\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (15, 43, 'Frantic Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br>\r\nLanguages: English, Deutsch.\r\n<br>\r\nSubtitles: English, Deutsch, Spanish.\r\n<br>\r\nAudio: Dolby Surround 5.1.\r\n<br>\r\nPicture Format: 16:9 Wide-Screen.\r\n<br>\r\nLength: (approx) 115 minutes.\r\n<br>\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (16, 43, 'Courage Under Fire Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br>\r\nLanguages: English, Deutsch.\r\n<br>\r\nSubtitles: English, Deutsch, Spanish.\r\n<br>\r\nAudio: Dolby Surround 5.1.\r\n<br>\r\nPicture Format: 16:9 Wide-Screen.\r\n<br>\r\nLength: (approx) 112 minutes.\r\n<br>\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (17, 43, 'Speed Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br>\r\nLanguages: English, Deutsch.\r\n<br>\r\nSubtitles: English, Deutsch, Spanish.\r\n<br>\r\nAudio: Dolby Surround 5.1.\r\n<br>\r\nPicture Format: 16:9 Wide-Screen.\r\n<br>\r\nLength: (approx) 112 minutes.\r\n<br>\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (18, 43, 'Speed 2: Cruise Control', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 120 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (19, 43, 'There''s Something About Mary Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br>\r\nLanguages: English, Deutsch.\r\n<br>\r\nSubtitles: English, Deutsch, Spanish.\r\n<br>\r\nAudio: Dolby Surround 5.1.\r\n<br>\r\nPicture Format: 16:9 Wide-Screen.\r\n<br>\r\nLength: (approx) 114 minutes.\r\n<br>\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (20, 43, 'Beloved Linked', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br>\r\nLanguages: English, Deutsch.\r\n<br>\r\nSubtitles: English, Deutsch, Spanish.\r\n<br>\r\nAudio: Dolby Surround 5.1.\r\n<br>\r\nPicture Format: 16:9 Wide-Screen.\r\n<br>\r\nLength: (approx) 164 minutes.\r\n<br>\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (21, 43, 'SWAT 3: Close Quarters Battle Linked', '<b>Windows 95/98</b><br /><br />211 in progress with shots fired. Officer down. Armed suspects with hostages. Respond Code 3! Los Angles, 2005, In the next seven days, representatives from every nation around the world will converge on Las Angles to witness the signing of the United Nations Nuclear Abolishment Treaty. The protection of these dignitaries falls on the shoulders of one organization, LAPD SWAT. As part of this elite tactical organization, you and your team have the weapons and all the training necessary to protect, to serve, and &quot;When needed&quot; to use deadly force to keep the peace. It takes more than weapons to make it through each mission. Your arsenal includes C2 charges, flashbangs, tactical grenades. opti-Wand mini-video cameras, and other devices critical to meeting your objectives and keeping your men free of injury. Uncompromised Duty, Honor and Valor!', 'www.swat3.com', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (22, 43, 'Unreal Tournament Linked', 'From the creators of the best-selling Unreal, comes Unreal Tournament. A new kind of single player experience. A ruthless multiplayer revolution.<br><br>This stand-alone game showcases completely new team-based gameplay, groundbreaking multi-faceted single player action or dynamic multi-player mayhem. It''s a fight to the finish for the title of Unreal Grand Master in the gladiatorial arena. A single player experience like no other! Guide your team of ''bots'' (virtual teamates) against the hardest criminals in the galaxy for the ultimate title - the Unreal Grand Master.', 'www.unrealtournament.net', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (23, 43, 'The Wheel Of Time Linked', 'The world in which The Wheel of Time takes place is lifted directly out of Jordan''s pages; it''s huge and consists of many different environments. How you navigate the world will depend largely on which game - single player or multipayer - you''re playing. The single player experience, with a few exceptions, will see Elayna traversing the world mainly by foot (with a couple notable exceptions). In the multiplayer experience, your character will have more access to travel via Ter''angreal, Portal Stones, and the Ways. However you move around, though, you''ll quickly discover that means of locomotion can easily become the least of the your worries...<br><br>During your travels, you quickly discover that four locations are crucial to your success in the game. Not surprisingly, these locations are the homes of The Wheel of Time''s main characters. Some of these places are ripped directly from the pages of Jordan''s books, made flesh with Legend''s unparalleled pixel-pushing ways. Other places are specific to the game, conceived and executed with the intent of expanding this game world even further. Either way, they provide a backdrop for some of the most intense first person action and strategy you''ll have this year.', 'www.wheeloftime.com', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (24, 43, 'Disciples: Sacred Lands Linked', 'A new age is dawning...<br><br>Enter the realm of the Sacred Lands, where the dawn of a New Age has set in motion the most momentous of wars. As the prophecies long foretold, four races now clash with swords and sorcery in a desperate bid to control the destiny of their gods. Take on the quest as a champion of the Empire, the Mountain Clans, the Legions of the Damned, or the Undead Hordes and test your faith in battles of brute force, spellbinding magic and acts of guile. Slay demons, vanquish giants and combat merciless forces of the dead and undead. But to ensure the salvation of your god, the hero within must evolve.<br><br>The day of reckoning has come... and only the chosen will survive.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (25, 43, 'Microsoft Internet Keyboard PS/2', 'The Internet Keyboard has 10 Hot Keys on a comfortable standard keyboard design that also includes a detachable palm rest. The Hot Keys allow you to browse the web, or check e-mail directly from your keyboard. The IntelliType Pro software also allows you to customize your hot keys - make the Internet Keyboard work the way you want it to!', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (26, 43, 'Microsoft IntelliMouse Explorer', 'Microsoft introduces its most advanced mouse, the IntelliMouse Explorer! IntelliMouse Explorer features a sleek design, an industrial-silver finish, a glowing red underside and taillight, creating a style and look unlike any other mouse. IntelliMouse Explorer combines the accuracy and reliability of Microsoft IntelliEye optical tracking technology, the convenience of two new customizable function buttons, the efficiency of the scrolling wheel and the comfort of expert ergonomic design. All these great features make this the best mouse for the PC!', 'www.microsoft.com/hardware/mouse/explorer.asp', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (27, 43, 'Hewlett Packard LaserJet 1100Xi Linked', 'HP has always set the pace in laser printing technology. The new generation HP LaserJet 1100 series sets another impressive pace, delivering a stunning 8 pages per minute print speed. The 600 dpi print resolution with HP''s Resolution Enhancement technology (REt) makes every document more professional.<br><br>Enhanced print speed and laser quality results are just the beginning. With 2MB standard memory, HP LaserJet 1100xi users will be able to print increasingly complex pages. Memory can be increased to 18MB to tackle even more complex documents with ease. The HP LaserJet 1100xi supports key operating systems including Windows 3.1, 3.11, 95, 98, NT 4.0, OS/2 and DOS. Network compatibility available via the optional HP JetDirect External Print Servers.<br><br>HP LaserJet 1100xi also features The Document Builder for the Web Era from Trellix Corp. (featuring software to create Web documents).', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (28, 43, 'Geschenkgutschein €  5.00', 'Purchase a Geschenkgutschein today to share with your family, friends or business associates!', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (29, 43, 'Geschenkgutschein € 10.00', 'Purchase a Geschenkgutschein today to share with your family, friends or business associates!', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (30, 43, 'Geschenkgutschein € 25.00', 'Purchase a Geschenkgutschein today to share with your family, friends or business associates!', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (31, 43, 'Geschenkgutschein € 50.00', 'Purchase a Geschenkgutschein today to share with your family, friends or business associates!', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (32, 43, 'Geschenkgutschein $100.00', 'Purchase a Geschenkgutschein today to share with your family, friends or business associates!', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (34, 43, 'A Bug''s Life "Multi Pak" Special 2003 Collectors Edition', 'A Bug''s Life "Multi Pak" Special 2003 Collectors Edition\r\n<br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).\r\n<br>\r\nLanguages: English, Deutsch.\r\n<br>\r\nSubtitles: English, Deutsch, Spanish.\r\n<br>\r\nAudio: Dolby Digital 5.1 / Dobly Surround Stereo.\r\n<br>\r\nPicture Format: 16:9 Wide-Screen.\r\n<br>\r\nLength: (approx) 91 minutes.\r\n<br>\r\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.abugslife.com', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (36, 43, 'Hewlett Packard - by attributes SALE', 'The Product Price is set to 0.00\r\n<br><br>\r\n\r\nThe Product Priced by Attribute is set to YES\r\n<br><br>\r\n\r\nThe attribute prices are defined without the price prefix of +\r\n<br><br>\r\n\r\nThe Display Price is made up of the lowest attribute price from each Option Name group.\r\n<br><br>\r\n\r\nIf there had been a Product Price, this would have been added together to the lowest attributes price from each of the Option Name groups to make up the display price.\r\n<br><br>\r\n\r\nThe price prefix of the + is not used as we are not "adding" to the display price.\r\n<br><br>\r\n\r\nThe Colors attributes are set for the discount to be applied, their prices before the discount are:<br>\r\nWhite $499.99<br>\r\nBlack $519.00<br>\r\nBlue $539.00<br>', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (57, 43, 'A Free Product - All', 'This is a free product where there are no prices at all.\r\n<br><br>\r\n\r\nThe Always Free Shipping is also turned ON.\r\n<br><br>\r\n\r\nIf this is bought seperately, the Zen Cart Free Charge payment module will show if there is no charges on shipping.\r\n<br><br>\r\n\r\nIf other products are purchased with a price or shipping charge, then the Zen Cart Free Charge payment module will not show and the shipping will be applied accordingly.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (101, 43, 'TEST $120 Sale 10% Special off', 'Product is Priced by Attribute.\r\n<br><br>\r\n\r\nAttribute Option Group: Color and Size are used for pricing by marking these as Included in Base Price.\r\n<br><br>\r\n\r\nGift Options has everything marked included in base price also, but because None is set to $0.00 that groups lowest price is $0.00 so it is not affecting the Base Price.\r\n<br><br>\r\n\r\nIf None was not part of this group and you did not want to include those prices, you would mark all of the Gift Option Attribute to NOT be included in the Base Price.\r\n<br><br>\r\n\r\nProduct Product is $0.00\r\n<br><br>\r\n\r\nSpecial does not exist\r\n<br><br>\r\nSale Price is 10%\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (100, 43, 'Hewlett Packard - by attributes SALE with Special', 'The Product Price is set to 0.00\r\n<br><br>\r\n\r\nThe Product Priced by Attribute is set to YES\r\n<br><br>\r\n\r\nThe attribute prices are defined without the price prefix of +\r\n<br><br>\r\n\r\nThe Display Price is made up of the lowest attribute price from each Option Name group.\r\n<br><br>\r\n\r\nIf there had been a Product Price, this would have been added together to the lowest attributes price from each of the Option Name groups to make up the display price.\r\n<br><br>\r\n\r\nThe price prefix of the + is not used as we are not "adding" to the display price.\r\n<br><br>\r\n\r\nThe Colors attributes are set for the discount to be applied, their prices before the discount are:<br>\r\nWhite $499.99<br>\r\nBlack $519.00<br>\r\nBlue $539.00<br>', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (39, 43, 'A Free Product', 'This is a free product that is also on special.\r\n<br><br>\r\n\r\nThis should show as having a price, special price but then be free.\r\n<br><br>\r\n\r\nWhile this is a FREE product, this does have Shipping.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (40, 43, 'A Call for Price Product', 'This is a Call for Price product that is also on special.\r\n<br>\r\n\r\nThis should show as having a price, special price but then be Call for Price. This means you cannot buy it.\r\n<br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (41, 43, 'A Call for Price Product SALE', 'This is a Call for Price product that is also on special and has a Sale price via Sale Maker.\r\n<br><br>\r\n\r\nThis should show as having a price, special price but then be Call for Price. This means you cannot buy it.\r\n<br><br>\r\n\r\nThe Add to Cart buttons automatically change to Call for Price, which is defined as: TEXT_CALL_FOR_PRICE\r\n<br><br>\r\n\r\nThis link will take the customer to the Contact Us page.\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (42, 43, 'A Free Product - SALE', 'This is a free product that is also on special.\r\n<br>\r\n\r\nThis should show as having a price, special price but then be free.\r\n<br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (43, 43, 'A Free Product with Attribute', 'This is a free product that is also on special.\r\n<br><br>\r\n\r\nThis should show as having a price, special price but then be free.\r\n<br><br>\r\n\r\nAttributes can be added that can optionally be set to free or not free\r\n<br><br>\r\n\r\nThe Color Red attribute is priced at $5.00 but marked as a Free Attribute when the Product is Free\r\n<br><br>\r\n\r\nThe Size Medium attribute is priced at $1.00 but marked as a Free Attribute when Product is Free', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (44, 43, 'A Mixed OFF Product with Attribute', 'This product has attributes and a minimum qty and units.\r\n<br><br>\r\n\r\nMixed is OFF this means you CANNOT mix attributes to make the minimums and units.\r\n<br><br>\r\n\r\nThe Size Option Value: Select from Below ... is a Display Only Attribute. \r\n<br><br>\r\n\r\nThis means that the product cannot be added to the Shopping Cart if that Option Value is selected. If it is still selected, then an error is triggered when the Add to Cart is pressed with a warning to the customer on what the error is.\r\n<br><br>\r\n\r\nNo checkout is allowed when errors exist.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (46, 43, 'A Mixed ON Product with Attribute', 'This product has attributes and a minimum qty and units.\r\n<br><br>\r\n\r\nMixed is ON this means you CAN mix attributes to make the minimums and units.\r\n<br><br>\r\n\r\nSelect from Below is a Display Only Attribute. This means that it cannot be added to the cart. If it is, then an error is triggered.\r\n<br><br>\r\n\r\nNo checkout is allowed when errors exist.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (47, 43, 'Geschenkgutscheine by attribtues', 'Priced by Attribute Geschenkgutscheine.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (48, 43, 'Test 1', 'This is a test product for copying and deleting attributes.\r\n<br><br>\r\nAll of the images for this product are in the main /images directory and /large directory.\r\n<br><br>\r\nThe main products_image is called 1_small.jpg\r\n<br><br>\r\nThere are additional images for this product that will auto load located in /images called:<br>\r\n1_small_01.jpg<br>\r\n1_small_02.jpg<br>\r\n1_small_03.jpg<br>\r\n<br>\r\nThe large additional images are in /images/large called:<br>\r\n1_small_01_LRG.jpg<br>\r\n1_small_02_LRG.jpg<br>\r\n1_small_03_LRG.jpg<br>\r\n\r\n<br><br>\r\n\r\nThe naming conventions for the additional images do not require that they be numeric. Using the numberic system helps establish the sort order of the images and how they will display.\r\n<br><br>\r\n\r\nWhat is important is that all the additional images be located in the same directory and start with the same name: 1_small and end in the same extenion: .jpg\r\n<br><br>\r\n\r\nThe additional large images need to be located in the /large directory and use the same name plus the Large image suffix, defined in the Admin ... Images ... in this case _LRG\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (49, 43, 'Test 2', 'This is a test product for copying and deleting attributes.\r\n<br><br>\r\n\r\nThis was made using the Attribute Copy to Product in the new Admin ... Catalog ... Attribute Controller ... and copying the Attribute from the Test 1 product to Test 2.\r\n<br><br>\r\n\r\nThis product does not have any additional images.\r\n<br><br>\r\n\r\nIt does have a Large image located in /large\r\n<br><br>\r\n\r\nThis uses the same name: 2_small plus the large image suffix _LRG plus the matching extention .jpg to give the new name: /images/large/2_small_LRG.jpg\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (50, 43, 'Test 3', 'This is a test product for copying and deleting attributes.\r\n<br><br>\r\n\r\nThis was made using the Attribute Copy to Product in the new Admin ... Catalog ... Attribute Controller ... and copying the attributes from the Test 2 product to Test 3.\r\n<br><br>\r\n\r\nThis product does not have any additional images.\r\n<br><br>\r\n\r\nIt does NOT have a Large image located in /large\r\n<br><br>\r\n\r\nThis means that when you click on the image for enlarge, unless the original image is larger than the small image settings you will see the same image in the popup.\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (51, 43, 'Free Ship & Payment Virtual weight 10', 'Free Shipping and Payment\r\n<br><br>\r\n\r\nThe Price is set to 25.00 ... but what makes it Free is that this product has been marked as:\r\n<br>\r\nProduct is Free: Yes\r\n<br><br>\r\n\r\nThis would allow the product to be listed with a price, but the actual charge is $0.00\r\n<br><br>\r\n\r\nThe weight is set to 10 but could be set to 0. What really makes it truely Free Shipping is that it has been marked to be Always Free Shipping.\r\n<br><br>\r\n\r\nAlways Free shipping is set to: Yes<br>\r\nThis will not charge for shipping, but requres a shipping address.\r\n<br><br>\r\n\r\nBecause there is no shipping and the price is 0, the Zen Cart Free Charge comes up for the payment module and the other payment modules vanish.\r\n<br><br>\r\n\r\nYou can change the text on the Zen Cart Free Charge module to read as you would prefer.\r\n<br><br>\r\n\r\nNote: if you add products that incur a charge or shipping charge, then the Zen Cart Free Charge payment module will vanish and the regular payment modules will show.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (52, 43, 'Free Ship & Payment Virtual', 'Product Price is set to 0\r\n<br><br>\r\n\r\nPayment weight is set to 2 ...\r\n<br><br>\r\n\r\nVirtual is ON ... this will skip shipping address\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (53, 43, 'Min and Units MIX', 'This product is purchased based on minimums and units.\r\n<br><br>\r\n\r\nThe Min is set to 6 and the units is set to 3\r\n<br><br>\r\n\r\nQuantity Minimums and Units are designed to more or less force the customer to make purchases of a Minimum Quantity ... and if need be, in Units.\r\n<br><br>\r\n\r\nThis product can only be purchased if you buy at least 6 ... and after that in units of 3 ... 9, 12, 15, 18, etc.\r\n<br><br>\r\n\r\nIf you do not purchase it in the right Quantity, you will not be able to checkout.\r\n<br><br>\r\n\r\nWhen adding to the cart, the quantity box on the product_info page is "smart". It will adjust itself based on what is in the cart.\r\n<br><br>\r\n\r\nThe Add to Cart buttons are also smart on New Products and Product Listing ... these also will adjust what is added to the cart.\r\n<br><br>\r\n\r\nFor example: If there is 1 in the cart, the next use of Add to Cart will add 5 more to make the Minimum of 6. Add again and 3 more will be added to keep the Units correct.\r\n<br><br>\r\n\r\nProduct Quantity Min/Unit Mix is for when a product has attributes.\r\n<br><br>\r\n\r\nIf Mix is ON then a mix of attributes options may be used to make up the Quantity Minimum and Units. This means you can mix 1 blue, 3 silver and 2 green to get 6.\r\n<br><br>\r\n\r\nIf the Mix is OFF then you may not mix 2 blue, 2 silver and 2 green to get 6.\r\n<br><br>\r\n\r\nThis product has the Product Qty Min/Unit Mix set to ON', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (54, 43, 'Min and Units NOMIX', 'This product is purchased based on minimums and units.\r\n<br><br>\r\n\r\nThe Min is set to 6 and the units is set to 3\r\n<br><br>\r\n\r\nQuantity Minimums and Units are designed to more or less force the customer to make purchases of a Minimum Quantity ... and if need be, in Units.\r\n<br><br>\r\n\r\nThis product can only be purchased if you buy at least 6 ... and after that in units of 3 ... 9, 12, 15, 18, etc.\r\n<br><br>\r\n\r\nIf you do not purchase it in the right Quantity, you will not be able to checkout.\r\n<br><br>\r\n\r\nWhen adding to the cart, the quantity box on the product_info page is "smart". It will adjust itself based on what is in the cart.\r\n<br><br>\r\n\r\nThe Add to Cart buttons are also smart on New Products and Product Listing ... these also will adjust what is added to the cart.\r\n<br><br>\r\n\r\nFor example: If there is 1 in the cart, the next use of Add to Cart will add 5 more to make the Minimum of 6. Add again and 3 more will be added to keep the Units correct.\r\n<br><br>\r\n\r\nProduct Quantity Min/Unit Mix is for when a product has attributes.\r\n<br><br>\r\n\r\nIf Mix is ON then a mix of attributes options may be used to make up the Quantity Minimum and Units. This means you can mix 1 blue, 3 silver and 2 green to get 6.\r\n<br><br>\r\n\r\nIf the Mix is OFF then you may not mix 2 blue, 2 silver and 2 green to get 6.\r\n<br><br>\r\n\r\nThis product has the Product Qty Min/Unit Mix set to OFF', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (55, 43, 'Min and Units MIX - Sale', 'This product is purchased based on minimums and units.\r\n<br><br>\r\n\r\nThe Min is set to 6 and the units is set to 3\r\n<br><br>\r\n\r\nQuantity Minimums and Units are designed to more or less force the customer to make purchases of a Minimum Quantity ... and if need be, in Units.\r\n<br><br>\r\n\r\nThis product can only be purchased if you buy at least 6 ... and after that in units of 3 ... 9, 12, 15, 18, etc.\r\n<br><br>\r\n\r\nIf you do not purchase it in the right Quantity, you will not be able to checkout.\r\n<br><br>\r\n\r\nWhen adding to the cart, the quantity box on the product_info page is "smart". It will adjust itself based on what is in the cart.\r\n<br><br>\r\n\r\nThe Add to Cart buttons are also smart on New Products and Product Listing ... these also will adjust what is added to the cart.\r\n<br><br>\r\n\r\nFor example: If there is 1 in the cart, the next use of Add to Cart will add 5 more to make the Minimum of 6. Add again and 3 more will be added to keep the Units correct.\r\n<br><br>\r\n\r\nProduct Quantity Min/Unit Mix is for when a product has attributes.\r\n<br><br>\r\n\r\nIf Mix is ON then a mix of attributes options may be used to make up the Quantity Minimum and Units. This means you can mix 1 blue, 3 silver and 2 green to get 6.\r\n<br><br>\r\n\r\nIf the Mix is OFF then you may not mix 2 blue, 2 silver and 2 green to get 6.\r\n<br><br>\r\n\r\nThis product has the Product Qty Min/Unit Mix set to ON\r\n<br><br>\r\n\r\nThis product has been placed on Sale via Sale Maker', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (56, 43, 'Min and Units NOMIX - Sale', 'This product is purchased based on minimums and units.\r\n<br><br>\r\n\r\nThe Min is set to 6 and the units is set to 3\r\n<br><br>\r\n\r\nQuantity Minimums and Units are designed to more or less force the customer to make purchases of a Minimum Quantity ... and if need be, in Units.\r\n<br><br>\r\n\r\nThis product can only be purchased if you buy at least 6 ... and after that in units of 3 ... 9, 12, 15, 18, etc.\r\n<br><br>\r\n\r\nIf you do not purchase it in the right Quantity, you will not be able to checkout.\r\n<br><br>\r\n\r\nWhen adding to the cart, the quantity box on the product_info page is "smart". It will adjust itself based on what is in the cart.\r\n<br><br>\r\n\r\nThe Add to Cart buttons are also smart on New Products and Product Listing ... these also will adjust what is added to the cart.\r\n<br><br>\r\n\r\nFor example: If there is 1 in the cart, the next use of Add to Cart will add 5 more to make the Minimum of 6. Add again and 3 more will be added to keep the Units correct.\r\n<br><br>\r\n\r\nProduct Quantity Min/Unit Mix is for when a product has attributes.\r\n<br><br>\r\n\r\nIf Mix is ON then a mix of attributes options may be used to make up the Quantity Minimum and Units. This means you can mix 1 blue, 3 silver and 2 green to get 6.\r\n<br><br>\r\n\r\nIf the Mix is OFF then you may not mix 2 blue, 2 silver and 2 green to get 6.\r\n<br><br>\r\n\r\nThis product has the Product Qty Min/Unit Mix set to OFF\r\n<br><br>\r\n\r\nThis product has been put on Sale via Sale Maker.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (59, 43, 'Hewlett Packard - by attributes', 'The Product Price is set to 0.00\r\n<br><br>\r\n\r\nThe Product Priced by Attribute is set to YES\r\n<br><br>\r\n\r\nThe attribute prices are defined without the price prefix of +\r\n<br><br>\r\n\r\nThe Display Price is made up of the lowest attribute price from each Option Name group.\r\n<br><br>\r\n\r\nIf there had been a Product Price, this would have been added together to the lowest attributes price from each of the Option Name groups to make up the display price.\r\n<br><br>\r\n\r\nThe price prefix of the + is not used as we are not "adding" to the display price.\r\n<br><br>', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (60, 43, 'Hewlett Packard - Sale with Attribute on Sale', 'The Product Price is set to 499.75\r\n<br><br>\r\n\r\nA Sale Maker Discount of 10% is applied.\r\n<br><br>\r\n\r\nThe attribute are marked to be discounted also.\r\n<br><br>\r\n\r\nPrior to the discount being applied:<br>\r\nBlue +$20.00<br>\r\nBlack +$10.00<br>\r\nWhite $0.00\r\n<br><br>\r\n\r\n4 meg +$50.00<br>\r\n8 meg +$75.00<br>\r\n16 meg +$100.00\r\n<br><br>', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (61, 43, 'Hewlett Packard - Sale with Attribute NOT on Sale', 'The Product Price is set to 499.75\r\n<br><br>\r\n\r\nA Sale Maker Discount of 10% is applied.\r\n<br><br>\r\n\r\nThe attribute are marked NOT to be discounted.\r\n<br><br>\r\n\r\nPrior to the discount being applied:<br>\r\nBlue +$20.00<br>\r\nBlack +$10.00<br>\r\nWhite $0.00\r\n<br><br>\r\n\r\n4 meg +$50.00<br>\r\n8 meg +$75.00<br>\r\n16 meg +$100.00\r\n<br><br>', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (111, 43, 'TEST $120 Special $90.00 Sale -$5.00 Skip', 'Product is $120\r\n<br><br>\r\n\r\nSpecial $90.00 or 25% - Specials are Skipped\r\n<br><br>\r\n\r\nSale is -$5.00\r\n<br><br>\r\n\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (110, 43, 'TEST $120 Sale -$5.00 Skip', 'Product is $120\r\n<br><br>\r\nSale is -$5.00\r\n<br><br>\r\nSpecials are skipped\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (109, 43, 'Stückzahl verstecken Methods', 'This product does not show the Quantity Box when Adding to the Shopping Cart.\r\n<br><br>\r\n\r\nWhile Quantity Box Shows is set to YES, the Product Qty Max has been set to 1\r\n\r\nThis will add only 1 to the Shopping Cart when Add to Cart is hit.\r\n<br><br>\r\n\r\nThe reason for this is that this is a download. As a download, there is never a reason to allow more than quantity 1 to be ordered.\r\n<br><br>\r\n\r\nNOTE: If using Quantity Box Shows set to NO, unless Qty Max is also set to 1 then each time the Add to Cart is clicked the current cart quantity is updated by 1. If Qty Max is set to 1 then no more than 1 will be able to be added to the Shopping Cart per order.\r\n<br><br>\r\n\r\nTwo methods are available to trigger the Stückzahl verstecken.\r\n<br><br>\r\n\r\nMethod 1: Set Quantity Box Shows to NO\r\n<br><br>\r\n\r\nMethod 2: Set Qty Maximum to 1\r\n<br><br>\r\n\r\nIn either case, you will only be able to add qty 1 to the shopping cart and the quantity box will not show.\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (133, 43, 'Multiple Downloads', '<p>This product is set up to have multiple downloads.</p><p>The Product Price is $49.99</p><p>The attributes are setup with two Option Names, one for each download to allow for two downloads at the same time.</p><p>The first Download is listed under:</p><p>Option Name: Version<br />Option Value: Download Windows - English<br />Option Value: Download Windows - Spanish<br />Option Value: DownloadMAC - English<br /></p><p>The second Download is listed under:</p><p>Option Name: Documentation<br />Option Value: PDF - English<br />Option Value:MS Word- English</p><p />', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (134, 43, 'Per letter - required', '<p>Product is priced by attribute</p><p>The Option Name Line 1 is setup as Text</p><p>The attribute is added to the product as Required</p><p>The pricing is $0.02 per letter</p><p>The Option Name Line2 is setup as Text</p><p>The attribute is added to the product as Required</p><p>The pricing is $0.02 per letter with 3 letters free</p><p>The Colors are set up as radio buttons and Red is the Default.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (74, 43, 'Hewlett Packard - by attributes with Special% no SALE', 'The Product Price is set to 0.00 Special is set to 20%\r\n<br><br>\r\n\r\nThe Product Priced by Attribute is set to YES\r\n<br><br>\r\n\r\nThe attribute prices are defined without the price prefix of +\r\n<br><br>\r\n\r\nThe Display Price is made up of the lowest attribute price from each Option Name group.\r\n<br><br>\r\n\r\nIf there had been a Product Price, this would have been added together to the lowest attributes price from each of the Option Name groups to make up the display price.\r\n<br><br>\r\n\r\nThe price prefix of the + is not used as we are not "adding" to the display price.\r\n<br><br>\r\n\r\nThe Colors attributes are, their prices before the Special discount is applied:<br>\r\nWhite $499.99<br>\r\nBlack $519.00<br>\r\nBlue $539.00\r\n<br><br>\r\n\r\nThe Specials Price is a flat $100 discount. This $100 discount is applied to all attributes marked attributes_discounted Yes.', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (130, 43, 'Special Product', '<p>This is a Special product priced at $15 with a $10 Special</p><p>There are quantity discounts setup which will be discounted from the Special Price.</p><p>Discounts are added on the Products Price Manager.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (131, 43, 'Per word - required', '<p>Product is priced by attribute</p><p>The Option Name Line 1 is setup as Text</p><p>The attribute is added to the product as Required</p><p>The pricing is $0.05 per word</p><p>The Option Name Line2 is setup as Text</p><p>The attribute is added to the product as Required</p><p>The pricing is $0.05 per word with 3 words Free</p><p>The Colors are set up as radio buttons and Red is the Default.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (132, 43, 'Golf Clubs', '<p>Products Price is set to 0 and Products Weight is set to 1</p><p>This is marked Price by Attribute</p><p>This is priced by attribute at 14.45 per club with an added weight of 1 on the attributes.</p><p>This will make the shipping weight 1lb for the product plus 1lb for each attribute (club) added.</p><p>The attributes are sorted so the clubs read in order on the Product Info, Shopping Cart, Order, Email and Account History.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (85, 43, 'TEST $120 Special $90', 'Product is $120\r\n<br><br>\r\n\r\nThere is a $90.00 or 25% Special and no sale on this product.\r\n<br><br>\r\n\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (78, 43, 'TEST 25% special 10% Sale Attribute Priced', 'Priced by Attribute - Product price is set to $0.00\r\n<br><br>\r\nAll attributes are marked to make the price.\r\n\r\n<br><br>\r\nProduct is $0\r\n<br><br>\r\nSpecial is 25%\r\n<br><br>\r\nSale is 10%\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (79, 43, 'TEST 25% Special Attribute Priced', 'Priced by Attribute - Product price is set to $0.00\r\n<br><br>\r\nAll attributes are marked to make the price.\r\n\r\n<br><br>\r\nProduct is $0\r\n<br><br>\r\nSpecial is 25%\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (80, 43, 'TEST 25% Special', 'Product is $100.00\r\n<br><br>\r\nSpecial is 25%\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (84, 43, 'TEST $120', 'Product is $120\r\n<br><br>\r\n\r\nThere is no special and no sale on this product.\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75<br>\r\n- Green $40\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nX-Small $40.00<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- None<br> \r\n- Embossed Collector''s Tin $40.00<br>\r\n- Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nFeatures: <br>\r\nQuality Design<br>\r\nCustom Handling<br>\r\nSame Day Shipping<br>\r\n<br><br>\r\n\r\nNOTE: <b>Select from below ...</b> is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\n\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\n\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>\r\n\r\nNOTE: <b>None</b> is similar to Display Only, but this can be used when for when no option value is required.\r\n<br><br>\r\n\r\nIts value is set the value to $0.00 and it is NOT marked Display Only. \r\n<br><br>\r\n\r\nBecause its value is $0.00 if included in the Attribute Based Price on products Priced by Attribute, this Options group would not have any value included in the calculated price.\r\n<br><br>\r\n\r\nNOTE: The Option Name: Featured is a READ ONLY Option Type\r\n<br><br>\r\nThis can be for repeatative information or anything that occures on many products but functions like an attribute in setting up the information. It does not get added to the Shopping Cart nor display on the Order. They should be marked exclude from Attribute Based Price.\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (82, 43, 'TEST $120 Sale -$5.00', 'Product is $120\r\n<br><br>\r\nSale is -$5.00\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (83, 43, 'TEST $120 Special $90.00 Sale -$5.00', 'Product is $120\r\n<br><br>\r\n\r\nSpecial $90.00 or 25%\r\n<br><br>\r\n\r\nSale is -$5.00\r\n<br><br>\r\n\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (76, 43, 'TEST 25% special 10% Sale', 'Product is $100.00\r\n<br><br>\r\nSpecial is 25%\r\n<br><br>\r\nSale is 10%\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (106, 43, 'Beispiel für maximal 3 Artikel', 'This product only allows Quantity 1 because the Products Qty Maximum is set to 3.\r\n<br><br>\r\n\r\nThis means there will be a Quantity box.\r\n<br><br>\r\n\r\nAdd button will not add more than a total of 3 to the Shopping Cart.\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (104, 43, 'Stückzahl verstecken', 'This product does not show the Quantity Box when Adding to the Shopping Cart.\r\n<br><br>\r\n\r\nThis will add 1 to the Shopping Cart when Add to Cart is hit.\r\n<br><br>\r\n\r\nNOTE: If using Quantity Box Shows set to NO, unless Qty Max is also set to 1 then each time the Add to Cart is clicked the current cart quantity is updated by 1. If Qty Max is set to 1 then no more than 1 will be able to be added to the Shopping Cart per order.\r\n<br><br>\r\n\r\nBecause the Image name is: 1_small.jpg<br>\r\nand stored in the /images directory ...\r\n<br><br>\r\n\r\nThe other matching images will show:\r\n<br><br>\r\n/images/1_small_00.jpg<br>\r\n/images/1_small_02.jpg<br>\r\n/images/1_small_03.jpg\r\n<br><br>\r\n\r\nThe matching large images from /images/large will show:\r\n<br><br>\r\n/images/large/1_small_00_LRG.jpg<br>\r\n/images/large/1_small_02_LRG.jpg<br>\r\n/images/large/1_small_03_LRG.jpg\r\n<br><br>\r\n\r\nA matching image must begin with the same exact name as the Product Image and end in the same extention.\r\n<br><br>\r\n\r\nThese will then auto load.\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (105, 43, 'A Maximum Sample of 1', 'This product only allows Quantity 1 because the Products Qty Maximum is set to 1.\r\n<br><br>\r\n\r\nThis means there will be no Quantity box.\r\n<br><br>\r\n\r\nAdd button will not add more than a total of 1 to the Shopping Cart.\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (88, 43, 'TEST $120 Sale Special $90 Skip', 'Product is $120\r\n<br><br>\r\nSpecial is $105\r\n<br><br>\r\nSale Price is $90 or 25% - Skip Products with Specials\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (89, 43, 'TEST $120 Sale 10% Special off Skip', 'Product is $120\r\n<br><br>\r\nSpecial does not exist\r\n<br><br>\r\nSale Price is 10% - Skip Products with Specials\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (90, 43, 'TEST $120 Sale 10% Special', 'Product is $120\r\n<br><br>\r\nSpecial is 25% or $90\r\n<br><br>\r\nSale Price is 10%\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (92, 43, 'TEST $120 Sale 10% Special off', 'Product is $120\r\n<br><br>\r\nSpecial does not exist\r\n<br><br>\r\nSale Price is 10%\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (93, 43, 'TEST $120 Special off Abverkauf neuer Preis $100', 'Product is $120\r\n<br><br>\r\nSpecial does not exist\r\n<br><br>\r\nSale Price is New Price $100\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nAttributes are not affected by the Sale Discount Price when a New Price is used.\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (94, 43, 'TEST $120 Special 25% Abverkauf neuer Preis $100', 'Product is $120\r\n<br><br>\r\nSpecial 25% or $90\r\n<br><br>\r\nSale Price is New Price $100\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nAttributes are not affected by the Sale Discount Price when a New Price is used.\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (95, 43, 'TEST $120 Special 25% Abverkauf neuer Preis $100 Skip Specials', 'Product is $120\r\n<br><br>\r\nSpecial 25% or $90\r\n<br><br>\r\nSale Price is New Price $100\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nAttributes are not affected by the Sale Discount Price when a New Price is used.\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (96, 43, 'TEST $120 Special off Abverkauf neuer Preis $100 Skip Specials', 'Product is $120\r\n<br><br>\r\nSpecial does not exist\r\n<br><br>\r\nSale Price is New Price $100\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nAttributes are not affected by the Sale Discount Price when a New Price is used.\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (97, 43, 'TEST $120 Sale 10% Special - Apply to price', 'Product is $120\r\n<br><br>\r\nSpecial is 25% or $90\r\n<br><br>\r\nSale Price is 10%\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (98, 43, 'TEST $120 Sale 10% Special off - Apply to Price', 'Product is $120\r\n<br><br>\r\nSpecial does not exist\r\n<br><br>\r\nSale Price is 10%\r\n<br><br>\r\n\r\nAttributes:<br>\r\nColor:<br>\r\n- Red $100.00<br>\r\n- Orange $50.00<br>\r\n- Yellow $75\r\n<br><br>\r\n\r\nSize:<br>\r\nSelect from Below:<br>\r\nSmall $50.00<br>\r\nMedium $75.00<br>\r\nLarge $100.00\r\n<br><br>\r\n\r\nGift Options:<br>\r\n- Dated Collector''s Tin $50.00<br>\r\n- Autographed Memorabila Card $75.00<br>\r\n- Wrapping $100.00\r\n<br><br>\r\n\r\nNOTE: Select from below is defined as a Display Only Attribute and NOT to be included in the base price. \r\n<br><br>\r\nThe Display Only means, the customer may NOT select this option value. If they do not selected another option value, then the product cannot be added to the shopping cart.\r\n<br><br>\r\nThe NOT included in base price means, if this product were priced by attributes, it would not be include. The reason for this is so that the lowest price of this group will be the Small at $50.00 and not Select from Below at $0.00\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (99, 43, 'Free Shipping Product with Weight', 'This product has Free Shipping.\r\n<br><br>\r\n\r\nThe weight is set to 5\r\n<br><br>\r\n\r\nWhile the weight is set to 5, it has the Always Free Shipping set to YES and the Free Shipping Module is installed.\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (107, 43, 'Free Shipping Product without Weight', 'This product has Free Shipping.\r\n<br><br>\r\n\r\nThe weight is set to 0\r\n<br><br>\r\n\r\nIt has the Always Free Shipping set to NO and the Free Shipping Module is installed but it will still ship for Free.\r\n<br><br>\r\n\r\nIn the Configruation settings for Shipping/Packaging ... Order Free Shipping 0 Weight Status has been defined to be Free Shipping.\r\n<br><br>\r\n\r\nNOTE: if that setting is changed, then this product will NOT ship for free, even though the weight is set to 0.\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (108, 43, 'Ein ausverkaufter Artikel', 'This product is Sold Out because the product quantity is <= 0\r\n<br><br>\r\n\r\nBecause the Configuration Settings in Stock are defined that Sold Out Products are not disabled and Sold Out cannot be purchased, the add to cart buttons are changed to either the large or small Sold Out image.\r\n<br><br>\r\n\r\nIf you change the Configuration Settings in Stock, then you will be able to purchase this product, even though it is Sold Out.\r\n<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (112, 43, 'Test Zwei', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (113, 43, 'Test Vier', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (114, 43, 'Test Fünf', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (115, 43, 'Test Eins', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (116, 43, 'Test Acht', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (117, 43, 'Test Drei', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (118, 43, 'Test Zehn', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (119, 43, 'Test Sechs', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (120, 43, 'Test Sieben', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (121, 43, 'Test Zwölf', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (122, 43, 'Test Neun', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (123, 43, 'Test Elf', 'This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (127, 43, 'Normaler Artikel', '<p>This is a normal product priced at $15</p><p>There are quantity discounts setup which will be discounted from the Products Price.</p><p>Discounts are added on the Products Price Manager.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (154, 43, 'Rope', '<p>Rope is sold by foot or yard with a minimum length of 10 feet or 10 yards</p><p>Product Price of $1.00<br />Product Weight of 0</p><p>Option Values:<br />per foot $0.00 weight .25<br />per yard $1.50 weight .75</p><p />', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (155, 43, 'Price Factor', '<p>This product is priced at $10.00</p><p>The attributes are priced using the Price Factor</p><p>Red is $10<br />Yellow is $20<br />Green is $30</p><p>This makes the total price $10 + the price factor of the attribute.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (156, 43, 'Price Factor Offset', '<p>This product is priced at $10.00</p><p>The attributes are priced using the Price Factor and Price Factor Offset</p><p>Red is $10 ($0)<br />Yellow is $20 ($10)<br />Green is $30 ($20)</p><p>The Price Factor Offset is set to 1 to take out the price of the Product Price then make the total price $10 + the price factor * $10 - price factor offset * $10 for the attributes.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (157, 43, 'Price Factor Offset by Attribute', '<p>This product is priced at $10.00</p><p>It is marked Price by Attribute.</p><p>The attributes are priced using the Price Factor and Price Factor Offset. </p><p>The actual Product Price is used just to compute the Price Factor.</p><p>Red is $10 ($0)<br />Yellow is $20 ($10)<br />Green is $30 ($20)</p><p>The Price Factor Offset is set to 1 to take out the price of the Product Price then make the total price the price factor * $10 - price factor offset * $10 for the attributes.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (158, 43, 'One Time Charge', '<p>This product is $45 with a one time charge set on the colors.</p><p>Red $5<br />Yellow is $10<br />Green is $15</p><p />', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (159, 43, 'Attribute Quantity Discount', '<p>Attribute qty discounts are attribute prices based on qty ordered.</p><p>Enter them as: </p><p>Red:<br />3:10.00,6:9.00,9:8.00,12:7.00,15:6.00</p><p>Yellow<br />3:10.50,6:9.50,9:8.50,12:7.50,15:6.50</p><p>Green:<br />3:11.00,6:10.00,9:9.00,12:8.00,15:7.00</p><p>A table will also show on the page to display these discounts as well as an indicator that qty discounts are available.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (160, 43, 'Golf Clubs', '<p>Products Price is set to 0 and Products Weight is set to 1</p><p>This is marked Price by Attribute</p><p>This is priced by attribute at 14.45 per club with an added weight of 1 on the attributes.</p><p>This will make the shipping weight 1lb for the product plus 1lb for each attribute (club) added.</p><p>The attributes are sorted so the clubs read in order on the Product Info, Shopping Cart, Order, Email and Account History.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (165, 43, 'Seil', '<p>Rope is sold by foot or yard with a minimum length of 10 feet or 10 yards</p><p>Product Price of $1.00<br />Product Weight of 0</p><p>Option Values:<br />per foot $0.00 weight .25<br />per yard $1.50 weight .75</p><p />', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (166, 43, 'Russ Tippins Band - The Hunter', '', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (167, 43, 'Test Dokument', 'Dies ist ein Testdocument', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (168, 43, 'Beispiel für Artikeltyp Product General', 'Product General Type are your regular products.\r\n\r\nThere are no special needs or layout issues to work with.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (169, 43, 'Beispiel für Artikeltyp Product Music', 'The Product Musik Type is specially designed for music media.\r\n\r\nThis can offer a lot more flexibility than the Product General.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (170, 43, 'Beispiel für Artikeltyp Document General', 'Document General Type is used for Products that are actually Dokumente.\r\n\r\nThese cannot be added to the cart but can be configured for the Document Sidebox. If your Document Sidebox is not showing, go to the Layout Controller and turn it on for your template.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (171, 43, 'Beispiel für Artikeltyp Document Product', 'Document Product Type is used for Dokumente that are also available for sale. <br /><br />You might wish to display brief peices of the Document then offer it for sale. <br /><br />This Product Type is also handy for downloadable Dokumente or Dokumente available either on CD or by download. <br /><br />The Document Product Type could be used in the Document Sidebox or the Categories Sidebox depending on how you configure its master categories id. <br /><br />This product has also been added as a linked product to the Document Category. This will allow it to show in both the Category and Document Sidebox. While not marked specifically for the master product type id related to the Product Types, it now is in a Product Type set for Document General so it will show in both boxes.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (172, 43, 'Beispiel für einen versandkostenfreien Artikel', '<p>Product Free Shipping can be setup to highlight the Free Shipping aspect of the product. <br /><br />These pages include a Free Shipping Image on them. <br /><br />You can define the ALWAYS_FREE_SHIPPING_ICON in the language file. This can be Text, Image, Text/Image Combo or nothing. <br /><br />The weight does not matter on Always Free Shipping if you set Always Free Shipping to Yes. <br /><br />Be sure to have the Free Shipping Module Turned on! Otherwise, if this is the only product in the cart, it will not be able to be shipped. <br /><br />Notice that this is defined with a weight of 5lbs. But because of the Always Free Shipping being set to Y there will be no shipping charges for this product. <br /><br />You do not have to use the Product Free Shipping product type just to use Always Free Shipping. But the reason you may want to do this is so that the layout of the Product Free Shipping product info page can be layout specifically for the Free Shipping aspect of the product. <br /><br />This includes a READONLY attribute for Option Name: Shipping and Option Value: Free Shipping Included. READONLY attributes do not show on the options for the order.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (173, 43, 'Buch', 'This Book is sold as a Book that is shipped to the customer or as a Download.<br><br>\r\n\r\nOnly the Book itself is on Special. The Downloadable versions are not on Special.<br><br>\r\n\r\nThis Book under Categories/Products is set to:<br><br>\r\n\r\nProduct Priced by Attribute: Yes<br>\r\nProducts Price: 0.00<br>\r\nWeight: 0<br><br>\r\n\r\nAn Option Name of: Version (type is dropdown)<br><br>\r\nOption Values of: Book Hard Cover<br><br>\r\nDownload: MAC English<br><br>\r\nDownload: Windows English<br><br>\r\n\r\nThe Attribute are set as:<br>\r\nOption Name: Version<br>\r\nOption Value: Book Hard Cover<br>\r\nPrice Prefix is blank<br>\r\nPrice: 52.50<br>\r\nWeight Prefix is blank\r\nWeight: 1<br>\r\nInclude in Base Price When Priced by Attribute Yes<br>\r\nApply Discounts Used by Product Special/Sale: Yes<br><br>\r\n\r\nOption Name: Version<br>\r\nOption Value: Download: MAC English<br>\r\nPrice Prefix is blank<br>\r\nPrice: 20.00<br>\r\nWeight: 0\r\nInclude in Base Price When Priced by Attribute No<br>\r\nApply Discounts Used by Product Special/Sale: No<br><br>\r\n\r\nOption Name: Version<br>\r\nOption Value: Download: Windows: English<br>\r\nPrice Prefix is blank<br>\r\nPrice: 20.00<br>\r\nWeight: 0<br>\r\nInclude in Base Price When Priced by Attribute No<br>\r\nApply Discounts Used by Product Special/Sale: No<br><br>\r\n\r\nIt is on Special for $47.50<br><br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (174, 43, 'A Call No Price', 'This is a Call for Price product with no price<br>\r\n\r\nThis should show as having a price, special price but then be Call for Price. This means you cannot buy it.\r\n<br>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (175, 43, 'Qty Discounts by 1', '<p>This is a normal product priced at $60</p><p>There are quantity discounts setup which will be discounted from the Products Price.</p><p>Discounts are added on the Products Price Manager.</p><p>The Discounts are offered in increments of 1.</p><p>Note: Attribute do not inherit the Mengenrabatte discounts.</p><p>Attribute will inherit Discounts from Specials or sales. This can be customized per attribute by marking the Attribute to Include Product Price Special or Sale Discounts.</p><p>Red is $100.00 and marked to include the Price to Special discount but will not inherit the Mengenrabatte discount.</p><p>Green is $100 and marked not to include the Price to Special discount and will not inherit the Mengenrabatte discount.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (176, 43, 'Normal Product by the dozen', '<p>This is a normal product priced at $100</p><p>There are quantity discounts setup which will be discounted from the Products Price by the dozen.</p><p>Discounts are added on the Products Price Manager.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (177, 43, 'Special Product by the dozen', '<p>This is a Special product priced at $100 with a $75 Special</p><p>There are quantity discounts setup which will be discounted from the Special Price discounted by the dozen.</p><p>Discounts are added on the Products Price Manager.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (178, 43, 'Qty Discounts by 1 Special', '<p>This is a normal product priced at $60 with a special of $50</p><p>There are quantity discounts setup which will be discounted from the Products Price.</p><p>Discounts are added on the Products Price Manager.</p><p>The Discounts are offered in increments of 1.</p><p>Note: Attribute do not inherit the Mengenrabatte discounts.</p><p>Attribute will inherit Discounts from Specials or sales. This can be customized per attribute by marking the Attribute to Include Product Price Special or Sale Discounts.</p><p>Red is $100.00 and marked to include the Price to Special discount but will not inherit the Mengenrabatte discount.</p><p>Green is $100 and marked not to include the Price to Special discount and will not inherit the Mengenrabatte discount.</p>', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (179, 43, 'Downloadartikel', '<p>This product is set up to have a single download.</p><p>The Product Price is $39.99</p><p>The attributes are setup with 1 Option Name, for the download to allow for one download but of various types.</p><p>The Download is listed under:</p><p>Option Name: Documentation<br />Option Value: PDF - English<br />Option Value: MS Word - English</p>', '', 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (1, 43, 'Color', 10, 2, 32, '', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (2, 43, 'Size', 20, 0, 32, '', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (3, 43, 'Model', 30, 0, 32, '', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (4, 43, 'Memory', 50, 0, 32, '', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (5, 43, 'Version', 40, 0, 32, '', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (6, 43, 'Media Type', 60, 0, 32, '', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (17, 43, 'Documentation', 45, 0, 32, '', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (16, 43, 'Irons', 800, 3, 32, '', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (7, 43, 'Logo Back', 310, 4, 32, '', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (8, 43, 'Logo Front', 300, 4, 32, 'You may upload your own image file(s)', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (9, 43, 'Line 2', 410, 1, 64, '', 40, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (10, 43, 'Line 1', 400, 1, 64, 'Enter your text up to 64 characters, punctuation and spaces', 40, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (11, 43, 'Line 3', 420, 1, 64, '', 40, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (12, 43, 'Line 4', 430, 1, 64, '', 40, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (13, 43, 'Gift Options', 70, 3, 32, 'Special Option Options Available:', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (14, 43, 'Amount', 200, 2, 32, '', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (15, 43, 'Features', 700, 5, 32, '&nbsp;', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (18, 43, 'Length', 70, 0, 32, '', 32, 5, 0);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style) VALUES (19, 43, 'Shipping', 600, 5, 32, '', 32, 0, 0);
REPLACE INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (0, 43, 'TEXT', 0);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (1, 43, '4 mb', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (2, 43, '8 mb', 20);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (3, 43, '16 mb', 30);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (4, 43, '32 mb', 40);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (5, 43, 'Value', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (6, 43, 'Premium', 20);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (7, 43, 'Deluxe', 30);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (8, 43, 'PS/2', 20);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (9, 43, 'USB', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (10, 43, 'Download: Windows - Englisch', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (13, 43, 'Box: Windows - Englisch', 1000);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (14, 43, 'DVD/VHS Kombipack', 30);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (15, 43, 'Blau', 50);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (16, 43, 'Rot', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (17, 43, 'Gelb', 30);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (18, 43, 'Medium', 30);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (63, 43, 'MS Word - Englisch', 20);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (19, 43, 'XXS', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (62, 43, 'PDF - Englisch', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (61, 43, '2 Iron', 20);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (20, 43, 'Gross', 40);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (60, 43, '8 Iron', 80);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (59, 43, '7 Iron', 70);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (21, 43, 'Klein', 20);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (58, 43, 'Wedge', 200);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (57, 43, '9 Iron', 90);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (22, 43, 'VHS', 20);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (23, 43, 'DVD', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (56, 43, '6 Iron', 60);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (55, 43, '5 Iron', 50);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (24, 43, '20th Century', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (54, 43, '4 Iron', 40);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (53, 43, '3 Iron', 30);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (25, 43, 'Orange', 20);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (26, 43, 'Grün', 40);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (27, 43, 'Lila', 60);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (28, 43, 'Braun', 70);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (29, 43, 'Schwarz', 80);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (30, 43, 'Weiss', 90);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (31, 43, 'Silber', 100);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (32, 43, 'Gold', 110);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (64, 43, 'Download: MAC - English', 100);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (34, 43, 'Wrapping', 40);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (35, 43, 'Autographed Memorabilia Card', 30);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (36, 43, 'Collector''s Tin', 20);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (37, 43, 'Bitte wählen Sie ...', 5);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (38, 43, '€ 5.00', 5);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (39, 43, '€ 10.00', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (40, 43, '€ 25.00', 25);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (41, 43, '€ 15.00', 15);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (42, 43, '€ 50.00', 50);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (43, 43, '€ 100.00', 100);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (44, 43, 'Bitte wählen Sie ...', 5);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (45, 43, 'KEIN', 5);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (46, 43, 'kein', 5);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (47, 43, 'Embossed Collector''s Tin', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (49, 43, 'Custom Handling', 20);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (48, 43, 'kein', 5);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (50, 43, 'Same Day Shipping', 30);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (51, 43, 'Quality Design', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (52, 43, 'Download: Windows - Spanisch', 20);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (65, 43, 'per Foot', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (66, 43, 'per Yard', 20);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (67, 43, 'Versandkostenfrei!', 10);
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order) VALUES (68, 43, 'Buch Hardcover', 5);
INSERT INTO orders (orders_id, customers_id, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, payment_module_code, shipping_method, shipping_module_code, coupon_code, cc_type, cc_owner, cc_number, cc_expires, cc_cvv, last_modified, date_purchased, orders_status, orders_date_finished, currency, currency_value, order_total, order_tax, paypal_ipn_id, ip_address, order_device) VALUES
(1, 1, 'Peter Meier', 'Demofirma', 'Demogasse 17', '', 'Berlin', '10101', 'Berlin', 'Deutschland', '012345678', 'demo@zencartdemo.at', 5, 'Peter Meier', 'Demofirma', 'Demogasse 17', '', 'Berlin', '10101', 'Berlin', 'Deutschland', 5, 'Peter Meier', 'Demofirma', 'Demogasse 17', '', 'Berlin', '10101', 'Berlin', 'Deutschland', 5, 'Vorkasse/Banküberweisung', 'eustandardtransfer', 'Versandkosten pro Stück (Standard)', 'item', '', '', '', '', '', NULL, NULL, '2019-04-15 16:37:32', 1, NULL, 'EUR', 1.000000, 332.49, 30.00, 0, '192.168.1.1 - 192.168.1.2', 'Desktop');
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity, onetime_charges, products_priced_by_attribute, product_is_free, products_discount_type, products_discount_type_from, products_prid) VALUES
(1, 1, 1, 'MG200MMS', 'Matrox G200 MMS', 299.9900, 299.9900, 10.0000, 1, 0.0000, 0, 0, 0, 0, '1:edff669e5da95c1d027b04d5412532fa');
INSERT INTO orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) VALUES
(1, 1, 1, '2019-06-18 16:37:32', 1, 'Bitte schnellstmöglich versenden');
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES
(1, 1, 'Zwischensumme:', '&euro;329.99', 329.9890, 'ot_subtotal', 100),
(2, 1, 'Versandkosten pro Stück (Standard):', '&euro;2.50', 2.5000, 'ot_shipping', 200),
(3, 1, 'Enthaltene Mwst. 10%:', '&euro;30.00', 29.9990, 'ot_tax', 300),
(4, 1, 'Endsumme:', '&euro;332.49', 332.4890, 'ot_total', 999);
INSERT INTO orders_products_attributes (orders_products_attributes_id, orders_id, orders_products_id, products_options, products_options_values, options_values_price, price_prefix, product_attribute_is_free, products_attributes_weight, products_attributes_weight_prefix, attributes_discounted, attributes_price_base_included, attributes_price_onetime, attributes_price_factor, attributes_price_factor_offset, attributes_price_factor_onetime, attributes_price_factor_onetime_offset, attributes_qty_prices, attributes_qty_prices_onetime, attributes_price_words, attributes_price_words_free, attributes_price_letters, attributes_price_letters_free, products_options_id, products_options_values_id, products_prid) VALUES
(1, 1, 1, 'Model', 'Value', 0.0000, '+', 0, 0, '', 1, 1, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, '', '', 0.0000, 0, 0.0000, 0, 3, 5, '1:edff669e5da95c1d027b04d5412532fa'),
(2, 1, 1, 'Memory', '4 mb', 0.0000, '', 0, 0, '', 1, 1, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, '', '', 0.0000, 0, 0.0000, 0, 4, 1, '1:edff669e5da95c1d027b04d5412532fa');
