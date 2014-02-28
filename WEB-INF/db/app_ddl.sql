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

create table jaring.wilayah (
	id			int			not null auto_increment
,	default_1	tinyint		not null default 0
,	default_2	tinyint		not null default 0
,	nama		varchar(64)	not null
,	constraint wilayah_pk primary key (id)
);

create table jaring.penandatangan (
	id			int				not null auto_increment
,	kepala_text	varchar(256)	not null default ''
,	jabatan		varchar(256)	not null default ''
,	nama		varchar(256)	not null
,	nip			varchar(256)	not null
,	constraint	penandatangan_pk primary key (id)
);