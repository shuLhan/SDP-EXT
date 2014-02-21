<?php

/* 
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

require_once '../../json_begin.php';

try {
	$q	="	select	A.id_reg	as id"
		."	,		A.deskripsi as text"
		."	from	rutanbandung_db.jenis_registrasi	as A"
		."	where	A.is_tahanan = 1"
		."	order by A.id_jenis_registrasi";

	$ps = Jaring::$_db->prepare ($q);
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