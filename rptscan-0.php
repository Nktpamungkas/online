<?php

$host="10.0.0.4";
//$host="DIT\MSSQLSERVER08";
$username="sa";
$password="ditbin";
$db_name="TM";
//--
$act=$_POST['act'];
$subid=$_GET['subid'];

//---tanggal
$tanggal1=date("d");
$tanggal2=date("m");
$tanggal3=date("Y");
switch ($tanggal2)
{
case "01":
  $bulan="Jan";
  break;
case "02":
  $bulan="Feb";
  break;
case "03":
  $bulan="Mar";
  break;
case "04":
  $bulan="Apr";
  break;
case "05":
  $bulan="Mei";
  break;
case "06":
  $bulan="Jun";
  break;
case "07":
  $bulan="Jul";
  break;
case "08":
  $bulan="Agt";
  break;
case "09":
  $bulan="Sep";
  break;
case "10":
  $bulan="Okt";
  break;
case "11":
  $bulan="Nop";
  break;
case "12":
  $bulan="Des";
  break;
}
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
				<li>
					<a href="inoutkk-1.php">Scan In/Out </a>				</li>
				<li class="selected">
					<a href="rptscan.php">Report </a>				</li>
			</ul>
		</div>
	</div>
	<div id="contents">
	  
		<div class="area">
			<div class="area">
				<table width="100%" border="0">
                  <tr>
                    <td><?php
