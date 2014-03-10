<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

/* 
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Cetak Sterek</title>
		<link rel="stylesheet" href="print.css" type="text/css" media="print, screen" />
	</head>
	<body>
<?php
$wbp = json_decode (stripslashes(filter_input (INPUT_POST, "data")), true);

foreach ($wbp as $w) {
	echo "<div class='sterek'>"
			."<div class='empty' ></div>"
			."<div class='foto_frame'>"
				."<img class='foto' src='image_crop.php?image_path=/sdp/".$w["foto_depan"]."' width='75' height='94'/>"
			."</div>"
			."<div class='info'>"
				."<div>"
					."<div class='key'>NAMA</div>"
					."<div class='sep'>:</div>"
					."<div class='value'>".substr ($w["nama_lengkap"], 0, 38)."</div>"
				."</div>"
				."<div>"
					."<div class='key clear'>NO. REG</div>"
					."<div class='sep'>:</div>"
					."<div class='value'>".$w["nmr_reg_gol"]."</div>"
				."</div>"
				."<div>"
					."<div class='key clear'>PUTUSAN</div>"
					."<div class='sep'>:</div>"
					."<div class='value'>".$w["tahun_hukuman"]." TAHUN ".$w["bulan_hukuman"]." BULAN ".$w["hari_hukuman"]." HARI</div>"
				."</div>"
				."<div>"
					."<div class='key clear'>PERKARA</div>"
					."<div class='sep'>:</div>"
					."<div class='value'>".$w["perkara"]."</div>"
				."</div>"
				."<div>"
					."<div class='key clear'>EKSPIRASI</div>"
					."<div class='sep'>:</div>"
					."<div class='value'>".$w["tgl_ekspirasi"]."</div>"
				."</div>"
			."</div>"
		."</div>";
}
?>
	</body>
</html>