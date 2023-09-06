<?php
ini_set("error_reporting", 1);
include "koneksi.php";
//--
$act=$_POST['act'];
$tgl=date("Y-m-d");
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>info bruto :: online system</title>
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
				<li class="selected">
					<a href="infobruto.php">Info Bruto </a>				</li>
				<li>
					<a href="qty.php">Qty per Buyer </a>				</li>
				<li>
					<a href="kk.php">Posisi KK </a>				</li>
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
                          <td class="blod9black">&nbsp;</td>
                          <td class="normal9black">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" class="boldCD6">Silahkan masukkan data yang ingin dicari </td>
                        </tr>
                        <tr>
                          <td class="blod9black">&nbsp;</td>
                          <td class="normal9black">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="blod9black">&nbsp;</td>
                          <td class="normal9black"></td>
                        </tr>
                        <tr>
                          <td class="blod9black">Sales Asistant </td>
                          <td class="normal9black"><?php
		 // echo "TEST";
		  	//--
	//$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//sqlsrv_select_db($db_name) or die ("Under maintenance");
	//--
		  	$sqlBuyer="select SalesPersonCode,SalesPersonName from SalesPerson order by SalesPersonName";

$qryBuyer = sqlsrv_query($conn,$sqlBuyer, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured : ');
 
$countBuyer = sqlsrv_num_rows($qryBuyer);
			
		if ($countBuyer > 0 ){
			echo "<select name=kodebuyer class='normal9black'>";
			echo "<option value='all'>-- ALL --</option>";
			echo "<option value='8' selected>Aan</option>";
			while($rowBuyer=sqlsrv_fetch_array($qryBuyer,SQLSRV_FETCH_ASSOC)){
				$Kdbuyer=$rowBuyer['SalesPersonCode']; $NamaBuyer=$rowBuyer['SalesPersonName'];
				
				echo "<option value='$Kdbuyer'>$NamaBuyer </option>";
				
			}
			echo "</select";
		}	
			//--
	//sqlsrv_free_result($qryBuyer);
	//sqlsrv_close($conn);
	//--
		  ?>                          </td>
                        </tr>
                        <tr>
                          <td class="blod9black">&nbsp;</td>
                          <td class="normal9black">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="blod9black">Range quantity bruto </td>
                          <td class="normal9black"><select name="Rbruto" class="normal9black" id="Rbruto">
                            <option value="all">-- ALL --</option>
                            <option value="1">&gt; 1000 Kg</option>
                            <option value="2">850 - 1000 Kg</option>
                            <option value="3">600 - 849 Kg</option>
                            <option value="4">400 - 599 Kg</option>
                            <option value="5">100 - 399 Kg</option>
                            <option value="6">75 - 99 Kg</option>
                            <option value="7">50 - 74 Kg</option>
                            <option value="8">25 - 49 Kg</option>
                            <option value="9" selected>&lt; 25 Kg</option>
                          </select>                          </td>
                        </tr>
                        <tr>
                          <td class="normal333">&nbsp;</td>
                          <td class="normal9black">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="blod9black">Actual Production </td>
                          <td class="normal9black"><select name="actual" class="normal9black" id="actual">
                            <option value="all">-- ALL --</option>
                            <option value="1" selected>Actual</option>
                            <option value="2">Retur</option>
                            <option value="3">Ganti Kain</option>
                          </select>
                          </td>
                        </tr>
                        <tr>
                          <td class="blod9black">&nbsp;</td>
                          <td class="normal9black">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="blod9black"><label></label>
                          <div align="right">
                            <label>
                            <div align="left">
                              <input name="cekRtgl" type="checkbox" id="cekRtgl" value="1">
                            Range Tanggal Order </div>
                            </label>
                          </div></td>
                          <td class="normal9black"><input name="tgl1" type="text" class="normal9black" id="tgl1" value="<?php echo $tgl; ?>" />
                            sampai
                            <input name="tgl2" type="text" class="normal9black" id="tgl2" value="<?php echo $tgl; ?>" /></td>
                        </tr>
                        <tr>
                          <td class="blod9black">&nbsp;</td>
                          <td class="normal9black">( format harus tahun-bulan-tanggal, contoh 2012-12-31) </td>
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
                          <td class="blod9black"><input name="act" type="hidden" id="act" value="cari" /></td>
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
	$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	sqlsrv_select_db($db_name) or die ("Under maintenance");
	//--

$tgl1=trim(strip_tags($_POST['tgl1'])); $tgl2=trim(strip_tags($_POST['tgl2']));
$Rbruto=trim(strip_tags($_POST['Rbruto']));
$kodebuyer=$_POST['kodebuyer']; $cekRtgl=$_POST['cekRtgl'];
$actual=$_POST['actual'];

if ($Rbruto=='1'){
	$rangebruto="> 1000 Kg";
}else if ($Rbruto=='2'){
	$rangebruto="850 - 1000 Kg";
	$r1=850; $r2=1000;
}else if ($Rbruto=='3'){
	$rangebruto="600 - 849 Kg";
	$r1=600; $r2=849;
}else if ($Rbruto=='4'){
	$rangebruto="400 - 599 Kg";
	$r1=400; $r2=599;
}else if ($Rbruto=='5'){
	$rangebruto="100 - 399 Kg";
	$r1=100; $r2=399;
}else if ($Rbruto=='6'){
	$rangebruto="75 - 99 Kg";
	$r1=75; $r2=99;
}else if ($Rbruto=='7'){
	$rangebruto="50 - 74 Kg";
	$r1=50; $r2=74;
}else if ($Rbruto=='8'){
	$rangebruto="25 - 49 Kg";
	$r1=25; $r2=49;
}else if ($Rbruto=='9'){
	$rangebruto="< 25 Kg";
}else if ($Rbruto=='all'){
	$rangebruto="ALL";
}

if ($actual=='2'){
	$aktual="RETUR";
}else if ($actual=='3'){
	$aktual="GANTI KAIN";
}else if ($actual=='1'){
	$aktual="ACTUAL";
}else{
	$aktual="";
}
	
if (($kodebuyer <> 'all') && ($cekRtgl <> '1') && ($actual=='all')){
	include "sqlSalesbruto.php";
	
}else if (($kodebuyer == 'all') && ($cekRtgl <> '1') && ($actual=='all')){
	include "sqlSalesbruto2.php";
	
}else if (($kodebuyer <> 'all') && ($cekRtgl == '1') && ($actual=='all')){
	include "sqlSalesbruto3.php";
	
}else if (($kodebuyer == 'all') && ($cekRtgl == '1') && ($actual=='all')){
	include "sqlSalesbruto4.php";
	
}else if (($kodebuyer == 'all') && ($cekRtgl <> '1') && ($actual<>'all')){
	include "sqlSalesbruto2b.php";
	
}else if (($kodebuyer <> 'all') && ($cekRtgl <> '1') && ($actual<>'all')){
	include "sqlSalesbruto1b.php";
	
}else if (($kodebuyer <> 'all') && ($cekRtgl == '1') && ($actual<>'all')){
	include "sqlSalesbruto3b.php";
	
}else if (($kodebuyer == 'all') && ($cekRtgl == '1') && ($actual<>'all')){
	include "sqlSalesbruto4b.php";
	
}

if ($cekRtgl=='1'){

$tgl1view=date('d/m/y', strtotime($tgl1));
$tgl2view=date('d/m/y',strtotime($tgl2));
}else{
$tgl1view="";
$tgl2view="";
}
$sql = sqlsrv_query($conn,$sql0, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured : ');
 
$count = sqlsrv_num_rows($sql);

		if ($count > 0 ){
			$row=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC);
			echo "<font class='boldCD6'>Hasil Pencarian : (". date("d/m/y") .")</font><br><br>";
			echo "<font class='blod9black'>Range Quantity Bruto           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</font><font class='normal9black'> $rangebruto </font><br>";
			echo "<font class='blod9black'>Range Tanggal Order           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</font> <font class='normal9black'> $tgl1view - $tgl2view </font><br>";
			echo "<font class='blod9black'>Production           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</font> <font class='normal9black'> $aktual </font><br><hr>";
			
			
					  echo " <table width='100%' border='0'>";
				 	  echo "  <tr>";
				   	  echo "   <td class='tombol'><div align='center'>No  </div></td>";
					  echo "<td class='tombol'><div align='center'>Sales Asistant</div></td>";
					  echo "<td class='tombol'><div align='center'>Tanggal Order</div></td>";
					  echo "<td class='tombol'><div align='center'>No Bon Order</div></td>";
					  echo "<td class='tombol'><div align='center'>QTY Bruto</div></td>";
					 // 
					  //echo "<td class='tombol'><div align='center'>No Hanger</div></td>";
					 // echo "<td class='tombol'><div align='center'>No Warna</div></td>";
					  echo "<td class='tombol'><div align='center'>Warna</div></td>";		
					  echo "<td class='tombol'><div align='center'>Jenis Kain</div></td>";			  
					  echo "<td class='tombol'><div align='center'>Nama Langganan</div></td>";         
					echo "</tr>";
					//--
					//--
					$c=0; $t=0;
					while ($row2=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC)){
					$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 					
									
					echo "<tr bgcolor='$bgcolor'>";
					  echo "<td width='20' class='normal333'>$c</td>";
					  echo "<td class='normal333'>".$row2['SalesPersonName']."</td>";
					  echo "<td class='normal333'>".$row2['TglSO']."</td>";		  
					   echo "<td class='normal333'>".$row2['DocumentNo']."</td>";	
					  echo "<td class='normal333' align=right>" .number_format($row2['Bruto'],2). " Kg</td>";
					   // 	
					   //echo "<td class='normal333'>$row2[HangerNo]</td>";
					 // echo "<td class='normal333'>$row2[ColorNo]</td>";
					   echo "<td class='normal333'>".$row2['Color']."</td>";
					   echo "<td class='normal333'>".$row2['ProductDesc']."</td>";
					  echo "<td class='normal333'>".$row2['BuyerName']."/ <br>".$row2['CustomerName']."</td>";
					 
					echo "</tr>";
					$t=$t + $row2['Bruto'];        
					}
					
					//---
					echo "  <tr>";
				   echo "   <td class='tombol'><div align='center'></div></td>";
					  echo "<td class='tombol'><div align='center'></div></td>";
					  echo "<td class='tombol'><div align='center'></div></td>";
					  echo "<td class='tombol'><div align='center'>Total Quantity Bruto</div></td>";
					  echo "<td class='tombol'><div align='right'>" .number_format($t,2). " Kg</div></td>";
					          
					echo "</tr>";
					
					//--
				 echo "</table>";

			}else{
				echo "Data TIDAK ditemukan, mohon cek lagi input filternya";	
			}
	//--
	//sqlsrv_free_result($sql);
	//sqlsrv_close($conn);
	//--
//}else{
//	echo "No Hanger dan buyer tidak boleh kosong !";
//--
//}
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