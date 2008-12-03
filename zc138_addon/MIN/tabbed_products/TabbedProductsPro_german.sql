SET @gid=0;
SELECT @gid:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title LIKE '%Tabbed Products Config%'
LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @gid;
DELETE FROM configuration_group WHERE configuration_group_id = @gid;
SET @gid=0;
SELECT @gid:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title LIKE '%TPP - Config%'
LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @gid;
DELETE FROM configuration_group WHERE configuration_group_id = @gid;
DELETE FROM configuration_group WHERE configuration_group_title LIKE '%Tabbed Products Config%';
DELETE FROM configuration_group WHERE configuration_group_title LIKE '%TPP - Config%';
DELETE FROM configuration WHERE configuration_description LIKE 'Set this to 1%' LIMIT 12;
DELETE FROM configuration WHERE configuration_title LIKE 'TPP - %' LIMIT 12;
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible ) 
                 VALUES (NULL, 'TPP - Config', 'Tabbed Products Pro - Config', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = @gid WHERE configuration_group_id = @gid;
INSERT INTO configuration VALUES(NULL, 'TPP - Global Enable Tabs', 'GLOBAL_ENABLE_TABS', '1', 'Set this to 1 if you want to enable the global use of tabs on your products', @gid, 1, '2008-01-14 20:11:07', '2007-01-12 22:07:11', NULL, 'zen_cfg_select_option(array(''0'', ''1''),'),
				(NULL, 'TPP - Global Main Image On Tab', 'GLOBAL_MAIN_IMAGE_ON_TAB', '0', 'Set this to 1 if you want all products to have the Main Image on the first (Product Description) tab', @gid, 2, '2008-01-14 20:18:34', '2007-01-12 22:07:11', NULL, 'zen_cfg_select_option(array(''0'', ''1''),'),
				(NULL, 'TPP - Global Product Description Tab', 'GLOBAL_PROD_DESC_ON_TAB', '1', 'Set this to 1 if you want all products to have the Main Product Description on its own tab', @gid, 3, '2008-01-14 20:18:34', '2007-01-12 22:07:11', NULL, 'zen_cfg_select_option(array(''0'', ''1''),'),
				(NULL, 'TPP - Global Attributes on Tab', 'GLOBAL_ATTRIBUTES_ON_TAB', '0', 'Set this to 1 if you want the Attributes to appear on their own tab. This will only show up if the product has attributes to show. If there are no attributes, the tab will not show up.', @gid, 4, '2008-01-14 20:19:22', '2007-01-12 22:07:11', NULL, 'zen_cfg_select_option(array(''0'', ''1''),'),
                (NULL, 'TPP - Global Attributes on Add-to-Cart Tab', 'GLOBAL_ATTRIBUTES_ON_ATC_TAB', '0', 'Set this to 1 if you want the Attributes to appear on the Add-To-Cart tab. They will only show up if the product has attributes to show. YOU MUST ALSO LEAVE THE Global Attributes on Tab OPTION ENABLED. This will override the standalone tab and show the attributes on the Add-To-Cart tab only. If the Add-To-Cart tab is set to false, this will be ignored and the attributes will follow their own tab settings.', @gid, 5, '2008-01-14 20:19:22', '2007-01-12 22:07:11', NULL, 'zen_cfg_select_option(array(''0'', ''1''),'),
				(NULL, 'TPP - Global Details On Tabs', 'GLOBAL_DETAILS_ON_TAB', '1', 'Set this to 1 if you want the Product Details to appear on their own tab (weight, model number, etc). This will only show up if the product has details enabled. If there are no product details, the tab will not show up. ', @gid, 6, '2008-01-15 15:34:07', '0001-01-01 00:00:00', NULL, 'zen_cfg_select_option(array(''0'', ''1''),'),
				(NULL, 'TPP - Global Add To Cart Tab', 'GLOBAL_ADD_TO_CART_ON_TAB', '0', 'Set this to 1 if you want the add to cart button to be on its own tab. Note this includes Add To Cart button and Qty Discounts table.', @gid, 7, '2008-01-14 19:29:49', '2007-01-12 22:07:11', NULL, 'zen_cfg_select_option(array(''0'', ''1''),'),
				(NULL, 'TPP - Global Additional Images Tab', 'GLOBAL_ADDL_IMAGES_ON_TAB', '1', 'Set this to 1 if you want the additional images for a product on its own tab. This will only show up if the product has additional images to show. If there are no additional images, the tab will not show up.', @gid, 8, '2008-01-14 20:19:09', '2007-01-12 22:07:11', NULL, 'zen_cfg_select_option(array(''0'', ''1''),'),
				(NULL, 'TPP - Global Customers Also Purchased Tab', 'GLOBAL_CUST_ALSO_PURCH_ON_TAB', '1', 'Set this to 1 if you want the Customers Also Purchased module on its own tab. This will only show up if the product has other products to show. If there are no other products, the tab will not show up.', @gid, 9, '2008-01-14 20:19:15', '2007-01-12 22:07:11', NULL, 'zen_cfg_select_option(array(''0'', ''1''),'),
				(NULL, 'TPP - Global Cross Sell Tab', 'GLOBAL_CROSS_SELL_ON_TAB', '0', 'Set this to 1 if you want the Cross Sell module on its own tab. This will only work if Cross Sell contrib is already installed and the product has cross sell items set up. Otherwise it will just not show up.', @gid, 10, '2007-01-12 22:07:11', '2007-01-12 22:07:11', NULL, 'zen_cfg_select_option(array(''0'', ''1''),'),
				(NULL, 'TPP - Global Reviews Tab', 'GLOBAL_REVIEWS_ON_TAB', '1', 'Set this to 1 if you want the Product Reviews to show up on its own tab. This will always show up even if there are no reviews. The Review module has its own "No reviews found" so it defaults.', @gid, 11, '2008-01-14 20:19:36', '2007-01-12 22:07:11', NULL, 'zen_cfg_select_option(array(''0'', ''1''),'),
				(NULL, 'TPP - Show Tab Headers', 'SHOW_TAB_HEADERS', '1', 'Set this to 1 if you want a header bar to appear under the tabs, above the tab content', @gid, 12, '2007-01-12 22:07:11', '2007-01-12 22:07:11', NULL, 'zen_cfg_select_option(array(''0'', ''1''),');

### for multiligual (german) installations
INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) 
                 VALUES (@gid, 43, 'TPP - Config', 'Tabbed Products Pro - Config', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id)
    VALUES 
    ('TPP - Global aktiviere Tabs', 'GLOBAL_ENABLE_TABS', 'Auf 1 stellen, wenn Sie die globale Verwendung von Tabs auf Ihren Produkten aktivieren wollen.', 43),
    ('TPP - Global Main Image On Tab', 'GLOBAL_MAIN_IMAGE_ON_TAB', 'Auf 1 stellen, wenn Sie möchten, dass alle Produkte die Hauptabbildung auf dem ersten (Produktbeschreibung) Tab haben.', 43),
    ('TPP - Global Artikelbeschreibung Tab', 'GLOBAL_PROD_DESC_ON_TAB', 'Auf 1 stellen, wenn Sie möchten, dass alle Produkte die Hauptproduktbeschreibung auf ihrem eigenen Tab haben.', 43),
    ('TPP - Global Attribute am Tab', 'GLOBAL_ATTRIBUTES_ON_TAB', 'Auf 1 stellen, wenn Sie möchten, dass die Attribute auf ihrem eigenen Tab erscheinen. Dieses wird nur erscheinen, wenn das Produkt Attribute hat, die gezeigt werden können. Wenn es keine Attribute gibt, wird der Tab nicht erscheinen.', 43),
    ('TPP - Global Attribute am in-den-Warenkorb Tab', 'GLOBAL_ATTRIBUTES_ON_ATC_TAB', 'Auf 1 stellen, wenn Sie möchten, dass die Attribute auf dem In den Einkaufswagen-Tab erscheinen. Sie werden nur erscheinen, wenn das Produkt Attribute hat, die gezeigt werden können. SIE MÜSSEN AUCH DIE globalen Attribute auf dem Tab OPTION AKTIVIERT belassen. Das wird den Standalone-Tab außer Kraft setzen, und die Attribute nur auf dem In den Einkaufswagen-Tab zeigen. Wenn der In den Einkaufswagen-Tab auf falsch eingestellt ist, wird er ignoriert, und die Attribute werden ihre eigenen Tabeinstellungen folgen.', 43),
    ('TPP - Global Details am Tab', 'GLOBAL_DETAILS_ON_TAB', 'Auf 1 stellen, wenn Sie möchten, dass die Produktdetails auf ihrem eigenen Tab erscheinen (Gewicht, Modellnummer usw.). Dieses wird nur erscheinen, wenn das Produkt Details aktiviert hat. Wenn es keine Produktdetails gibt, wird der Tab nicht erscheinen.', 43),
    ('TPP - Global in-den-Warenkorb  Tab', 'GLOBAL_ADD_TO_CART_ON_TAB', 'Auf 1 stellen, wenn Sie möchten, dass das In den Einkaufswagen-Button auf einem eigenen Tab ist. Beachten Sie, dass dieses ein In den Einkaufswagen-Button und eine Mengenrabatt-Tabelle beinhaltet.', 43),
    ('TPP - Global zusätzliche Bilder Tab', 'GLOBAL_ADDL_IMAGES_ON_TAB', 'Auf 1 stellen, wenn Sie die zusätzlichen Bilder für ein Produkt auf ihrem eigenen Tab möchten. Dieses wird nur erscheinen, wenn das Produkt zusätzliche Bilder hat, die gezeigt werden können. Wenn es keine zusätzlichen Bilder gibt, wird der Tab nicht erscheinen.', 43),
    ('TPP - Global was-Kunden-noch-kauften Tab', 'GLOBAL_CUST_ALSO_PURCH_ON_TAB', 'Auf 1 stellen, wenn Sie das Kunden kauften auch-Modul auf einem eigenen Tab möchten. Dieses wird nur erscheinen, wenn das Produkt andere Produkte zu zeigen hat. Wenn es keine anderen Produkte gibt, wird der Tab nicht erscheinen.', 43),
    ('TPP - Global Cross Sell Tab', 'GLOBAL_CROSS_SELL_ON_TAB', 'Auf 1 stellen, wenn Sie das Querverkaufs-Modul auf einem eigenen Tab haben möchten. Dieses wird nur funktionieren, wenn Querverkauf contrib schon installiert ist und das Produkt Querverkaufsartikel schon eingerichtet hat. Sonst wird es einfach nicht erscheinen.', 43),
    ('TPP - Global Bewertungs Tab', 'GLOBAL_REVIEWS_ON_TAB', 'Auf 1 stellen, wenn Sie möchten, dass Produktrezensionen in einem eigenen Tab erscheint. Es wird immer erscheinen, auch wenn es keine Rezensionen gibt. Das Rezension-Modul hat seinen eigenen  "keine Rezensionen gefunden", daher wird die Standardeinstellung verwendet.', 43),
    ('TPP - Show Tab Unterschrift', 'SHOW_TAB_HEADERS', 'Auf 1 stellen, wenn Sie möchten, dass eine Headerleiste unter den Tabs erscheint, oberhalb vom Tabinhalt.', 43);                
    