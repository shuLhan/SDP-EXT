<?php
require_once "../../json_begin.php";

try {
	$q	="	insert into penandatangan ("
		."		kepala_text"
		."	,	jabatan"
		."	,	nama"
		."	,	nip"
		."	) values ( ? , ? , ? , ? )";

	$ps = Jaring::$_db->prepare ($q);
	$i	= 1;
	$ps->bindValue ($i++, filter_input(INPUT_POST, "kepala_text"), PDO::PARAM_STR);
	$ps->bindValue ($i++, filter_input(INPUT_POST, "jabatan"), PDO::PARAM_STR);
	$ps->bindValue ($i++, filter_input(INPUT_POST, "nama"), PDO::PARAM_STR);
	$ps->bindValue ($i++, filter_input(INPUT_POST, "nip"), PDO::PARAM_STR);
	$ps->execute ();
	$ps->closeCursor ();

	$r['success']	= true;
	$r['data']		= Jaring::$MSG_SUCCESS_CREATE;
} catch (Exception $e) {
	$r['data']		= $e->getMessage ();
}

require_once "../../json_end.php";