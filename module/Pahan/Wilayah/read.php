<?php

/*
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

require_once "../../json_begin.php";

try {
	$filter = $_GET["query"];

	// Get total row
	$q	="	select	COUNT(id)	as total"
		."	from	jaring.wilayah"
		."	where	nama like ?";

	$ps = Jaring::$_db->prepare ($q);
	$i	= 1;
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->execute ();
	$rs = $ps->fetchAll (PDO::FETCH_ASSOC);
	$ps->closeCursor ();

	if (count ($rs) > 0) {
		$t = (int) $rs[0]["total"];
	}

	$q	="	select	id"
		."	,		nama"
		."	from	jaring.wilayah"
		."	where	nama like ?"
		."	limit	?,?";

	$ps = Jaring::$_db->prepare ($q);
	$i	= 1;
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

require_once "../../json_end.php";