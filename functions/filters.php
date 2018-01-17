<?php

 /**
  * Wordpress API filters
  *
  * @link https://codex.wordpress.org/Plugin_API/Filter_Reference
  *
  * @package _ncv2
  */

function ncv2_sanitize_french_chars($filename) {

	/* Force the file name in UTF-8 (encoding Windows / OS X / Linux) */
	$filemane = mb_convert_encoding($filename, "UTF-8");

	$char_not_clean = array('/À/','/Á/','/Â/','/Ã/','/Ä/','/Å/','/Ç/','/È/','/É/','/Ê/','/Ë/','/Ì/','/Í/','/Î/','/Ï/','/Ò/','/Ó/','/Ô/','/Õ/','/Ö/','/Ù/','/Ú/','/Û/','/Ü/','/Ý/','/à/','/á/','/â/','/ã/','/ä/','/å/','/ç/','/è/','/é/','/ê/','/ë/','/ì/','/í/','/î/','/ï/','/ð/','/ò/','/ó/','/ô/','/õ/','/ö/','/ù/','/ú/','/û/','/ü/','/ý/','/ÿ/', '/©/');
	$clean = array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','y','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','o','u','u','u','u','y','y','copy');

	$friendly_filename = preg_replace($char_not_clean, $clean, $filename);


	/* After replacement, we destroy the last residues */
	$friendly_filename = utf8_decode($friendly_filename);
	$friendly_filename = preg_replace('/\?/', '', $friendly_filename);


	/* Lowercase */
	$friendly_filename = strtolower($friendly_filename);

	return $friendly_filename;
}
add_filter('sanitize_file_name', 'ncv2_sanitize_french_chars', 10);
