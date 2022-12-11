CREATE TABLE tx_webm_domain_model_queueitem (
   tablenames varchar(255) NOT NULL DEFAULT '',
   fieldname varchar(255) NOT NULL DEFAULT '',
   uid_foreign int(11) unsigned DEFAULT '0',
   anzeige_website smallint(1) unsigned NOT NULL DEFAULT '0',
   sys_file_uid int(11) unsigned DEFAULT '0',
   status int(11) unsigned DEFAULT '0'
);
