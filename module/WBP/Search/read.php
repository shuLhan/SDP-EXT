<?php
/*
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */
require_once "../../json_begin.php";

try {
	$filter		= $_GET["query"];
	$st_aktif	= (int) $_GET["subaction"];

	// Get total row
	$q	="	select		COUNT(A.nomor_induk)	as total "
		."	from		rutanbandung_db.identitas	as A "
		."	,			rutanbandung_db.perkara		as B "
		."	where		A.nomor_induk			= B.nomor_induk "
		."	and			A.is_deleted			= 0 "
		."	and			( "
		."			A.nomor_induk			like ? "
		."		or	A.nama_lengkap			like ? "
		."		or	A.nama_alias1			like ? "
		."		or	A.alamat				like ? "
		."		or	A.keterangan_pekerjaan	like ? "
		."		or	A.nm_ayah				like ? "
		."		or	A.nm_ibu				like ? "
		."		or	A.nm_saudara			like ? "
		."		or	A.nm_istri_suami		like ? "
		."		or	A.tmp_tgl_istri_suami	like ? "
		."		or	A.nm_anak				like ? "
		."		or	A.cacat					like ? "
		."		or	A.ciri					like ? "
		."		or	B.id_perkara			like ? "
		."		or	B.kepolisian			like ? "
		."		or	B.risalah_kejadian_perkara	like ? "
		."	) ";

	if ($st_aktif === 1) {
		$q	.="	and	B.id_status		= 'STA' "
			."	and B.id_sub_status = 'SSA1' ";
	}

	$ps = Jaring::$_db->prepare ($q);
	$i	= 1;
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);

	$ps->execute ();
	$rs = $ps->fetchAll (PDO::FETCH_ASSOC);
	$ps->closeCursor ();

	if (count ($rs) > 0) {
		$t = (int) $rs[0]["total"];
	}

	$q	="	select	A.nomor_induk "
		."	,		A.nama_lengkap "
		."	,		B.nmr_reg_gol "
		."	,		("
		."				select	DR.deskripsi "
		."				from	rutanbandung_db.daftar_referensi as DR"
		."				where	B.id_sub_status = DR.id_lookup "
		."			) as status"
		."	,		("
		."				select	concat(B.deskripsi, '-', S.no_sel) "
		."				from	rutanbandung_db.mutasi_sel	MS"
		."				,		rutanbandung_db.blok		B"
		."				,		rutanbandung_db.sel			S"
		."				where	MS.id_perkara	= B.id_perkara "
		."				and		MS.id_blok_baru	= B.id_blok "
		."				and		MS.no_sel_baru	= S.id_sel "
		."				order by MS.id_mutasi_sel desc "
		."				limit 1 "
		."			) as kamar "
		."	,		A.foto_depan"
		."	,		A.alamat"
		."	,		B.tahun_hukuman"
		."	,		B.bulan_hukuman"
		."	,		B.hari_hukuman"
		."	,		concat(C.pasal_utama,' ', C.uu_kejahatan)	as perkara"
		."	,		DATE_FORMAT(B.tgl_ekspirasi, '%d/%m/%Y')	as tgl_ekspirasi"
		."	,		DATE_FORMAT(B.tgl_sepertiga, '%d/%m/%Y')	as tgl_sepertiga"
		."	,		DATE_FORMAT(B.tgl_setengah, '%d/%m/%Y')		as tgl_setengah"
		."	,		DATE_FORMAT(B.tgl_duapertiga, '%d/%m/%Y')	as tgl_duapertiga"
		."	from	rutanbandung_db.identitas	as A "
		."	,		rutanbandung_db.perkara		as B "
		."	,		rutanbandung_db.kejahatan	as C "
		."	where	A.nomor_induk		= B.nomor_induk "
		."	and		B.id_perkara		= C.id_perkara "
		."	and		A.is_deleted		= 0 "
		."	and		( "
		."			A.nomor_induk			like ? "
		."		or	A.nama_lengkap			like ? "
		."		or	A.nama_alias1			like ? "
		."		or	A.alamat				like ? "
		."		or	A.keterangan_pekerjaan	like ? "
		."		or	A.nm_ayah				like ? "
		."		or	A.nm_ibu				like ? "
		."		or	A.nm_saudara			like ? "
		."		or	A.nm_istri_suami		like ? "
		."		or	A.tmp_tgl_istri_suami	like ? "
		."		or	A.nm_anak				like ? "
		."		or	A.cacat					like ? "
		."		or	A.ciri					like ? "
		."		or	B.id_perkara			like ? "
		."		or	B.kepolisian			like ? "
		."		or	B.risalah_kejadian_perkara	like ? "
		."	) ";

	if ($st_aktif === 1) {
		$q	.="	and	B.id_status		= 'STA' "
			."	and B.id_sub_status = 'SSA1' ";
	}

	$q	.="	order by	A.nama_lengkap	ASC "
		."	limit		? , ?";

	$ps	= Jaring::$_db->prepare ($q);
	$i	= 1;
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, "%". $filter ."%", PDO::PARAM_STR);
	$ps->bindValue ($i++, (int) $_GET["start"], PDO::PARAM_INT);
	$ps->bindValue ($i++, (int) $_GET["limit"], PDO::PARAM_INT);
	$ps->execute ();
	$rs = $ps->fetchAll (PDO::FETCH_ASSOC);
	$ps->closeCursor ();

	$r['success']	= true;
	$r['data']		= $rs;
	$r['total']		= $t;
} catch (Exception $e) {
	$r['data']	= $e->getMessage ();
}

require_once "../../json_end.php";