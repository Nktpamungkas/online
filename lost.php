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
	<title>lost quantity :: online system</title>
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
					<a href="infobruto.php">Info Bruto </a>				</li>
				<li>
					<a href="qty.php">Qty per Buyer </a>				</li>
				<li class="selected">
					<a href="lost.php">Lost Quantity </a>				</li>
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
                          <td class="blod9black">No Bon Order </td>
                          <td class="normal9black"><input name="nobo" type="text" class="normal9black" id="nobo"></td>
                        </tr>
                        <tr>
                          <td class="blod9black">&nbsp;</td>
                          <td class="normal9black">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="blod9black">No Hanger </td>
                          <td class="normal9black"><input name="nohanger" type="text" class="normal9black" id="nohanger" value="" /></td>
                        </tr>
                        <tr>
                          <td class="normal333">&nbsp;</td>
                          <td class="normal9black"><span class="normal333">(tanpa tanda (-) contoh LCT11213</span></td>
                        </tr>
                        <tr>
                          <td class="blod9black">&nbsp;</td>
                          <td class="normal9black">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="blod9black"><input name="cekRtgl" type="checkbox" id="cekRtgl" value="1">
                          Range Tanggal </td>
                          <td class="normal9black"><input name="tgl1" type="text" class="normal9black" id="tgl1" value="<?php echo $tgl; ?>" />
                            sampai
                            <input name="tgl2" type="text" class="normal9black" id="tgl2" value="<?php echo $tgl; ?>" /></td>
                        </tr>
                        <tr>
                          <td class="blod9black">&nbsp;</td>
                          <td class="normal9black">&nbsp;</td>
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
	//$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//sqlsrv_select_db($db_name) or die ("Under maintenance");
	//--

$tgl1=trim(strip_tags($_POST['tgl1'])); $tgl2=trim(strip_tags($_POST['tgl2']));
$nohanger=trim(strip_tags($_POST['nohanger']));
$nobo=$_POST['nobo'];

if (($nohanger <> '') || ($nobo <> '')){

$sql0="select distinct(qty.BonOrder),qty.ProductNumber,qty.Quantity,qty.UnitName,qty.Color,qty.ProductDesc,qty.BuyerName,qty.BuyerTitle,qty.CustomerName from 
(
select
			x.SONumber,x.DocumentNo as BonOrder,x.Quantity, 
			cust.PartnerNumber as CustomerNumber, cust.CompanyTitle as CustomerTitle, cust.PartnerName as CustomerName,
			buy.PartnerNumber as BuyerNumber, buy.CompanyTitle as BuyerTitle, buy.PartnerName as BuyerName,
			pm.ProductNumber, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName
		from
			(
			select
				so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo,
				pcb.ID as PCBID, pcb.DocumentNo as NoKK, 
				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
				pcblp.DepartmentID
				
			from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID left join
				ProcessControlJO pcjo on sod.ID = pcjo.SODID left join
				ProcessControlBatches pcb on pcjo.PCID = pcb.PCID left join
				ProcessControlBatchesLastPosition pcblp on pcb.ID = pcblp.PCBID left join
				ProcessFlowProcessNo pfpn on pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID and pfpn.MachineType = 24 left join
				ProcessFlowDetailsNote pfdn on pfpn.EntryType = pfdn.EntryType and pfpn.ID = pfdn.ParentID
			where so.BuyerID='$kodebuyer' and (so.SODate between '$tgl1' and '$tgl2')
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,
					pcb.ID, pcb.DocumentNo, 
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
where pm.ProductNumber like '$nohanger%'			

) qty";

$sql = sqlsrv_query($conn,$sql0, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured : ');
 
$count = sqlsrv_num_rows($sql);

		if ($count > 0 ){
			$row=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC);
			echo "<font class='boldCD6'>Hasil Pencarian : (". date("d/m/y") .")</font><br><br>";
			echo "<font class='blod9black'>No Hanger           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</font><font class='normal9black'> $nohanger </font><br>";
			echo "<font class='blod9black'>Jenis Kain           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</font> <font class='normal9black'>".$row['ProductDesc']." </font><br>";
			echo "<font class='blod9black'>Nama Buyer           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</font><font class='normal9black'> ".$row['BuyerName']." ,".$row['BuyerTitle']."</font><br><br>";

			
					  echo " <table width='100%' border='0'>";
				 	  echo "  <tr>";
				   	  echo "   <td class='tombol'><div align='center'>No  </div></td>";
					  echo "<td class='tombol'><div align='center'>Bon Order</div></td>";
					  echo "<td class='tombol'><div align='center'>Kode Produk</div></td>";
					  echo "<td class='tombol'><div align='center'>Warna</div></td>";
					  echo "<td class='tombol'><div align='center'>Quantity</div></td>";
					  echo "<td class='tombol'><div align='center'>Nama Langganan</div></td>";         
					echo "</tr>";
					//--
					//--
					$c=0; $t=0;
					while ($row2=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC)){
					$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 					
									
					echo "<tr bgcolor='$bgcolor'>";
					  echo "<td width='20' class='normal333'>$c</td>";
					  echo "<td class='normal333'>".$row2['BonOrder']."</td>";
					  echo "<td class='normal333'>".$row2['ProductNumber']."</td>";		  
					   echo "<td class='normal333'>".$row2['Color']."</td>";
					  echo "<td class='normal333' align=right>" .number_format($row2['Quantity'],2). " Kg</td>";
					   
					  echo "<td class='normal333'>".$row2['CustomerName']."</td>";
					 
					echo "</tr>";
					$t=$t + $row2['Quantity'];        
					}
					
					//---
					echo "  <tr>";
				   echo "   <td class='tombol'><div align='center'></div></td>";
					  echo "<td class='tombol'><div align='center'></div></td>";
					  echo "<td class='tombol'><div align='center'></div></td>";
					  echo "<td class='tombol'><div align='center'>Total Quantity</div></td>";
					  echo "<td class='tombol'><div align='right'>" .number_format($t,2). " Kg</div></td>";
					  echo "<td class='tombol'><div align='center'></div></td>";         
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
}else{
	echo "No Hanger atau no bon order tidak boleh kosong !";
//--
}
}
?></td>
                </tr>
                <tr>
                  <td class="normal9black">&nbsp;</td>
                </tr>
              </table>
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