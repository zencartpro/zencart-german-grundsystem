#
# * Country/Zones Zen Cart SQL Load for MySQL databases
# * @package Installer
# * @access private
# * @copyright Copyright 2003-2016 Zen Cart Development Team
# * @copyright Portions Copyright 2003 osCommerce
# * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
# * @version GIT: $Id: Author: DrByte  Sat Feb 1 23:58:27 2014 -0500 Modified in v1.5.3 $
#
# NOTE: UTF8 files need to be saved with encoding format set to UTF8-without-BOM.
#


## SQL Sections Specific to UTF8 character set

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Convert currencies for Text emails', 'CURRENCIES_TRANSLATIONS', '&pound;,£:&euro;,€:&reg;,®:&trade;,™', 'What currency conversions do you need for Text emails?<br />Example = &amp;pound;,&pound;:&amp;euro;,&euro;', 12, 120, NULL, '2003-11-21 00:00:00', NULL, 'zen_cfg_textarea_small(');

INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (240,'Åland Islands','AX','ALA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (1,'Afghanistan','AF','AFG','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (2,'Albania','AL','ALB','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (3,'Algeria','DZ','DZA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (4,'American Samoa','AS','ASM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (5,'Andorra','AD','AND','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (6,'Angola','AO','AGO','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (7,'Anguilla','AI','AIA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (8,'Antarctica','AQ','ATA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (9,'Antigua and Barbuda','AG','ATG','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (10,'Argentina','AR','ARG','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (11,'Armenia','AM','ARM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (12,'Aruba','AW','ABW','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (13,'Australia','AU','AUS','7');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (14,'Austria','AT','AUT','5');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (15,'Azerbaijan','AZ','AZE','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (16,'Bahamas','BS','BHS','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (17,'Bahrain','BH','BHR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (18,'Bangladesh','BD','BGD','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (19,'Barbados','BB','BRB','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (20,'Belarus','BY','BLR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (21,'Belgium','BE','BEL','5');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (22,'Belize','BZ','BLZ','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (23,'Benin','BJ','BEN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (24,'Bermuda','BM','BMU','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (25,'Bhutan','BT','BTN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (26,'Bolivia','BO','BOL','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (27,'Bosnia and Herzegowina','BA','BIH','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (28,'Botswana','BW','BWA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (29,'Bouvet Island','BV','BVT','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (30,'Brazil','BR','BRA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (31,'British Indian Ocean Territory','IO','IOT','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (32,'Brunei Darussalam','BN','BRN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (33,'Bulgaria','BG','BGR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (34,'Burkina Faso','BF','BFA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (35,'Burundi','BI','BDI','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (36,'Cambodia','KH','KHM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (37,'Cameroon','CM','CMR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (38,'Canada','CA','CAN','2');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (39,'Cape Verde','CV','CPV','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (40,'Cayman Islands','KY','CYM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (41,'Central African Republic','CF','CAF','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (42,'Chad','TD','TCD','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (43,'Chile','CL','CHL','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (44,'China','CN','CHN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (45,'Christmas Island','CX','CXR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (46,'Cocos (Keeling) Islands','CC','CCK','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (47,'Colombia','CO','COL','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (48,'Comoros','KM','COM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (49,'Congo','CG','COG','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (50,'Cook Islands','CK','COK','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (51,'Costa Rica','CR','CRI','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (52,"Côte d'Ivoire",'CI','CIV','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (53,'Croatia','HR','HRV','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (54,'Cuba','CU','CUB','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (55,'Cyprus','CY','CYP','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (56,'Czech Republic','CZ','CZE','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (57,'Denmark','DK','DNK','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (58,'Djibouti','DJ','DJI','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (59,'Dominica','DM','DMA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (60,'Dominican Republic','DO','DOM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (61,'Timor-Leste','TL','TLS','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (62,'Ecuador','EC','ECU','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (63,'Egypt','EG','EGY','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (64,'El Salvador','SV','SLV','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (65,'Equatorial Guinea','GQ','GNQ','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (66,'Eritrea','ER','ERI','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (67,'Estonia','EE','EST','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (68,'Ethiopia','ET','ETH','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (69,'Falkland Islands (Malvinas)','FK','FLK','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (70,'Faroe Islands','FO','FRO','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (71,'Fiji','FJ','FJI','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (72,'Finland','FI','FIN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (73,'France','FR','FRA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (75,'French Guiana','GF','GUF','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (76,'French Polynesia','PF','PYF','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (77,'French Southern Territories','TF','ATF','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (78,'Gabon','GA','GAB','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (79,'Gambia','GM','GMB','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (80,'Georgia','GE','GEO','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (81,'Germany','DE','DEU','5');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (82,'Ghana','GH','GHA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (83,'Gibraltar','GI','GIB','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (84,'Greece','GR','GRC','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (85,'Greenland','GL','GRL','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (86,'Grenada','GD','GRD','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (87,'Guadeloupe','GP','GLP','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (88,'Guam','GU','GUM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (89,'Guatemala','GT','GTM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (90,'Guinea','GN','GIN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (91,'Guinea-bissau','GW','GNB','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (92,'Guyana','GY','GUY','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (93,'Haiti','HT','HTI','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (94,'Heard and Mc Donald Islands','HM','HMD','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (95,'Honduras','HN','HND','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (96,'Hong Kong','HK','HKG','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (97,'Hungary','HU','HUN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (98,'Iceland','IS','ISL','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (99,'India','IN','IND','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (100,'Indonesia','ID','IDN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (101,'Iran (Islamic Republic of)','IR','IRN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (102,'Iraq','IQ','IRQ','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (103,'Ireland','IE','IRL','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (104,'Israel','IL','ISR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (105,'Italy','IT','ITA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (106,'Jamaica','JM','JAM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (107,'Japan','JP','JPN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (108,'Jordan','JO','JOR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (109,'Kazakhstan','KZ','KAZ','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (110,'Kenya','KE','KEN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (111,'Kiribati','KI','KIR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (112,"Korea, Democratic People's Republic of",'KP','PRK','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (113,'Korea, Republic of','KR','KOR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (114,'Kuwait','KW','KWT','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (115,'Kyrgyzstan','KG','KGZ','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (116,"Lao People's Democratic Republic",'LA','LAO','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (117,'Latvia','LV','LVA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (118,'Lebanon','LB','LBN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (119,'Lesotho','LS','LSO','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (120,'Liberia','LR','LBR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (121,'Libya','LY','LBY','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (122,'Liechtenstein','LI','LIE','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (123,'Lithuania','LT','LTU','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (124,'Luxembourg','LU','LUX','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (125,'Macao','MO','MAC','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (126,'Macedonia, The Former Yugoslav Republic of','MK','MKD','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (127,'Madagascar','MG','MDG','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (128,'Malawi','MW','MWI','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (129,'Malaysia','MY','MYS','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (130,'Maldives','MV','MDV','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (131,'Mali','ML','MLI','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (132,'Malta','MT','MLT','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (133,'Marshall Islands','MH','MHL','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (134,'Martinique','MQ','MTQ','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (135,'Mauritania','MR','MRT','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (136,'Mauritius','MU','MUS','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (137,'Mayotte','YT','MYT','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (138,'Mexico','MX','MEX','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (139,'Micronesia, Federated States of','FM','FSM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (140,'Moldova','MD','MDA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (141,'Monaco','MC','MCO','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (142,'Mongolia','MN','MNG','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (143,'Montserrat','MS','MSR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (144,'Morocco','MA','MAR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (145,'Mozambique','MZ','MOZ','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (146,'Myanmar','MM','MMR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (147,'Namibia','NA','NAM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (148,'Nauru','NR','NRU','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (149,'Nepal','NP','NPL','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (150,'Netherlands','NL','NLD','5');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (151,'Bonaire, Sint Eustatius and Saba','BQ','BES','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (152,'New Caledonia','NC','NCL','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (153,'New Zealand','NZ','NZL','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (154,'Nicaragua','NI','NIC','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (155,'Niger','NE','NER','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (156,'Nigeria','NG','NGA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (157,'Niue','NU','NIU','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (158,'Norfolk Island','NF','NFK','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (159,'Northern Mariana Islands','MP','MNP','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (160,'Norway','NO','NOR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (161,'Oman','OM','OMN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (162,'Pakistan','PK','PAK','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (163,'Palau','PW','PLW','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (164,'Panama','PA','PAN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (165,'Papua New Guinea','PG','PNG','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (166,'Paraguay','PY','PRY','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (167,'Peru','PE','PER','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (168,'Philippines','PH','PHL','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (169,'Pitcairn','PN','PCN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (170,'Poland','PL','POL','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (171,'Portugal','PT','PRT','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (172,'Puerto Rico','PR','PRI','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (173,'Qatar','QA','QAT','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (174,'Réunion','RE','REU','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (175,'Romania','RO','ROU','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (176,'Russian Federation','RU','RUS','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (177,'Rwanda','RW','RWA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (178,'Saint Kitts and Nevis','KN','KNA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (179,'Saint Lucia','LC','LCA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (180,'Saint Vincent and the Grenadines','VC','VCT','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (181,'Samoa','WS','WSM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (182,'San Marino','SM','SMR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (183,'Sao Tome and Principe','ST','STP','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (184,'Saudi Arabia','SA','SAU','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (185,'Senegal','SN','SEN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (186,'Seychelles','SC','SYC','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (187,'Sierra Leone','SL','SLE','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (188,'Singapore','SG','SGP', '4');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (189,'Slovakia (Slovak Republic)','SK','SVK','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (190,'Slovenia','SI','SVN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (191,'Solomon Islands','SB','SLB','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (192,'Somalia','SO','SOM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (193,'South Africa','ZA','ZAF','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (194,'South Georgia and the South Sandwich Islands','GS','SGS','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (195,'Spain','ES','ESP','3');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (196,'Sri Lanka','LK','LKA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (197,'St. Helena','SH','SHN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (198,'St. Pierre and Miquelon','PM','SPM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (199,'Sudan','SD','SDN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (200,'Suriname','SR','SUR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (201,'Svalbard and Jan Mayen Islands','SJ','SJM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (202,'Swaziland','SZ','SWZ','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (203,'Sweden','SE','SWE','5');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (204,'Switzerland','CH','CHE','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (205,'Syrian Arab Republic','SY','SYR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (206,'Taiwan','TW','TWN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (207,'Tajikistan','TJ','TJK','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (208,'Tanzania, United Republic of','TZ','TZA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (209,'Thailand','TH','THA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (210,'Togo','TG','TGO','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (211,'Tokelau','TK','TKL','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (212,'Tonga','TO','TON','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (213,'Trinidad and Tobago','TT','TTO','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (214,'Tunisia','TN','TUN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (215,'Turkey','TR','TUR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (216,'Turkmenistan','TM','TKM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (217,'Turks and Caicos Islands','TC','TCA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (218,'Tuvalu','TV','TUV','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (219,'Uganda','UG','UGA','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (220,'Ukraine','UA','UKR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (221,'United Arab Emirates','AE','ARE','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (222,'United Kingdom','GB','GBR','6');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (223,'United States','US','USA', '2');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (224,'United States Minor Outlying Islands','UM','UMI','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (225,'Uruguay','UY','URY','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (226,'Uzbekistan','UZ','UZB','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (227,'Vanuatu','VU','VUT','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (228,'Vatican City State (Holy See)','VA','VAT','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (229,'Venezuela','VE','VEN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (230,'Viet Nam','VN','VNM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (231,'Virgin Islands (British)','VG','VGB','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (232,'Virgin Islands (U.S.)','VI','VIR','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (233,'Wallis and Futuna Islands','WF','WLF','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (234,'Western Sahara','EH','ESH','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (235,'Yemen','YE','YEM','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (236,'Serbia','RS','SRB','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (238,'Zambia','ZM','ZMB','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (239,'Zimbabwe','ZW','ZWE','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (241,'Palestine, State of','PS','PSE','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (242,'Montenegro','ME','MNE','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (243,'Guernsey','GG','GGY','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (244,'Isle of Man','IM','IMN','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (245,'Jersey','JE','JEY','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (246,'South Sudan','SS','SSD','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (247,'Curaçao','CW','CUW','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (248,'Sint Maarten (Dutch part)','SX','SXM','1');


INSERT INTO countries_name (countries_id, language_id, countries_name) VALUES

(1, 1, 'Afghanistan'),
(2, 1,  'Albania'),
(3, 1,  'Algeria'),
(4, 1,  'American Samoa'),
(5, 1,  'Andorra'),
(6, 1,  'Angola'),
(7, 1,  'Anguilla'),
(8, 1,  'Antarctica'),
(9,  1, 'Antigua and Barbuda'),
(10, 1,  'Argentina'),
(11, 1,  'Armenia'),
(12,  1, 'Aruba'),
(13, 1,  'Australia'),
(14, 1,  'Austria'),
(15, 1,  'Azerbaijan'),
(16, 1,  'Bahamas'),
(17, 1,  'Bahrain'),
(18, 1,  'Bangladesh'),
(19, 1,  'Barbados'),
(20, 1,  'Belarus'),
(21, 1,  'Belgium'),
(22, 1,  'Belize'),
(23, 1,  'Benin'),
(24, 1,  'Bermuda'),
(25, 1,  'Bhutan'),
(26, 1,  'Bolivia'),
(27, 1,  'Bosnia and Herzegowina'),
(28, 1,  'Botswana'),
(29, 1,  'Bouvet Island'),
(30, 1,  'Brazil'),
(31, 1,  'British Indian Ocean Territory'),
(32, 1,  'Brunei Darussalam'),
(33, 1,  'Bulgaria'),
(34, 1,  'Burkina Faso'),
(35, 1,  'Burundi'),
(36, 1,  'Cambodia'),
(37, 1,  'Cameroon'),
(38, 1,  'Canada'),
(39, 1,  'Cape Verde'),
(40, 1,  'Cayman Islands'),
(41, 1,  'Central African Republic'),
(42, 1,  'Chad'),
(43, 1,  'Chile'),
(44, 1,  'China'),
(45, 1,  'Christmas Island'),
(46, 1,  'Cocos (Keeling) Islands'),
(47, 1,  'Colombia'),
(48, 1,  'Comoros'),
(49, 1,  'Congo'),
(50, 1,  'Cook Islands'),
(51, 1,  'Costa Rica'),
(52, 1,  'Côte d''Ivoire'),
(53, 1,  'Croatia'),
(54, 1,  'Cuba'),
(55, 1,  'Cyprus'),
(56, 1,  'Czech Republic'),
(57, 1,  'Denmark'),
(58, 1,  'Djibouti'),
(59, 1,  'Dominica'),
(60, 1,  'Dominican Republic'),
(61, 1,  'Timor-Leste',),
(62, 1,  'Ecuador'),
(63, 1,  'Egypt'),
(64, 1,  'El Salvador'),
(65, 1,  'Equatorial Guinea'),
(66, 1,  'Eritrea'),
(67, 1,  'Estonia'),
(68, 1,  'Ethiopia'),
(69, 1,  'Falkland Islands (Malvinas)'),
(70, 1,  'Faroe Islands'),
(71, 1,  'Fiji'),
(72, 1,  'Finland'),
(73, 1,  'France'),
(75, 1,  'French Guiana'),
(76, 1,  'French Polynesia'1),
(77, 1,  'French Southern Territories'),
(78, 1,  'Gabon'),
(79, 1,  'Gambia'),
(80, 1,  'Georgia'),
(81, 1,  'Germany'),
(82, 1,  'Ghana'),
(83, 1,  'Gibraltar'),
(84, 1,  'Greece'),
(85, 1,  'Greenland'),
(86, 1,  'Grenada'),
(87, 1,  'Guadeloupe'),
(88, 1,  'Guam'),
(89, 1,  'Guatemala'),
(90, 1,  'Guinea'),
(91, 1,  'Guinea-bissau'),
(92, 1,  'Guyana'),
(93, 1,  'Haiti'),
(94, 1,  'Heard and Mc Donald Islands'),
(95, 1,  'Honduras'),
(96, 1,  'Hong Kong'),
(97, 1,  'Hungary'),
(98, 1,  'Iceland'),
(99, 1,  'India'),
(100, 1,  'Indonesia'),
(101, 1,  'Iran (Islamic Republic of)'),
(102, 1,  'Iraq'),
(103, 1,  'Ireland'),
(104, 1,  'Israel'),
(105, 1,  'Italy'),
(106, 1,  'Jamaica'),
(107, 1,  'Japan'),
(108, 1,  'Jordan'),
(109, 1,  'Kazakhstan'),
(110, 1, 'Kenya'),
(111, 1, 'Kiribati'),
(112, 1, 'Korea, Democratic People''s Republic of'),
(113, 1, 'Korea, Republic of'),
(114, 1, 'Kuwait'),
(115, 1, 'Kyrgyzstan'),
(116, 1, 'Lao People''s Democratic Republic'),
(117, 1, 'Latvia'),
(118, 1,  'Lebanon'),
(119, 1,  'Lesotho'),
(120, 1,  'Liberia'),
(121, 1,  'Libya'),
(122, 1,  'Liechtenstein'),
(123, 1,  'Lithuania'),
(124, 1,  'Luxembourg'),
(125, 1,  'Macao'),
(126, 1,  'Macedonia, The Former Yugoslav Republic of'),
(127, 1,  'Madagascar'),
(128, 1,  'Malawi'),
(129, 1,  'Malaysia'),
(130, 1,  'Maldives'),
(131, 1, 'Mali'),
(132, 1, 'Malta'),
(133, 1, 'Marshall Islands'),
(134, 1, 'Martinique'),
(135, 1, 'Mauritania'),
(136, 1, 'Mauritius'),
(137, 1, 'Mayotte'),
(138, 1, 'Mexico'),
(139, 1, 'Micronesia, Federated States of'),
(140, 1, 'Moldova'),
(141, 1, 'Monaco'),
(142, 1, 'Mongolia'),
(143, 1, 'Montserrat'),
(144, 1, 'Morocco'),
(145, 1, 'Mozambique'),
(146, 1, 'Myanmar'),
(147, 1, 'Namibia'),
(148, 1, 'Nauru'),
(149, 1, 'Nepal'),
(150, 1, 'Netherlands'),
(151, 1, 'Bonaire, Sint Eustatius and Saba'),
(152, 1, 'New Caledonia'),
(153, 1, 'New Zealand'),
(154, 1, 'Nicaragua'),
(155, 1, 'Niger'),
(156, 1, 'Nigeria'),
(157, 1, 'Niue'),
(158, 1, 'Norfolk Island'),
(159, 1, 'Northern Mariana Islands'),
(160, 1, 'Norway'),
(161, 1, 'Oman',),
(162, 1, 'Pakistan'),
(163, 1, 'Palau'),
(164, 1, 'Panama'),
(165, 1, 'Papua New Guinea'),
(166, 1, 'Paraguay'),
(167, 1, 'Peru'),
(168, 1, 'Philippines'),
(169, 1, 'Pitcairn'),
(170, 1, 'Poland'),
(171, 1, 'Portugal'),
(172, 1, 'Puerto Rico'),
(173, 1, 'Qatar'),
(174, 1, 'Réunion'),
(175, 1, 'Romania'),
(176, 1, 'Russian Federation'),
(177, 1, 'Rwanda'),
(178, 1, 'Saint Kitts and Nevis'),
(179, 1, 'Saint Lucia'),
(180, 1, 'Saint Vincent and the Grenadines'),
(181, 1, 'Samoa'),
(182, 1, 'San Marino'),
(183, 1, 'Sao Tome and Principe'),
(184, 1, 'Saudi Arabia'),
(185, 1, 'Senegal'),
(186, 1, 'Seychelles'),
(187, 1, 'Sierra Leone'),
(188, 1, 'Singapore'),
(189, 1, 'Slovakia (Slovak Republic)',),
(190, 1, 'Slovenia'),
(191, 1, 'Solomon Islands'),
(192, 1, 'Somalia'),
(193, 1, 'South Africa'),
(194, 1, 'South Georgia and the South Sandwich Islands'),
(195, 1, 'Spain'),
(196, 1, 'Sri Lanka'),
(197, 1, 'St. Helena'),
(198, 1, 'St. Pierre and Miquelon'),
(199, 1, 'Sudan'),
(200, 1, 'Suriname'),
(201, 1, 'Svalbard and Jan Mayen Islands'),
(202, 1, 'Swaziland'),
(203, 1, 'Sweden'),
(204, 1, 'Switzerland'),
(205, 1, 'Syrian Arab Republic'),
(206, 1, 'Taiwan'),
(207, 1, 'Tajikistan'),
(208, 1, 'Tanzania, United Republic of'),
(209, 1, 'Thailand'),
(210, 1, 'Togo'),
(211, 1, 'Tokelau'),
(212, 1, 'Tonga'),
(213, 1, 'Trinidad and Tobago'),
(214, 1, 'Tunisia'),
(215, 1, 'Turkey'),
(216, 1, 'Turkmenistan'),
(217, 1, 'Turks and Caicos Islands'),
(218, 1, 'Tuvalu'),
(219, 1, 'Uganda'),
(220, 1, 'Ukraine'),
(221, 1, 'United Arab Emirates'),
(222, 1, 'United Kingdom',),
(223, 1, 'United States'),
(224, 1, 'United States Minor Outlying Islands'),
(225, 1, 'Uruguay'),
(226, 1, 'Uzbekistan'),
(227, 1, 'Vanuatu'),
(228, 1, 'Vatican City State (Holy See)'),
(229, 1, 'Venezuela'),
(230, 1, 'Viet Nam'),
(231, 1, 'Virgin Islands (British)'),
(232, 1, 'Virgin Islands (U.S.)'),
(233, 1, 'Wallis and Futuna Islands'),
(234, 1, 'Western Sahara'),
(235, 1, 'Yemen'),
(236, 1, 'Serbia'),
(238, 1, 'Zambia'),
(239, 1, 'Zimbabwe'),
(240, 1, 'Åland Islands'),
(241, 1, 'Palestine, State of'),
(242, 1, 'Montenegro'),
(243, 1, 'Guernsey'),
(244, 1, 'Isle of Man'),
(245, 1, 'Jersey'),
(246, 1, 'South Sudan'),
(247, 1, 'Curaçao'),
(248, 1, 'Sint Maarten (Dutch part)'),
(1, 43, 'Afghanistan'),
(2, 43,  'Albanien'),
(3, 43,  'Algerien'),
(4, 43,  'American Samoa'),
(5, 43,  'Andorra'),
(6, 43,  'Angola'),
(7, 43,  'Anguilla'),
(8, 43,  'Antarctica'),
(9,  43, 'Antigua and Barbuda'),
(10, 43,  'Argentinien'),
(11, 43,  'Armenien'),
(12, 43, 'Aruba'),
(13, 43,  'Australien'),
(14, 43,  'Österreich'),
(15, 43,  'Aserbaidschan'),
(16, 43,  'Bahamas'),
(17, 43,  'Bahrain'),
(18, 43,  'Bangladesch'),
(19, 43,  'Barbados'),
(20, 43,  'Weissrussland'),
(21, 43,  'Belgien'),
(22, 43,  'Belize'),
(23, 43,  'Benin'),
(24, 43,  'Bermuda'),
(25, 43,  'Bhutan'),
(26, 43,  'Bolivien'),
(27, 43,  'Bosnien Herzegowina'),
(28, 43,  'Botswana'),
(29, 43,  'Bouvet Island'),
(30, 43,  'Brasilien'),
(31, 43,  'British Indian Ocean Territory'),
(32, 43,  'Brunei Darussalam'),
(33, 43,  'Bulgarien'),
(34, 43,  'Burkina Faso'),
(35, 43,  'Burundi'),
(36, 43,  'Kambodscha'),
(37, 43,  'Kamerun'),
(38, 43,  'Kanada'),
(39, 43,  'Cape Verde'),
(40, 43,  'Cayman Islands'),
(41, 43,  'Zentralafrikanische Republik'),
(42, 43,  'Tschad'),
(43, 43,  'Chile'),
(44, 43,  'China'),
(45, 43,  'Christmas Island'),
(46, 43,  'Cocos (Keeling) Islands'),
(47, 43,  'Kolumbien'),
(48, 43,  'Komoren'),
(49, 43,  'Kongo'),
(50, 43,  'Cook Islands'),
(51, 43,  'Costa Rica'),
(52, 43,  'Elfenbeinküste'),
(53, 43,  'Kroatien'),
(54, 43,  'Kuba'),
(55, 43,  'Zypern'),
(56, 43,  'Tschechien'),
(57, 43,  'Dänemark'),
(58, 43,  'Djibouti'),
(59, 43,  'Dominica'),
(60, 43,  'Dominikanische Republik'),
(61, 43,  'Timor-Leste',),
(62, 43,  'Ecuador'),
(63, 43,  'Ägypten'),
(64, 43,  'El Salvador'),
(65, 43,  'Equatorial Guinea'),
(66, 43,  'Eritrea'),
(67, 43,  'Estland'),
(68, 43,  'Äthiopien'),
(69, 43,  'Falkland Inseln (Malvinas)'),
(70, 43,  'Faroer Inseln'),
(71, 43,  'Fiji'),
(72, 43,  'Finnland'),
(73, 43,  'Frankreich'),
(75, 43,  'French Guiana'),
(76, 43,  'French Polynesia'1),
(77, 43,  'French Southern Territories'),
(78, 43,  'Gabun'),
(79, 43,  'Gambia'),
(80, 43,  'Georgien'),
(81, 43,  'Deutschland'),
(82, 43,  'Ghana'),
(83, 43,  'Gibraltar'),
(84, 43,  'Greece'),
(85, 43,  'Griechenland'),
(86, 43,  'Grenada'),
(87, 43,  'Guadeloupe'),
(88, 43,  'Guam'),
(89, 43,  'Guatemala'),
(90, 43,  'Guinea'),
(91, 43,  'Guinea-Bissau'),
(92, 43,  'Guyana'),
(93, 43,  'Haiti'),
(94, 43,  'Heard and Mc Donald Islands'),
(95, 43,  'Honduras'),
(96, 43,  'Hong Kong'),
(97, 43,  'Ungarn'),
(98, 43,  'Island'),
(99, 43,  'Indien'),
(100, 43,  'Indonesien'),
(101, 43,  'Iran'),
(102, 43,  'Irak'),
(103, 43,  'Irland'),
(104, 43,  'Israel'),
(105, 43,  'Italien'),
(106, 43,  'Jamaica'),
(107, 43,  'Japan'),
(108, 43,  'Jordanien'),
(109, 43,  'Kasachstan'),
(110, 43, 'Kenia'),
(111, 43, 'Kiribati'),
(112, 43, 'Nordkorea'),
(113, 43, 'Südkorea'),
(114, 43, 'Kuwait'),
(115, 43, 'Kyrgyzstan'),
(116, 43, 'Laos'),
(117, 43, 'Lettland'),
(118, 43,  'Libanon'),
(119, 43,  'Lesotho'),
(120, 43,  'Liberia'),
(121, 43,  'Libyen'),
(122, 43,  'Liechtenstein'),
(123, 43,  'Litauen'),
(124, 43,  'Luxembourg'),
(125, 43,  'Macao'),
(126, 43,  'Mazedonien'),
(127, 43,  'Madagaskar'),
(128, 43,  'Malawi'),
(129, 43,  'Malaysia'),
(130, 43,  'Malediven'),
(131, 43, 'Mali'),
(132, 43, 'Malta'),
(133, 43, 'Marshall Islands'),
(134, 43, 'Martinique'),
(135, 43, 'Mauretanien'),
(136, 43, 'Mauritius'),
(137, 43, 'Mayotte'),
(138, 43, 'Mexico'),
(139, 43, 'Micronesia, Federated States of'),
(140, 43, 'Moldova'),
(141, 43, 'Monaco'),
(142, 43, 'Mongolei'),
(143, 43, 'Montserrat'),
(144, 43, 'Marokko'),
(145, 43, 'Mozambique'),
(146, 43, 'Myanmar'),
(147, 43, 'Namibia'),
(148, 43, 'Nauru'),
(149, 43, 'Nepal'),
(150, 43, 'Niederlande'),
(151, 43, 'Bonaire, Sint Eustatius and Saba'),
(152, 43, 'New Caledonia'),
(153, 43, 'Neuseeland'),
(154, 43, 'Nicaragua'),
(155, 43, 'Niger'),
(156, 43, 'Nigeria'),
(157, 43, 'Niue'),
(158, 43, 'Norfolk Island'),
(159, 43, 'Northern Mariana Islands'),
(160, 43, 'Norwegen'),
(161, 43, 'Oman',),
(162, 43, 'Pakistan'),
(163, 43, 'Palau'),
(164, 43, 'Panama'),
(165, 43, 'Papua Neu Guinea'),
(166, 43, 'Paraguay'),
(167, 43, 'Peru'),
(168, 43, 'Philippinen'),
(169, 43, 'Pitcairn'),
(170, 43, 'Polen'),
(171, 43, 'Portugal'),
(172, 43, 'Puerto Rico'),
(173, 43, 'Qatar'),
(174, 43, 'Réunion'),
(175, 43, 'Rumänien'),
(176, 43, 'Russland'),
(177, 43, 'Ruanda'),
(178, 43, 'Saint Kitts and Nevis'),
(179, 43, 'Saint Lucia'),
(180, 43, 'Saint Vincent and the Grenadines'),
(181, 43, 'Samoa'),
(182, 43, 'San Marino'),
(183, 43, 'Sao Tome and Principe'),
(184, 43, 'Saudi Arabien'),
(185, 43, 'Senegal'),
(186, 43, 'Seychellen'),
(187, 43, 'Sierra Leone'),
(188, 43, 'Singapur'),
(189, 43, 'Slowakei',),
(190, 43, 'Slowenien'),
(191, 43, 'Solomon Islands'),
(192, 43, 'Somalia'),
(193, 43, 'Südafrika'),
(194, 43, 'South Georgia and the South Sandwich Islands'),
(195, 43, 'Spanien'),
(196, 43, 'Sri Lanka'),
(197, 43, 'St. Helena'),
(198, 43, 'St. Pierre and Miquelon'),
(199, 43, 'Sudan'),
(200, 43, 'Surinam'),
(201, 43, 'Svalbard and Jan Mayen Islands'),
(202, 43, 'Swaziland'),
(203, 43, 'Schweden'),
(204, 43, 'Schweiz'),
(205, 43, 'Syrian Arab Republic'),
(206, 43, 'Taiwan'),
(207, 43, 'Tajikistan'),
(208, 43, 'Tansania'),
(209, 43, 'Thailand'),
(210, 43, 'Togo'),
(211, 43, 'Tokelau'),
(212, 43, 'Tonga'),
(213, 43, 'Trinidad and Tobago'),
(214, 43, 'Tunesien'),
(215, 43, 'Türkei'),
(216, 43, 'Turkmenistan'),
(217, 43, 'Turks and Caicos Islands'),
(218, 43, 'Tuvalu'),
(219, 43, 'Uganda'),
(220, 43, 'Ukraine'),
(221, 43, 'Vereinigte Arabische Emirate'),
(222, 43, 'Großbritannien'),
(223, 43, 'USA'),
(224, 43, 'United States Minor Outlying Islands'),
(225, 43, 'Uruguay'),
(226, 43, 'Usbekistan'),
(227, 43, 'Vanuatu'),
(228, 43, 'Vatikanstaat'),
(229, 43, 'Venezuela'),
(230, 43, 'Vietnam'),
(231, 43, 'Virgin Islands (British)'),
(232, 43, 'Virgin Islands (U.S.)'),
(233, 43, 'Wallis and Futuna Islands'),
(234, 43, 'Western Sahara'),
(235, 43, 'Jemen'),
(236, 43, 'Serbien'),
(238, 43, 'Sambia'),
(239, 43, 'Zimbabwe'),
(240, 43, 'Åland Islands'),
(241, 43, 'Palästina'),
(242, 43, 'Montenegro'),
(243, 43, 'Guernsey'),
(244, 43, 'Isle of Man'),
(245, 43, 'Jersey'),
(246, 43, 'Südsudan'),
(247, 43, 'Curaçao'),
(248, 43, 'Sint Maarten (Dutch part)');





# USA
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (1,223,'AL','Alabama');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (2,223,'AK','Alaska');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (3,223,'AS','American Samoa');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (4,223,'AZ','Arizona');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (5,223,'AR','Arkansas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (7,223,'AA','Armed Forces Americas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (9,223,'AE','Armed Forces Europe');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (11,223,'AP','Armed Forces Pacific');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (12,223,'CA','California');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (13,223,'CO','Colorado');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (14,223,'CT','Connecticut');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (15,223,'DE','Delaware');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (16,223,'DC','District of Columbia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (17,223,'FM','Federated States Of Micronesia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (18,223,'FL','Florida');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (19,223,'GA','Georgia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (20,223,'GU','Guam');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (21,223,'HI','Hawaii');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (22,223,'ID','Idaho');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (23,223,'IL','Illinois');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (24,223,'IN','Indiana');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (25,223,'IA','Iowa');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (26,223,'KS','Kansas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (27,223,'KY','Kentucky');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (28,223,'LA','Louisiana');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (29,223,'ME','Maine');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (30,223,'MH','Marshall Islands');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (31,223,'MD','Maryland');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (32,223,'MA','Massachusetts');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (33,223,'MI','Michigan');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (34,223,'MN','Minnesota');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (35,223,'MS','Mississippi');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (36,223,'MO','Missouri');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (37,223,'MT','Montana');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (38,223,'NE','Nebraska');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (39,223,'NV','Nevada');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (40,223,'NH','New Hampshire');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (41,223,'NJ','New Jersey');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (42,223,'NM','New Mexico');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (43,223,'NY','New York');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (44,223,'NC','North Carolina');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (45,223,'ND','North Dakota');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (46,223,'MP','Northern Mariana Islands');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (47,223,'OH','Ohio');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (48,223,'OK','Oklahoma');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (49,223,'OR','Oregon');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (50,163,'PW','Palau');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (51,223,'PA','Pennsylvania');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (52,223,'PR','Puerto Rico');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (53,223,'RI','Rhode Island');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (54,223,'SC','South Carolina');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (55,223,'SD','South Dakota');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (56,223,'TN','Tennessee');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (57,223,'TX','Texas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (58,223,'UT','Utah');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (59,223,'VT','Vermont');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (60,223,'VI','Virgin Islands');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (61,223,'VA','Virginia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (62,223,'WA','Washington');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (63,223,'WV','West Virginia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (64,223,'WI','Wisconsin');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (65,223,'WY','Wyoming');

# Canada
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (66,38,'AB','Alberta');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (67,38,'BC','British Columbia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (68,38,'MB','Manitoba');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (69,38,'NL','Newfoundland');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (70,38,'NB','New Brunswick');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (71,38,'NS','Nova Scotia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (72,38,'NT','Northwest Territories');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (73,38,'NU','Nunavut');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (74,38,'ON','Ontario');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (75,38,'PE','Prince Edward Island');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (76,38,'QC','Quebec');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (77,38,'SK','Saskatchewan');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (78,38,'YT','Yukon Territory');

# Germany
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (79,81,'NDS','Niedersachsen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (80,81,'BAW','Baden-Württemberg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (81,81,'BAY','Bayern');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (82,81,'BER','Berlin');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (83,81,'BRG','Brandenburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (84,81,'BRE','Bremen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (85,81,'HAM','Hamburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (86,81,'HES','Hessen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (87,81,'MEC','Mecklenburg-Vorpommern');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (88,81,'NRW','Nordrhein-Westfalen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (89,81,'RHE','Rheinland-Pfalz');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (90,81,'SAR','Saarland');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (91,81,'SAS','Sachsen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (92,81,'SAC','Sachsen-Anhalt');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (93,81,'SCN','Schleswig-Holstein');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (94,81,'THE','Thüringen');

# Austria
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (95,14,'WI','Wien');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (96,14,'NO','Niederösterreich');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (97,14,'OO','Oberösterreich');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (98,14,'SB','Salzburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (99,14,'KN','Kärnten');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (100,14,'ST','Steiermark');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (101,14,'TI','Tirol');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (102,14,'BL','Burgenland');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (103,14,'VB','Voralberg');

# Schweiz
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (104,204,'AG','Aargau');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (105,204,'AI','Appenzell Innerrhoden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (106,204,'AR','Appenzell Ausserrhoden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (107,204,'BE','Bern');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (108,204,'BL','Basel-Landschaft');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (109,204,'BS','Basel-Stadt');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (110,204,'FR','Freiburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (111,204,'GE','Genf');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (112,204,'GL','Glarus');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (113,204,'JU','Graubnden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (114,204,'JU','Jura');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (115,204,'LU','Luzern');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (116,204,'NE','Neuenburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (117,204,'NW','Nidwalden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (118,204,'OW','Obwalden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (119,204,'SG','St. Gallen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (120,204,'SH','Schaffhausen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (121,204,'SO','Solothurn');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (122,204,'SZ','Schwyz');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (123,204,'TG','Thurgau');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (124,204,'TI','Tessin');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (125,204,'UR','Uri');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (126,204,'VD','Waadt');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (127,204,'VS','Wallis');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (128,204,'ZG','Zug');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (129,204,'ZH','Zürich');

# Spanien
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'A Coruña','A Coruña');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Álava','Álava');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Albacete','Albacete');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Alicante','Alicante');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Almería','Almería');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Asturias','Asturias');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Ávila','Ávila');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Badajoz','Badajoz');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Baleares','Baleares');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Barcelona','Barcelona');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Burgos','Burgos');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Cáceres','Cáceres');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Cádiz','Cádiz');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Cantabria','Cantabria');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Castellón','Castellón');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Ceuta','Ceuta');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Ciudad Real','Ciudad Real');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Córdoba','Córdoba');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Cuenca','Cuenca');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Girona','Girona');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Granada','Granada');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Guadalajara','Guadalajara');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Guipúzcoa','Guipúzcoa');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Huelva','Huelva');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Huesca','Huesca');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Jaén','Jaén');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'La Rioja','La Rioja');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Las Palmas','Las Palmas');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'León','León');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Lérida','Lérida');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Lugo','Lugo');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Madrid','Madrid');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Málaga','Málaga');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Melilla','Melilla');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Murcia','Murcia');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Navarra','Navarra');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Ourense','Ourense');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Palencia','Palencia');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Pontevedra','Pontevedra');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Salamanca','Salamanca');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Santa Cruz de Tenerife','Santa Cruz de Tenerife');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Segovia','Segovia');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Sevilla','Sevilla');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Soria','Soria');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Tarragona','Tarragona');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Teruel','Teruel');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Toledo','Toledo');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Valencia','Valencia');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Valladolid','Valladolid');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Vizcaya','Vizcaya');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Zamora','Zamora');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Zaragoza','Zaragoza');

#Australien zones
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 13, 'ACT', 'Australian Capital Territory');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 13, 'NSW', 'New South Wales');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 13, 'NT', 'Northern Territory');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 13, 'QLD', 'Queensland');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 13, 'SA', 'South Australia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 13, 'TAS', 'Tasmania');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 13, 'VIC', 'Victoria');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 13, 'WA', 'Western Australia');

#Italien zones
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'AG','Agrigento');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'AL','Alessandria');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'AN','Ancona');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'AO','Aosta');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'AR','Arezzo');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'AP','Ascoli Piceno');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'AT','Asti');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'AV','Avellino');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'BA','Bari');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'BT','Barletta Andria Trani');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'BL','Belluno');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'BN','Benevento');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'BG','Bergamo');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'BI','Biella');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'BO','Bologna');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'BZ','Bolzano');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'BS','Brescia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'BR','Brindisi');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'CA','Cagliari');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'CL','Caltanissetta');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'CB','Campobasso');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'CI','Carbonia-Iglesias');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'CE','Caserta');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'CT','Catania');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'CZ','Catanzaro');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'CH','Chieti');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'CO','Como');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'CS','Cosenza');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'CR','Cremona');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'KR','Crotone');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'CN','Cuneo');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'EN','Enna');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'FM','Fermo');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'FE','Ferrara');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'FI','Firenze');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'FG','Foggia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'FC','Forlì Cesena');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'FR','Frosinone');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'GE','Genova');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'GO','Gorizia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'GR','Grosseto');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'IM','Imperia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'IS','Isernia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'AQ','Aquila');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'SP','La Spezia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'LT','Latina');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'LE','Lecce');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'LC','Lecco');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'LI','Livorno');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'LO','Lodi');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'LU','Lucca');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'MC','Macerata');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'MN','Mantova');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'MS','Massa Carrara');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'MT','Matera');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'VS','Medio Campidano');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'ME','Messina');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'MI','Milano');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'MO','Modena');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'MB','Monza e Brianza');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'NA','Napoli');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'NO','Novara');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'NU','Nuoro');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'OG','Ogliastra');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'OT','Olbia-Tempio');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'OR','Oristano');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'PD','Padova');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'PA','Palermo');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'PR','Parma');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'PG','Perugia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'PV','Pavia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'PU','Pesaro Urbino');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'PE','Pescara');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'PC','Piacenza');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'PI','Pisa');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'PT','Pistoia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'PN','Pordenone');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'PZ','Potenza');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'PO','Prato');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'RG','Ragusa');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'RA','Ravenna');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'RC','Reggio Calabria');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'RE','Reggio Emilia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'RI','Rieti');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'RN','Rimini');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'RM','Roma');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'RO','Rovigo');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'SA','Salerno');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'SS','Sassari');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'SV','Savona');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'SI','Siena');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'SR','Siracusa');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'SO','Sondrio');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'TA','Taranto');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'TE','Teramo');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'TR','Terni');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'TO','Torino');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'TP','Trapani');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'TN','Trento');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'TV','Treviso');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'TS','Trieste');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'UD','Udine');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'VA','Varese');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'VE','Venezia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'VB','Verbania');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'VC','Vercelli');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'VR','Verona');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'VV','Vibo Valentia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'VI','Vicenza');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (NULL, 105,'VT','Viterbo');

