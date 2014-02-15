<?php
/* 
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */
require_once "../json_begin.php";

try {
	$q		="	delete from telephone"
			."	where	nomor_induk = ?"
			."	and		sn			= ?"
			."	and		pin			= ?"
			."	and		update_date	= ?";

	$ps	= Jaring::$_db->prepare ($q);
	$i	= 1;
	$ps->bindValue ($i++, $_POST["nomor_induk"], PDO::PARAM_STR);
	$ps->bindValue ($i++, $_POST["sn"], PDO::PARAM_STR);
	$ps->bindValue ($i++, $_POST["pin"], PDO::PARAM_STR);
	$ps->bindValue ($i++, $_POST["update_date"], PDO::PARAM_STR);
	$ps->execute ();
	$ps->closeCursor ();

	$r['success']	= true;
	$r['data']		= Jaring::$MSG_SUCCESS_DESTROY;
} catch (Exception $e) {
	$r['data']		= $e->getMessage ();
}

require_once "../json_end.php";