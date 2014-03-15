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
$wilayah1		= filter_input (INPUT_POST, "print_wilayah_1");
$wilayah2		= filter_input (INPUT_POST, "print_wilayah_2");
$ttd			= json_decode (stripslashes(filter_input (INPUT_POST, "print_ptd")), true);
$wbp			= json_decode (stripslashes(filter_input (INPUT_POST, "data")), true);

$tgl_ekspirasi		= filter_input (INPUT_POST, "tanggal_ekspirasi");
if (empty ($tgl_ekspirasi)) {
	$tgl_ekspirasi	= strftime ("%d  %B  %Y");
} else {
	$t				= strtotime ($tgl_ekspirasi .' + 1 day');
	$tgl_ekspirasi	= strftime ("%d  %B  %Y", $t);
}

$print_date		= filter_input (INPUT_POST, "print_date");
if (empty ($print_date)) {
	$print_date = strftime ("%d  %B  %Y");
} else {
	$t			= strtotime ($print_date);
	$print_date	= strftime ("%d  %B  %Y", $t);
}

$tgl_pahan_10		= filter_input (INPUT_POST, "tanggal_pahan_10");
if (empty ($tgl_pahan_10)) {
	$tgl_pahan_10	= strftime ("%d  %B  %Y");
} else {
	$t				= strtotime ($tgl_pahan_10);
	$tgl_pahan_10	= strftime ("%d  %B  %Y", $t);
}

$kepada			= "";
$satres			= "";
$keterangan		= "";
$pasal			= "";
$tembusan		= array();

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

		$pasal	= "UU No. 8 Tahun 1981"
				.", Pasal 24 KUHAP"
				.", Pasal 19 Ayat 6 PP No. 24 Tahun 1983"
				.", Pasal 19 KUHAP Ayat 7 Penjelasan PP No. 29 Tahun 1983"
				.", dan Peraturan Menteri Hukum dan HAM  No. M.HH-24.PK.01.01.01 Tahun 2011";
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

		$pasal	= "UU No. 8 Tahun 1981"
				.", Pasal 25 KUHAP"
				.", Pasal 19 Ayat 6 PP No. 24 Tahun 1983"
				.", Pasal 19 KUHAP Ayat 7 Penjelasan PP No. 29 Tahun 1983"
				.", dan Peraturan Menteri Hukum dan HAM  No. M.HH-24.PK.01.01.01 Tahun 2011";
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

		$pasal		= "UU No. 8 Tahun 1981"
					.", Pasal 26 KUHAP"
					.", Pasal 19 Ayat 6 PP No. 27 Tahun 1983"
					.", Pasal 19 Ayat 7 Penjelasan PP No. 29 Tahun 1983"
					.", dan Peraturan Menteri Hukum dan HAM  No. M.HH-24.PK.01.01.01 Tahun 2011";
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
		$pasal		= "Pasal 19 Ayat 6 PP No. 27 Tahun 1983"
					." dan Pasal 19 Ayat 7 Penjelasan PP No. 27 Tahun 1983";
		break;

	case 'AV':
		$kepada		= "Ketua Mahkamah Agung R.I.";
		$wilayah2	= "Jakarta";
		$tembusan[]	= "Yth. Ketua Pengadilan Tinggi ". $wilayah1 ." di ". $wilayah2;
		$tembusan[]	= "Yth. Ketua Pengadilan Negeri Klas I ". $wilayah2 ." di ". $wilayah2;
		$tembusan[]	= "Kepala Kejaksaan Negeri ". $wilayah2 ." di ". $wilayah2;
		$pasal		= "Pasal 19 Ayat 6 PP No. 27 Tahun 1983"
					." dan Pasal 19 Ayat 7 Penjelasan PP No. 27 Tahun 1983";
		break;
}

$tembusan[] = "Arsip";

$TBS = new clsTinyButStrong();
$TBS->Plugin (TBS_INSTALL, OPENTBS_PLUGIN);

$TBS->LoadTemplate ('PAHAN_03.docx');

$TBS->MergeField("tanggal_cetak", $print_date);
$TBS->MergeField ("kepada", $kepada);
$TBS->MergeField ("keterangan", $keterangan);
$TBS->MergeField ("satres", $satres);
$TBS->MergeField ("wilayah1", $wilayah1);
$TBS->MergeField ("wilayah2", $wilayah2);
$TBS->MergeField ("ttd", $ttd);
$TBS->MergeBlock("wbp", $wbp);
$TBS->MergeBlock("tembusan", $tembusan);

// PAHAN 03
$TBS->MergeField("tanggal_pahan_10", $tgl_pahan_10);
$TBS->MergeField("tanggal_ekspirasi", $tgl_ekspirasi);
$TBS->MergeField("pasal", $pasal);

$saveas = "Pahan 03 - ". $golongan ." - ". $print_date;

$TBS->Show (OPENTBS_DOWNLOAD, $saveas);