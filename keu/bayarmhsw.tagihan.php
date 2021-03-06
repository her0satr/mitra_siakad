<?php
// Author : Irvandy Goutama
// Email  : irvandygoutama@gmail.com
// Start  : 1 Juni 2008

session_start();

  include_once "../dwo.lib.php";
  include_once "../db.mysql.php";
  include_once "../connectdb.php";
  include_once "../parameter.php";
  include_once "../cekparam.php";
  include_once "../fpdf.php";

// *** Parameters ***
$lbr = 190;
$mrg = 10;
$TahunID = $_REQUEST['TahunID'];
$MhswID = sqling($_REQUEST['MhswID']);

// Init PDF
$pdf = new FPDF();
$pdf->SetTitle("Tagihan Administrasi");
$pdf->SetAutoPageBreak(true, 5);

if(empty($MhswID))
{	$s = "select MhswID from khs where TahunID='$TahunID' and KodeID='".KodeID."' order by MhswID";
	$r = _query($s);
	while($w = _fetch_array($r))
	{	
		$pdf->AddPage();
		HeaderLogo('TAGIHAN ADMINISTRASI', $pdf, 'P');
		BuatHeader($TahunID, $w['MhswID'], $pdf);
		TampilkanDetailBiaya($TahunID, $w['MhswID'], $pdf);
		BuatFooter($TahunID, $w['MhswID'], $pdf);
	}
}
else
{
	$pdf->AddPage();
	HeaderLogo('TAGIHAN ADMINISTRASI', $pdf, 'P');
	BuatHeader($TahunID, $MhswID, $pdf);
	TampilkanDetailBiaya($TahunID, $MhswID, $pdf);
	BuatFooter($TahunID, $MhswID, $pdf);
}

$pdf->Output();

// *** functions ***
function BuatFooter($TahunID, $MhswID, $p) {
  $t = 5;
  $p->Ln(2*$t);
  
  $identitas = GetFields('identitas', 'Kode', KodeID, '*');
  $arr = array();
  $arr[] = array('', $identitas['Kota'].', '.date('d M Y'));
  $arr[] = array('Mengetahui,', 'Mahasiswa,');
  $arr[] = array('', '');
  $arr[] = array('', '');
  $arr[] = array('', '');
  $arr[] = array('', '');
  $arr[] = array('', '');
  $arr[] = array(GetaField('pejabat', "KodeJabatan='PUKET4' and KodeID", KodeID, 'Nama'), GetaField('mhsw', "MhswID='$MhswID' and KodeID", KodeID, 'Nama'));
  $arr[] = array('Biro Akademik', '');
  
  // Tampilkan
  $p->SetFont('Helvetica', '', 9);
  foreach ($arr as $a) {
    $p->Cell(10, $t, '', 0, 0);
	$p->Cell(50, $t, $a[0], 0, 0, 'C');
	$p->Cell(60, $t, '', 0, 0);
    $p->Cell(50, $t, $a[1], 0, 0, 'C');
	
	$p->Ln($t);
  }
  $p->Ln(2*$t);
  $t = 4;
  $p->SetFont('Helvetica', '', 7);
  $p->Cell(10, $t, '', 0, 0);
  $p->Cell(100, $t, 'NB:', 0, 1);
  $p->Cell(10, $t, '', 0, 0);
  $p->Cell(100, $t, 'Pembayaran ditransfer ke rekening', 0, 1);
  $rekening = GetFields('rekening', "Def='Y' and KodeID", KodeID, '*');
  $p->Cell(10, $t, '', 0, 0);
  $p->Cell(100, $t, 'An: '.$rekening['Nama'], 0, 1);
  $p->Cell(10, $t, '', 0, 0);
  $p->Cell(100, $t, 'No. Rekening: '.$rekening['RekeningID'], 0, 1);
  $p->Cell(10, $t, '', 0, 0);
  $p->Cell(100, $t, $rekening['Bank'], 0, 1);
  $p->Cell(10, $t, '', 0, 0);
  $p->Cell(100, $t, $rekening['Cabang'], 0, 1);
}

