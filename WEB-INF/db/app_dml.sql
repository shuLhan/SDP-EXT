INSERT INTO rutanbandung_db._menu VALUES (3, 0, 0, 'Telepon'			, 'telephone'	, '', 'MainTelephone', '');
INSERT INTO rutanbandung_db._menu VALUES (4, 3, 1, 'Manajemen Telepon'	, 'manage'		, '', 'Telephone', '');
INSERT INTO rutanbandung_db._menu VALUES (5, 3, 1, 'Riwayat Telepon'	, 'history'		, '', 'Telephone_History', '');

INSERT INTO rutanbandung_db._menu VALUES (10, 0, 0	, 'WBP'				, 'wbp'		, ''			, 'WBP'			, '');
INSERT INTO rutanbandung_db._menu VALUES (11, 10, 3	, 'Pencarian WBP'	, 'search'	, 'WBP_Search'	, 'WBP_Search'	, '');

INSERT INTO rutanbandung_db._group_menu VALUES (1, 3, 4);
INSERT INTO rutanbandung_db._group_menu VALUES (1, 4, 4);
INSERT INTO rutanbandung_db._group_menu VALUES (1, 5, 4);

INSERT INTO rutanbandung_db._group_menu VALUES (1, 10, 4);
INSERT INTO rutanbandung_db._group_menu VALUES (1, 11, 4);