<?php 
function TampilkanLogin() {
  $col = 4;
  
  $s = "select * from level where (Accounting = 'N' and NA='N') AND (LevelID = '100' OR LevelID = '120') order by LevelID";
  $r = mysql_query($s) or die("Gagal: "+mysql_error());
  //echo "<table class=bsc cellspacing=1 cellpadding=4 align=center>";
  //echo "<tr>";
  $cnt = 0;
  
  /*
  while ($w = mysql_fetch_array($r)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
    }
    $cnt++;
    $simbol = (empty($w['Simbol']))? 'img/login.png' : $w['Simbol'];
    echo "<td class=bsc align=center valign=top width=100>
    <a href='?mnux=login&lgn=frm&lid=$w[LevelID]&nme=$w[Nama]' title='Login sebagai $w[Nama]'>
    <img src='$simbol' border=0><br>
    $w[Nama]</a></td>";
  }
  */
  
  ?>

<div class='isi'>
	<div id="content-outer">
<div id="content">
	<div id="page-heading">
		
	</div>
	<table border="0" width="50%" cellpadding="0" cellspacing="0" id="content-table" style="float:left">
	<tr>
		<td colspan='5'>
			<h1>Fasilitas Online</h1>
			<h2 style="font-size:13;" >
			<img src="img/daftar.png" alt="Smiley face" width='65' style='float:left;padding-right:15px;'><span style="font-size:16;">Pendaftaran Online</span></br>
			Informasi seputar pendaftaran Mahasiswa Baru : Pendaftaran, Tes, Pengumuman.
			</h2></br>
            <h2 style="font-size:13;" >
			<img src="img/siakad.png" alt="Smiley face" width='65' style='float:left;padding-right:15px;'><span style="font-size:16;">SIAKAD</span></br>
			Informasi seputar perkuliahan: KRS, KHS, Jadwal, dll.
			</h2>
		</td>
	</tr>
	
	</table>
	<div id="loginbox" style="float:right;margin-right:100px;">
	<div id="login-inner">
		<table border="0" cellpadding="0" cellspacing="0">
		<form name="form" action='?' method=POST>
		<input type=hidden name='mnux' value='loginprc' />
		<input type=hidden name='gos' value='cek' />
		<input type=hidden name='nme' value='<?php echo "admin"; ?>' />
		<input type=hidden name='institusi' value='<?php echo KodeID; ?>' />
		<input type=hidden name='KodeID' value='<?php echo KodeID; ?>' />
		<input type=hidden name='BypassMenu' value='1' />
		<tr>
			<th>Username</th>
			<td><input type='text' name='Login' class="login-inp" value='' size=10 maxlength=20></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type=password name='Password' class="login-inp" value='' size=10 maxlength=20></td>
		</tr>
		<tr>
			<th>Level</th>
			<td><select name="lid" class="login-inp" style="background-color:#7d7d7d;">
					<option value ='120' selected> Pilih Level</option>
			<?php  while ($w = mysql_fetch_array($r)) { ?>	
					<option value = "<?php echo $w['LevelID']; ?>"> <?php echo $w['Nama']; ?></option>
				<?php } ?>	
				</select></td>
		</tr>
		<tr>
			<th></th>
			<td valign="top">&nbsp;  </td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
			<input type='submit' name='Submit' class="submit-login" value='Login' style="float:left;background: url(img/login/submit_login.gif) no-repeat;border: none;cursor: pointer;display: block;color: #fff;height: 29px;width: 73px;"/>
			<input type='reset' name='Reset' class="submit-login" value='Reset' style="float:right; background: url(img/login/submit_login.gif) no-repeat;border: none;cursor: pointer;display: block;color: #fff;height: 29px;width: 73px;"/>
			</td>
		</tr>
		</form>
		</table>
	</div>					
</div>
	<div class="clear"></div>
 </div>
<div class="clear">&nbsp;</div>
</div>
  <?php
  //echo "</tr></table>";
}
function frm(){
  ResetLogin();
  global $arrID;
  $LabelLogin = ($_REQUEST['lid'] == 120)? "N.P.M" : "Kode Login";
  $CatatanCama = ($_REQUEST['lid'] == 33)? "Password default adalah tanggal lahir anda dengan format TTTT-BB-HH.<br>Contoh: Masukkan '1999-12-31' untuk tanggal lahir 31 Desember 1999" : "";
  //$institusi = GetOption2('identitas', 'Nama', 'Kode', $arrID['Kode'], '', 'Kode');
  $institusi = KodeID;
  $NamaInstitusi = GetaField('identitas', 'Kode', KodeID, 'Nama');
  $isifrm = "<table class=bsc cellspacing=0 cellpadding=4 width=100%>
  <form name='frmLogin' action='?' method=POST>
  <input type=hidden name='lid' value='$_REQUEST[lid]' />
  <input type=hidden name='mnux' value='loginprc' />
  <input type=hidden name='gos' value='cek' />
  <input type=hidden name='nme' value='$_REQUEST[nme]' />
  <input type=hidden name='institusi' value='$institusi' />
  <input type=hidden name='KodeID' value='".KodeID."' />
  <input type=hidden name='BypassMenu' value='1' />
  
  <tr><td class=inp>Institusi:</td>
      <td class=ul1 nowrap>$NamaInstitusi &nbsp;</td></tr>
  <tr><td class=inp>$LabelLogin:</td>
      <td class=ul1>
      <input type=text name='Login' value='' size=10 maxlength=20>
      </td></tr>
  <tr><td class=inp>Password:</td>
      <td class=ul1><input type=password name='Password' value='' size=10 maxlength=20>
					<br>$CatatanCama</td></tr>
  <tr><td class=ul1 colspan=3>
      <input type=submit name='Submit' value='Login' />
      <input type=reset name='Reset' value='Reset' />
      <input type=button name='Batal' value='Batal' onClick=\"location='?mnux='\" />
  </td></tr>
  </form></table>

  
  ";
  //<tr><td class=ul>Institusi</td><td class=ul><select name=institusi>$institusi</select></td></tr>
  echo Konfirmasi("Login: $_REQUEST[nme]", $isifrm);
}


// *** Main ***
$lgn = (!empty($_REQUEST['lgn']))? $_REQUEST['lgn'] : 'TampilkanLogin';
$lgn();

?>
