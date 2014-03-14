<?php

/*
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */
define ("APP_PATH", realpath (dirname (__FILE__) ."/../../../") ."/");

require_once APP_PATH ."/WEB-INF/classes/tbs_class.php";
require_once APP_PATH ."/WEB-INF/classes/tbs_plugin_opentbs.php";

setlocale (LC_TIME, "");

$golongan		= filter_input (INPUT_POST, "golongan");
$kejaksaan		= filter_input (INPUT_POST, "kejaksaan");
$reserse		= filter_input (INPUT_POST, "reserse");
$asal_tahanan	= filter_input (INPUT_POST, "asal_tahanan");
$kepada			= "";
$satres			= "";
$keterangan		= "";
$wilayah1		= filter_input (INPUT_POST, "print_wilayah_1");
$wilayah2		= filter_input (INPUT_POST, "print_wilayah_2");
$ttd			= json_decode (stripslashes(filter_input (INPUT_POST, "print_ptd")), true);
$wbp			= json_decode (stripslashes(filter_input (INPUT_POST, "data")), true);
$print_date		= filter_input (INPUT_POST, "print_date");
$tembusan		= array();

if (empty ($print_date)) {
	$print_date = strftime ("%d  %B  %Y");
} else {
	$t			= strtotime ($print_date);
	$print_date	= strftime ("%d  %B  %Y", $t);
}

switch ($golongan)
{
	case 'AI':
		$kepada		= "Kepala Kepolisian Daerah ". $wilayah1;
		if ($reserse === "NR") {
			$satres = "Cq. Direktur Reserse Narkoba";
		} else {
			$satres = "Cq. Direktur Reserse Kriminal Umum";
		}

		$tembusan[] = "Kepala Kantor Wilayah Kementrian Hukum dan HAM ". $wilayah1 ." di ". $wilayah2;
		$tembusan[] = "Direktur Tahanan dan Barang Bukti Polda ". $wilayah1 ." di ". $wilayah2;

		if (! empty ($asal_tahanan)) {
			if ($asal_tahanan === "T-") {
				$tembusan[] = "Kepala Kejaksaan Tinggi ". $wilayah1 ." di ". $wilayah2;
			} else if ($asal_tahanan === "Pen") {
				$tembusan[] = "Ketua Pengadilan Negeri ". $wilayah2 ." di ". $wilayah2;
			}
		}
		break;

	case 'AII':
		$keterangan	= "(JPU)";
		$kepada		= "Kepala Kejaksaan Negeri ";

		if ($kejaksaan === "CMI") {
			$kepada	.= "Cimahi";
			$satres	= "Cq. Kasie Pidana Umum";
		} else {
			$kepada	.= $wilayah2;
		}

		$tembusan[] = "Kepala Kantor Wilayah Kementrian Hukum dan HAM ". $wilayah1 ." di ". $wilayah2;

		if ($kejaksaan === "CMI") {
			$tembusan[] = "Yth. Ketua Pengadilan Bale Bandung Di Kabupaten Bandung";
		} else {
			if (! empty ($asal_tahanan)) {
				if ($asal_tahanan === "T-") {
					$tembusan[] = "Kepala Kejaksaan Tinggi ". $wilayah1 ." di ". $wilayah2;
				} else if ($asal_tahanan === "Pen") {
					$tembusan[] = "Ketua Pengadilan Negeri Klas I ". $wilayah2 ." di ". $wilayah2;
				}
			}
			if ($reserse === "TPK") {
				$tembusan[] = "Ketua Pengadilan Tindak Pidana Korupsi ". $wilayah2 ." di ". $wilayah2;
			}
		}
		break;

	case 'AIII':
		$keterangan	= "(JPU)";
		$kepada		= "Ketua Pengadilan Negeri Klas I ";

		if ($kejaksaan === "CMI") {
			$kepada	.= "Cimahi";
			$satres	="Cq. Kasie Pidana Umum";
		} else {
			$kepada	.= $wilayah2;
		}

		$tembusan[]	= "Kepala Kejaksaan Negeri ". $wilayah2 ." di ". $wilayah2;
		break;

	case 'AIV':
		$kepada	= "Ketua Pengadilan Tinggi ";

		if ($kejaksaan === "CMI") {
			$kepada .= "Cimahi";
			$satres	= "Cq. Kasie Pidana Umum";
		} else {
			$kepada .= $wilayah2;
		}

		$tembusan[] = "Ketua Pengadilan Negeri Klas I ". $wilayah2 ." di ". $wilayah2;
		$tembusan[] = "Kepala Kejaksaan Negeri ". $wilayah2 ." di ". $wilayah2;
		break;

	case 'AV':
		$kepada		= "Ketua Mahkamah Agung R.I.";
		$wilayah2	= "Jakarta";
		$tembusan[]	= "Yth. Ketua Pengadilan Tinggi ". $wilayah1 ." di ". $wilayah2;
		$tembusan[]	= "Yth. Ketua Pengadilan Negeri Klas I ". $wilayah2 ." di ". $wilayah2;
		$tembusan[]	= "Kepala Kejaksaan Negeri ". $wilayah2 ." di ". $wilayah2;
		break;
}

$tembusan[] = "Arsip";

$TBS = new clsTinyButStrong();
$TBS->Plugin (TBS_INSTALL, OPENTBS_PLUGIN);

$TBS->LoadTemplate ('PAHAN_10.docx');

$TBS->MergeField("tanggal_cetak", $print_date);
$TBS->MergeField ("kepada", $kepada);
$TBS->MergeField ("keterangan", $keterangan);
$TBS->MergeField ("satres", $satres);
$TBS->MergeField ("wilayah1", $wilayah1);
$TBS->MergeField ("wilayah2", $wilayah2);
$TBS->MergeField ("ttd", $ttd);
$TBS->MergeBlock("wbp", $wbp);
$TBS->MergeBlock("tembusan", $tembusan);

$TBS->Show ();