<?php

/*
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

require_once "../../json_begin.php";

try {
	$q	="	update	penandatangan"
		."	set		kepala_text	= ?"
		."	,		jabatan		= ?"
		."	,		nama		= ?"
		."	,		nip			= ?"
		."	where	id			= ?";

	$ps	= Jaring::$_db->prepare ($q);
	$i	= 1;
	$ps->bindValue ($i++, filter_input(INPUT_POST, "kepala_text"), PDO::PARAM_STR);
	$ps->bindValue ($i++, filter_input(INPUT_POST, "jabatan"), PDO::PARAM_STR);
	$ps->bindValue ($i++, filter_input(INPUT_POST, "nama"), PDO::PARAM_STR);
	$ps->bindValue ($i++, filter_input(INPUT_POST, "nip"), PDO::PARAM_STR);
	$ps->bindValue ($i++, filter_input(INPUT_POST, "id"), PDO::PARAM_STR);
	$ps->execute ();
	$ps->closeCursor ();

	$r['success']	= true;
	$r['data']		= Jaring::$MSG_SUCCESS_UPDATE;
} catch (Exception $e) {
	$r['data']	= $e->getMessage ();
}

require_once "../../json_end.php";