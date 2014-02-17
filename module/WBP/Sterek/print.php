<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

/* 
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */
?>
<html>
	<head>
		<title>Cetak Sterek</title>
		<link rel="stylesheet" href="print.css" type="text/css" media="print, screen" />
	</head>
	<body>
<?php
$wbp = json_decode (stripslashes($_POST["data"]), true);

foreach ($wbp as $w) {
	echo "<div class='sterek'>"
			."<div class='empty' ></div>"
			."<div class='foto_frame'>"
				."<img class='foto' src='/sdp/".$w["foto_depan"]."' width='75' height='94'/>"
			."</div>"
			."<div class='info'>"
				."<div>"
					."<div class='key'>NAMA</div>"
					."<div class='sep'>:</div>"
					."<div class='value'>".$w["nama_lengkap"]."</div>"
				."</div>"
				."<div>"
					."<div class='key'>NO. REG</div>"
					."<div class='sep'>:</div>"
					."<div class='value'>".$w["nmr_reg_gol"]."</div>"
				."</div>"
				."<div>"
					."<div class='key'>PUTUSAN</div>"
					."<div class='sep'>:</div>"
					."<div class='value'>".$w["tahun_hukuman"]." THN ".$w["bulan_hukuman"]." BLN ".$w["hari_hukuman"]." HR</div>"
				."</div>"
				."<div>"
					."<div class='key'>PERKARA</div>"
					."<div class='sep'>:</div>"
					."<div class='value'>".$w["perkara"]."</div>"
				."</div>"
				."<div>"
					."<div class='key'>EKSPIRASI</div>"
					."<div class='sep'>:</div>"
					."<div class='value'>".$w["tgl_ekspirasi"]."</div>"
				."</div>"
			."</div>"
		."</div>";
}
?>
	</body>
</html>