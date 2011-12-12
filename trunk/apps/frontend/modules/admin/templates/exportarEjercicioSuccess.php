<?php

// force to download a file



		
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header('Content-type: application/xml; charset="utf-8"',true);		
		header("Content-Type: application/force-download");
		header("Content-Type: application/download");;
		header("Content-Disposition: attachment; filename = $nombre.xml");
		header("Content-Transfer-Encoding: binary ");
		












/*
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=$nombre.xml");

header("Content-Description: File Transfer");
*/
echo $xml;

?>
