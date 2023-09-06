<?php
session_start();
if (!isset($_SESSION['labReg_username'])) {
header("location:../lab/index.php?g=salah&&err=111");//
exit;//
} 
$lReg_username=$_SESSION['labReg_username'];

include "koneksiLAB.php";
db_connect($db_name);
//--
$idkk=$_REQUEST['kk'];
$act=$_GET['g'];
//-
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Bon Resep :: online system</title>
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
                    <td><span class="boldCD6">DATA DYESTUFF / CHEMICAL YANG DIGUNAKAN</span></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
				  <?php
				  if (!$act){
				  ?>
                  <tr>
                    <td class="normal9black"><form name="form1" method="post" action="?g=1">
                      Nomor Kartu Kerja : 
                      <input name="kk" type="text" class="normal333" id="kk" size="30">
                                        <input name="Submit" type="submit" class="tombol" value="Cari">
                    </form>
                    </td>
                  </tr>
				  <?php
				  }else{
				  ?>
                  <tr>
                    <td class="normal9black"><?php
   
	//--
	//set_time_limit(600);
	//'$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//'mssql_select_db($db_name) or die ("Under maintenance");
	//--
$sql="select convert(char(10),CreateTime,103) as TglBonResep,convert(char(10),CreateTime,108) as JamBonResep,ID_NO,COLOR_NAME,PROGRAM_NAME,PRODUCT_LOT,VOLUME,PROGRAM_CODE,YARN as NoKK,TOTAL_WT,USER25 from ticket_title where YARN='$idkk' order by createtime";
				 //--lot
$qry=mssql_query($sql);

$countdata=mssql_num_rows($qry);

if ($countdata > 0)
{

 echo "<strong>Nomor Kartu Kerja : $idkk </strong><hr>";
 while($row=mssql_fetch_assoc($qry)){						

echo "<table>";
echo "<tr class=tombol><td colspan='4' align=left>Create : $row[TglBonResep] $row[JamBonResep] &nbsp;&nbsp;&nbsp;&nbsp;No Bon Resep : $row[ID_NO]</td></tr>";
echo "<tr><td width=150>Color Name </td><td width=250>: $row[COLOR_NAME]</td><td width=150>Program Code </td><td>: $row[PROGRAM_CODE] </td></tr>";
echo "<tr><td>Program Name </td><td>: $row[PROGRAM_NAME]</td><td width=150> </td><td></td></tr>";
echo "<tr><td>Lots </td><td>: $row[PRODUCT_LOT]</td><td>Total Wt (Kg)</td><td>: $row[TOTAL_WT]</td></tr>";
echo "<tr><td>Volume (Litres) </td><td>: $row[VOLUME]</td><td>Carry Over </td><td>: $row[USER25] </td></tr>";
//echo "<tr><td></td><td>: $row[PROGRAM_NAME] </td></tr>";
echo"</table>";
echo "<hr size='2' style='outline-style:double' />";	

	$sqlstep="select distinct(STEP_NO),RECIPE_CODE from Ticket_detail where ID_No='$row[ID_NO]' order by Step_NO";
	$qrystep=mssql_query($sqlstep);
	
	while ($rowst=mssql_fetch_assoc($qrystep)){
		
	 echo "Step $rowst[STEP_NO] Recipe Code: $rowst[RECIPE_CODE]<br>";
	 
	 	$sqlisi="select ID_NO,STEP_NO,RECIPE_CODE,PRODUCT_CODE,CONC,CONCUNIT,TARGET_WT,REMARK from Ticket_detail 
where ID_No='$row[ID_NO]' and STEP_NO='$rowst[STEP_NO]' order by Step_NO";
		$qryisi=mssql_query($sqlisi);
		  	
			echo " <table width='80%' border='0'>";
			$c=0;
			while ($rowisi=mssql_fetch_assoc($qryisi)){
			$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
			  echo "  <tr bgcolor='$bgcolor'>";
			  echo "   <td class='normal333' width=60><div align='left'>$rowisi[PRODUCT_CODE]</div></td>";
			 
			 		$sqlp=mssql_query("Select ProductName from Product where ProductCode='$rowisi[PRODUCT_CODE]'");
					$qryp=mssql_fetch_assoc($sqlp);
					
			  echo "   <td class='normal333' width=300><div align='left'>$qryp[ProductName] </div></td>";
			  
			  		if ($rowisi[CONCUNIT]==0){
						$unit1="%";
						$unit2="g";
						$berat=$rowisi[TARGET_WT];
					}else{
						$unit1="g/L";
						$unit2="Kg";
						$berat=$rowisi[TARGET_WT]/1000;
						$berat="".number_format($berat,3)."";
					}	
			  echo "   <td class='normal333' width=100><div align='right'>$rowisi[CONC] $unit1</div></td>";
			   
			   echo "   <td class='normal333' width=100><div align='right'>$berat $unit2</div></td>";
				  echo "<td class='normal333' width=100><div align='left'>$rowisi[REMARK]</div></td>";
				  
				echo "</tr>";
			}
			echo "</table>";
			
		echo "<br>";
//--
	}//end detail
	echo "<hr size='2' style='outline-style:double' />";
	echo "<hr>";
				
 }//end while
 
	
}else{
	echo "Data tidak ditemukan !";
}
	//--
	mssql_free_result($sql);
	mssql_close($conn);
	//--
}//end act
?></td>
                  </tr>
                  <tr>
                    <td class="normal9black">&nbsp;</td>
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