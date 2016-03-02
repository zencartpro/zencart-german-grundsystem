##########################################################################
# Zen Colorbox 2.3 Multilanguage Install - 2016-03-02 - webchills
##########################################################################

INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES
('Zen Colorbox', 'Configure Zen Colorbox settings', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
('<b>Zen Colorbox</b>', 'ZEN_COLORBOX_STATUS', 'true', '<br />If true, all product images on the following pages will be displayed within a lightbox:<br /><br />- document_general_info<br />- document_product_info<br />- page (EZ-Pages)<br />- product_free_shipping_info<br />- product_info<br />- product_music_info<br />- product_reviews<br />- product_reviews_info<br />- product_reviews_write<br /><br /><b>Default: true</b>', @gid, 100, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('Overlay Opacity', 'ZEN_COLORBOX_OVERLAY_OPACITY', '0.6', '<br />Controls the transparency of the overlay.<br /><br /><b>Default: 0.6</b>', @gid, 101, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''0'', ''0.1'', ''0.2'', ''0.3'', ''0.4'', ''0.5'', ''0.6'', ''0.7'', ''0.8'', ''0.9'', ''1''), '),
('Resize Duration', 'ZEN_COLORBOX_RESIZE_DURATION', '400', '<br />Controls the speed of the image resizing.<br /><br />Note: This value is measured in milliseconds.<br /><br /><b>Default: 400</b><br />', @gid, 102, NOW(), NOW(), NULL, NULL),
('Initial Width', 'ZEN_COLORBOX_INITIAL_WIDTH', '250', '<br />If Enable Resize Animations is set to true, the lightbox will resize its width from this value to the current image width, when first displayed.<br /><br />Note: This value is measured in pixels.<br /><br /><b>Default: 250</b><br />', @gid, 103, NOW(), NOW(), NULL, NULL),
('Initial Height', 'ZEN_COLORBOX_INITIAL_HEIGHT', '250', '<br />If Enable Resize Animations is set to true, the lightbox will resize its height from this value to the current image height, when first displayed.<br /><br />Note: This value is measured in pixels.<br /><br /><b>Default: 250</b><br />', @gid, 104, NOW(), NOW(), NULL, NULL),
('Display Image Counter', 'ZEN_COLORBOX_COUNTER', 'true', '<br />If true, the image counter will be displayed (below the caption of each image) within the lightbox.<br /><br /><b>Default: true</b>', @gid, 105, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('Close on Overlay Click', 'ZEN_COLORBOX_CLOSE_OVERLAY', 'false', '<br />If true, the lightbox will close when the overlay is clicked.<br /><br /><b>Default: false</b>', @gid, 106, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('Loop', 'ZEN_COLORBOX_LOOP', 'true', '<br />If true, Images will loop in both directions.<br /><br /><b>Default: true</b>', @gid, 107, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('<b>Slideshow</b>', 'ZEN_COLORBOX_SLIDESHOW', 'false', '<br />If true, Images will display as a slideshow.<br /><br /><b>Default: false</b>', @gid, 200, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('&nbsp; Slideshow Auto Start', 'ZEN_COLORBOX_SLIDESHOW_AUTO', 'true', '<br />If true, your slideshow will auto start.<br /><br /><b>Default: true</b>', @gid, 201, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('&nbsp; Slideshow Speed', 'ZEN_COLORBOX_SLIDESHOW_SPEED', '2500', '<br />Sets the speed of the slideshow <br /><br />Note: This value is measured in milliseconds.<br /><br /><b>Default: 2500</b>', @gid, 202, NOW(), NOW(), NULL, NULL),
('&nbsp; Slideshow Start Text', 'ZEN_COLORBOX_SLIDESHOW_START_TEXT', 'start slideshow', '<br />Link text to start the slideshow.<br /><br /><b>Default: start slideshow</b>', @gid, 203, NOW(), NOW(), NULL, NULL),
('&nbsp; Slideshow Stop Text', 'ZEN_COLORBOX_SLIDESHOW_STOP_TEXT', 'stop slideshow', '<br />Link text to stop the slideshow.<br /><br /><b>Default: stop slideshow</b>', @gid, 204, NOW(), NOW(), NULL, NULL),
('<b>Gallery Mode</b>', 'ZEN_COLORBOX_GALLERY_MODE', 'true', '<br />If true, the lightbox will allow additional images to quickly be displayed using previous and next buttons.<br /><br /><b>Default: true</b>', @gid, 300, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('&nbsp; Include Main Image in Gallery', 'ZEN_COLORBOX_GALLERY_MAIN_IMAGE', 'true', '<br />If true, the main product image will be included in the lightbox gallery.<br /><br /><b>Default: true</b>', @gid, 301, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('<b>EZ-Pages Support</b>', 'ZEN_COLORBOX_EZPAGES', 'true', '<br />If true, the lightbox effect will be used for linked images on all EZ-Pages.<br /><br /><b>Default: true</b>', @gid, 400, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('&nbsp; File Types', 'ZEN_COLORBOX_FILE_TYPES', 'jpg,png,gif', '<br />On EZ-Pages, the lightbox effect will be applied to all images with one of the following file types.<br /><br /><b>Default: jpg,png,gif</b><br />', @gid, 401, NOW(), NOW(), NULL, NULL);


##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Zen Colorbox', 'Zen Colorbox Einstellungen', '1', '1');


REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('<b>Zen Colorbox</b>', 'ZEN_COLORBOX_STATUS', 'Wollen Sie für die Vergrößerung Ihrer Artikelbilder einen Lightboxeffekt nutzen?<br/><br/>Voreinstellung = true<br/>', 43),
('Overlay Transparenz', 'ZEN_COLORBOX_OVERLAY_OPACITY', 'Gewünschte Transparenz des Overlays<br/><br/>Voreinstellung = 0.6<br/>', 43),
('Dauer der Bildvergrößerung', 'ZEN_COLORBOX_RESIZE_DURATION', 'Geschwindigkeit in Millisekunden<br/><br/>Voreinstellung = 400<br/>', 43),
('Anfangs Bildbreite', 'ZEN_COLORBOX_INITIAL_WIDTH', 'Breite des Artikelbildes beim ersten Aufruf<br/><br/>Voreinstellung = 250<br/>', 43),
('Anfangs Bildhöhe', 'ZEN_COLORBOX_INITIAL_HEIGHT', 'Höhe des Artikelbildes beim ersten Aufruf<br/><br/>Voreinstellung = 250<br/>', 43),
('Bildzähler anzeigen', 'ZEN_COLORBOX_COUNTER', 'Soll innerhalb der Lightbox eine Anzeige zur Anzahl der Bilder erscheinen?<br/><br/>Voreinstellung = true<br/>', 43),
('Beim Click aufs Overlay schließen?', 'ZEN_COLORBOX_CLOSE_OVERLAY', 'Soll die Lightbox beim Clicken auf das Overlay geschlossen werden?<br/><br/>Voreinstellung = false<br/>', 43),
('Loop', 'ZEN_COLORBOX_LOOP', 'Wenn auf true gestellt vergrößern sich die Bilder in beide Richtungen<br/><br/>Voreinstellung = true<br/>', 43),
('<b>Slideshow</b>', 'ZEN_COLORBOX_SLIDESHOW', 'Sollen die zusätzlichen Artikelbilder in einer Slideshow angezeigt werden?<br/><br/>Voreinstellung = false<br/>', 43),
('&nbsp; Slideshow Autostart', 'ZEN_COLORBOX_SLIDESHOW_AUTO', 'Slideshow automatisch starten?<br/><br/>Voreinstellung = true<br/>', 43),
('&nbsp; Slideshow Geschwindigkeit', 'ZEN_COLORBOX_SLIDESHOW_SPEED', 'Geschwindigkeit der Slideshow in Millisekunden<br/><br/>Voreinstellung = 2500<br/>', 43),
('&nbsp; Slideshow Start Text', 'ZEN_COLORBOX_SLIDESHOW_START_TEXT', 'Text des Links zum Starten der Slideshow<br/><br/>Voreinstellung = start slideshow<br/>', 43),
('&nbsp; Slideshow Stop Text', 'ZEN_COLORBOX_SLIDESHOW_STOP_TEXT', 'Text des Links zum Stoppen der Slideshow<br/><br/>Voreinstellung = stop slideshow<br/>', 43),
('<b>Galerie Modus</b>', 'ZEN_COLORBOX_GALLERY_MODE', 'Sollen die zusätzlichen Artikelbilder in einer Galerie zum Durchblättern erscheinen<br/><br/>Voreinstellung = true<br/>', 43),
('&nbsp; Hauptbild in Galerie aufnehmen?', 'ZEN_COLORBOX_GALLERY_MAIN_IMAGE', 'Soll das Hauptartikelbild Bestandteil der Galerieansicht sein?<br/><br/>Voreinstellung = true<br/>', 43),
('<b>EZ-Pages Unterstützung</b>', 'ZEN_COLORBOX_EZPAGES', 'Soll der Lightbox Effekt auch auf Bilder in den EZ Pages angewandt werden?<br/><br/>Voreinstellung = true<br/>', 43),
('&nbsp; Dateitypen', 'ZEN_COLORBOX_FILE_TYPES', 'Auf den EZ-Pages wird der Lightbox Effekt auf alle Bilder mit folgenden Dateitypen angewandt:<br/><br/>Voreinstellung = jpg,png,gif<br/>', 43);



###################################
# Register for Admin Access Control
###################################

INSERT INTO admin_pages (page_key ,language_key ,main_page ,page_params ,menu_key ,display_on_menu ,sort_order)VALUES 
('configZenColorbox', 'BOX_CONFIGURATION_ZEN_COLORBOX', 'FILENAME_CONFIGURATION', CONCAT('gID=',@gid), 'configuration', 'Y', @gid);