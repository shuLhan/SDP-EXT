<?php
/* 
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */
require_once "../../json_begin.php";

try {
	// Get total row
	$q	="	select		COUNT(A.nomor_induk)	as total "
		."	from		sdpext_telephone		A "
		."	,			identitas				B "
		."	where		A.nomor_induk			= B.nomor_induk "
		."	and			B.is_deleted			= 0 "
		."	and			( "
		."			A.nomor_induk	like ? "
		."		or	B.nama_lengkap	like ? "
		."		or	A.sn			like ? "
		."		or	A.pin			like ? "
		."	) ";

	$ps = Jaring::$_db->prepare ($q);
	$i	= 1;
	$ps->bindValue ($i++, "%". $_GET["query"] ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $_GET["query"] ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $_GET["query"] ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $_GET["query"] ."%", PDO::PARAM_STR);
	$ps->execute ();
	$rs = $ps->fetchAll (PDO::FETCH_ASSOC);
	$ps->closeCursor ();

	if (count ($rs) > 0) {
		$t = (int) $rs[0]["total"];
	}

	$q	="	select		A.nomor_induk "
		."	,			B.nama_lengkap "
		."	,			A.sn "
		."	,			A.pin "
		."	,			A.status "
		."	,			A.update_date "
		."	,			C.nmr_reg_gol		as no_reg "
		."	from		sdpext_telephone	A "
		."	,			identitas			B "
		."	,			perkara				C "
		."	where		A.nomor_induk		= B.nomor_induk "
		."	and			B.nomor_induk		= C.nomor_induk "
		."	and			B.is_deleted		= 0 "
		."	and			( "
		."			A.nomor_induk			like ? "
		."		or	B.nama_lengkap			like ? "
		."		or	A.sn					like ? "
		."		or	A.pin					like ? "
		."	) "
		."	order by	B.nama_lengkap	ASC "
		."	,			A.status		DESC "
		."	,			A.update_date	DESC "
		."	limit		". (int) $_GET["start"] .",". (int) $_GET["limit"];

	$ps = Jaring::$_db->prepare ($q);
	$ps->execute (array (
			"%". $_GET["query"] ."%"
		,	"%". $_GET["query"] ."%"
		,	"%". $_GET["query"] ."%"
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

require_once "../../json_end.php";