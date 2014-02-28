--
-- Create group User and user 'SDP'
--
insert into jaring._group (name, type) values ('User', 0);

insert into jaring._user (name, realname, password) values ('sdp', 'SDP', 'c0a04af421d69791100e21c8d74b150c66b2fbc4a3e5a331a2412cf18ae2d16f');

insert into jaring._user_group (_user_id, _group_id) values (2, 2);

INSERT INTO jaring._group_menu VALUES (2, 1, 1);
INSERT INTO jaring._group_menu VALUES (2, 2, 0);
INSERT INTO jaring._group_menu VALUES (2, 1000, 0);
INSERT INTO jaring._group_menu VALUES (2, 1001, 0);
INSERT INTO jaring._group_menu VALUES (2, 1002, 0);
INSERT INTO jaring._group_menu VALUES (2, 1003, 0);

INSERT INTO jaring._menu VALUES (3, 0, 0, 'Telepon'				, 'telephone'			, ''					, 'Telephone'			, '');
INSERT INTO jaring._menu VALUES (4, 3, 3, 'Manajemen Telepon'	, 'telephone_manage'	, 'Telephone_Manage'	, 'Telephone_Manage'	, '');
INSERT INTO jaring._menu VALUES (5, 3, 3, 'Riwayat Telepon'		, 'telephone_history'	, 'Telephone_History'	, 'Telephone_History'	, '');

INSERT INTO jaring._menu VALUES (10, 0, 0	, 'WBP'				, 'wbp'			, ''			, 'WBP'			, '');
INSERT INTO jaring._menu VALUES (11, 10, 3	, 'Pencarian WBP'	, 'wbp_search'	, 'WBP_Search'	, 'WBP_Search'	, '');
INSERT INTO jaring._menu VALUES (12, 10, 3	, 'Sterek'			, 'wbp_sterek'	, 'WBP_Sterek'	, 'WBP_Sterek'	, '');

INSERT INTO jaring._menu VALUES (20, 0	, 0	, 'Pahan'			, 'pahan'			, ''				, 'Pahan'		, '');
INSERT INTO jaring._menu VALUES (21, 20	, 3	, 'Pahan 10'		, 'pahan_manage'	, 'Pahan_Manage'	, 'Pahan_10'	, '');

INSERT INTO jaring._group_menu VALUES (1, 3, 4);
INSERT INTO jaring._group_menu VALUES (1, 4, 4);
INSERT INTO jaring._group_menu VALUES (1, 5, 4);
INSERT INTO jaring._group_menu VALUES (1, 10, 4);
INSERT INTO jaring._group_menu VALUES (1, 11, 4);
INSERT INTO jaring._group_menu VALUES (1, 12, 4);
INSERT INTO jaring._group_menu VALUES (1, 20, 4);
INSERT INTO jaring._group_menu VALUES (1, 21, 4);

INSERT INTO jaring._group_menu VALUES (2, 3, 4);
INSERT INTO jaring._group_menu VALUES (2, 4, 4);
INSERT INTO jaring._group_menu VALUES (2, 5, 4);
INSERT INTO jaring._group_menu VALUES (2, 10, 4);
INSERT INTO jaring._group_menu VALUES (2, 11, 4);
INSERT INTO jaring._group_menu VALUES (2, 12, 4);
INSERT INTO jaring._group_menu VALUES (2, 20, 4);
INSERT INTO jaring._group_menu VALUES (2, 21, 4);

INSERT INTO jaring.wilayah (default_1, default_2, nama) VALUES (1, 0, 'Jawa Barat');
INSERT INTO jaring.wilayah (default_1, default_2, nama) VALUES (0, 1, 'Bandung');
INSERT INTO jaring.wilayah (default_1, default_2, nama) VALUES (0, 0, 'Cimahi');
INSERT INTO jaring.wilayah (default_1, default_2, nama) VALUES (0, 0, 'Jakarta');

INSERT INTO jaring.penandatangan (kepala_text, jabatan, nama, nip) VALUES ('K E P A L A'		,''									,'JOKO PITOYO, Bc.IP., S.Sos'		,'19580202 198303 1 001');
INSERT INTO jaring.penandatangan (kepala_text, jabatan, nama, nip) VALUES ('An. K E P A L A'	,'Kasie. Pelayanan Tahanan'			,'R. BUDIMAN P. KUSUMAH, SH., MH.'	,'19750223 199902 1 001');
INSERT INTO jaring.penandatangan (kepala_text, jabatan, nama, nip) VALUES ('Plh. KEPALA'		,''									,'SUPARMAN, Amd.IP., SH., MH.'		,'19750604 199902 1 001');
INSERT INTO jaring.penandatangan (kepala_text, jabatan, nama, nip) VALUES ('An. K E P A L A'	,'Kasubsie. Administrasi Perawatan'	,'M. IRVAN MUAYAT, Amd.IP., SH.'	,'19790223 200012 1 001');