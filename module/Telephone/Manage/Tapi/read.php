<?php

/* 
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

require_once "../../../json_begin.php";

try {
	// Get total row
	$q	="	select		COUNT(A.nomor_induk)	as total "
		."	from		rutanbandung_db.identitas	as A "
		."	,			rutanbandung_db.perkara		as B "
		."	where		A.nomor_induk			= B.nomor_induk "
		."	and			A.is_deleted			= 0 "
		."	and			B.id_status				= 'STA' "
		."	and			B.id_sub_status			= 'SSA1' "
		."	and			( "
		."			A.nomor_induk	like ? "
		."		or	A.nama_lengkap	like ? "
		."	) ";

	$ps = Jaring::$_db->prepare ($q);
	$ps->execute (array (
			"%". $_GET["query"] ."%"
		,	"%". $_GET["query"] ."%")
	);
	$rs = $ps->fetchAll (PDO::FETCH_ASSOC);
	$ps->closeCursor ();

	if (count ($rs) > 0) {
		$t = (int) $rs[0]["total"];
	}

	$q	="	select		A.nomor_induk "
		."	,			A.nama_lengkap "
		."	,			B.nmr_reg_gol		as no_reg"
		."	,			concat (C.uu_kejahatan, ' - ', C.pasal_utama) as uu "
		."	from		rutanbandung_db.identitas	as A "
		."	,			rutanbandung_db.perkara		as B "
		."	,			rutanbandung_db.kejahatan	as C "
		."	where		A.nomor_induk			= B.nomor_induk "
		."	and			B.id_perkara			= C.id_perkara "
		."	and			A.is_deleted			= 0 "
		."	and			B.id_status				= 'STA' "
		."	and			B.id_sub_status			= 'SSA1' "
		."	and			( "
		."			A.nomor_induk	like ? "
		."		or	A.nama_lengkap	like ? "
		."	) "
		."	order by	A.nama_lengkap "
		."	limit		". (int) $_GET["start"] .",". (int) $_GET["limit"];

	$ps = Jaring::$_db->prepare ($q);
	$ps->execute (array (
			"%". $_GET["query"] ."%"
		,	"%". $_GET["query"] ."%"
		)
	);
	$rs = $ps->fetchAll (PDO::FETCH_ASSOC);
	$ps->closeCursor ();

	$r = array (
		'success'	=> true
	,	'data'		=> $rs
	,	'total'		=> $t
	);
} catch (Exception $e) {
	$r['data']	= $e->getMessage ();
}

require_once "../../../json_end.php";