function TampilkanDetailBiaya($TahunID, $MhswID, $p) {
  global $arrID;
  $p->SetFont('Helvetica', '', 10);
  $t = 5;
  $p->Ln($t);
  $s = "select TambahanNama, Nama, TrxID, Jumlah, Besar, Dibayar from bipotmhsw where KodeID = '".KodeID."' and MhswID = '$MhswID' and TahunID = '$TahunID'";
  $q = _query($s);
  while($d = _fetch_array($q)){
  	$Tagihan = $d['TrxID']*$d['Jumlah']*$d['Besar'];
	$Dibayar = $d['Dibayar'];
	
	
	$TambahanNama = (empty($w['TambahanNama']))? "" : ' ('.$w['TambahanNama'].')';
	if($Tagihan!=$Dibayar){
		$Total += $d['Jumlah']*$d['Besar'];
		$p->Cell(100, $t, $d['Nama'].' '.$TambahanNama, 0, 0);
		$p->Cell(15, $t, number_format($d['Jumlah'], 0, ',', '.').' x', 0, 0, 'R');
		$p->Cell(28, $t, 'Rp. '.number_format($d['Besar'], 0, ',', '.'), 0, 0, 'R');
		$p->Cell(28, $t, 'Rp. '.number_format($Total, 0, ',', '.'), 0, 0, 'R');
		$p->Ln($t);
	}
  }
  $p->Ln(3);
  $t = 7;
  $p->SetFont('Helvetica', 'B', 12);
  $p->Cell(10, $t, '', 0, 0);
  $p->Cell(100, $t, 'Total yang harus dibayarkan:', 'LBT', 0, 'L');
  $p->Cell(70, $t, 'Rp. '.number_format($Total, 0, ',', '.'), 'BTR', 0, 'R');
  $p->Ln($t);
}

function BuatHeader($TahunID, $MhswID, $p) {
  $mhsw = GetFields('mhsw', "KodeID='".KodeID."' and MhswID", $MhswID, 'MhswID, Nama, ProdiID');
  
  $NamaTahun = GetaField('tahun', "KodeID='".KodeID."' and TahunID='$TahunID' and ProdiID",
				$mshw['ProdiID'], 'Nama');
  $t = 5; $lbr = 200;

  $arr = array();
  $arr[] = array('Program Studi', ':', GetaField('prodi', "ProdiID='$mhsw[ProdiID]' and KodeID", KodeID, 'Nama'));
  $arr[] = array('Jenjang', ':', GetaField('prodi p left outer join jenjang j on p.JenjangID=j.JenjangID', 
									"p.ProdiID='$mhsw[ProdiID]' and p.KodeID", KodeID, "concat(j.Nama, ' - ', j.Keterangan)"));
  $arr[] = array('Tahun', ':', $TahunID.' - '.GetaField('tahun', "TahunID='$TahunID' and KodeID", KodeID, 'Nama'));
  $arr[] = array('NPM', ':', $mhsw['MhswID']);
  $arr[] = array('Nama', ':', $mhsw['Nama'], 'IPS (Indeks Prestasi Sementara)', ':', GetaField('khs', "TahunID='$TahunID' and MhswID='$MhswID' and KodeID", KodeID, 'IPS'));
  // Tampilkan
  $p->SetFont('Helvetica', '', 9);
  foreach ($arr as $a) {
    $p->SetFont('Helvetica', 'I', 9);
    $p->Cell(30, $t, $a[0], 0, 0);
    $p->Cell(4, $t, $a[1], 0, 0, 'C');
    $p->SetFont('Helvetica', 'B', 9);
    $p->Cell(85, $t, $a[2], 0, 0);
	
	if(!empty($a[3]))
	{
		$p->SetFont('Helvetica', 'B', 9);
		$p->Cell(50, $t, $a[3], 'BLT', 0);
		$p->Cell(4, $t, $a[4], 'BT', 0, 'C');
		$p->SetFont('Helvetica', 'B', 9);
		$p->Cell(8, $t, $a[5], 'BRT', 0);
	}
	$p->Ln($t);
  }
  $p->Ln(4);
  $p->Cell(0, 0, '', 'T', 0);
}
function HeaderLogo($jdl, $p, $orientation='P')
{	$pjg = 110;
	$logo = (file_exists("../img/logo.jpg"))? "../img/logo.jpg" : "img/logo.jpg";
    $identitas = GetFields('identitas', 'Kode', KodeID, 'Nama, Alamat1, Telepon, Fax');
	$p->Image($logo, 12, 8, 18);
	$p->SetY(5);
    $p->SetFont("Helvetica", '', 8);
    $p->Cell($pjg, 5, $identitas['Yayasan'], 0, 1, 'C');
    $p->SetFont("Helvetica", 'B', 10);
    $p->Cell($pjg, 7, $identitas['Nama'], 0, 0, 'C');
    
	//Judul
	if($orientation == 'L')
	{
		$p->SetFont("Helvetica", 'B', 16);
		$p->Cell(20, 7, '', 0, 0);
		$p->Cell($pjg, 7, $jdl, 0, 1, 'C');
	}
	else
	{	$p->SetFont("Helvetica", 'B', 12);
		$p->Cell(80, 7, $jdl, 0, 1, 'C');
	}
	
    $p->SetFont("Helvetica", 'I', 6);
	$p->Cell($pjg, 3,
      $identitas['Alamat1'], 0, 1, 'C');
    $p->Cell($pjg, 3,
      "Telp. ".$identitas['Telepon'].", Fax. ".$identitas['Fax'], 0, 1, 'C');
    $p->Ln(3);
	if($orientation == 'L') $length = 275;
	else $length = 190;
    $p->Cell($length, 0, '', 1, 1);
    $p->Ln(2);
}
?>
