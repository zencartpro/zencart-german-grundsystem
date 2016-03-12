#########################################################################
# Paket Tracking 2.6 Multilanguage Install - 2016-03-12 - webchills
#########################################################################

INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible )  VALUES 
('Paket Tracking', 'Settings for Package Tracker', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Package Tracking - Carrier 1 Status', 'CARRIER_STATUS_1', 'False', 'Enable Tracking for Carrier 1<br /><br />Set to false if you do NOT want Carrier 1 to be displayed on Admin and Customer page.', @gid, 1, now(), now(), NULL, "zen_cfg_select_option(array('True', 'False'),"),
('Package Tracking - Carrier 1 Name', 'CARRIER_NAME_1', 'DHL', 'Enter name of Carrier 1 <br /> <br /><strong>Example:</strong> FedEx, UPS, Canada Post, etc...<br />(default: FedEx)', @gid, 2, now(), now(), NULL, NULL),
('Package Tracking - Carrier 1 Tracking Link', 'CARRIER_LINK_1', 'http://nolp.dhl.de/nextt-online-public/set_identcodes.do?lang=de&idc=', 'Enter the tracking link of Carrier 1<br /> <br /><strong>Example:</strong> http://nolp.dhl.de/nextt-online-public/set_identcodes.do?lang=de&idc=', @gid, 3, now(), now(), NULL, NULL),
('Package Tracking - Carrier 2 Status', 'CARRIER_STATUS_2', 'False', 'Enable Tracking for Carrier 2<br /><br />Set to false if you do NOT want Carrier 2 to be displayed on Admin and Customer page.', @gid, 4, now(), now(), NULL, "zen_cfg_select_option(array('True', 'False'),"),
('Package Tracking - Carrier 2 Name', 'CARRIER_NAME_2', 'DPD', 'Enter name of Carrier 2 <br /> <br /><strong>Example:</strong> FedEx, UPS, Canada Post, etc...<br />(default: UPS)', @gid, 5, now(), now(), NULL, NULL),
('Package Tracking - Carrier 2 Tracking Link', 'CARRIER_LINK_2', 'http://extranet.dpd.de/cgi-bin/delistrack?typ=1&lang=de&pknr=', 'Enter the tracking link of Carrier 2<br /> <br /><strong>Example:</strong> http://extranet.dpd.de/cgi-bin/delistrack?typ=1&lang=de&pknr=', @gid, 6, now(), now(), NULL, NULL),
('Package Tracking - Carrier 3 Status', 'CARRIER_STATUS_3', 'False', 'Enable Tracking for Carrier 3<br /><br />Set to false if you do NOT want Carrier 3 to be displayed on Admin and Customer page.', @gid, 7, now(), now(), NULL, "zen_cfg_select_option(array('True', 'False'),"),
('Package Tracking - Carrier 3 Name', 'CARRIER_NAME_3', 'UPS', 'Enter name of Carrier 3 <br /> <br /><strong>Example:</strong> FedEx, UPS, Canada Post, etc...<br />(default: USPS)', @gid, 8, now(), now(), NULL, NULL),
('Package Tracking - Carrier 3 Tracking Link', 'CARRIER_LINK_3', 'http://wwwapps.ups.com/WebTracking/processInputRequest?sort_by=status&tracknums_displ ayed=1&TypeOfInquiryNumber=T&loc=de_DE&InquiryNumber1=', 'Enter the tracking link of Carrier 3<br /> <br /><strong>Example:</strong>http://wwwapps.ups.com/WebTracking/processInputRequest?sort_by=status&tracknums_displ ayed=1&TypeOfInquiryNumber=T&loc=de_DE&InquiryNumber1=', @gid, 9, now(), now(), NULL, NULL),
('Package Tracking - Carrier 4 Status', 'CARRIER_STATUS_4', 'False', 'Enable Tracking for Carrier 4<br /><br />Set to false if you do NOT want Carrier 4 to be displayed on Admin and Customer page.', @gid, 10, now(), now(), NULL, "zen_cfg_select_option(array('True', 'False'),"),
('Package Tracking - Carrier 4 Name', 'CARRIER_NAME_4', 'Hermes', 'Enter name of Carrier 4 <br /> <br /><strong>Example:</strong> FedEx, UPS, Canada Post, etc...<br />(default: blank)', @gid, 11, now(), now(), NULL, NULL),
('Package Tracking - Carrier 4 Tracking Link', 'CARRIER_LINK_4', 'http://tracking.hlg.de/Tracking.jsp?TrackID=', 'Enter the tracking link of Carrier 4<br /> <br /><strong>Example:</strong> http://tracking.hlg.de/Tracking.jsp?TrackID=', @gid, 12, now(), now(), NULL, NULL),
('Package Tracking - Carrier 5 Status', 'CARRIER_STATUS_5', 'False', 'Enable Tracking for Carrier 5<br /><br />Set to false if you do NOT want Carrier 5 to be displayed on Admin and Customer page.', @gid, 13, now(), now(), NULL, "zen_cfg_select_option(array('True', 'False'),"),
('Package Tracking - Carrier 5 Name', 'CARRIER_NAME_5', 'Post Austria', 'Enter name of Carrier 5 <br /> <br /><strong>Example:</strong> FedEx, UPS, Canada Post, etc...<br />(default: blank)', @gid, 14, now(), now(), NULL, NULL),
('Package Tracking - Carrier 5 Tracking Link', 'CARRIER_LINK_5', 'http://www.post.at/sendungsverfolgung.php/details?pnum1=', 'Enter the tracking link of Carrier 5<br /> <br /><strong>Example:</strong> http://www.post.at/tnt_query.php?pnum1=', @gid, 15, now(), now(), NULL, NULL),
('Package Tracking - Carrier 6 Status', 'CARRIER_STATUS_6', 'False', 'Enable Tracking for Carrier 6<br /><br />Set to false if you do NOT want Carrier 6 to be displayed on Admin and Customer page.', @gid, 16, now(), now(), NULL, "zen_cfg_select_option(array('True', 'False'),"),
('Package Tracking - Carrier 6 Name', 'CARRIER_NAME_6', 'Deutsche Post Brief', '<b>NOTE: Carrier 6 is reserved for carriers which use more fields in their tracking links as just the ID. E.g. day, month and year.</b><br/><br/>Enter name of Carrier 6 <br /> <br /><strong>Example:</strong> Deutsche Post brief<br />(default: blank)', @gid, 17, now(), now(), NULL, NULL),
('Package Tracking - Carrier 6 Tracking Link Part 1', 'CARRIER_LINK_6_PART1', 'https://www.deutschepost.de/sendung/simpleQueryResult.html?form.sendungsnummer=', 'Enter the tracking link of Carrier 6 for Part 1 (Tracking ID)<br /> <br /><strong>Example:</strong> https://www.deutschepost.de/sendung/simpleQueryResult.html?form.sendungsnummer=', @gid, 18, now(), now(), NULL, NULL),
('Package Tracking - Carrier 6 Tracking Link Part 2', 'CARRIER_LINK_6_PART2', '&form.einlieferungsdatum_tag=', 'Enter part 2 of the tracking link of Carrier 6 (for the day)<br /> <br /><strong>Example:</strong> &form.einlieferungsdatum_tag=', @gid, 19, now(), now(), NULL, NULL),
('Package Tracking - Carrier 6 Tracking Link Part 3', 'CARRIER_LINK_6_PART3', '&form.einlieferungsdatum_monat=', 'Enter part 3 of the tracking link of Carrier 6 (for the month)<br /> <br /><strong>Example:</strong> &form.einlieferungsdatum_monat=', @gid, 20, now(), now(), NULL, NULL),
('Package Tracking - Carrier 6 Tracking Link Part 4', 'CARRIER_LINK_6_PART4', '&form.einlieferungsdatum_jahr=', 'Enter part 4 of the tracking link of Carrier 6 (for the year)<br /> <br /><strong>Example:</strong> &form.einlieferungsdatum_jahr=', @gid, 21, now(), now(), NULL, NULL),
('Package Tracking - Max display for Track Order sidebox', 'MAX_DISPLAY_PRODUCTS_IN_TRACK_ORDERS_BOX', '3', 'The maximum number of orders to display on the Track Order sidebox ', @gid, 22, now(), now(), NULL, NULL),                               
('Package Tracking - Switch for Edit Orders v3.0 or Super Orders v3.0', 'TY_TRACKER', 'False', 'If you have the either Edit Orders v3.0 or Super Orders v3.0 installed, set this option to TRUE so that the Ty Package Tracker fields will display in Edit Orders or Super Orders<br><br><strong><font color=red>YOU MUST HAVE EDIT ORDERS v3.0 OR SUPER ORDERS v3.0 INSTALLED TO USE THIS FEATURE!!</font></strong><br><br>\(Activating this flag without the required mod\(s\) installed <strong>WILL CAUSE ERRORS IN YOUR STORE!!!!</strong>\)', @gid, 23, now(), now(), NULL, "zen_cfg_select_option(array('True', 'False'),");

                                
##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Paket Tracking', 'Paket Tracking Einstellungen', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Paket Tracking - Versandunternehmen 1 Name', 'CARRIER_NAME_1', 'Geben Sie den Namen von Versandunternehmen 1 ein <br />Beispiel: DHL, GLS, DPD, Post Austria, Deutsche Post, etc...<br />(Voreingestellt: DHL)', 43),
('Paket Tracking - Versandunternehmen 1 Tracking Link', 'CARRIER_LINK_1', 'Geben Sie den Tracking Link von Versandunternehmen 1 ein.<br /> Beispiel: http://nolp.dhl.de/nextt-online-public/set_identcodes.do?lang=de&idc=', 43),
('Paket Tracking - Versandunternehmen 1 Status', 'CARRIER_STATUS_1','Wollen Sie das Tracking für Versandunternehmen 1 aktivieren?<br />Auf false setzen, wenn Sie NICHT wollen, dass Versandunternehmen 1 auf der Admin- und der Kundenseite erscheint.', 43),
('Paket Tracking - Versandunternehmen 2 Name', 'CARRIER_NAME_2', 'Geben Sie den Namen von Versandunternehmen 2 ein <br />Beispiel: DHL, GLS, DPD, Post Austria, Deutsche Post, etc...<br />(Voreingestellt: DPD)', 43),
('Paket Tracking - Versandunternehmen 2 Tracking Link', 'CARRIER_LINK_2', 'Geben Sie den Tracking Link von Versandunternehmen 2 ein.<br /> Beispiel: http://extranet.dpd.de/cgi-bin/delistrack?typ=1&lang=de&pknr=', 43),
('Paket Tracking - Versandunternehmen 2 Status', 'CARRIER_STATUS_2', 'Wollen Sie das Tracking für Versandunternehmen 2 aktivieren?<br />Auf false setzen, wenn Sie NICHT wollen, dass Versandunternehmen 2 auf der Admin- und der Kundenseite erscheint.', 43),
('Paket Tracking - Versandunternehmen 3 Name', 'CARRIER_NAME_3', 'Geben Sie den Namen von Versandunternehmen 3 ein <br />Beispiel: DHL, GLS, DPD, Post Austria, Deutsche Post, etc...<br />(Voreingestellt: UPS)', 43),
('Paket Tracking - Versandunternehmen 3 Tracking Link', 'CARRIER_LINK_3', 'Geben Sie den Tracking Link von Versandunternehmen 3 ein.<br /> Beispiel: http://wwwapps.ups.com/WebTracking/processInputRequest?sort_by=status&tracknums_displ ayed=1&TypeOfInquiryNumber=T&loc=de_DE&InquiryNumber1=', 43),
('Paket Tracking - Versandunternehmen 3 Status', 'CARRIER_STATUS_3', 'Wollen Sie das Tracking für Versandunternehmen 3 aktivieren?<br />Auf false setzen, wenn Sie NICHT wollen, dass Versandunternehmen 3 auf der Admin- und der Kundenseite erscheint.', 43),
('Paket Tracking - Versandunternehmen 4 Name', 'CARRIER_NAME_4', 'Geben Sie den Namen von Versandunternehmen 4 ein <br />Beispiel: DHL, GLS, DPD, Post Austria, Deutsche Post, etc...<br />(Voreingestellt: Hermes)', 43),
('Paket Tracking - Versandunternehmen 4 Tracking Link', 'CARRIER_LINK_4','Geben Sie den Tracking Link von Versandunternehmen 4 ein.<br /> Beispiel: http://tracking.hlg.de/Tracking.jsp?TrackID=', 43),
('Paket Tracking - Versandunternehmen 4 Status', 'CARRIER_STATUS_4', 'Wollen Sie das Tracking für Versandunternehmen 4 aktivieren?<br />Auf false setzen, wenn Sie NICHT wollen, dass Versandunternehmen 4 auf der Admin- und der Kundenseite erscheint.', 43),
('Paket Tracking - Versandunternehmen 5 Name', 'CARRIER_NAME_5', 'Geben Sie den Namen von Versandunternehmen 5 ein <br />Beispiel: DHL, GLS, DPD, Post Austria, Deutsche Post, etc...<br />(Voreingestellt: Post Austria)', 43),
('Paket Tracking - Versandunternehmen 5 Tracking Link', 'CARRIER_LINK_5','Geben Sie den Tracking Link von Versandunternehmen 5 ein.<br /> Beispiel: http://www.post.at/sendungsverfolgung.php/details?pnum1=', 43),
('Paket Tracking - Versandunternehmen 5 Status', 'CARRIER_STATUS_5','Wollen Sie das Tracking für Versandunternehmen 5 aktivieren?<br />Auf false setzen, wenn Sie NICHT wollen, dass Versandunternehmen 5 auf der Admin- und der Kundenseite erscheint.', 43),
('Paket Tracking - Versandunternehmen 6 Name', 'CARRIER_NAME_6', '<b>Versandunternehmen 6 ist nur für Anbieter vorgesehen, deren Trackinglinks neben der Tracking ID noch zusätzliche Angaben wie Tag, Monat und Jahr der Übergabe enthalten müssen. Beispiel: Deutsche Post Brief</b><br/><br/> Geben Sie den Namen für das spezielle Versandunternehmen 6 ein <br />Beispiel: Deutsche Post Brief<br />(Voreingestellt: Deutsche Post Brief)', 43),
('Paket Tracking - Versandunternehmen 6 Tracking Link - Teil 1', 'CARRIER_LINK_6_PART1','Geben Sie den ersten Teil des Tracking Links von Versandunternehmen 6 ein. Dieser Teil bezieht sich auf die Trackingnummer<br /> Beispiel: https://www.deutschepost.de/sendung/simpleQueryResult.html?form.sendungsnummer=', 43),
('Paket Tracking - Versandunternehmen 6 Tracking Link - Teil 2', 'CARRIER_LINK_6_PART2','Geben Sie den zweiten Teil des Tracking Links von Versandunternehmen 6 ein. Dieser Teil bezieht sich auf den Tag der Aufgabe<br /> Beispiel: &form.einlieferungsdatum_tag=', 43),
('Paket Tracking - Versandunternehmen 6 Tracking Link - Teil 3', 'CARRIER_LINK_6_PART3','Geben Sie den dritten Teil des Tracking Links von Versandunternehmen 6 ein. Dieser Teil bezieht sich auf den Monat der Aufgabe<br /> Beispiel: &form.einlieferungsdatum_monat', 43),
('Paket Tracking - Versandunternehmen 6 Tracking Link - Teil 4', 'CARRIER_LINK_6_PART4','Geben Sie den viertrn Teil des Tracking Links von Versandunternehmen 6 ein. Dieser Teil bezieht sich auf das Jahr der Aufgabe<br /> Beispiel: &form.einlieferungsdatum_jahr', 43),
('Paket Tracking - Versandunternehmen 6 Status', 'CARRIER_STATUS_6','Wollen Sie das Tracking für Versandunternehmen 6 aktivieren?<br />Auf false setzen, wenn Sie NICHT wollen, dass Versandunternehmen 6 auf der Admin- und der Kundenseite erscheint.', 43),
('Paket Tracking - Sidebox Einstellung', 'MAX_DISPLAY_PRODUCTS_IN_TRACK_ORDERS_BOX','Maximale Anzahl der Bestellungen, die in der Bestellverfolgungs-Sidebox angezeigt werden sollen.', 43),
('Paket Tracking - Super Orders oder Edit Orders', 'TY_TRACKER','Haben Sie das Modul Super Orders 3.0 oder Edit Orders 3.0 installiert? Dann stellen Sie hier auf TRUE, damit die Paket Tracking Felder in den Super Orders oder Edit Orders Eingabemasken angezeigt werden. Nur auf TRUE stellen, wenn Sie diese Zusatzmodule in Version 3.0 installiert haben!', 43);


###################################
# Register for Admin Access Control
###################################

INSERT INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order)
VALUES ('configProdPaketTracking','BOX_CONFIGURATION_PRODUCT_PAKETTRACKING','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);


##############################
# Change orders_status_history
##############################
                               
ALTER TABLE `orders_status_history` 
ADD `track_id1` TEXT,
ADD `track_id2` TEXT,
ADD `track_id3` TEXT,
ADD `track_id4` TEXT,
ADD `track_id5` TEXT,
ADD `track_id6` TEXT,
ADD `track_day` int(2),
ADD `track_month` int(2),
ADD `track_year` int(4);