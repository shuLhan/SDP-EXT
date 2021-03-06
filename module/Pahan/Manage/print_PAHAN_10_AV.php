<?php
/*
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

setlocale (LC_TIME, "");

$kejaksaan		= filter_input (INPUT_POST, "kejaksaan");
$reserse		= filter_input (INPUT_POST, "reserse");
$asal_tahanan	= filter_input (INPUT_POST, "asal_tahanan");
$print_date		= filter_input (INPUT_POST, "print_date");

if (empty ($print_date)) {
	$print_date = "<pre>". strftime ("%d  %B  %Y") ."</pre>";
} else {
	$t = strtotime ($print_date);
	$print_date = "<pre>". strftime ("%d  %B  %Y", $t) ."</pre>";
}

$print_wil1	= filter_input (INPUT_POST, "print_wilayah_1");
$print_wil2	= filter_input (INPUT_POST, "print_wilayah_2");
$print_ptd	= json_decode (stripslashes(filter_input (INPUT_POST, "print_ptd")), true);
$hanging	= filter_input (INPUT_POST, "hanging");
$rowsize	= filter_input (INPUT_POST, "rowsize");
?>
<!DOCTYPE xhtml PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Pahan 10 AV</title>
		<link rel="stylesheet" href="../print.css" type="text/css" media="print, screen"/>
	</head>
	<body>
		<img id="logo" alt="RUTAN KLAS I BANDUNG" src="../logo.png" width="491"/>
		<br />
		<br />
		<div class="header">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div id="header_date"><?php echo $print_date ?></div>
		</div>
		<div class="header">
			<div>Nomor</div>
			<div>:</div>
			<div><pre>W.11.PAS.PAS.27-PK.01.01.01-                         / <?php echo date("Y"); ?></pre>
			</div>
			<div></div>
			<div></div>
		</div>
		<div class="header">
			<div>Lampiran</div>
			<div>:</div>
			<div>-</div>
			<div>Yth.</div>
			<div>Ketua Mahkamah Agung R.I.
			</div>
		</div>
		<div class="header">
			<div>Perihal</div>
			<div>:</div>
			<div>Pemberitahuan 10 (sepuluh) hari lagi akan habisnya masa penahanan tersangka atas nama :</div>
			<div></div>
			<div>
				Di -
				<span id="kota"> Jakarta </span>
			</div>
		</div>
		<div class="clear"></div>
		<p class="text">
			Sesuai Pasal 19 Ayat 6 PP. No. 27 Tahun 1983 dan Pasal 19 Ayat 7 Penjelasan PP. No. 27 Tahun 1983, dengan ini kami beritahukan :
		</p>
		<div class="wbp">
			<div class='wbp_header'>
				<div><div>No.</div></div>
				<div><div>Nama Tahanan</div></div>
				<div><div>Alamat</div></div>
				<div><div>Tanggal <br/> dan <br/> No. Surat Penahanan</div></div>
				<div><div>Tanggal mulai Ditahan</div></div>
				<div><div>Tanggal akan habisnya</div></div>
				<div><div>Keterangan</div></div>
			</div>
<?php
	$wbp	= json_decode (stripslashes(filter_input (INPUT_POST, "data")), true);
	$i		= 1;
	$c		= count ($wbp);

	foreach ($wbp as $w) {
		if (($i === $c) && $hanging === "true") {
			echo "</div>"
				."<div class='clear'></div>"
				."<div class='footer'>";
		}
		echo "<div class='wbp_data' style='height:". $rowsize ."em;'>"
				."<div><div>". $i								."</div></div>"
				."<div><div>". $w["nama_lengkap"]				."</div></div>"
				."<div><div>". $w["alamat"]						."</div></div>"
				."<div><div>". $w["tgl_srt_thn"] ."<br/>";

		if (empty ($w["no_srt_pmt"])) {
			echo $w["nmr_srt_thn"]	."</div></div>";
		} else {
			echo $w["no_srt_pmt"]	."</div></div>";
		}

		echo	"<div><div>". $w["tgl_awal_tahan_golongan"]		."</div></div>"
				."<div><div>". $w["tgl_ekspirasi"]				."</div></div>"
				."<div><div>";

		if ($w["id_reg"] === "AI") {
			echo $w["nm_pjbt_thn"];
		} else if ($w["id_reg"] === "AII") {
			echo $w["nama_jaksa_utama"];
		} else if ($w["id_reg"] === "AIII" || $w["id_reg"] === "AIV" || $w["id_reg"] === "AV") {
			echo $w["nama_hakim_utama"];
		} else {
			echo $w["id_reg"];
		}
		echo "</div></div>"
			."</div>";
		$i++;
	}

	if ($hanging !== "true") {
		echo "</div>"
			."<div class='clear'></div>"
			."<div class='footer'>";
	}
?>
			<p class="text">
				Demikianlah untuk mendapat perhatian sebagaimana mestinya.
			</p>
			<div class="signature">
				<div></div>
				<div>
				<?php
					if (! empty ($print_ptd['kepala_text'])) {
						echo $print_ptd['kepala_text'] .",";
					}
				?>
				</div>
			</div>
			<div class="signature">
				<div></div>
				<div>
					<?php echo $print_ptd['jabatan']; ?>
				</div>
			</div>
			<div class="signature">
				<div></div>
				<div class="sig"></div>
			</div>
			<div class="signature">
				<div></div>
				<div class="sig_name">
					<?php echo $print_ptd['nama']; ?>
				</div>
			</div>
			<div class="signature">
				<div></div>
				<div class="sig_nip">NIP.
					<?php echo $print_ptd['nip']; ?>
				</div>
			</div>
			<div class="clear"></div>
			<br/>

			<p>
			Tembusan disampaikan kepada Yth:
			</p>
			<ol class="attachment">
				<li>Yth. Ketua Pengadilan Tinggi <?php echo $print_wil1 ." di ". $print_wil2 ?></li>
				<li>Yth. Ketua Pengadilan Negeri Klas I <?php echo $print_wil2 ." di ". $print_wil2; ?></li>
				<li>Kepala Kejaksaan Negeri <?php echo $print_wil2 ." di ". $print_wil2; ?>
				</li>
				<li>Arsip</li>
			</ol>
		</div>
	</body>
</html>