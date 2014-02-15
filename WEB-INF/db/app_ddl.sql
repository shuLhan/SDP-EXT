GRANT SELECT ON rutanbandung_db.* to 'jaring'@'localhost';

CREATE TABLE jaring.telephone (
	nomor_induk		varchar (50)	not null
,	sn				varchar (50)	not null default ''
,	pin				varchar (18)	not null default ''
,	status			tinyint			not null default 1
,	update_date		timestamp		not null default CURRENT_TIMESTAMP
,	update_user		int				not null
,	CONSTRAINT update_user_user 
);