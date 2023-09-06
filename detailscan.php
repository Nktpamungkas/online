<?php

$host="10.0.0.4";
//$host="DIT\MSSQLSERVER08";
$username="sa";
$password="ditbin";
$db_name="TM";
//--
$act=$_REQUEST['act'];
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
                            <td colspan="2" class="boldCD6">LAPORAN SCAN KARTU KERJA MASUK PER DEPARTEMEN </td>
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
								
								echo "<option value='".$rdep['ID']."' selected>".$rdep['DepartmentName']."</option>";
								$sqldep=mssql_query("select ID,ParentID,DepartmentName from Departments where ParentID = '0' order by DepartmentName");
								while($rjenis=mssql_fetch_assoc($sqldep)){									
									echo "<option value=".$rjenis['ID'].">".$rjenis['DepartmentName']."</option>";
								}
							}else{
								echo "<option value='' selected></option>";
								$sqldep=mssql_query("select ID,ParentID,DepartmentName from Departments where ParentID = '0' order by DepartmentName");
								while($rjenis=mssql_fetch_assoc($sqldep)){									
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
									echo "<option value=".$rjenis['ID'].">".$rjenis['DepartmentName']."</option>";
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
                            <td class="blod9black">Range Scan IN </td>
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
}elseif ($act=="progress"){
	echo "IN PROGRESS";
}else{   
	//--
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	//--

$nokk=trim(strip_tags($_POST['nokk']));
$nobo=trim(strip_tags($_POST['nobo']));

$tgldateDel=$_GET['d']; $tglmonthDel=$_GET['m']; $tglyearDel=$_GET['y'];
if ($tgldateDel<>"" && $tglmonthDel<>"" && $tglyearDel<>""){
	$tglDel="$tglyearDel-$tglmonthDel-$tgldateDel 00:00:00";
	$tglDisplay="$tgldateDel/$tglmonthDel/$tglyearDel";
}else{
	$tglDel="0000-00-00";
	$tglDisplay=" - ";
}

$tgldateDel2=$_GET['d2']; $tglmonthDel2=$_GET['m2']; $tglyearDel2=$_GET['y2'];
if ($tgldateDel2<>"" && $tglmonthDel2<>"" && $tglyearDel2<>""){
	$tglDel2="$tglyearDel2-$tglmonthDel2-$tgldateDel2 23:59:59";
	$tglDisplay2="$tgldateDel2/$tglmonthDel2/$tglyearDel2";
}else{
	$tglDel2="0000-00-00";
	$tglDisplay2=" - ";
}

$dep0=trim(strip_tags($_GET['dep0']));
$dep=trim(strip_tags($_GET['dep']));

/*$sql0="select
			x.*, 
			udq.UnitName, udq.DetailDigits,
			udw.UnitName as WeightUnitName, udw.DetailDigits as WeightDigits,
			udb.UnitName as BatchUnitName, udb.DetailDigits as BatchDigits,
			cust.PartnerNumber as CustomerNumber, cust.CompanyTitle as CustomerTitle, cust.PartnerName as CustomerName,
			buy.PartnerNumber as BuyerNumber, buy.CompanyTitle as BuyerTitle, buy.PartnerName as BuyerName,
			pm.ProductNumber, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
			dep.DepartmentCode, dep.DepartmentName, pdep.DepartmentCode as RootDepartmentCode, pdep.DepartmentName as RootDepartmentName
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo,
				pcb.ID as PCBID, pcb.DocumentNo as NoKK, pcb.Gross as Bruto,
				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID
				
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
			--where jo.DocumentNo='$nobo'
			where so.SODate between '$tglDel' and '$tglDel2'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			where dep.ID='$dep'
			order by
				x.SODID, x.PCBID"; */
//----Filter tgl
//---cek sub dept
	//if ($dep==""){
		//$sql0="select * from PCCardPosition where Dated between '$tglDel' and '$tglDel2' and DepartmentID='$dep0' and Status='1' order by Dated";
	//}else{
if($dep<>""){
		$sql0="select * from PCCardPosition where Dated between '$tglDel' and '$tglDel2' and DepartmentID='$dep' and Status='1' order by Dated";
}else{
$sql0="select z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.Dated between '$tglDel' and '$tglDel2' and x.Status='1' 
) z
where z.ParentID='$dep0'
order by z.DepartmentName,z.Dated";
}
	//}
//-

$sql = mssql_query($sql0) 
    or die('A error occured : 0');
 
$count = mssql_num_rows($sql);

			if ($count > 0 ){
			//$row=mssql_fetch_assoc($sql);
			
			   if($dep<>""){
					$sqlDep0="select ID,ParentID,DepartmentName from Departments where ID='$dep'";			
					$sqlDep = mssql_query($sqlDep0) ;
					$rowDepA=mssql_fetch_assoc($sqlDep);
					$subDep=$rowDepA[DepartmentName]; $parID=$rowDepA[ParentID];
					
					$sqlDep1="select ID,ParentID,DepartmentName from Departments where ID='$parID'";			
					$sqlDepB = mssql_query($sqlDep1) ;
					$rowDepB=mssql_fetch_assoc($sqlDepB);
					$ParentDep=$rowDepB[DepartmentName];
				}else{
					
					$subDep="";
					
					$sqlDep1="select ID,ParentID,DepartmentName from Departments where ID='$dep0'";			
					$sqlDepB = mssql_query($sqlDep1) ;
					$rowDepB=mssql_fetch_assoc($sqlDepB);
					$ParentDep=$rowDepB[DepartmentName];
				}
			
			echo "<font class='blod9black'>Hasil Pencarian Departemen : $ParentDep ($subDep) <br><br>Tanggal SCAN IN :</font> $tglDisplay s.d. $tglDisplay2 <font class='blod9black'>( Total Kartu Kerja Masuk : $count )<br><br>";

			
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	  if($dep==""){
	  echo "   <td class='tombol'><div align='center'>Sub Dept. </div></td>";
	  }
	  echo "   <td class='tombol'><div align='center'>Langganan </div></td>";
	  echo "   <td class='tombol'><div align='center'>No BOn ORder </div></td>";
       
	   echo "   <td class='tombol'><div align='center'>No LOT </div></td>";
          echo "<td class='tombol'><div align='center'>KK IN</div></td>";
		  echo "<td class='tombol'><div align='center'>KK OUT</div></td>";
          echo "<td class='tombol'><div align='center'>No Warna </div></td>";
          echo "<td class='tombol'><div align='center'>Warna</div></td>";
          echo "<td class='tombol'><div align='center'>Nett QTY </div></td>";
		  echo "<td class='tombol'><div align='center'>Bruto BagiKain</div></td>";
          echo "<td class='tombol'><div align='center'>Product Number </div></td>";
          echo "<td class='tombol'><div align='center'>Product Description </div></td>";
		  echo "   <td class='tombol'><div align='center'>No Kartu Kerja </div></td>";
        echo "</tr>";
		
		$c=0;
		$noOut=0;
		while ($row=mssql_fetch_assoc($sql)){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
			//--
		$sql2="select
			x.*, 
			udq.UnitName, udq.DetailDigits,
			udw.UnitName as WeightUnitName, udw.DetailDigits as WeightDigits,
			udb.UnitName as BatchUnitName, udb.DetailDigits as BatchDigits,
			cust.PartnerNumber as CustomerNumber, cust.CompanyTitle as CustomerTitle, cust.PartnerName as CustomerName,
			buy.PartnerNumber as BuyerNumber, buy.CompanyTitle as BuyerTitle, buy.PartnerName as BuyerName,
			pm.ProductNumber, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
			dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight,
			dep.DepartmentCode, dep.DepartmentName, pdep.DepartmentCode as RootDepartmentCode, pdep.DepartmentName as RootDepartmentName
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo,
				pcb.ID as PCBID, pcb.DocumentNo as NoKK,convert(char(10),pcb.Dated,103) as TglKK, pcb.Gross as Bruto,
				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID
				
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
			--where jo.DocumentNo='$nobo'
			--where so.SODate between '$tglDel' and '$tglDel2'
			where pcb.ID='$row[PCBID]' and pcb.Gross<>'0'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,pcb.Dated,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			--where dep.ID='$dep'
			order by
				x.SODID desc, x.PCBID";

$sql2b = mssql_query($sql2) or die('A error occured : ');
$row2=mssql_fetch_assoc($sql2b);
		//--
						
        echo "<tr bgcolor='$bgcolor'>";
		if($dep==""){
			$sqlgetdep=mssql_query("select ID,DepartmentName from Departments where ID='$row[DepartmentID]'");
			$rowgetdep=mssql_fetch_assoc($sqlgetdep);
			
	  echo "   <td class='normal333'  valign=top>$rowgetdep[DepartmentName]</td>";
	  }
		echo "<td width='120' class='normal333'  valign=top>$row2[CustomerName]</td>";
		echo "<td width='120' class='normal333'  valign=top>$row2[DocumentNo]</td>";
          
		  //--lot
					  echo "<td class='normal333' valign=top>";
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='$row2[PCID]'";
					  $qryLot = mssql_query($sqlLot) 
								or die('A error occured : ');
								
					  		$rowLot=mssql_fetch_assoc($qryLot);	
							echo "'$rowLot[TotalLot]-$row2[LotNo]";
					  
					  echo "</td>";
					  //--
		  //--		  
		  //echo "tess :$rowkk[5]";
if($dep<>""){		  
//---dep
		  //----in
		  $sqlkk=mssql_query("select * from PCCardPosition where PCBID='$row2[PCBID]' and Status='1' and Dated between '$tglDel' and '$tglDel2' and DepartmentID='$dep' order by Dated");	
			$inoutIN="";
		  while ($rowkk=mssql_fetch_assoc($sqlkk)){
		  		//$rowkk=mssql_fetch_row($sqlkk);
			 
				$sqlkk2=mssql_query("select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition where ID='$rowkk[ID]' and DepartmentID='$dep' order by Dated");
				$rowkk2=mssql_fetch_assoc($sqlkk2);
				$inoutIN="$inoutIN <font class='Bold333'>$rowkk2[TglIn]</font> $rowkk2[JamIn]|";
				$tglINakhir=$rowkk2[Dated];
		  }
		  echo "<td width='120' class='BoldCD6' align='center' valign=top><font class='normal7black'>$inoutIN</font></td>";
		  //---
//--dep0
}else{
//----in
$sql0kk="select z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.PCBID='$row2[PCBID]' and x.Dated between '$tglDel' and '$tglDel2' and x.Status='1' 
) z
where z.DepartmentID='$row[DepartmentID]'
order by z.Dated";

		  $sqlkk=mssql_query($sql0kk) or die('A error occured : 1');	
			$inoutIN="";
		  while ($rowkk=mssql_fetch_assoc($sqlkk)){
		  		//$rowkk=mssql_fetch_row($sqlkk);
			 
				$sqlkk2=mssql_query("select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition where ID='$rowkk[ID]' and DepartmentID='$rowkk[DepartmentID]' order by Dated");
				$rowkk2=mssql_fetch_assoc($sqlkk2);
				$inoutIN="$inoutIN <font class='Bold333'>$rowkk2[TglIn]</font> $rowkk2[JamIn]|";
				$tglINakhir=$rowkk2[Dated];
		  }
		  echo "<td width='120' class='BoldCD6' align='center' valign=top><font class='normal7black'>$inoutIN</font></td>";
		  //---
}
//---dep0 end		
 
//--Out	
if($dep<>""){
//--dep 	
$sqlkkO=mssql_query("select top 1 * from PCCardPosition where PCBID='$row2[PCBID]' and Status='0' and Dated > '$tglINakhir' and DepartmentID='$dep' order by Dated");
			$inoutOut="";
			
			 $rowkkO=mssql_fetch_assoc($sqlkkO);
						$sqlkk2b=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
	left join
	Departments dep on pcpos.CounterDepartmentID  = dep.ID
	where pcpos.ID='$rowkkO[ID]' and pcpos.DepartmentID='$dep' order by Dated desc");
	$countOut=mssql_num_rows($sqlkk2b);
			  $rowkk2b=mssql_fetch_assoc($sqlkk2b);
			  $InoutOUT="<font class='Bold333'>$rowkk2b[TglIn]</font> $rowkk2b[JamIn] <font class='blod9black'>$rowkk2b[DepOut]</font>";
		//--out
}else{
//-dep0		
//--Out		
$sql0kkO="select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.PCBID='$row2[PCBID]' and x.Dated > '$tglINakhir' and x.Status='0' 
) z
where z.DepartmentID='$row[DepartmentID]'
order by z.Dated";

		  $sqlkkO=mssql_query($sql0kkO) or die('A error occured : 1b out');	
			$inoutOut="lll";
			
			 $rowkkO=mssql_fetch_assoc($sqlkkO);
						$sqlkk2b=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
	left join
	Departments dep on pcpos.CounterDepartmentID  = dep.ID
	where pcpos.ID='$rowkkO[ID]' and pcpos.DepartmentID='$row[DepartmentID]' order by Dated desc");
	$countOut=mssql_num_rows($sqlkk2b);
			  $rowkk2b=mssql_fetch_assoc($sqlkk2b);
			  $InoutOUT="<font class='Bold333'>$rowkk2b[TglIn]</font> $rowkk2b[JamIn] <font class='blod9black'>$rowkk2b[DepOut]</font>";
		//--out
//--dep0 end
}			  
		  	if ($countOut==0){
				$noOut=$noOut + 1;
			}
		  echo "<td width='120' class='BoldCD6' align='center' valign=top><font class='normal7black'>$InoutOUT</font></td>";
		  //--
          echo "<td width='100' class='normal333' valign=top>$row2[ColorNo]</td>";
          echo "<td width='150' class='normal333' valign=top>$row2[Color]</td>";
          echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Quantity],2). " $row2[UnitName]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Weight],2). " $row2[UnitName]</td>";
          echo "<td width='120' class='normal333' valign=top>$row2[ProductNumber]</td>";
          echo "<td class='normal333' valign=top>$row2[ProductDesc]</td>";
		  echo "<td width='120' class='normal333' valign=top>'$row2[NoKK]<br>$row2[TglKK]</td>";
        echo "</tr>";
        
		}
     echo "</table>";
	 echo "<br>Kartu Kerja Belum Keluar : $noOut";

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