<?php
  // Sisfo Kampus versi 4
  // Author: SIAKAD TEAM
  // Email: setio.dewo@gmail.com
  // Start: Juli 2008
  session_start();
  include_once "dwo.lib.php";
  include_once "db.mysql.php";
  include_once "connectdb.php";
  include_once "parameter.php";
  include_once "cekparam.php";
  $mdlid = GetSetVar('mdlid');
  $loadTime = date('m d, Y H:i:s');
  
  function cekSession(){
  	$s = "select * from session where sessionId = '".$_SESSION['_Session']."' and user = '".$_SESSION['_Login']."'";
	$q = _query($s);
	$w = _fetch_array($q);
	if (mysql_num_rows($q) == 0){
		$s2 = "insert into session (sessionId,user,address,sessionTime) values ('".$_SESSION['_Session']."', '".$_SESSION['_Login']."', '".$_SERVER['REMOTE_ADDR']."', '".time()."')";
		$q2 = _query($s2);
	} else {
		$s2 = "update session set sessionTime = '".time()."' where sessionId = '".$w[sessionId]."'";
		$q2 = _query($s2);	
	}
	
  }
 ?>
 
<HTML xmlns="http://www.w3.org/1999/xhtml">
  <HEAD><TITLE><?php echo $_Institution; ?></TITLE>
  <META http-equiv="cache-control" content="max-age=0">
  <META http-equiv="pragma" content="no-cache">
  <META http-equiv="expires" content="0" />
  <META http-equiv="content-type" content="text/html; charset=UTF-8">
  
  <META content="SIAKAD TEAM" name="author" />
  <META content="Sisfo Kampus" name="description" />
  
  <link rel="stylesheet" type="text/css" href="themes/<?=$_Themes;?>/index.css" />
  <link rel="stylesheet" type="text/css" href="themes/<?=$_Themes;?>/ddcolortabs.css" />
  
	<link type="text/css" rel="stylesheet" media="all" href="chat/css/chat.css" />
	<link type="text/css" rel="stylesheet" media="all" href="chat/css/screen.css" />
	
	<!--[if lte IE 7]>
	<link type="text/css" rel="stylesheet" media="all" href="chat/css/screen_ie.css" />
	<style>
	.footer {
		clear: both;
		text-align: center;
		padding: 4px;
		background: transparent url(themes/default/img/bot_bg.jpg) repeat-x scroll;
		border-top: 1px solid #DDD;
		border-bottom: 1px solid #DDD;
		bottom:0px;
		position:absolute;
		width:100%;
	}
	.chatboxcontent {
		width:225px;
		padding:7px;
	}
	</style>
	<![endif]-->
	
	<script type="text/javascript" src="chat/js/jquery-1.2.6.min.js"></script>
  
  <script type="text/javascript" language="javascript" src="include/js/dropdowntabs.js"></script>
  <!-- <script type="text/javascript" language="javascript" src="include/js/jquery.js"></script> -->
  <script type="text/javascript" language="javascript" src="floatdiv.js"></script>
  <script type="text/javascript" language="javascript" src="include/js/drag.js"></script>
  <link rel="stylesheet" type="text/css" href="themes/<?=$_Themes;?>/drag.css" />
  
  <link href="fb/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="fb/facebox.js" language='javascript' type="text/javascript"></script>
  
  <script type="text/javascript" language="javascript" src="include/js/boxcenter.js"></script>
  <script type="text/javascript" language="javascript" src="clock.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox() ;
	  $("input[type=button]").attr("class","buttons");
	  $("input[type=submit]").attr("class","buttons");
	  $("input[type=reset]").attr("class","buttons");
    })
  </script>
  <!--<script type="text/javascript" language="javascript" src="include/js/jquery.autocomplete.js"></script>-->
  <!--<script type="text/javascript" language="javascript" src="include/js/jtip.js"></script>-->

  </HEAD>
<BODY onLoad="setClock('<?php print $loadTime ?>'); setInterval('updateClock()', 1000 )">

  <?php
    include "header.php";

    if (!empty($_SESSION['_Session'])) {
	
      $NamaLevel = GetaField('level', 'LevelID', $_SESSION['_LevelID'], 'Nama');

      if (!empty($_SESSION['mdlid'])) {
        $_strMDLID = GetaField('mdl', "MdlID", $_SESSION['mdlid'], "concat(MdlGrpID, ' &raquo; ', Nama)");
        echo "<div class=MenuDirectory>Menu: $_strMDLID</div>";
      }
      echo "<div class=NamaLogin>Login: <b>$_SESSION[_Nama]</b> ($NamaLevel) &raquo; <a href='?mnux=loginprc&gos=lout'>Logout</a></div>
			<div class=WaktuServer><b>Waktu server:</b> <span id='clock' title='".date('m d, Y H:i:s')."'>&nbsp;</span>&nbsp;</div>";
			echo '<script type="text/javascript" src="chat/js/chat.js"></script>';
			$_SESSION['username'] = $_SESSION[_Login]; // Must be already set
			$tombolChat = "<div id='onlineUser' onClick='javascript:openUser()'></div>";
			 cekSession();
      if (empty($_REQUEST['BypassMenu'])) include "menusis.php";
    } else {
		echo '<script>
			$("#userbox").css("display","none");
		</script>';
	}
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
		<form name="form" action='index.php?' method=POST>
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
					<option value ='1' selected> Pilih Level</option>
			<?php  
				$s = "select * from level where Accounting = 'N' and NA='N' order by LevelID";
				$r = mysql_query($s) or die("Gagal: "+mysql_error());
				while ($w = mysql_fetch_array($r)) { ?>	
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

    </div>
  
  <div class="bottomspace"></div>

  <div class='footer' style="text-align:left;padding-left:50px">
   &copy; 2013 Pusat Informasi dan Komputer
  <? echo $tombolChat ?>
  </div>
  
</BODY>
</HTML>