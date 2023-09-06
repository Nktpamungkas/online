<?php
//--
$act=$_POST['act'];

//-
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Masuk Keluar KK :: online system</title>
	<link rel="shortcut icon" href="images/dit.ico">
	<link rel="stylesheet" href="css/styles.css" type="text/css" />
	<link rel="stylesheet" href="css/main.css" type="text/css" />
</head>
<body>
	<div id="header">
		<div class="area">
			<div id="logo">			  <img src="images/logo.png" alt="LOGO" height="86" width="151" />			</div>
			<ul id="navigation">
				<li>
					<a href="index.html">Home</a>
				</li>
				<li>
					<a href="kk0.php">Posisi KK </a>				</li>
				<li class="selected">
					<a href="inoutkk-1.php">Scan In/Out </a>				</li>
				<li>
					<a href="rptscan.php">Report </a>				</li>
			</ul>
		</div>
	</div>
	<div id="contents">
	  
		<div class="area">
			<div class="area">
				<table width="110%" border="0">
                  <tr>
                    <td><?php
if (!$act){   
?></td>
                  </tr>
                  <tr>
                    <td><form id="form1" name="form1" method="post" action="?">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="normal9black">
                          <tr>
                            <td colspan="2" class="boldCD6">LAPORAN SCAN KARTU KERJA MASUK</td>
                          </tr>
                          
                          
                          <tr>
                            <td width="200" class="blod9black">&nbsp;</td>
                            <td class="normal9black"><input name="act" type="hidden" id="act" value="cari" /></td>
                          </tr>
                          
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black"><input name="opt" type="radio" value="per"> 
                              Per Departemen </td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black"><input name="opt" type="radio" value="antar"> 
                              Antar Departemen </td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
						  <tr>
                            <td class="blod9black"><input name="opt" type="radio" value="noOut"> 
                              KK Belum Keluar </td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black"><input name="opt" type="radio" value="Sisa"> 
                              Sisa KK di Department </td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black"><input name="opt" type="radio" value="rekap"> 
                              REKAP </td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black"><input name="button" type="submit" class="tombol" id="button" value="CARI DATA" /></td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                        </table>
                    </form></td>
                  </tr>
                  <tr>
                    <td class="normal9black"><?php
}else{   
	
	$opt=$_POST['opt'];
	
	if ($opt=="per"){
		echo "<meta http-equiv='refresh' content='0; url=inoutkk-0.php'>";
	}elseif ($opt=="antar"){
		echo "<meta http-equiv='refresh' content='0; url=inoutdep.php'>";
	}elseif ($opt=="noOut"){
		echo "<meta http-equiv='refresh' content='0; url=nooutdep.php'>";
	}elseif ($opt=="Sisa"){
		//echo "<meta http-equiv='refresh' content='0; url=sisakkdep.php'>"; //'--update 2015.04.16
		echo "<meta http-equiv='refresh' content='0; url=sisakk-0.php'>";
	}else{
		echo "<meta http-equiv='refresh' content='0; url=rptscanrekap.php'>";
	
	}
	
}?></td>
                  </tr>
                  <tr>
                    <td class="normal9black">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="normal9black"><p>&nbsp;</p></td>
                  </tr>
              </table>
				<div id="features">
				  <ul>
					<li></li>
					<li></li>
				  </ul>
			  </div>
			</div>
	  </div>
	</div>
	<div id="footer">
	  <div class="area">
			
			<p><a href="http://www.bintoro.my.id" target="_blank"><img src="images/logodit13.png" width="150" height="62" border="0"></a><br>
© 2013 - PT Indo Taichen Textile Industry </p>
	  </div>
</div>
</body>
</html>