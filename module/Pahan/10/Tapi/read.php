<?php

/* 
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

require_once "../../../json_begin.php";

try {
	$filter = $_GET["query"];
	
	// Get total row
	$q	="	select	COUNT(A.nomor_induk)				as total"
		."	from	rutanbandung_db.identitas			as A"
		."	,		rutanbandung_db.perkara				as B"
		."	,		rutanbandung_db.jenis_registrasi	as C"
		."	where	A.nomor_induk		= B.nomor_induk"
		."	and		B.id_reg			= C.id_reg"
		."	and		A.is_deleted		= 0"
		."	and		B.id_status			= 'STA'"
		."	and		B.id_sub_status		= 'SSA1'"
		."	and		( "
		."			A.nomor_induk	like ? "
		."		or	A.nama_lengkap	like ? "
		."	) ";

	$ps = Jaring::$_db->prepare ($q);
	$i	= 1;
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->execute ();
	$rs = $ps->fetchAll (PDO::FETCH_ASSOC);
	$ps->closeCursor ();

	if (count ($rs) > 0) {
		$t = (int) $rs[0]["total"];
	}

	$q	="	select	A.nomor_induk"
		."	,		B.id_reg"
		."	,		B.nmr_reg_gol"
		."	,		A.nama_lengkap"
		."	,		A.alamat"
		."	,		B.tgl_srt_thn"
		."	,		B.nmr_srt_thn"
		."	,		B.tgl_awal_tahan_golongan"
		."	,		B.tgl_ekspirasi"
		."	,		B.nama_jaksa_utama"
		."	from	rutanbandung_db.identitas			as A"
		."	,		rutanbandung_db.perkara				as B"
		."	,		rutanbandung_db.jenis_registrasi	as C"
		."	where	A.nomor_induk		= B.nomor_induk"
		."	and		B.id_reg			= C.id_reg"
		."	and		A.is_deleted		= 0"
		."	and		B.id_status			= 'STA'"
		."	and		B.id_sub_status		= 'SSA1'"
		."	and		("
		."			A.nomor_induk	like ?"
		."		or	A.nama_lengkap	like ?"
		."	)"
		."	order by	A.nama_lengkap"
		."	limit		?,?";

	$ps = Jaring::$_db->prepare ($q);
	$i	= 1;
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, (int) $_GET["start"], PDO::PARAM_INT);
	$ps->bindValue ($i++, (int) $_GET["limit"], PDO::PARAM_INT);
	$ps->execute ();
	$rs = $ps->fetchAll (PDO::FETCH_ASSOC);
	$ps->closeCursor ();

	$r["success"]	= true;
	$r["data"]		= $rs;
	$r["total"]		= $t;
} catch (Exception $e) {
	$r['data']	= $e->getMessage ();
}

require_once "../../../json_end.php";