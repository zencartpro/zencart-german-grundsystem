#####################################################################
# reCAPTCHA 1.1 Multilanguage Install - 2010-09-04 - webchills
#####################################################################


SET @gid=0;
SELECT @gid:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title LIKE '%reCAPTCHA%'
LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @gid;
DELETE FROM configuration_group WHERE configuration_group_id = @gid;
SET @gid=0;
SELECT @gid:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title LIKE '%reCAPTCHA%'
LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @gid;
DELETE FROM configuration_group WHERE configuration_group_id = @gid;
DELETE FROM configuration_group WHERE configuration_group_title LIKE '%reCAPTCHA Settings%';
DELETE FROM configuration_group WHERE configuration_group_title LIKE '%reCAPTCHA Einstellungen%';
DELETE FROM configuration WHERE configuration_description LIKE 'reCAPTCHA%' LIMIT 4;
DELETE FROM configuration WHERE configuration_title LIKE 'reCAPTCHA - %' LIMIT 4;

INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES
(NULL, 'reCAPTCHA', 'reCAPTCHA Settings', '1', '1');
SET @gid=last_insert_id();

UPDATE configuration_group SET sort_order = @gid WHERE configuration_group_id = @gid;

INSERT INTO configuration VALUES 
('', 'reCAPTCHA - Enable Contact Form', 'CONTACT_US_RECAPTCHA_STATUS', 'true', 'Display reCAPTCHA text on contact form (default: true)', @gid, '1', now(), now(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('', 'reCAPTCHA - Public Key', 'CONTACT_US_RECAPTCHA_PUBLIC_KEY', '', 'Public key given from reCAPTCHA website (default: blank).', @gid, '2', now(), now(), NULL, NULL),
('', 'reCAPTCHA - Private Key', 'CONTACT_US_RECAPTCHA_PRIVATE_KEY', '', 'Private key given from reCAPTCHA website (default: blank).', @gid, '3', now(), now(), NULL, NULL),
('', 'reCAPTCHA - Theme', 'CONTACT_US_RECAPTCHA_THEME', 'red', 'Choose a theme option for the reCAPTCHA widget.', @gid, '4', now(), now(), NULL, 'zen_cfg_select_option(array(''red'', ''white'', ''blackglass'', ''clean''),');


##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'reCAPTCHA', 'reCAPTCHA Einstellungen', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('reCAPTCHA - Auf der Kontaktseite aktivieren?', 'CONTACT_US_RECAPTCHA_STATUS', 'Soll reCAPTCHA auf der Kontaktseite aktiviert werden? (Voreingestellt: true)', 43),
('reCAPTCHA - Public Key', 'CONTACT_US_RECAPTCHA_PUBLIC_KEY', 'Tragen Sie hier Ihren Public Key ein, den Sie auf <a href="http://www.google.com/recaptcha" target="_blank">www.google.com/recaptcha</a> registriert haben. Ohne diesen Key wird reCAPTCHA nicht funktionieren!', 43),
('reCAPTCHA - Private Key', 'CONTACT_US_RECAPTCHA_PRIVATE_KEY', 'Tragen Sie hier Ihren Private Key ein, den Sie auf <a href="http://www.google.com/recaptcha" target="_blank">www.google.com/recaptcha</a> registriert haben. Ohne diesen Key wird reCAPTCHA nicht funktionieren!', 43),
('reCAPTCHA - Design', 'CONTACT_US_RECAPTCHA_THEME', 'Wählen Sie eins der vier möglichen Designs für die reCAPTCHA Anzeige aus. (Voreingestellt: red)', 43);