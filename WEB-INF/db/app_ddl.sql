GRANT SELECT ON rutanbandung_db.* to 'jaring'@'localhost';

CREATE TABLE jaring.telephone (
	nomor_induk		varchar (50)	not null
,	sn				varchar (50)	not null default ''
,	pin				varchar (18)	not null default ''
,	status			tinyint			not null default 1
,	update_date		timestamp		not null default CURRENT_TIMESTAMP
,	update_user		int				not null
,	CONSTRAINT _identitas_nomor_induk_fk	foreign key (nomor_induk) references rutanbandung_db.identitas (nomor_induk)
,	CONSTRAINT _user_update_user_fk			foreign key (update_user) references jaring._user (id)
);