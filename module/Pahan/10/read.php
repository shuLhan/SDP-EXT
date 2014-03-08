<?php

/* 
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

require_once '../../json_begin.php';

try {
	$q	="	select	B.id_reg"
		."	,		B.nmr_reg_gol"
		."	,		A.nama_lengkap"
		."	,		A.alamat"
		."	,		date_format (B.tgl_srt_thn, '%d/%m/%Y')				as tgl_srt_thn"
		."	,		B.nmr_srt_thn"
		."	,		("
		."				select	D.no_srt_pmt"
		."				from	rutanbandung_db.perpanjangan_tahanan	D"
		."				where	B.id_reg		= D.id_reg"
		."				and		B.id_perkara	= D.id_perkara"
		."				and		B.tgl_entry		= ("
		."					select	max(E.tgl_entry)"
		."					from	rutanbandung_db.perpanjangan_tahanan E"
		."					where	E.id_perkara = D.id_perkara"
		."				)"
		."			)													as no_srt_pmt"
		."	,		date_format (B.tgl_awal_tahan_golongan, '%d/%m/%Y')	as tgl_awal_tahan_golongan"
		."	,		date_format (B.tgl_ekspirasi, '%d/%m/%Y')			as tgl_ekspirasi"
		."	,		B.nama_jaksa_utama"
		."	,		B.nm_pjbt_thn"
		."	from	rutanbandung_db.identitas				as A"
		."	,		rutanbandung_db.perkara					as B"
		."	,		rutanbandung_db.jenis_registrasi		as C"
		."	where	A.nomor_induk		= B.nomor_induk"
		."	and		B.id_reg			= C.id_reg"
		."	and		B.is_tahanan		= 1"
		."	and		A.is_deleted		= 0"
		."	and		B.id_status			= 'STA'"
		."	and		B.id_sub_status		= 'SSA1'"
		."	and		B.tgl_ekspirasi		= ?"
		."	order by	B.id_reg		asc"
		."	,			A.nama_lengkap	asc";

	$ps = Jaring::$_db->prepare ($q);
	$ps->bindValue ($i++, $_GET["query"], PDO::PARAM_STR);
	$ps->execute ();
	$rs = $ps->fetchAll (PDO::FETCH_ASSOC);
	$ps->closeCursor ();
	
	$r["success"]	= true;
	$r["data"]		= $rs;
} catch (Exception $ex) {
	$r["success"]	= false;
	$r["data"]		= $ex->getMessage();
}

require_once '../../json_end.php';