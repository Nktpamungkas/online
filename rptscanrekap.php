<?php
ini_set("error_reporting", 1);
include "koneksi.php";
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
$dep0=trim(strip_tags($_POST['dep0']));
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Rekap Masuk Keluar KK :: online system</title>
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
                            <td colspan="2" class="boldCD6">LAPORAN REKAPITULASI IMPLEMENTASI KARTU KERJA ONLINE </td>
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
                            <td class="blod9black">Range Tanggal Scan IN KK </td>
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
								<option value="2022">2022</option>  
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
								<option value="2022">2022</option>  
                              </select></td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">Departemen</td>
                            <td class="normal9black"><select name="dep0" class="normal9black" id="dep0">
                              <?php
							 //--
//ini_set('default_socket_timeout',   1);
//ini_set('sqlsrv.connect_timeout',    1);
//ini_set('sqlsrv.timeout',            600);
set_time_limit(600);
	//$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//sqlsrv_select_db($db_name) or die ("Under maintenance");
	//--
						  	if ($subid<>""){
								$sdep=sqlsrv_query($conn,"select ID,ParentID,DepartmentName from Departments where ID = '$subid'", array(), array("Scrollable"=>"buffered"));
								$rdep=sqlsrv_fetch_array($sdep,SQLSRV_FETCH_ASSOC);
								
								echo "<option value='".$rdep['ID']."' selected>".$rdep['DepartmentName']."</option>";
								$sqldep=sqlsrv_query($conn,"select ID,ParentID,DepartmentCode,DepartmentName from Departments 
where DepartmentName not like '%PRT' and (DepartmentCode < 12 and ParentID=0) or ID=39 or ID=43 
order by DepartmentName", array(), array("Scrollable"=>"buffered"));
								while($rjenis=sqlsrv_fetch_array($sqldep,SQLSRV_FETCH_ASSOC)){									
									echo "<option value=".$rjenis['ID'].">".$rjenis['DepartmentName']."</option>";
								}
							}else{
								echo "<option value='' selected></option>";
								$sqldep=sqlsrv_query($conn,"select ID,ParentID,DepartmentCode,DepartmentName from Departments 
where DepartmentName not like '%PRT' and (DepartmentCode < 12 and ParentID=0) or ID=39 or ID=43 
order by DepartmentName", array(), array("Scrollable"=>"buffered"));
								while($rjenis=sqlsrv_fetch_array($sqldep,SQLSRV_FETCH_ASSOC)){									
									echo "<option value=".$rjenis['ID'].">".$rjenis['DepartmentName']."</option>";
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
//--
//--
//ini_set('default_socket_timeout',   1);
//ini_set('sqlsrv.connect_timeout',    1);
//ini_set('sqlsrv.timeout',            600);
set_time_limit(600);
	//$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//sqlsrv_select_db($db_name) or die ("Under maintenance");
	//--


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
//--
if ($dep0==""){
	
//---cek sub dep
	$sqlsub=sqlsrv_query($conn,"select ID,ParentID,DepartmentCode,DepartmentName from Departments 
where DepartmentName not like '%PRT' and (DepartmentCode < 12 and ParentID=0) or ID=39 or ID=43 
order by DepartmentName", array(), array("Scrollable"=>"buffered"));

		echo "<font class='blod9black'>Rekap Scan IN Kartu Kerja tanggal : $tglDisplay - $tglDisplay2 </font><br><br>";
			
			
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	   echo "   <td class='tombol'><div align='center'>Department</div></td>";
	  echo "   <td class='tombol'><div align='center'>Total KK IN</div></td>";
	  echo "   <td class='tombol'><div align='center'>< 1 Hari</div></td>";
       echo "   <td class='tombol'><div align='center'>1-2 Hari</div></td>";
	    echo "   <td class='tombol'><div align='center'>2-3 Hari</div></td>";
       echo "   <td class='tombol'><div align='center'>3-4 Hari</div></td>";
	   echo "   <td class='tombol'><div align='center'>4-5 Hari</div></td>";
	   echo "   <td class='tombol'><div align='center'>5-6 Hari</div></td>";
	   echo "   <td class='tombol'><div align='center'>6-7 Hari</div></td>";	   
	   echo "   <td class='tombol'><div align='center'>> 1 Minggu</div></td>";
	   echo "   <td class='tombol'><div align='center'>> 2 Hari</div></td>";
$TKK=0;
$thit0=0; $thit1=0; $thit2=0; $thit3=0; $thit4=0; $thit5=0; $thit6=0; $thit7=0; $hit2h=0;
	$c=0;	
 while ($rowSub=sqlsrv_fetch_array($sqlsub,SQLSRV_FETCH_ASSOC)){
	$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';	
	
	
	switch ($rowSub['ID'])
	{
		case 4 :
			$depID=19;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='57' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 24 :
			$depID=28;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='19' or z.DepartmentID='57' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 2 :
			$depID=57;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 58 :
			$depID=59;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='57' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 62 :
			$depID=63;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='57' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 1 :
			$depID=66;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='57'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 23 :
			$depID=67;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='57' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 49 :
			$depID=68;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='57' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43' or z.DepartmentID='60'"; //---60 > KK Oke
			break;
			
		case 69 :
			$depID=70;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='57' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 39 :
			$depID=39;
			$dep0=34;
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='57' or z.DepartmentID='43'";
			break;
		case 43 :
			$depID=43;
			$dep0=34;
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='57' or z.DepartmentID='39'";
			break;
	
	}
		 
	
		//--cari total per dept
		$sqlT1="select count(zz.PCBID) as Jum from
(
select distinct(z.PCBID) from
(
	select x.* from
	(
	select Dated,PCBID,Status,DepartmentID from PCCardPosition 
	where Dated between '$tglDel' and '$tglDel2' and Status='1' and DepartmentID='$depID'
	) x	
)z
)zz";
$qryT1 = sqlsrv_query($conn,$sqlT1, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured : ');
	
	$rowT1=sqlsrv_fetch_array($qryT1);
		
		//--end cari total
	 
	
		
		 //$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 				
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td width='120' class='normal333'  valign=center>&nbsp;&nbsp;".$rowSub['DepartmentName']."</td>";
		//echo "<td width='120' class='normal333'  valign=top></td>";
		$TKK=$TKK+$rowT1[0];
		echo "<td width='120' class='normal333'  valign=center align=right height=30>".$rowT1[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
//------------------------------------------------------------------------------!
$sqlpcb="select distinct(z.PCBID) from
(
	select x.* from
	(
	select Dated,PCBID,Status,DepartmentID from PCCardPosition 
	where Dated between '$tglDel' and '$tglDel2' and Status='1' and DepartmentID='$depID'
	) x	
)z";
	
$qrypcb=sqlsrv_query($conn,$sqlpcb, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured : pcbid list');

$countpcb=sqlsrv_num_rows($qrypcb);

if ($countpcb > 0 ){

$hit0=0; $hit1=0; $hit2=0; $hit3=0; $hit4=0; $hit5=0; $hit6=0; $hit7=0; $hit2h=0;

	while($rowpcb=sqlsrv_fetch_array($qrypcb,SQLSRV_FETCH_ASSOC)){
	//--IN
		$sqlkk=sqlsrv_query($conn,"select top 1 z.* from
		(
		select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
		where x.Dated between '$tglDel' and '$tglDel2' and x.Status='1' and PCBID='".$rowpcb['PCBID']."'
		) z
		where z.ParentID='$dep0' and z.DepartmentID='$depID'
		order by z.DepartmentName,z.Dated", array(), array("Scrollable"=>"buffered")); 
		
		$rowkk=sqlsrv_fetch_array($sqlkk,SQLSRV_FETCH_ASSOC);
											 
						$sqlkk2=sqlsrv_query($conn,"select top 1 ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition where ID='".$rowkk['ID']."' and DepartmentID='$depID' order by Dated", array(), array("Scrollable"=>"buffered"));
						$rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);						
						//$tglINakhir=$rowkk2[Dated];
						$pecah1 = explode("/", $rowkk2['TglIn']);
						$date1 = $pecah1[0];
						$month1 = $pecah1[1];
						$year1 = $pecah1[2];
	
	//--OUT
if ($dep0=='49'){
		$sqlkkO=sqlsrv_query($conn,"select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.Status='1' and PCBID='".$rowpcb['PCBID']."' and x.Dated >= '".$rowkk2['Dated']."'
) z
where $depor
order by z.Dated", array(), array("Scrollable"=>"buffered"));
}else{
		$sqlkkO=sqlsrv_query($conn,"select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.Status='1' and PCBID='".$rowpcb['PCBID']."' and x.Dated >= '".$rowkk2['Dated']."'
) z
where z.ParentID<>'$dep0' and ($depor)
order by z.Dated", array(), array("Scrollable"=>"buffered"));
}

		 $rowkkO=sqlsrv_fetch_array($sqlkkO,SQLSRV_FETCH_ASSOC);
		 
		 $sqlkk2b=sqlsrv_query($conn,"select top 1 pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition pcpos 
			left join
			Departments dep on pcpos.CounterDepartmentID  = dep.ID
			where pcpos.ID='".$rowkkO['ID']."' and pcpos.DepartmentID='".$rowkkO['DepartmentID']."' order by Dated desc", array(), array("Scrollable"=>"buffered"));
			$countOut=sqlsrv_num_rows($sqlkk2b);
					  $rowkk2b=sqlsrv_fetch_array($sqlkk2b,SQLSRV_FETCH_ASSOC);
					  
					  
					$pecah2 = explode("/", $rowkk2b['TglIn']);
					$date2 = $pecah2[0];
					$month2 = $pecah2[1];
					$year2 = $pecah2[2];
					$jd1 = GregorianToJD($month1,$date1, $year1);
					$jd2 = GregorianToJD($month2,$date2,$year2);
						$selisih=$jd2 - $jd1;
						$selisih=abs($selisih);
						$time=round((strtotime($rowkk2b['Dated']) - strtotime($rowkk2['Dated']))/3600,1);
			
			//--mulai hitunng
			//if (($selisih > 0) || ($selisih < 1)){
			if($selisih > 0){ //tgl berbeda
			
				 if ($time > 0){
			  		$time2=round($time/24,1);
						
					  if ($time2 < 1){
						$hit0=$hit0+1;
					  }	
					 
					  if(($time2 >= 1) && ($time2 < 2)){
					  	$hit1=$hit1 + 1;
					  }
					  
					  if(($time2 >= 2) && ($time2 < 3)){
					  	$hit2=$hit2 + 1;
					  }
					  
					  if(($time2 >= 3) && ($time2 < 4)){
					  	$hit3=$hit3 + 1;
					  }
					  
					  if(($time2 >= 4) && ($time2 < 5)){
					  	$hit4=$hit4 + 1;
					  }
					  
					  if(($time2 >= 5) && ($time2 < 6)){
					  	$hit5=$hit5 + 1;
					  }
					  
					  if(($time2 >= 6) && ($time2 <= 7)){
					  	$hit6=$hit6 + 1;
					  }
					  
					  if($time2 > 7){
					  	$hit7=$hit7 + 1;
					  }
					  
					   if($time2 > 2){
					  	$hit2h=$hit2h + 1;
					  }
					  
				 }else{ //--belum out
				  $timenow=date("Y-m-d H:i:s");
				  $timelos=round((strtotime($timenow) - strtotime($rowkk2['Dated']))/3600,1);
				  $timelos=abs($timelos);
				  $time2los=round($timelos/24,1);
				 		
					  if ($time2los < 1){
						$hit0=$hit0+1;
					  }
					  
					  if(($time2los >= 1) && ($time2los < 2)){
					  	$hit1=$hit1 + 1;
					  }
					  
					  if(($time2los >= 2) && ($time2los < 3)){
					  	$hit2=$hit2 + 1;
					  }
					  
					  if(($time2los >= 3) && ($time2los < 4)){
					  	$hit3=$hit3 + 1;
					  }
					  
					  if(($time2los >= 4) && ($time2los < 5)){
					  	$hit4=$hit4 + 1;
					  }
					  
					  if(($time2los >= 5) && ($time2los < 6)){
					  	$hit5=$hit5 + 1;
					  }
					  
					  if(($time2los >= 6) && ($time2los <= 7)){
					  	$hit6=$hit6 + 1;
					  }
					  
					  if($time2los > 7){
					  	$hit7=$hit7 + 1;
					  }
					  
					  if($time2los > 2){
					  	$hit2h=$hit2h + 1;
					  }
					  //--
				 }
			}else{
				$hit0=$hit0+1;
			}
			
			
			//--hitung		
	
	$perhit0=$hit0/$rowT1[0] * 100;		
	$showperhit0="/ ".number_format($perhit0,1)."%";
	
	$perhit1=$hit1/$rowT1[0] * 100;		
	$showperhit1="/ ".number_format($perhit1,1)."%";
	
	$perhit2=$hit2/$rowT1[0] * 100;		
	$showperhit2="/ ".number_format($perhit2,1)."%";
	
	$perhit3=$hit3/$rowT1[0] * 100;		
	$showperhit3="/ ".number_format($perhit3,1)."%";
	
	$perhit4=$hit4/$rowT1[0] * 100;		
	$showperhit4="/ ".number_format($perhit4,1)."%";
	
	$perhit5=$hit5/$rowT1[0] * 100;		
	$showperhit5="/ ".number_format($perhit5,1)."%";
	
	$perhit6=$hit6/$rowT1[0] * 100;		
	$showperhit6="/ ".number_format($perhit6,1)."%";
	
	$perhit7=$hit7/$rowT1[0] * 100;		
	$showperhit7="/ ".number_format($perhit7,1)."%";
	
	$perhit2h=$hit2h/$rowT1[0] * 100;		
	$showperhit2h="/ ".number_format($perhit2h,1)."%";
				  
	} //end while pcb
}else{ //--countpcb=0
$showperhit0=""; $showperhit1=""; $showperhit2=""; $showperhit3=""; $showperhit4=""; $showperhit5=""; $showperhit6=""; $showperhit7=""; $showperhit2h="";
$hit0="-"; $hit1="-"; $hit2="-"; $hit3="-"; $hit4="-"; $hit5="-"; $hit6="-"; $hit7="-"; $hit2h="-";

}
//------------------------------------------------------------------------------!!		
		$thit0=$thit0+$hit0; $thit1=$thit1+$hit1; $thit2=$thit2+$hit2; $thit3=$thit3+$hit3;
		$thit4=$thit4+$hit4; $thit5=$thit5+$hit5; $thit6=$thit6+$hit6; $thit7=$thit7+$hit7; $thit2h=$thit2h+$hit2h;
		//--dibawah 1 hari
		echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong>$hit0</strong> $showperhit0</td>";
		
		//--1 hari dibawah 2 hari atau 48 jam
		
		
        echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong>$hit1</strong> $showperhit1</td>";
		//--end 1 hari
		
	    echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong>$hit2</strong> $showperhit2</td>";
        echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong>$hit3</strong> $showperhit3</td>";
	   echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong>$hit4</strong> $showperhit4</td>";
	   echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong>$hit5</strong> $showperhit5</td>";
	   echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong>$hit6</strong> $showperhit6</td>";	    
       	   echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong><a href='scDetail.php?td=$tgldateDel&tm=$tglmonthDel&ty=$tglyearDel&td2=$tgldateDel2&tm2=$tglmonthDel2&ty2=$tglyearDel2&dep0=$dep0&dep=$depID&num=7'>$hit7</strong> $showperhit7 </a></td>";
		   
		   echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong><a href='scDetail.php?td=$tgldateDel&tm=$tglmonthDel&ty=$tglyearDel&td2=$tgldateDel2&tm2=$tglmonthDel2&ty2=$tglyearDel2&dep0=$dep0&dep=$depID&num=21'>$hit2h</strong> $showperhit2h </a></td>";
        echo "</tr>";
	}	
	 echo "<tr><td class='tombol'>Total : </td>";
	echo "<td width='120' class='tombol'  valign=center align=right height=25>$TKK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
	//--
	$perthit0=$thit0/$TKK * 100;		
	$showperthit0="/ ".number_format($perthit0,1)."%";
	
	$perthit1=$thit1/$TKK * 100;		
	$showperthit1="/ ".number_format($perthit1,1)."%";
	
	$perthit2=$thit2/$TKK * 100;		
	$showperthit2="/ ".number_format($perthit2,1)."%";
	
	$perthit3=$thit3/$TKK * 100;		
	$showperthit3="/ ".number_format($perthit3,1)."%";
	
	$perthit4=$thit4/$TKK * 100;		
	$showperthit4="/ ".number_format($perthit4,1)."%";
	
	$perthit5=$thit5/$TKK * 100;		
	$showperthit5="/ ".number_format($perthit5,1)."%";
	
	$perthit6=$thit6/$TKK * 100;		
	$showperthit6="/ ".number_format($perthit6,1)."%";
	
	$perthit7=$thit7/$TKK * 100;		
	$showperthit7="/ ".number_format($perthit7,1)."%";
	
	$perthit2h=$thit2h/$TKK * 100;		
	$showperthit2h="/ ".number_format($perthit2h,1)."%";
	//--
	echo "<td width='120' class='tombol'  valign=center align=left>&nbsp;$thit0 $showperthit0</td>";
	echo "<td width='120' class='tombol'  valign=center align=left>&nbsp;$thit1 $showperthit1</td>";
	echo "<td width='120' class='tombol'  valign=center align=left>&nbsp;$thit2 $showperthit2</td>";
        echo "<td width='120' class='tombol'  valign=center align=left>&nbsp;$thit3 $showperthit3</td>";
	   echo "<td width='120' class='tombol'  valign=center align=left>&nbsp;$thit4 $showperthit4</td>";
	   echo "<td width='120' class='tombol'  valign=center align=left>&nbsp;$thit5 $showperthit5</td>";
	   echo "<td width='120' class='tombol'  valign=center align=left>&nbsp;$thit6 $showperthit6</td>";	    
	   echo "<td width='120'class='tombol'  valign=center align=left>&nbsp;$thit7 $showperthit7</td>";
	   echo "<td width='120'class='tombol'  valign=center align=left>&nbsp;$thit2h $showperthit2h</td>";
	 echo  "</tr>";
     echo "</table>";



//}else{
//	echo "<br><br><font class='normal9black'>Data TIDAK ditemukan !</font>";	
//}
	//--


	//sqlsrv_free_result($sql);
	//sqlsrv_close($conn);
	//--
//}
//--
}else{ //---dep0 <> ""
	
	//echo "Progress";
		//--
	//--cek dep
					$sqlDep1="select ID,ParentID,DepartmentName from Departments where ID='$dep0'";			
					$sqlDepB = sqlsrv_query($conn,$sqlDep1, array(), array("Scrollable"=>"buffered")) ;
					$rowDepB=sqlsrv_fetch_array($sqlDepB,SQLSRV_FETCH_ASSOC);
					$ParentDep=$rowDepB['DepartmentName'];
//---cek sub dep
	/* $sqlsub=sqlsrv_query("select ID,ParentID,DepartmentCode,DepartmentName from Departments 
where DepartmentName not like '%PRT' and (DepartmentCode < 12 and ParentID=0) or ID=39 or ID=43 
order by DepartmentName"); */
$sqlsub=sqlsrv_query($conn,"select top 1 ID,ParentID,DepartmentCode,DepartmentName from Departments 
where ID=$dep0", array(), array("Scrollable"=>"buffered"));

		echo "<font class='blod9black'>Rekap Scan IN Kartu Kerja tanggal : $tglDisplay - $tglDisplay2 </font><br><br>";
			
			
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	   echo "   <td class='tombol'><div align='center'>Department</div></td>";
	  echo "   <td class='tombol'><div align='center'>Total KK IN</div></td>";
	  echo "   <td class='tombol'><div align='center'>< 1 Hari</div></td>";
       echo "   <td class='tombol'><div align='center'>1-2 Hari</div></td>";
	    echo "   <td class='tombol'><div align='center'>2-3 Hari</div></td>";
       echo "   <td class='tombol'><div align='center'>3-4 Hari</div></td>";
	   echo "   <td class='tombol'><div align='center'>4-5 Hari</div></td>";
	   echo "   <td class='tombol'><div align='center'>5-6 Hari</div></td>";
	   echo "   <td class='tombol'><div align='center'>6-7 Hari</div></td>";
	   echo "   <td class='tombol'><div align='center'>> 1 Minggu</div></td>";
	   echo "   <td class='tombol'><div align='center'>> 2 Hari</div></td>";
$TKK=0;
$thit0=0; $thit1=0; $thit2=0; $thit3=0; $thit4=0; $thit5=0; $thit6=0; $thit7=0; $hit2h=0;
	$c=0;	
 while ($rowSub=sqlsrv_fetch_array($sqlsub,SQLSRV_FETCH_ASSOC)){
	$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';	
	
	
	switch ($rowSub['ID'])
	{
		case 4 :
			$depID=19;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='57' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 24 :
			$depID=28;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='19' or z.DepartmentID='57' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 2 :
			$depID=57;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 58 :
			$depID=59;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='57' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 62 :
			$depID=63;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='57' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 1 :
			$depID=66;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='57'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 23 :
			$depID=67;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='57' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 49 :
			$depID=68;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='57' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43' or z.DepartmentID='60'"; //60 --KK Oke
			break;
			
		case 69 :
			$depID=70;
			$dep0=$rowSub['ID'];
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='57' or z.DepartmentID='39' or z.DepartmentID='43'";
			break;
			
		case 39 :
			$depID=39;
			$dep0=34;
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='57' or z.DepartmentID='43'";
			break;
		case 43 :
			$depID=43;
			$dep0=34;
			$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='57' or z.DepartmentID='39'";
			break;
	
	}
		 
	
		//--cari total per dept
		$sqlT1="select count(zz.PCBID) as Jum from
(
select distinct(z.PCBID) from
(
	select x.* from
	(
	select Dated,PCBID,Status,DepartmentID from PCCardPosition 
	where Dated between '$tglDel' and '$tglDel2' and Status='1' and DepartmentID='$depID'
	) x	
)z
)zz";
$qryT1 = sqlsrv_query($conn,$sqlT1, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured : ');
	
	$rowT1=sqlsrv_fetch_array($qryT1);
		
		//--end cari total
	 
	
		
		 //$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 				
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td width='120' class='normal333'  valign=center>&nbsp;&nbsp;$ParentDep</td>";
		//echo "<td width='120' class='normal333'  valign=top></td>";
		$TKK=$TKK+$rowT1[0];
		echo "<td width='120' class='normal333'  valign=center align=right height=30>".$rowT1[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
//------------------------------------------------------------------------------!
$sqlpcb="select distinct(z.PCBID) from
(
	select x.* from
	(
	select Dated,PCBID,Status,DepartmentID from PCCardPosition 
	where Dated between '$tglDel' and '$tglDel2' and Status='1' and DepartmentID='$depID'
	) x	
)z";
	
$qrypcb=sqlsrv_query($conn,$sqlpcb, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured : pcbid list');

$countpcb=sqlsrv_num_rows($qrypcb);

if ($countpcb > 0 ){

$hit0=0; $hit1=0; $hit2=0; $hit3=0; $hit4=0; $hit5=0; $hit6=0; $hit7=0; $hit2h=0;

	while($rowpcb=sqlsrv_fetch_array($qrypcb,SQLSRV_FETCH_ASSOC)){
	//--IN
		$sqlkk=sqlsrv_query($conn,"select top 1 z.* from
		(
		select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
		where x.Dated between '$tglDel' and '$tglDel2' and x.Status='1' and PCBID='".$rowpcb['PCBID']."'
		) z
		where z.ParentID='$dep0' and z.DepartmentID='$depID'
		order by z.DepartmentName,z.Dated", array(), array("Scrollable"=>"buffered")); 
		
		$rowkk=sqlsrv_fetch_array($sqlkk,SQLSRV_FETCH_ASSOC);
											 
						$sqlkk2=sqlsrv_query($conn,"select top 1 ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition where ID='".$rowkk['ID']."' and DepartmentID='$depID' order by Dated", array(), array("Scrollable"=>"buffered"));
						$rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);	
						$tglrowkk2=$rowkk2['Dated']->format('Y-m-d H:i:s');
						//$tglINakhir=$rowkk2[Dated];
						$pecah1 = explode("/", $rowkk2['TglIn']);
						$date1 = $pecah1[0];
						$month1 = $pecah1[1];
						$year1 = $pecah1[2];
	
	//--OUT
if ($dep0=='49'){
		$sqlkkO=sqlsrv_query($conn,"select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.Status='1' and PCBID='".$rowpcb['PCBID']."' and x.Dated >= '$tglrowkk2'
) z
where $depor
order by z.Dated", array(), array("Scrollable"=>"buffered"));
}else{
		$sqlkkO=sqlsrv_query($conn,"select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.Status='1' and PCBID='".$rowpcb['PCBID']."' and x.Dated >= '$tglrowkk2'
) z
where z.ParentID<>'$dep0' and ($depor)
order by z.Dated", array(), array("Scrollable"=>"buffered"));
}

		 $rowkkO=sqlsrv_fetch_array($sqlkkO,SQLSRV_FETCH_ASSOC);
		 
		 $sqlkk2b=sqlsrv_query($conn,"select top 1 pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition pcpos 
			left join
			Departments dep on pcpos.CounterDepartmentID  = dep.ID
			where pcpos.ID='".$rowkkO['ID']."' and pcpos.DepartmentID='".$rowkkO['DepartmentID']."' order by Dated desc", array(), array("Scrollable"=>"buffered"));
			$countOut=sqlsrv_num_rows($sqlkk2b);
					  $rowkk2b=sqlsrv_fetch_array($sqlkk2b,SQLSRV_FETCH_ASSOC);
					  
					  
					if($rowkk2b['TglIn']!=""){$pecah2 = explode("/", $rowkk2b['TglIn']);
					$date2 = $pecah2[0];
					$month2 = $pecah2[1];
					$year2 = $pecah2[2];}
					$jd1 = GregorianToJD($month1,$date1, $year1);
					$jd2 = GregorianToJD($month2,$date2,$year2);
						$selisih=$jd2 - $jd1;
						$selisih=abs($selisih);
						if($rowkk2['Dated']!=""){$tgl1		= $rowkk2['Dated']->format('Y-m-d H:i:s');}
						if($rowkk2b['Dated']!=""){$tgl2		= $rowkk2b['Dated']->format('Y-m-d H:i:s');}
						$time=round((strtotime($tgl2) - strtotime($tgl1))/3600,1);
			
			//--mulai hitunng
			//if (($selisih > 0) || ($selisih < 1)){
			if($selisih > 0){ //tgl berbeda
			
				 if ($time > 0){
			  		$time2=round($time/24,1);
						
					  if ($time2 < 1){
						$hit0=$hit0+1;
					  }	
					 
					  if(($time2 >= 1) && ($time2 < 2)){
					  	$hit1=$hit1 + 1;
					  }
					  
					  if(($time2 >= 2) && ($time2 < 3)){
					  	$hit2=$hit2 + 1;
					  }
					  
					  if(($time2 >= 3) && ($time2 < 4)){
					  	$hit3=$hit3 + 1;
					  }
					  
					  if(($time2 >= 4) && ($time2 < 5)){
					  	$hit4=$hit4 + 1;
					  }
					  
					  if(($time2 >= 5) && ($time2 < 6)){
					  	$hit5=$hit5 + 1;
					  }
					  
					  if(($time2 >= 6) && ($time2 <= 7)){
					  	$hit6=$hit6 + 1;
					  }
					  
					  if($time2 > 7){
					  	$hit7=$hit7 + 1;
					  }
					  
					  if($time2 > 2){
					  	$hit2h=$hit2h + 1;
					  }
					  
				 }else{ //--belum out
				  $timenow=date("Y-m-d H:i:s");
				  $timelos=round((strtotime($timenow) - strtotime($rowkk2['Dated']))/3600,1);
				  $timelos=abs($timelos);
				  $time2los=round($timelos/24,1);
				 		
					  if ($time2los < 1){
						$hit0=$hit0+1;
					  }
					  
					  if(($time2los >= 1) && ($time2los < 2)){
					  	$hit1=$hit1 + 1;
					  }
					  
					  if(($time2los >= 2) && ($time2los < 3)){
					  	$hit2=$hit2 + 1;
					  }
					  
					  if(($time2los >= 3) && ($time2los < 4)){
					  	$hit3=$hit3 + 1;
					  }
					  
					  if(($time2los >= 4) && ($time2los < 5)){
					  	$hit4=$hit4 + 1;
					  }
					  
					  if(($time2los >= 5) && ($time2los < 6)){
					  	$hit5=$hit5 + 1;
					  }
					  
					  if(($time2los >= 6) && ($time2los <= 7)){
					  	$hit6=$hit6 + 1;
					  }
					  
					  if($time2los > 7){
					  	$hit7=$hit7 + 1;
					  }
					  
					  if($time2los > 2){
					  	$hit2h=$hit2h + 1;
					  }
					  //--
				 }
			}else{
				$hit0=$hit0+1;
			}
			
			
			//--hitung		
	
	$perhit0=$hit0/$rowT1[0] * 100;		
	$showperhit0="/ ".number_format($perhit0,1)."%";
	
	$perhit1=$hit1/$rowT1[0] * 100;		
	$showperhit1="/ ".number_format($perhit1,1)."%";
	
	$perhit2=$hit2/$rowT1[0] * 100;		
	$showperhit2="/ ".number_format($perhit2,1)."%";
	
	$perhit3=$hit3/$rowT1[0] * 100;		
	$showperhit3="/ ".number_format($perhit3,1)."%";
	
	$perhit4=$hit4/$rowT1[0] * 100;		
	$showperhit4="/ ".number_format($perhit4,1)."%";
	
	$perhit5=$hit5/$rowT1[0] * 100;		
	$showperhit5="/ ".number_format($perhit5,1)."%";
	
	$perhit6=$hit6/$rowT1[0] * 100;		
	$showperhit6="/ ".number_format($perhit6,1)."%";
	
	$perhit7=$hit7/$rowT1[0] * 100;		
	$showperhit7="/ ".number_format($perhit7,1)."%";
	
	$perhit2h=$hit2h/$rowT1[0] * 100;		
	$showperhit2h="/ ".number_format($perhit2h,1)."%";
				  
	} //end while pcb
}else{ //--countpcb=0
$showperhit0=""; $showperhit1=""; $showperhit2=""; $showperhit3=""; $showperhit4=""; $showperhit5=""; $showperhit6=""; $showperhit7=""; $showperhit2h="";
$hit0="-"; $hit1="-"; $hit2="-"; $hit3="-"; $hit4="-"; $hit5="-"; $hit6="-"; $hit7="-"; $hit2h="-"; 

}
//------------------------------------------------------------------------------!!		
		$thit0=$thit0+$hit0; $thit1=$thit1+$hit1; $thit2=$thit2+$hit2; $thit3=$thit3+$hit3; 
		$thit4=$thit4+$hit4; $thit5=$thit5+$hit5; $thit6=$thit6+$hit6; $thit7=$thit7+$hit7;  $thit2h=$thit2h+$hit2h;
		//--dibawah 1 hari
		echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong>$hit0</strong> $showperhit0</td>";
		
		//--1 hari dibawah 2 hari atau 48 jam
		
		
        echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong><a href='scDetail.php?td=$tgldateDel&tm=$tglmonthDel&ty=$tglyearDel&td2=$tgldateDel2&tm2=$tglmonthDel2&ty2=$tglyearDel2&dep0=$dep0&dep=$depID&num=1'>$hit1</strong> $showperhit1</a></td>";
		//--end 1 hari
		
	    echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong><a href='scDetail.php?td=$tgldateDel&tm=$tglmonthDel&ty=$tglyearDel&td2=$tgldateDel2&tm2=$tglmonthDel2&ty2=$tglyearDel2&dep0=$dep0&dep=$depID&num=2'>$hit2</strong> $showperhit2</a></td>";
        echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong><a href='scDetail.php?td=$tgldateDel&tm=$tglmonthDel&ty=$tglyearDel&td2=$tgldateDel2&tm2=$tglmonthDel2&ty2=$tglyearDel2&dep0=$dep0&dep=$depID&num=3'>$hit3</strong> $showperhit3</a></td>";
	   echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong><a href='scDetail.php?td=$tgldateDel&tm=$tglmonthDel&ty=$tglyearDel&td2=$tgldateDel2&tm2=$tglmonthDel2&ty2=$tglyearDel2&dep0=$dep0&dep=$depID&num=4'>$hit4</strong> $showperhit4</a></td>";
	   echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong><a href='scDetail.php?td=$tgldateDel&tm=$tglmonthDel&ty=$tglyearDel&td2=$tgldateDel2&tm2=$tglmonthDel2&ty2=$tglyearDel2&dep0=$dep0&dep=$depID&num=5'>$hit5</strong> $showperhit5</a></td>";
	   echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong><a href='scDetail.php?td=$tgldateDel&tm=$tglmonthDel&ty=$tglyearDel&td2=$tgldateDel2&tm2=$tglmonthDel2&ty2=$tglyearDel2&dep0=$dep0&dep=$depID&num=6'>$hit6</strong> $showperhit6</a></td>";
	   echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong><a href='scDetail.php?td=$tgldateDel&tm=$tglmonthDel&ty=$tglyearDel&td2=$tgldateDel2&tm2=$tglmonthDel2&ty2=$tglyearDel2&dep0=$dep0&dep=$depID&num=7'>$hit7</strong> $showperhit7 </a></strong></td>";
	   echo "<td width='120' class='normal333'  valign=center align=left>&nbsp;<strong><a href='scDetail.php?td=$tgldateDel&tm=$tglmonthDel&ty=$tglyearDel&td2=$tgldateDel2&tm2=$tglmonthDel2&ty2=$tglyearDel2&dep0=$dep0&dep=$depID&num=21'>$hit2h</strong> $showperhit2h </a></strong></td>";
        echo "</tr>";
	}	
	
     echo "</table>";


	//sqlsrv_free_result($sql);
	//sqlsrv_close($conn);
	//--
}
//--
}
?></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="normal9black">&nbsp;</td>
                  </tr>
              </table>
				<h2>&nbsp;</h2>
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