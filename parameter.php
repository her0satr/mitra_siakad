<?php
// Parameter
$_ProductName = "Siakad";
$_Institution = 'STIKES Pemkab. Jombang';
$_Identitas = "SISFO";
$_Author = "Siakad Team";
$_AuthorEmail = "mitradesain@yahoo.com";
$_URL = "";

$_Themes = "default";

if (!defined('KodeID')) define('KodeID', $_Identitas);
$arrID = GetFields('identitas', 'Kode', KodeID, '*');

// System
$_lf = "\r\n";
$_defmnux = 'login';
$_maxbaris = 10;

// PMB
$_PMBDigit = 4;


// Penanggalan
$arrBulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
  'Agustus', 'September', 'Oktober', 'November', 'Desember');
$arrHari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

?>
