#########################################################################################
# Login als Kunde (Encrypted Master Passwort) 2.7 Zen-Cart 1.5.5 - 2016-03-02 - webchills
#########################################################################################


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added) VALUES
('Encrypted Master Password: Single Admin ID', 'EMP_LOGIN_ADMIN_ID', '1', 'Specify the ID of an admin user that is permitted to use the Encrypted Master Password feature. Set the value to 0 to disable the <em>Single Admin ID</em> feature.<br /><br /><b>Default: 1</b><br />', 1, '300', NOW(), NOW()),
('Encrypted Master Password: Admin Profile ID', 'EMP_LOGIN_ADMIN_PROFILE_ID', '1', 'Specify the admin <em>User Profile ID</em> that is permitted to use the Encrypted Master Password feature &mdash; all admins that are in this profile are permitted.  Set the value to 0 to disable the <em>Admin Profile ID</em> feature.<br /><br /><b>Default: 1 (Superusers)</b><br />', 1, '301', NOW(), NOW());

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Login als Kunde: Nur für einen bestimmten Admin erlaubt?', 'EMP_LOGIN_ADMIN_ID', 'Wenn das Login als Kunde nur für einen ganz bestimmten Admin erlaubt sein soll, dann geben Sie hier die ID dieses Admin Users an (Standard: 1). Stellen Sie hier auf 0, wenn Sie diese Funktion nicht nutzen wollen und alle Admins das nutzen dürfen.',	43),
('Login als Kunde: Nur für bestimmte Admingruppe erlaubt?', 'EMP_LOGIN_ADMIN_PROFILE_ID', 'Wenn das Login als Kunde nur für Admins in einer bestimmten Gruppe erlaubt sein soll (Standard: Superuser), dann stellen Sie hier auf 1. Stellen Sie auf 0, wenn Sie diese Funktion nicht nutzen wollen und das Kundenlogin für alle Admingruppen erlaubt sein soll.',	43);
