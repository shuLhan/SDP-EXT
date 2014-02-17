<?php

/* 
 * Copyright 2014 - Mhd Sulhan
 * Authors:
 *   - mhd.sulhan (m.shulhan@gmail.com)
 */

$targ_w = 450;
$targ_h = 350;
$jpeg_quality = 90;

$src	= $_SERVER["DOCUMENT_ROOT"] .'/'. $_GET["image_path"];
$img_r	= imagecreatefromjpeg ($src);
$dst_r	= ImageCreateTrueColor ($targ_w, $targ_h);

imagecopyresampled ($dst_r, $img_r, 0, 0, 140, 0, $targ_w, $targ_h, 450, 350);

header('Content-type: image/jpeg', true);
imagejpeg($dst_r, null, $jpeg_quality);
imagedestroy($dst_r);