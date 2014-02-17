--
-- Create group User and user 'SDP'
--
insert into _group (name, type) values ('User', 0);

insert into _user (name, realname, password) values ('sdp', 'SDP', 'c0a04af421d69791100e21c8d74b150c66b2fbc4a3e5a331a2412cf18ae2d16f');

insert into _user_group (_user_id, _group_id) values (2, 2);

INSERT INTO jaring._group_menu VALUES (2, 1, 1);
INSERT INTO jaring._group_menu VALUES (2, 2, 0);
INSERT INTO jaring._group_menu VALUES (2, 1000, 0);
INSERT INTO jaring._group_menu VALUES (2, 1001, 0);
INSERT INTO jaring._group_menu VALUES (2, 1002, 0);
INSERT INTO jaring._group_menu VALUES (2, 1003, 0);

INSERT INTO jaring._menu VALUES (3, 0, 0, 'Telepon'				, 'telephone'	, ''					, 'MainTelephone'		, '');
INSERT INTO jaring._menu VALUES (4, 3, 3, 'Manajemen Telepon'	, 'manage'		, 'Telephone_Manage'	, 'Telephone'			, '');
INSERT INTO jaring._menu VALUES (5, 3, 3, 'Riwayat Telepon'		, 'history'		, 'Telephone_History'	, 'Telephone_History'	, '');

INSERT INTO jaring._menu VALUES (10, 0, 0	, 'WBP'				, 'wbp'			, ''			, 'WBP'			, '');
INSERT INTO jaring._menu VALUES (11, 10, 3	, 'Pencarian WBP'	, 'wbp_search'	, 'WBP_Search'	, 'WBP_Search'	, '');
INSERT INTO jaring._menu VALUES (12, 10, 3	, 'Sterek'			, 'wbp_sterek'	, 'WBP_Sterek'	, 'WBP_Sterek'	, '');

INSERT INTO jaring._group_menu VALUES (1, 3, 4);
INSERT INTO jaring._group_menu VALUES (1, 4, 4);
INSERT INTO jaring._group_menu VALUES (1, 5, 4);
INSERT INTO jaring._group_menu VALUES (1, 10, 4);
INSERT INTO jaring._group_menu VALUES (1, 11, 4);
INSERT INTO jaring._group_menu VALUES (1, 12, 4);

INSERT INTO jaring._group_menu VALUES (2, 3, 4);
INSERT INTO jaring._group_menu VALUES (2, 4, 4);
INSERT INTO jaring._group_menu VALUES (2, 5, 4);
INSERT INTO jaring._group_menu VALUES (2, 10, 4);
INSERT INTO jaring._group_menu VALUES (2, 11, 4);
INSERT INTO jaring._group_menu VALUES (2, 12, 4);
