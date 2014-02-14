CREATE USER 'sdpext'@'localhost' IDENTIFIED BY 'sdpext';
CREATE USER 'sdpext'@'%' IDENTIFIED BY 'sdpext';

GRANT SELECT ON rutanbandung_db.*			to 'sdpext'@'%' identified by 'sdpext';
GRANT ALL ON rutanbandung_db._group			to 'sdpext'@'%' identified by 'sdpext';
GRANT ALL ON rutanbandung_db._group_menu	to 'sdpext'@'%' identified by 'sdpext';
GRANT ALL ON rutanbandung_db._menu			to 'sdpext'@'%' identified by 'sdpext';
GRANT ALL ON rutanbandung_db._user			to 'sdpext'@'%' identified by 'sdpext';
GRANT ALL ON rutanbandung_db._user_group	to 'sdpext'@'%' identified by 'sdpext';

CREATE TABLE sdpext_telephone (
	nomor_induk		varchar (50)	not null
,	sn				varchar (50)	not null default ''
,	pin				varchar (18)	not null default ''
,	status			tinyint			not null default 1
,	update_date		timestamp		not null default CURRENT_TIMESTAMP
,	update_user		int				not null
,	CONSTRAINT update_user_user 
);

GRANT ALL ON rutanbandung_db.sdpext_telephone to 'sdpext'@'%';

flush privileges;