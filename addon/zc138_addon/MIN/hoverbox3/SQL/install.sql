#####################################################################
# HoverBox 3 Multilanguage Install - 2009-04-30 - webchills
#####################################################################

SET @HoverBox=0;
SELECT @HoverBox:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title LIKE '%HoverBox%'
LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @HoverBox;
DELETE FROM configuration_group WHERE configuration_group_id = @HoverBox;
SET @HoverBox=0;
SELECT @HoverBox:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title LIKE '%HoverBox%'
LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @HoverBox;
DELETE FROM configuration_group WHERE configuration_group_id = @HoverBox;
DELETE FROM configuration_group WHERE configuration_group_title LIKE '%HoverBox%';
DELETE FROM configuration WHERE configuration_description LIKE 'HoverBox%' LIMIT 12;
DELETE FROM configuration WHERE configuration_title LIKE 'LB - %' LIMIT 12;

INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES
(NULL, 'HoverBox', 'HoverBox Configuration', '0', '1');
SET @HoverBox=last_insert_id();

UPDATE configuration_group SET sort_order = @HoverBox WHERE configuration_group_id = @HoverBox;

INSERT INTO configuration VALUES 
(NULL, 'Enable HoverBox?', 'HOVERBOX_ENABLED', 'true', 'If set to true, all your product images will display using the HoverBox effect when viewing larger images.  <br />If additional products exist, they will be presented in a slideshow fashion. Customers have the option to go through them manually or via the autoplay function.<br /><br /><b>Default: true</b><br />', @HoverBox, 10, NOW(), NOW(), NULL, 'zen_cfg_select_option( array(''true'', ''false''), '), 
(NULL, 'Include Product Title?', 'HOVERBOX_DISPLAY_TITLE', 'true', 'If set to true, the title of your product will be included below your product image.<br /><br /><b>Default: true</b><br />', @HoverBox, 20, NOW(), NOW(), NULL, 'zen_cfg_select_option( array(''true'', ''false''), '),
(NULL, 'Include Product Price?', 'HOVERBOX_DISPLAY_PRICE', 'true', 'If set to true, the price of your product will be included below your product image.<br /><br /><b>Default: true</b><br />', @HoverBox, 30, NOW(), NOW(), NULL, 'zen_cfg_select_option( array(''true'', ''false''), '),
(NULL, 'Include Product Description?', 'HOVERBOX_PRODUCT_DESC', 'false', 'If set to true, the products description will be included below your product image.  You can limit the number of characters as well.<br /><br /><b>Default: false</b><br />', @HoverBox, 40, NOW(), NOW(), NULL, 'zen_cfg_select_option( array(''true'', ''false''), '),
(NULL, 'Product Description Limitation', 'HOVERBOX_MAX_DESC_LENGTH', '200', 'Limit the number of characters for the product description displayed, if enabled.<br /><br /><b>Default: 200</b><br />', @HoverBox, 50, NOW(), NOW(), NULL, NULL),
(NULL, 'Z-Index of HoverBox?', 'HOVERBOX_ZINDEX', '5000', 'This is the layer at which HoverBox resides on the page while viewing your product images. Change this to a higher value if your having problems with anything protruding into your effect.<br /><br /><b>Default: 5000</b><br />', @HoverBox, 60, NOW(), NOW(), NULL, NULL),
(NULL, 'Use Smart Image Resizing?', 'HOVERBOX_SMART_RESIZE', 'true', 'If smart resizing is enabled, HoverBox will resize the image if it is to big to fit within the viewable browser area.  Basically this keeps the entire image within view, even if it is too big for the screen.<br /><br /><b>Default: true</b><br />', @HoverBox, 70, NOW(), NOW(), NULL, 'zen_cfg_select_option( array(''true'', ''false''), '),
(NULL, 'Background Color of HoverBox Contents?', 'HOVERBOX_BACKGROUND_COLOR', '#ffffff', 'This is the background color for the HoverBox itself.  Where your product image resides when viewing a larger view.<br /><br /><b>Default: #ffffff</b><br />', @HoverBox, 80, NOW(), NOW(), NULL, NULL),
(NULL, 'Enable Overlay?', 'HOVERBOX_OVERLAY_ENABLE', 'true', 'While viewing a product image, your store is overlayed with a background color (or image on the Mac, overlay.png).  You can enable/disable this functionality if you so choose.<br /><br /><b>Default: true</b><br />', @HoverBox, 90, NOW(), NOW(), NULL, 'zen_cfg_select_option( array(''true'', ''false''), '),
(NULL, 'Background Color of Page Overlay?', 'HOVERBOX_OVERLAY_BACKGROUND', '#000000', 'This is the background color for the overlay that covers your page while HoverBox is active, for compatibility purposes FireFox &amp; Safari on the Mac use overlay.png located in your template images folder inside the HoverBox folder.<br /><br /><b>Default: #000000</b><br />', @HoverBox, 100, NOW(), NOW(), NULL, NULL),
(NULL, 'Overlay Background Opacity?', 'HOVERBOX_OVERLAY_OPACITY', '0.85', 'The opacity of the overlay used while HoverBox is active.  If the number is less than one, be sure to include the leading zeroes.<br /><b>Default: 0.85</b><br />', @HoverBox, 110, NOW(), NOW(), NULL, NULL),
(NULL, 'Padding for HoverBox Contents?', 'HOVERBOX_BORDER_SIZE', '10', 'The padding, or spacing of the inner-contents of HoverBox<br /><br /><b>Default: 10</b><br />', @HoverBox, 120, NOW(), NOW(), NULL, NULL),
(NULL, 'Radius of Rounded Corners?', 'HOVERBOX_CORNER_RADIUS', '10', 'Without using images, HoverBox has the ability to have rounded corners.  The higher the value, the more rounded the corners will render.  Set to 0 for no rounded corners.<br /><br /><b>Default: 10</b><br />', @HoverBox, 130, NOW(), NOW(), NULL, NULL),
(NULL, 'HoverBox Close Button Opacity - Normal?', 'HOVERBOX_CLOSE_NORMAL', '0.65', 'The initial opacity of the close button used by HoverBox.<br /><br /><b>Default: 0.65</b><br />', @HoverBox, 140, NOW(), NOW(), NULL, NULL),
(NULL, 'HoverBox Close Button Opacity - Hover?', 'HOVERBOX_CLOSE_HOVER', '1', 'The opacity of the close button used by HoverBox during mouseover.<br /><br /><b>Default: 1</b><br />', @HoverBox, 150, NOW(), NOW(), NULL, NULL),
(NULL, 'Additional Images - End-to-Beginning?', 'HOVERBOX_END_BEG', 'false', 'Allow customers to loop to the beginning of the images from the last image. This does not pertain to the autoplay function.<br /><br /><b>Default: false</b><br />', @HoverBox, 160, NOW(), NOW(), NULL, 'zen_cfg_select_option( array(''true'', ''false''), '),
(NULL, 'Enable Slideshow Feature?', 'HOVERBOX_SHOW_SLIDE', 'true', 'If you have additional product images or other views of your product, this option enables/disables the slideshow functionality.<br /><br /><b>Default: true</b><br />', @HoverBox, 170, NOW(), NOW(), NULL, 'zen_cfg_select_option( array(''true'', ''false''), '),
(NULL, 'Slideshow Interval (seconds)?', 'HOVERBOX_SLIDE_DELAY', '5', 'The time, in seconds, to display each image in the slideshow.<br /><br /><b>Default: 5</b><br />
', @HoverBox, 180, NOW(), NOW(), NULL, NULL),
(NULL, 'Additional Image Text - Image 1 of 10?', 'HOVERBOX_IMG_NUMBER', 'Bild #{position} von #{total}', 'Sets the "Image 1 of 2" text when there is more than one image.<br />
<br />
The text is replaced with a regular expression: #{position} is the number of the current image, #{total} is the total number of images.<br />
<br /><b>Examples:</b><br />Image #{position} of #{total} - default English<br />
Image #{position} (of #{total}) - English variation <br />
Imagen #{position} de #{total} - Espanol<br />Immagine #{position} di #{total} - Italian<br />Bild #{position} von #{total} - German<br>
Image #{position} de #{total} - French <br>
&#12452;&#12513;&#12540;&#12472; #{position} &#12398; #{total} - Japanese <br />
<br /><b>Default: Image #{position} of #{total}</b><br />', @HoverBox, 190, NOW(), NOW(), NULL, NULL);

##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@HoverBox, 43, 'HoverBox', 'HoverBox Einstellungen', '0', '1');


REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('HoverBox - HoverBox aktivieren?', 'HOVERBOX_ENABLED', 'Wenn aktiviert, werden alle Artikelbilder beim Vergrößern mit dem HoverBox Effekt angezeigt.  <br />Falls zusätzliche Artikelbilder vorhanden sind, werden diese in einer Slideshow angezeigt. Besucher haben die Möglichkeit, manuell durch die Slideshow zu blättern oder eine Autoplay-Funktion zu nutzen.<br /><br /><b>Voreinstellung: true</b><br />',	43),
('HoverBox - Artikelname anzeigen?', 'HOVERBOX_DISPLAY_TITLE', 'Wenn aktiviert, wird der Artikelname unterhalb des Bildes angezeigt.<br /><br /><b>Voreinstellung: true</b><br />',	43),
('HoverBox - Artikelpreis anzeigen?', 'HOVERBOX_DISPLAY_PRICE', 'Wenn aktiviert, wird der Artikelpreis unterhalb des Bildes angezeigt.<br /><br /><b>Voreinstellung: true</b><br />',	43),
('HoverBox - Artikelbeschreibung anzeigen?', 'HOVERBOX_PRODUCT_DESC', 'Wenn aktiviert, wird die Artikelbeschreibung unterhalb des Bildes angezeigt. Die Anzahl der Buchstaben in der Beschreibung kann definiert werden.<br /><br /><b>Voreinstellung: false</b><br />',	43),
('HoverBox - Artikelbeschreibung kürzen auf', 'HOVERBOX_MAX_DESC_LENGTH', 'Falls die Artikelbeschreibung aktiviert ist: Wieviele Zeichen soll der Beschreibungstext haben?<br/><br/><b>Voreinstellung: 200</b><br />',	43),
('HoverBox - Z-Index der HoverBox', 'HOVERBOX_ZINDEX', 'Layer, in dem die HoverBox erscheint. Sollten sich andere Elemente in den HoverBox Effekt einmischen, erhöhen Sie diesen Wert.<br /><br /><b>Voreinstellung: 5000</b><br />',	43),
('HoverBox - Bildgrößenänderung aktivieren?', 'HOVERBOX_SMART_RESIZE', 'Wenn aktiviert, verkleinert die HoverBox das Artikelbild, falls es zu gross ist. Das Bild wird also an die zur Verfügung stehende Bildschirmgrösse angepasst.<br /><br /><b>Voreinstellung: true</b><br />',	43),
('HoverBox - Hintergrundfarbe', 'HOVERBOX_BACKGROUND_COLOR', 'Dies ist die Hintegrundfarbe der HoverBox selbst. Sie umgibt das Artikelbild in der Grossansicht.<br /><br /><b>Voreinstellung: #ffffff</b><br />',	43),
('HoverBox - Overlay aktivieren?', 'HOVERBOX_OVERLAY_ENABLE', 'In der Grossansicht wird der Shop mit einer Hintergrundfarbe unterlegt (bzw. mit dem Bild overlay.png auf einem MAC). Diesen Effekt können Sie hier deaktivieren.<br /><br /><b>Voreinstellung: true</b><br />',	43),
('HoverBox - Overlay Hintergrundfarbe', 'HOVERBOX_OVERLAY_BACKGROUND', 'Hintergrundfarbe, mit der der Shop bei aktiver HoverBox unterlegt wird. Auf einem MAC verwenden Safari und Firefox statt der Farbe das Bild overlay.png im Ordner HoverBox des jeweiligen Templatebilderordners.<br /><br /><b>Voreinstellung: #000000</b><br />',	43),
('HoverBox - Transparenz des Overlays', 'HOVERBOX_OVERLAY_OPACITY', 'Transparenz des Overlays bei aktiver HoverBox.  Bei Werten unter 1, geben Sie unbedingt die führende Null an.<br /><b>Voreinstellung: 0.85</b><br />',	43),
('HoverBox - Padding', 'HOVERBOX_BORDER_SIZE', 'Abstandswert für den Inhalt der HoverBox in Pixeln<br /><br /><b>Voreingestellt: 10</b><br />',	43),
('HoverBox - Radius der abgerundeten Ecken', 'HOVERBOX_CORNER_RADIUS', 'Die HoverBox ist in der Lage ohne zusätzliche Bilder abgerundete Ecken anzuzeigen.  Je höher der hier eingestellte Wert, desto stärker die Abrundung. Für eine normale Darstellung ohne abgerundete Ecken stellen Sie den Wert auf Null.<br /><br /><b>Voreinstellung: 10</b><br />',	43),
('HoverBox - Transparenz des Close Buttons', 'HOVERBOX_CLOSE_NORMAL',	'Anfangstransparenz des Close Buttons in der HoverBox<br /><br /><b>Voreingestellt: 0.65</b><br />',	43),
('HoverBox - Transparenz des Close Buttons bei Mouseover', 'HOVERBOX_CLOSE_HOVER', 'Transparenz des Close Buttons in der HoverBox bei Mouseover<br /><br /><b>Voreinstellung: 1</b><br />',	43),
('HoverBox - Zusätzliche Bilder - Weiterblättern zum Anfang?', 'HOVERBOX_END_BEG', 'Soll der Besucher bei Erreichen des letzten Bildes weiter zum ersten Bild blättern können?<br /><br /><b>Voreinstellung: false</b><br />',	43),
('HoverBox - Slideshow Feature aktivieren?', 'HOVERBOX_SHOW_SLIDE', 'Soll die Slideshow-Funktion zur Verfügung stehen? (Nur verfügbar, wenn es mehrere Artikelbilder gibt)<br /><br /><b>Voreinstellung: true</b><br />', 43),
('HoverBox - Slideshow Intervall', 'HOVERBOX_SLIDE_DELAY', 'Wie lange (in Sekunden) soll jedes Bild in der Slideshow angezeigt werden?<br/><br/><b>Voreinstellung: 5</b><br />',	43),
('HoverBox - Text für Zusatzbilder', 'HOVERBOX_IMG_NUMBER', 'Text bei der Anzeige mehrerer Artikelbilder<br/>#{position} ist die Nummer des aktiven Bildes, #{total} ist die Gesamtanzahl der Bilder.<br />
<br/><b>Voreinstellung: Bild #{position} von #{total}</b><br />',	43);
