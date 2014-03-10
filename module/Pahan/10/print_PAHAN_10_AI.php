<?php
/*
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

setlocale (LC_TIME, "");

$reserse		= $_POST["reserse"];
$asal_tahanan	= $_POST["asal_tahanan"];
$print_date		= $_POST["print_date"];

if (empty ($print_date)) {
	$print_date = "<pre>". strftime ("%d  %B  %Y") ."</pre>";
} else {
	$t = strtotime ($print_date);
	$print_date = "<pre>". strftime ("%d  %B  %Y", $t) ."</pre>";
}

$print_wil1	= $_POST["print_wilayah_1"];
$print_wil2	= $_POST["print_wilayah_2"];
$print_ptd	= json_decode (stripslashes($_POST["print_ptd"]), true);
$hanging	= $_POST["hanging"];
$rowsize	= $_POST["rowsize"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Pahan 10 AI</title>
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
			<div>Kepala Kepolisian Daerah</div>
		</div>
		<div class="header">
			<div>Perihal</div>
			<div>:</div>
			<div>Pemberitahuan 10 (sepuluh) hari lagi akan habisnya masa penahanan tersangka atas nama :</div>
			<div></div>
			<div>
				<span id="provinsi">
					<?php echo $print_wil1; ?>
				</span><br/>
				<?php
					if ($reserse === "RESKRIM") {
						echo "Cq. Direktur Reserse Kriminal Umum";
					} else if ($reserse === "NR") {
						echo "Cq. Direktur Reserse Narkoba";
					} else if ($reserse === "TPK") {
						echo "Cq. Direktur Reserse Kriminal Umum";
					}
				?>
				<br/>
				Di - 
				<span id="kota">
					<?php echo $print_wil2; ?>
				</span>
			</div>
		</div>
		<div class="clear"></div>
		<p class="text">
			Sesuai Pasal 19 Ayat 6 PP. No. 27 Tahun 1983 dan Pasal 19 Ayat 7 Penjelasan PP. No. 27 Tahun 1983, dengan ini kami beritahukan :
		</p>
		<div class='wbp'>
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
	$wbp	= json_decode (stripslashes($_POST["data"]), true);
	$i		= 1;
	$c		= count ($wbp);

	foreach ($wbp as $w) {
		if (($i === $c) && $hanging === "true") {
			echo "</div>"
				."<div class='clear'></div>"
				."<div class='footer'>";
		}
		echo "<div class='wbp_data' style='height:". $rowsize ."em;'>"
				."<div><div>". $i												."</div></div>"
				."<div><div>". $w["nama_lengkap"]								."</div></div>"
				."<div><div>". $w["alamat"]										."</div></div>"
				."<div><div>". $w["tgl_srt_thn"] ."<br/>";

		if (empty ($w["no_srt_pmt"])) {
			echo $w["nmr_srt_thn"]	."</div></div>";
		} else {
			echo $w["no_srt_pmt"]	."</div></div>";
		}

		echo	"<div><div>". $w["tgl_awal_tahan_golongan"]					."</div></div>"
				."<div><div>". $w["tgl_ekspirasi"]								."</div></div>"
				."<div><div>". $w["nama_jaksa_utama"]							."</div></div>"
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
				<li>Kepala Kantor Wilayah Kementrian Hukum dan HAM <?php echo $print_wil1; ?> di <?php echo $print_wil2; ?></li>
				<li>Direktur Tahanan dan Barang Bukti Polda <?php echo $print_wil1; ?> di <?php echo $print_wil2; ?></li>
				<?php
					if (! empty ($asal_tahanan)) {
						if ($asal_tahanan === "T-") {
							echo "<li>Kepala Kejaksaan Tinggi ". $print_wil1 ." di ". $print_wil2 ."</li>";
						} else if ($asal_tahanan === "Pen") {
							echo "<li>Ketua Pengadilan Negeri ". $print_wil2 ." di ". $print_wil2 ."</li>";
						}
					}
				?>
				<li>Arsip</li>
			</ol>
		</div>
	</body>
</html>