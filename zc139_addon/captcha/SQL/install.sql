################################################################
# CAPTCHA 2.9.3  Multilanguage Install - 2010-05-22 - webchills
################################################################

SET @gid=0;
SELECT @gid:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title LIKE '%CAPTCHA%'
LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @gid;
DELETE FROM configuration_group WHERE configuration_group_id = @gid;
SET @gid=0;
SELECT @gid:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title LIKE '%CAPTCHA%'
LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @gid;
DELETE FROM configuration_group WHERE configuration_group_id = @gid;
DELETE FROM configuration_group WHERE configuration_group_title LIKE '%CAPTCHA%';
DELETE FROM configuration WHERE configuration_description LIKE 'CAPTCHA%' LIMIT 12;
DELETE FROM configuration WHERE configuration_title LIKE 'CAPTCHA - %' LIMIT 12;
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES
(NULL, 'CAPTCHA', 'CAPTCHA Configuration', '1', '1');
SET @gid=last_insert_id();

UPDATE configuration_group SET sort_order = @gid WHERE configuration_group_id = @gid;

INSERT INTO configuration VALUES 
(NULL, 'CAPTCHA - Code Length', 'CAPTCHA_CODE_LENGTH', '6', 'CAPTCHA Verification Code length', @gid, 1, NOW(), NOW(), NULL, NULL),
(NULL, 'CAPTCHA - Image Width', 'CAPTCHA_IMG_WIDTH', '240', 'CAPTCHA Image Width', @gid, 2, NOW(), NOW(), NULL, NULL),
(NULL, 'CAPTCHA - Image Height', 'CAPTCHA_IMG_HEIGHT', '50', 'CAPTCHA Image Height', @gid, 3, NOW(),NOW(), NULL, NULL),
(NULL, 'CAPTCHA - Chars minimum size', 'CAPTCHA_CHARS_MIN_SIZE', '0.6', 'CAPTCHA Chars minimum size (1.0=Image Height)', @gid, 4, NOW(), NOW(), NULL, NULL),
(NULL, 'CAPTCHA - Chars maximum size', 'CAPTCHA_CHARS_MAX_SIZE', '0.8', 'CAPTCHA Chars maximum size (1.0=Image Height)', @gid, 5, NOW(), NOW(), NULL, NULL),
(NULL, 'CAPTCHA - Corner of rotation', 'CAPTCHA_CHARS_ROTATION', '10', 'CAPTCHA Chars Corner of rotation', @gid, 6, NOW(), NOW(), NULL, NULL),
(NULL, 'CAPTCHA - Shadow Chars', 'CAPTCHA_CHARS_SHADOW', 'true', 'CAPTCHA Generate Shadows for Characters', @gid, 7, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'CAPTCHA - Image Type', 'CAPTCHA_IMG_TYPE', 'png', 'CAPTCHA Image Type', @gid, 8, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'png\', \'jpeg\', \'gif\'),'),
(NULL, 'CAPTCHA - Create Account page', 'CAPTCHA_CREATE_ACCOUNT', 'false', 'CAPTCHA Activate Validation on Create Account page', @gid, 9, NOW(), NOW(),NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'CAPTCHA - Contact Us page', 'CAPTCHA_CONTACT_US', 'true', 'CAPTCHA Activate Validation on Contact Us page', @gid, 10, NOW(), NOW(),NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'CAPTCHA - Tell A Friend page', 'CAPTCHA_TELL_A_FRIEND', 'false', 'CAPTCHA Activate Validation on Tell A Friend page', @gid, 11, NOW(), NOW(),NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'CAPTCHA - Write Review page', 'CAPTCHA_REVIEWS_WRITE', 'false', 'CAPTCHA Activate Validation on Write Review page', @gid, 13, NOW(), NOW(),NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');


##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'CAPTCHA', 'CAPTCHA Einstellungen', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('CAPTCHA - Länge des Codes', 'CAPTCHA_CODE_LENGTH', 'Länge des CAPTCHA Codes', 43),
('CAPTCHA - Bildbreite', 'CAPTCHA_IMG_WIDTH', 'CAPTCHA Bilbreite', 43),
('CAPTCHA - Bildhöhe', 'CAPTCHA_IMG_HEIGHT','CAPTCHA Bildhöhe', 43),
('CAPTCHA - Zeichen Mindestgrösse', 'CAPTCHA_CHARS_MIN_SIZE', 'CAPTCHA Mindestgrösse der Zeichen 1.0=Bildhöhe', 43),
('CAPTCHA - Zeichen Maximalgrösse', 'CAPTCHA_CHARS_MAX_SIZE', 'CAPTCHA Maximalgrösse der Zeichen 1.0=Bildhöhe', 43),
('CAPTCHA - Schräge der Zeichen', 'CAPTCHA_CHARS_ROTATION', 'CAPTCHA Stärke der Schräge', 43),
('CAPTCHA - Schatten für Zeichen', 'CAPTCHA_CHARS_SHADOW', 'CAPTCHA Schatten bei den Zeichen erzeugen', 43),
('CAPTCHA - Bildtyp', 'CAPTCHA_IMG_TYPE', 'CAPTCHA Bildtyp', 43),
('CAPTCHA - Seite Registrierung', 'CAPTCHA_CREATE_ACCOUNT', 'CAPTCHA auf der Registrierungsseite aktivieren', 43),
('CAPTCHA - Seite Kontakt', 'CAPTCHA_CONTACT_US', 'CAPTCHA auf der Kontaktseite aktivieren', 43),
('CAPTCHA - Seite Weiterempfehlen', 'CAPTCHA_TELL_A_FRIEND', 'CAPTCHA auf der Weiterempfehlungsseite aktivieren', 43),
('CAPTCHA - Seite Bewertung schreiben', 'CAPTCHA_REVIEWS_WRITE', 'CAPTCHA auf der Bewertungsseite aktivieren', 43);