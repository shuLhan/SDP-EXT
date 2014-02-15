<?php

/* 
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

require_once "../json_begin.php";

try {
	if ($_POST["subaction"] === "change") {
		$q	="	update	telephone"
			."	set		status		= 0"
			."	where	nomor_induk	= ?"
			."	and		update_date	= ?";

		$ps = Jaring::$_db->prepare ($q);
		$i = 1;
		$ps->bindValue ($i++, $_POST["nomor_induk"], PDO::PARAM_STR);
		$ps->bindValue ($i++, $_POST["update_date"], PDO::PARAM_STR);
		$ps->execute ();
		$ps->closeCursor ();
		
		// insert new data
		$q	="	insert into telephone ("
			."		nomor_induk "
			."	,	sn "
			."	,	pin "
			."	,	status "
			."	,	update_user "
			."	) values ( ? , ? , ? , ? , ? )";

		$ps	= Jaring::$_db->prepare ($q);
		$i	= 1;
		$ps->bindValue ($i++, $_POST['nomor_induk'], PDO::PARAM_STR);
		$ps->bindValue ($i++, $_POST['sn'], PDO::PARAM_STR);
		$ps->bindValue ($i++, $_POST['pin'], PDO::PARAM_STR);
		$ps->bindValue ($i++, (int) $_POST['status'], PDO::PARAM_INT);
		$ps->bindValue ($i++, (int) $_POST['user_id'], PDO::PARAM_INT);		
		$ps->execute ();
		$ps->closeCursor ();
	} else {
		$q	="	update	telephone"
			."	set		sn			= ?"
			."	,		pin			= ?"
			."	,		status		= ?"
			."	where	nomor_induk	= ?"
			."	and		update_date	= ?";

		$ps = Jaring::$_db->prepare ($q);
		$i = 1;
		$ps->bindValue ($i++, $_POST["sn"], PDO::PARAM_STR);
		$ps->bindValue ($i++, $_POST["pin"], PDO::PARAM_STR);
		$ps->bindValue ($i++, (int) $_POST["status"], PDO::PARAM_INT);
		$ps->bindValue ($i++, $_POST["nomor_induk"], PDO::PARAM_STR);
		$ps->bindValue ($i++, $_POST["update_date"], PDO::PARAM_STR);
		$ps->execute ();
		$ps->closeCursor ();
	}

	$r['success']	= true;
	$r['data']		= Jaring::$MSG_SUCCESS_UPDATE;
} catch (Exception $e) {
	$r['data']	= $e->getMessage ();
}

require_once "../json_end.php";