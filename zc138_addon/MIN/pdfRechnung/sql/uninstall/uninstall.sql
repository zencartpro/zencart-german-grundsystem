DELETE FROM configuration WHERE  configuration_key LIKE 'RL_INVOICE_%';
DELETE FROM configuration_language WHERE  configuration_key LIKE 'RL_INVOICE_%';

DELETE FROM configuration_group WHERE configuration_group_id = '725';