if (!$act){   
?></td>
                  </tr>
                  <tr>
                    <td><form id="form1" name="form1" method="post" action="?">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="normal9black">
                          <tr>
                            <td colspan="2" class="boldCD6">LAPORAN IMPLEMENTASI KARTU KERJA ONLINE </td>
                          </tr>
                          
                          
                          <tr>
                            <td width="200" class="blod9black">&nbsp;</td>
                            <td class="normal9black"><input name="act" type="hidden" id="act" value="cari" /></td>
                          </tr>
                          <tr>
                            <td class="blod9black">Departemen</td>
                            <td class="normal9black"><select name="dep0" class="normal9black" id="dep0" onChange="window.location='?subid='+this.value">
                              <?php
							 //--
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	//--
						  	if ($subid<>""){
								$sdep=mssql_query("select ID,ParentID,DepartmentName from Departments where ID = '$subid'");
								$rdep=mssql_fetch_assoc($sdep);
								
								echo "<option value='$rdep[ID]' selected>$rdep[DepartmentName]</option>";
								$sqldep=mssql_query("select ID,ParentID,DepartmentName from Departments where ParentID = '0' order by DepartmentName");
								while($rjenis=mssql_fetch_assoc($sqldep)){									
									echo "<option value=$rjenis[ID]>$rjenis[DepartmentName]</option>";
								}
							}else{
								echo "<option value='' selected></option>";
								$sqldep=mssql_query("select ID,ParentID,DepartmentName from Departments where ParentID = '0' order by DepartmentName");
								while($rjenis=mssql_fetch_assoc($sqldep)){									
									echo "<option value=$rjenis[ID]>$rjenis[DepartmentName]</option>";
								}
							}
								?>
                            </select></td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">Sub Dept </td>
                            <td class="normal9black"><select name="dep" class="normal9black" id="dep">
							 <?php
							 //--
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	//--
							if ($subid<>""){
								echo "<option value='' selected></option>";
								$sqldep=mssql_query("select ID,ParentID,DepartmentName from Departments where ParentID = '$subid' order by DepartmentName");
								while($rjenis=mssql_fetch_assoc($sqldep)){									
									echo "<option value=$rjenis[ID]>$rjenis[DepartmentName]</option>";
								}
							}/*else{
						  		echo "<option value='' selected></option>";
								$sqldep=mssql_query("select ID,ParentID,DepartmentName from Departments where ParentID <> '0' order by ParentID,ID");
								while($rjenis=mssql_fetch_assoc($sqldep)){									
									echo "<option value=$rjenis[ID]>$rjenis[DepartmentName]</option>";
								}
							}*/
								?>
                            </select></td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">Range Tanggal Buka KK </td>
                            <td class="normal9black"><select name="tgldateDel" class="normal9black" id="tgldateDel">
                                <option value="<?php echo $tanggal1 ; ?>" selected><?php echo $tanggal1 ; ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                              </select>
                              -
                              <select name="tglmonthDel" class="normal9black" id="tglmonthDel">
                                <option value="<?php echo $tanggal2; ?>" selected><?php echo $bulan; ?></option>
                                <option value="1">Jan</option>
                                <option value="2">Feb</option>
                                <option value="3">Mar</option>
                                <option value="4">Apr</option>
                                <option value="5">Mei</option>
                                <option value="6">Jun</option>
                                <option value="7">Jul</option>
                                <option value="8">Agt</option>
                                <option value="9">Sep</option>
                                <option value="10">Okt</option>
                                <option value="11">Nop</option>
                                <option value="12">Des</option>
                              </select>
                              -
                              <select name="tglyearDel" class="normal9black" id="tglyearDel">
                                <option value="<?php echo $tanggal3; ?>" selected><?php echo $tanggal3; ?></option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                              </select>
                              Sampai
                              <select name="tgldateDel2" class="normal9black" id="tgldateDel2">
                                <option value="<?php echo $tanggal1 ; ?>" selected><?php echo $tanggal1 ; ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                              </select>
                              -
                              <select name="tglmonthDel2" class="normal9black" id="tglmonthDel2">
                                <option value="<?php echo $tanggal2; ?>" selected><?php echo $bulan; ?></option>
                                <option value="1">Jan</option>
                                <option value="2">Feb</option>
                                <option value="3">Mar</option>
                                <option value="4">Apr</option>
                                <option value="5">Mei</option>
                                <option value="6">Jun</option>
                                <option value="7">Jul</option>
                                <option value="8">Agt</option>
                                <option value="9">Sep</option>
                                <option value="10">Okt</option>
                                <option value="11">Nop</option>
                                <option value="12">Des</option>
                              </select>
                              -
                              <select name="tglyearDel2" class="normal9black" id="tglyearDel2">
                                <option value="<?php echo $tanggal3; ?>" selected><?php echo $tanggal3; ?></option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                              </select></td>
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
}else if($act=="progres"){   
	echo "IN PROGRESS<br><br><br>";
	
	echo "<font class='blod9black'>Hasil Pencarian Departemen :  <br><br>Tanggal Buka Kartu Kerja :</font> - s.d. - <font class='blod9black'>( Total Kartu Kerja : - )<br><br>";

			
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	  echo "   <td class='tombol'><div align='center'>Departemen </div></td>";
       
	   echo "   <td class='tombol'><div align='center'>Jumlah Scan IN </div></td>";
          echo "<td class='tombol'><div align='center'>Persentase IN</div></td>";
		  echo "<td class='tombol'><div align='center'>Jumlah Scan Out</div></td>";
          echo "<td class='tombol'><div align='center'>Persentase Out </div></td>";
        // echo "<td class='tombol'><div align='center'>Warna</div></td>";
         //' echo "<td class='tombol'><div align='center'>Nett QTY </div></td>";
		// ' echo "<td class='tombol'><div align='center'>Bruto </div></td>";
        // ' echo "<td class='tombol'><div align='center'>Product Number </div></td>";
        // ' echo "<td class='tombol'><div align='center'>Product Description </div></td>";
		 //' echo "   <td class='tombol'><div align='center'>No Kartu Kerja </div></td>";
        echo "</tr>";
		echo"</table>";
}else{
	//--
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	//--

$nokk=trim(strip_tags($_POST['nokk']));
$nobo=trim(strip_tags($_POST['nobo']));

$tgldateDel=$_POST['tgldateDel']; $tglmonthDel=$_POST['tglmonthDel']; $tglyearDel=$_POST['tglyearDel'];
if ($tgldateDel<>"" && $tglmonthDel<>"" && $tglyearDel<>""){
	$tglDel="$tglyearDel-$tglmonthDel-$tgldateDel 00:00:00";
	$tglDisplay="$tgldateDel/$tglmonthDel/$tglyearDel";
}else{
	$tglDel="0000-00-00";
	$tglDisplay=" - ";
}

$tgldateDel2=$_POST['tgldateDel2']; $tglmonthDel2=$_POST['tglmonthDel2']; $tglyearDel2=$_POST['tglyearDel2'];
if ($tgldateDel2<>"" && $tglmonthDel2<>"" && $tglyearDel2<>""){
	$tglDel2="$tglyearDel2-$tglmonthDel2-$tgldateDel2 23:59:59";
	$tglDisplay2="$tgldateDel2/$tglmonthDel2/$tglyearDel2";
}else{
	$tglDel2="0000-00-00";
	$tglDisplay2="";
}

$dep=$_POST['dep'];
/* $sql0="select count(x.NoKK) as JumKK
from
(
	select pcb.DocumentNo as NoKK,pcb.Dated as TglKK from ProcessControlBatches pcb
	where pcb.Dated between '$tglDel' and '$tglDel2'
)x"; */

$sql0="select count(x.ID) as JumKK
from
(
	select * from PCCardPosition where Dated between '$tglDel' and '$tglDel2' and DepartmentID='35' and Status='1' --order by PCBID,Dated
)x"; 

$sql = mssql_query($sql0) 
    or die('A error occured : ');
 
$count = mssql_num_rows($sql);

			if ($count > 0 ){
			$row=mssql_fetch_assoc($sql);
			$jumlahKK=$row[JumKK];
			
			//---departemen
			$sqlDep0="select ID,ParentID,DepartmentName from Departments where ID='$dep'";			
			$sqlDep = mssql_query($sqlDep0) ;
			$rowDepA=mssql_fetch_assoc($sqlDep);
			$subDep=$rowDepA[DepartmentName]; $parID=$rowDepA[ParentID];
			
			$sqlDep1="select ID,ParentID,DepartmentName from Departments where ID='$parID'";			
			$sqlDepB = mssql_query($sqlDep1) ;
			$rowDepB=mssql_fetch_assoc($sqlDepB);
			$ParentDep=$rowDepB[DepartmentName];
			//--
			echo "<font class='blod9black'>Jumlah Buka Kartu Kerja tanggal $tglDisplay sampai $tglDisplay2 , Total : $jumlahKK</font><br><br>";
			echo "<font class='blod9black'>Scan Departemen : $ParentDep ($subDep)</font><br><br>";

			
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	  echo "   <td class='tombol'><div align='center'>Jumlah_Scan_IN</div></td>";
       echo "   <td class='tombol'><div align='center'>PERSENTASE IN</div></td>";
	    echo "   <td class='tombol'><div align='center'>Jumlah_Scan_OUT</div></td>";
       echo "   <td class='tombol'><div align='center'>PERSENTASE OUT</div></td>";
	  
	  //------------------------------------------count IN
	  $sqlc=mssql_query("select * from PCCardPosition where Dated between '$tglDel' and '$tglDel2' and DepartmentID='35' and Status='1' order by PCBID,Dated");

 
			$countc = mssql_num_rows($sqlc);
			
			if ($countc = 0 ){
							$jumRow=0;
							$jumRowO=0;
			}else{
						$jumRow=0; $jumRowO=0;
						
						 while ($rowJum=mssql_fetch_assoc($sqlc)){
						 $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
						 //--IN
							$sqlPC="select count(z.PCBID) as jKK
from
(
	select distinct(PCBID) from PCCardPosition where PCBID='$rowJum[PCBID]' and DepartmentID='$dep' and Status='1'
)z";
							
							$qrPC=mssql_query($sqlPC);
							$rowPC=mssql_fetch_assoc($qrPC);
							$jumRow=$jumRow + $rowPC[jKK];
						//--
						//----OUT
						$sqlPCO="select count(z.PCBID) as jKKO
from
(
	select distinct(PCBID) from PCCardPosition where PCBID='$rowJum[PCBID]' and DepartmentID='$dep' and Status='0'
)z";
							
							$qrPCO=mssql_query($sqlPCO);
							$rowPCO=mssql_fetch_assoc($qrPCO);
							$jumRowO=$jumRowO + $rowPCO[jKKO];
						//--
							
						}
			}
	  //--
		//--
		

	//---------------------------------------------
	
	
	
	//-----------------------------------------
		$c=0;	
		 $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 				
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td width='120' class='normal333'  valign=top>$jumRow</td>";
			//---hitung persen
				$persenIN=$jumRow/$jumlahKK * 100;
          echo "<td width='120' class='normal333' valign=top>" .number_format($persenIN,2). " %</td>";
		  echo "<td width='120' class='normal333'  valign=top>$jumRowO</td>";
			//---hitung persen
				$persenOUT=$jumRowO/$jumlahKK * 100;
          echo "<td width='120' class='normal333' valign=top>" .number_format($persenOUT,2). " %</td>";
        echo "</tr>";
		
     echo "</table>";

			}else{
				echo "<br><br><font class='normal9black'>Data TIDAK ditemukan !</font>";	
			}
	//--
	mssql_free_result($sql);
	mssql_close($conn);
	//--
//}
//--

//--
}
?></td>
                  </tr>
                  <tr>
                    <td class="normal9black">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="normal9black"><p>&nbsp;</p></td>
                  </tr>
              </table>
				<h2>&nbsp;</h2>
				<div id="features">
				  <ul>
					<li></li>
					<li></li>
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