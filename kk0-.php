<?php

$host="10.0.0.4";
//$host="DIT\MSSQLSERVER08";
$username="sa";
$password="ditbin";
$db_name="TM";
//--
$act=$_POST['act'];
$custid=$_GET['custid'];
$codcust=$_POST['kodebuyer'];
$nobo=trim(strip_tags($_POST['nobo']));
$nopo=trim(strip_tags($_POST['nopo']));
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
	<title>posisi KK :: online system</title>
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
				<table width="120%" border="0">
                  <tr>
                    <td><?php
if (!$act){   
?></td>
                  </tr>
                  <tr>
                    <td><form id="form1" name="form1" method="post" action="?">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="normal9black">
                          <tr>
                            <td colspan="2" class="boldCD6">Silahkan masukkan data yang ingin dicari </td>
                          </tr>
                          <tr>
                            <td width="200" class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black"><input name="nokk" type="hidden" class="normal9black" id="nokk" value="" /></td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black"></td>
                          </tr>
                          <tr>
                            <td class="blod9black">No Bon Order </td>
                            <td class="normal9black"><input name="nobo" type="text" class="normal9black" id="nobo" size="25" />
                            note : Kosongkan No Bon Order jika ingin filter by No PO atau customer</td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black"><input name="act" type="hidden" id="act" value="cari" /></td>
                          </tr>
                          <tr>
                            <td class="blod9black">No PO Langganan </td>
                            <td class="normal9black"><input name="nopo" type="text" class="normal9black" id="nopo" size="30"> 
                              note : Kosongkan No PO jika ingin filter by customer</td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black"> Customer </td>
                            <td class="normal9black"><select name="kodebuyer" class="normal9black" id="kodebuyer" onChange="window.location='kk02.php?custid='+this.value">
							<?php
		 // echo "TEST";
		  	//--
			set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
		$sqlcus=mssql_query("select ID,PartnerNumber,PartnerName from Partners where ID='$custid'");
		$rcus=mssql_fetch_assoc($sqlcus);
		echo "<option value='' selected></option>";
	//--
		  	$sqlBuyer="select ID,PartnerNumber,PartnerName  from Partners where Status ='1' or Status='3' or Status='5' order by PartnerName";

$qryBuyer = mssql_query($sqlBuyer) 
    or die('A error occured : ');
 
$countBuyer = mssql_num_rows($qryBuyer);

		if ($countBuyer > 0 ){
				//echo "<select name=kodebuyer class='normal9black'  onChange='window.location=?subid=+this.value'>";
				//echo "<option value='' selected></option>";
			while($rowBuyer=mssql_fetch_assoc($qryBuyer)){
				$IDBuyer=$rowBuyer[ID]; $Kdbuyer=$rowBuyer[PartnerNumber]; $NamaBuyer=$rowBuyer[PartnerName];
				
				echo "<option value='$IDBuyer'>$Kdbuyer / $NamaBuyer </option>";
				
			}
			//echo "</select";
		}	
			//--
	mssql_free_result($qryBuyer);
	mssql_close($conn);
	//--
		  ?>
		  </select></td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          
                          <tr>
                            <td class="blod9black">Buyer</td>
                            <td class="normal9black"><select name="buyer" class="normal9black" id="buyer" onChange="window.location='kk02.php?buyid='+this.value">
                              <?php
		 // echo "TEST";
		  	//--
			set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
		$sqlcus=mssql_query("select ID,PartnerNumber,PartnerName from Partners where ID='$custid'");
		$rcus=mssql_fetch_assoc($sqlcus);
		echo "<option value='' selected></option>";
	//--
		  	$sqlBuyer="select ID,PartnerNumber,PartnerName  from Partners where Status='4' or Status='5' order by PartnerName";

$qryBuyer = mssql_query($sqlBuyer) 
    or die('A error occured : ');
 
$countBuyer = mssql_num_rows($qryBuyer);

		if ($countBuyer > 0 ){
				//echo "<select name=kodebuyer class='normal9black'  onChange='window.location=?subid=+this.value'>";
				//echo "<option value='' selected></option>";
			while($rowBuyer=mssql_fetch_assoc($qryBuyer)){
				$IDBuyer=$rowBuyer[ID]; $Kdbuyer=$rowBuyer[PartnerNumber]; $NamaBuyer=$rowBuyer[PartnerName];
				
				echo "<option value='$IDBuyer'>$Kdbuyer / $NamaBuyer </option>";
				
			}
			//echo "</select";
		}	
			//--
	mssql_free_result($qryBuyer);
	mssql_close($conn);
	//--
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
	set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	//--


if ($nobo <> ''){

//echo "No Bon ORder";
//--
$sql0="select top 1
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
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				
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
			where jo.DocumentNo='$nobo' and pcb.Gross<>'0'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sql = mssql_query($sql0) 
    or die('A error occured : ');
 
$count = mssql_num_rows($sql);

			if ($count > 0 ){
			$row=mssql_fetch_assoc($sql);
			$ponya=trim($row[PONumber]);
			echo "<font class='blod9black'>Hasil Pencarian : (". date("d/m/y") .")</font><br><br>";

			echo "<table width='100%' border='0'>";
      echo "<tr>";
        echo "<td width='100' align='left' valign='middle' class='normal9black'>&nbsp;</td>";
        echo "<td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td align='left' valign='middle' class='normal9black'>No Bon Order </td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $row[DocumentNo]</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td align='left' valign='middle' class='normal9black'>Tgl Order </td>";
        echo "<td align='left' valign='middle' class='normal9black'>:  $row[TglSO]</td>";
      echo "</tr>";
	  //--cek po
	  if ($ponya<>''){
	  
        echo "<tr>";
        echo "<td align='left' valign='middle' class='normal9black'><strong>No PO </td>";
        echo " <td align='left' valign='middle' class='normal9black'>: <strong>$row[PONumber]</td>";
        echo "</tr>";
        echo " <tr>";
	
	 }
	 //--
        echo "<td align='left' valign='middle' class='normal9black'>Buyer</td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $row[BuyerNumber] - $row[BuyerTitle] $row[BuyerName]</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td align='left' valign='middle' class='normal9black'>Customer</td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $row[CustomerNumber] - $row[CustomerTitle] $row[CustomerName]</td>";
     echo " </tr>";
     echo " <tr>";
      echo "  <td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
      echo "  <td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
     echo " </tr>";
      
     echo " <tr>";
      echo "  <td align='left' valign='middle' class='normal9black'>Detail</td>";
     echo "   <td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
     echo " </tr>";
      
    echo "</table>";
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	  echo "<td class='tombol'><div align='center'>No.</div></td>";
	  //--cek PO
	  if ($ponya==''){
	  echo "<td class='tombol'><div align='center'>No PO</div></td>";
	  }
	  //--
	  
      echo "<td class='tombol'><div align='center'>No LOT</div></td>";
	   		echo "<td class='tombol'><div align='center'>Posisi Sebelumnya </div></td>";
          echo "<td class='tombol'><div align='center'>Posisi Terakhir </div></td>";
          echo "<td class='tombol'><div align='center'>No Warna </div></td>";
          echo "<td class='tombol'><div align='center'>Warna</div></td>";
		  echo "<td class='tombol'><div align='center'>Lebar</div></td>";
		   echo "<td class='tombol'><div align='center'>Gramasi</div></td>";
          echo "<td class='tombol'><div align='center'>Nett QTY Order</div></td>";
		  echo "<td class='tombol'><div align='center'>Roll</div></td>";
		  echo "<td class='tombol'><div align='center'>Bruto BagiKain</div></td>";
		   echo "<td class='tombol'><div align='center'>Tgl Dibutuhkan /Delivery</div></td>";
          echo "<td class='tombol'><div align='center'>Product Number </div></td>";
          echo "<td class='tombol'><div align='center'>Product Description </div></td>";
		  echo "   <td class='tombol'><div align='center'>Alur Proses </div></td>";
		  echo "   <td class='tombol'><div align='center'>No Kartu Kerja </div></td>";
		  echo "   <td class='tombol'><div align='center'>Dept. Note </div></td>";
		  
        echo "</tr>";
		//--
		$sqlpre02="select jo.DocumentNo,pcb.ID as PCBID, pcb.DocumentNo as NoKK,pcb.Gross
from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID left join
				ProcessControlJO pcjo on sod.ID = pcjo.SODID left join
				ProcessControlBatches pcb on pcjo.PCID = pcb.PCID 
where jo.DocumentNo='$nobo' and pcb.Gross<>'0'";
		$qrypre02=mssql_query($sqlpre02);
		//$rowpre02=mssql_fetch_row($qrypre02);

		//--
		$c=0;
		while ($rowpre02=mssql_fetch_assoc($qrypre02)){
		
		
		//-------begin		
		$sqlpre2=mssql_query("select top 1 ID,Dated,PCBID,DepartmentID from PCCardPosition where PCBID='$rowpre02[PCBID]' order by ID desc");
		$hit=mssql_num_rows($sqlpre2);
if ($hit > 0){ //---------------------------------------------jika KK sudah keluar
				$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
		$rowpre2=mssql_fetch_assoc($sqlpre2);
		
		//--
		$sql2="select
			x.*, 
			udq.UnitName, udq.DetailDigits,
			udw.UnitName as WeightUnitName, udw.DetailDigits as WeightDigits,
			udb.UnitName as BatchUnitName, udb.DetailDigits as BatchDigits,
			cust.PartnerNumber as CustomerNumber, cust.CompanyTitle as CustomerTitle, cust.PartnerName as CustomerName,
			buy.PartnerNumber as BuyerNumber, buy.CompanyTitle as BuyerTitle, buy.PartnerName as BuyerName,
			pm.ProductNumber, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
			pm.Weight as Gramasi,pm.CuttableWidth as Lebar,convert(varchar,pm.Note) as Alur,
			dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight,
			dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount,
			convert(char(10),dbo.fn_StockMovementDetails_GetTglBagiKain(0, x.PCBID),103) as TglBagiKain,
			dep.DepartmentCode, dep.DepartmentName, pdep.DepartmentCode as RootDepartmentCode, pdep.DepartmentName as RootDepartmentName,
			dep.ID as deptID
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo,convert(char(10),sod.RequiredDate,103) as TglPerlu,
				pcb.ID as PCBID, pcb.DocumentNo as NoKK,convert(char(10),pcb.Dated,103) as TglKK, pcb.Gross as Bruto,
				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				
			from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID left join
				ProcessControlJO pcjo on sod.ID = pcjo.SODID left join
				ProcessControlBatches pcb on pcjo.PCID = pcb.PCID left join
				PCCardPosition pcblp on pcb.ID = pcblp.PCBID left join
				ProcessFlowProcessNo pfpn on pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID and pfpn.MachineType = 24 left join
				ProcessFlowDetailsNote pfdn on pfpn.EntryType = pfdn.EntryType and pfpn.ID = pfdn.ParentID
			where jo.DocumentNo='$nobo' and pcb.Gross<>'0' and pcblp.ID='$rowpre2[ID]'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sql2b = mssql_query($sql2) 
    or die('A error occured : ');
		//--
	//	$c=0;
	//	while ($row2=mssql_fetch_assoc($sql2b)){
	//	$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
	$row2=mssql_fetch_assoc($sql2b);
	
		//----cari salinan
			   $child=$row2[ChildLevel];
			
					if($child > 0){
						$sqlgetparent=mssql_query("select ID,LotNo from ProcessControlBatches where ID='$row2[RootID]' and ChildLevel='0'");
						$rowgp=mssql_fetch_assoc($sqlgetparent);
						
						//$nomLot=substr("$row2[LotNo]",0,1);
						$nomLot=$rowgp[LotNo];
						$nomorLot="$nomLot/K$row2[ChildLevel]&nbsp;";				
											
					}else{
						$nomorLot=$row2[LotNo];
							
					}
			  //--end salinan
							
			$sqlkk=mssql_query("select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and CounterDepartmentID<>'$row2[DepartmentID]' order by Dated desc");
			$rowkk=mssql_fetch_row($sqlkk);
						
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td class='normal333' valign=top>$c</td>";
		//--cek PO
	  if ($ponya==''){
	  echo "<td class='normal333' valign=top>$row2[DetailRefNo]</td>";
	  }
	  //--
          //--lot
					  echo "<td class='normal333' valign=top>";
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='$row2[PCID]' and RootID='0' and LotNo < '1000'";
					  $qryLot = mssql_query($sqlLot) 
								or die('A error occured : ');							
							
								
					  		$rowLot=mssql_fetch_assoc($qryLot);	
							echo "'$rowLot[TotalLot]-$nomorLot";
					  
					  echo "</td>";
					  //--
			//---POSISI SEBELUMnya
				
				$sqlpsb=mssql_query("Select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and Status ='0' and DepartmentID<>'$row2[DepartmentID]' order by Dated desc");
				$rowpsb=mssql_fetch_row($sqlpsb);
				
				$sqlkkpsb=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.DepartmentID  = dep.ID
where pcpos.ID='$rowpsb[0]' order by Dated desc");
		  $rowkkpsb=mssql_fetch_assoc($sqlkkpsb);		  
	
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='normal7black'>$rowkkpsb[DepOut]  <br>Out: $rowkkpsb[TglIn] $rowkkpsb[JamIn]</font></td>";
			
			//--end posisi sebelumnya
			//---if stenter cek no mesin
			$ketsetting="";
			
			if ($row2[DepartmentCode]==44){
				$mtp=14;  //type : finishing
				$linemesin="1499001";
				 $sqlset=mssql_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  		$cset=mssql_num_rows($sqlset);
			  if ($cset > 0 ){		  
		  
				$rowset=mssql_fetch_assoc($sqlset);
				$sqlflow=mssql_query("select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='$mtp' order by Dated desc");
				$cflow=mssql_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=mssql_fetch_assoc($sqlflow);
				$ketsetting="$rowflow[TglF] $rowflow[JamF]<br>";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=mssql_query("select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '$linemesin'");
					$rownomes=mssql_fetch_assoc($sqlnomes);
					
					$sqlnomes2=mssql_query("select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='$rownomes[ID]'");
					$rownomes2=mssql_fetch_assoc($sqlnomes2);
					
					$sqlgnomes=mssql_query("select ID,Code,Description,MachineType from Machines where ID='$rownomes2[ValueI]'");
					$cgnomes=mssql_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=mssql_fetch_assoc($sqlgnomes);
						$ketsetting="$rowgnomes[Description]<br>";
					}	
				  }
				}		
			
			}//---end  if stenter
			//--begin inspec note
			if ($row2[DepartmentCode]==34){
				$sqlset=mssql_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  		$cset=mssql_num_rows($sqlset);
			  if ($cset > 0 ){		  
		  
				$rowset=mssql_fetch_assoc($sqlset);
				$sqlflow=mssql_query("select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowset[ID]' order by Dated desc");
				$cflow=mssql_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=mssql_fetch_assoc($sqlflow);
				//$ketsetting="$rowflow[TglF] $rowflow[JamF]<br>";
				//echo $rowset[ID];
					//--cari noote
					$sqlnomes=mssql_query("select cast(Note as nvarchar(50)) as Note from ProcessFlowDetailsDeptNote where DepartmentID='30' and ParentID ='$rowflow[ID]'");
										
					$cgnomes=mssql_num_rows($sqlnomes);
					if ($cgnomes > 0){
						$rownomes=mssql_fetch_assoc($sqlnomes);
						$ketsetting="$rownomes[Note]<br>";
					}	
				  }
				}		
			
			}
			//--end inspek
		  //--		  
		  //echo "tess :$rowkk[5]";
		  if ($rowkk[5]==0){ // =0 : out
		  //---1
		//  $sqlkk1=mssql_query("select top 1 ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition where PCBID='$row2[PCBID]' order by Dated desc");
		//	$rowkk1=mssql_fetch_assoc($sqlkk1);
		  //--
		  
							$sqlkk2=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.CounterDepartmentID  = dep.ID
where pcpos.ID='$rowkk[0]' order by Dated desc");
		  $rowkk2=mssql_fetch_assoc($sqlkk2);
		  
	//	  if ($rowkk1[PCBID]==$rowkk2[ID]){
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$row2[DepartmentName]<hr>Out:</font> <font class='normal7black'>$rowkk2[DepOut]  <br>$rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		//  }else{
        //  	echo "<td width='120' class='BoldCD6' align='center'><font class='blod9black'>$row2[DepartmentName]</font><br><font class='normal7black'>In: $rowkk1[TglIn] $rowkk1[JamIn]<br>Tujuan Out: $rowkk2[DepOut]  <br>$rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		//  }
		  //--
		  }elseif ($rowkk[5]<>0){ // =1 : in
		  	$sqlkk2=mssql_query("select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,DepartmentID  from PCCardPosition where ID='$rowkk[0]' order by Dated desc");
			$rowkk2=mssql_fetch_assoc($sqlkk2);
			
			$cekTgl=$rowkk2[TglIn]; $cekDep=$rowkk2[DepartmentID];
			$pecah1 = explode("/", $cekTgl);
			$date1 = $pecah1[0];
			$month1 = $pecah1[1];
			$year1 = $pecah1[2];
			$pecah2 = explode("/", $row2[TglPerlu]);
			$date2 = $pecah2[0];
			$month2 = $pecah2[1];
			$year2 = $pecah2[2];
			$tglNow="$tanggal1/$tanggal2/$tanggal3";
			$now=strtotime(date("Y-m-d H:m:s"));
			$pecah3 = explode("/", $tglNow);
			$date3 = $pecah3[0];
			$month3 = $pecah3[1];
			$year3 = $pecah3[2];
			
				$jd1 = GregorianToJD($month1,$date1, $year1);
				//$new_jd1 = sprintf('%04d%02d%02d', $year1, $month1, $date1);
				$jd2 = GregorianToJD($month2,$date2,$year2);	
				//list($year, $month, $day) = explode('/', $row2[TglPerlu]);
				//$new_jd2 = sprintf('%04d%02d%02d', $year, $month, $day);
				$new_jd2="$year2-$month2-$date2 00:00:00";
				$new_jd2=strtotime($new_jd2);
				$jd3 = GregorianToJD($month3,$date3,$year3);			 
				// hitung selisih hari kedua tanggal				 
				
				//$selisih1 = $jd2 - $jd1;
				
				
				//$selisihnya=JDToGregorian($selisih);

			echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$row2[DepartmentName]</font><font size=0.1><br>$ketsetting</font><hr><font class='normal7black'>In: $rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		  }
		  //--
		  
		  //---setting
		  $sqlset=mssql_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  $cset=mssql_num_rows($sqlset);
		  if ($cset > 0 ){
		  	$rowset=mssql_fetch_assoc($sqlset);
				$sqlflow=mssql_query("select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='14' order by Dated desc");
				$cflow=mssql_num_rows($sqlflow);
				if ($cflow > 0 ){
					$rowflow=mssql_fetch_assoc($sqlflow);
						$sqlmsn="select 
		lt.ID, lt.ParentID, lt.MachineType,  
		dv.ValueI as ID1, dv.ValueD as Value1, dv.UnitID as UnitID1, dv.UnitMultiplier as UnitMultiplier1, 1 as ColVis1, 
		isnull(d.FormID,0) as FormID, isnull(md.Description,'''') as Description,ud.UnitName 
	from 
		ProcessFlowDetails lt inner join 
		ProcessFlowDetailsValues dv on lt.ID = dv.ParentID left join 
		MachineReadingSetting d on lt.MachineType = d.MachineType and lt.LineID = d.LineID left join 
		MachineReadingDescription md on d.DescriptionID = md.ID left join
		UnitDescription ud on dv.UnitID=ud.ID
	where lt.MachineType='14' and lt.ParentID ='$rowflow[ID]' and (md.Description='Machine No.' or md.Description='Overfeed' or md.Description='Speed' or md.Description='Temperature') and dv.ValueI='40'
	order by 
		md.Description";
		
						$qrymsn=mssql_query($sqlmsn);
						$ketsetting="$rowflow[TglF] $rowflow[JamF]<br>";
						while ($rowmsn=mssql_fetch_assoc($qrymsn)){
							$decmes=trim($rowmsn[Description]);
							if ($decmes=='Machine no.'){
								$sqlmes=mssql_query("select ID,Description from Machines where ID='$rowmsn[ID1]'");
								$rowmes=mssql_fetch_assoc($sqlmes);
								$val="$rowmes[Description]";
							}else{
								$val="".number_format($rowmsn[Value1],1)."";
							}
							$ketsetting="$ketsetting $rowmsn[Description]: $val $rowmsn[UnitName] <br>";
						}
						
					
				}
		  
		  }
		  //--end setting
          echo "<td width='100' class='normal333' valign=top>$row2[ColorNo]</td>";
          echo "<td width='150' class='normal333' valign=top>$row2[Color]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Lebar],0). " inch</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Gramasi],0). " gr/m2</td>";
          echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Quantity],2). " $row2[UnitName]</td>";
		  echo "<td width='80' class='normal333' valign=top align=center>$row2[RollCount]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Weight],2). " Kg<br>"; //$row2[UnitName]<br>";
		   echo "<font size=0.1>$row2[TglBagiKain]</font></td>";
		   //echo "<td width='120' class='normal333' valign=top>'$row2[TglPerlu]";
		  // if ($cekDep<>60){
		  // echo "c";
		   //$selisih=$row2[TglPerlu] - $cekTgl;
		   		//if ($cekTgl > $row2[TglPerlu]){
						//echo "<br>Delay $selisih hari $tglNow";
				//}
		 //  }
		 if($now > $new_jd2)
		 {
		 	if ($cekDep==60){
				$selisih=$jd2 - $jd1;
				if ($selisih < 0){
					$selisih=abs($selisih);
					echo "<td width='140' class='normal333' valign=top>'$row2[TglPerlu]";
					echo "<br><font color=red><strong>Delay $selisih hari</stong></font>";
				}else{
					echo "<td width='140' class='normal333' valign=top>'$row2[TglPerlu]";
				}
			}else{
				$selisih=$jd3 - $jd2;
				$selisih=abs($selisih);
				echo "<td width='140' class='normal333' valign=top bgcolor='#FFFF00'>'$row2[TglPerlu]";
				echo "<br><font class='normal333blink'><Blink>Delay $selisih hari</Blink></font>";
			}
		 }else{
		 		$selisih=$jd3-$jd2;
				$selisih=abs($selisih);
		 	echo "<td width='120' class='normal333' valign=top>'$row2[TglPerlu] <br><br><strong>$selisih hari lagi</strong>";
		 }
		 
		
		   echo "</td>";
         echo "<td width='120' class='normal333' valign=top>$row2[ProductNumber]";
		  
		  $ketsetting="";
   

		  $sqlset=mssql_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  $cset=mssql_num_rows($sqlset);
		  if ($cset > 0 ){		  
		  
		  	$rowset=mssql_fetch_assoc($sqlset);
				$sqlflow=mssql_query("select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='14' order by Dated desc");
				$cflow=mssql_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=mssql_fetch_assoc($sqlflow);
				echo "<hr>";
				$ketsetting="$rowflow[TglF] $rowflow[JamF]<br>";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=mssql_query("select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1499001'");
					$rownomes=mssql_fetch_assoc($sqlnomes);
					
					$sqlnomes2=mssql_query("select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='$rownomes[ID]'");
					$rownomes2=mssql_fetch_assoc($sqlnomes2);
					
					$sqlgnomes=mssql_query("select ID,Code,Description,MachineType from Machines where ID='$rownomes2[ValueI]'");
					$cgnomes=mssql_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=mssql_fetch_assoc($sqlgnomes);
						$ketsetting="$ketsetting $rowgnomes[Description]<br>";
					}
					//--
					//--cari speed
					$sqlspeed=mssql_query("select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401002'");
					$rowspeed=mssql_fetch_assoc($sqlspeed);
					
					$sqlspeed2=mssql_query("select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowspeed[ID]'");
					
					$cspeed=mssql_num_rows($sqlspeed2);
					
					if ($cspeed > 0){
						$rowspeed2=mssql_fetch_assoc($sqlspeed2);
						$ketsetting="$ketsetting Speed:" .number_format($rowspeed2[ValueD],2). " $rowspeed2[UnitName]<br>";
					}
					//--
					//--cari temperatur
					$sqltemp=mssql_query("select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401003'");
					$rowtemp=mssql_fetch_assoc($sqltemp);
					
					$sqltemp2=mssql_query("select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowtemp[ID]'");
					
					$ctemp=mssql_num_rows($sqltemp2);
					
					if ($ctemp > 0){
						$rowtemp2=mssql_fetch_assoc($sqltemp2);
						$ketsetting="$ketsetting suhu:" .number_format($rowtemp2[ValueD],2). " $rowtemp2[UnitName]<br>";
					}
					//--
					//--cari overfeed
					$sqlover=mssql_query("select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401004'");
					$rowover=mssql_fetch_assoc($sqlover);
					
					$sqlover2=mssql_query("select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowover[ID]'");
					
					$cover=mssql_num_rows($sqlover2);
					
					if ($cover > 0){
						$rowover2=mssql_fetch_assoc($sqlover2);
						$ketsetting="$ketsetting overfeed:" .number_format($rowover2[ValueD],1). " $rowover2[UnitName]<br>";
					}
					//--				
						
				}
		  
		  }
		  //--end setting
		  echo "<font size=0.1>$ketsetting</font></td>";
          echo "<td class='normal333' valign=top>$row2[ProductDesc]</td>";
		   echo "<td width='120' class='normal333' valign=top>$row2[Alur]</td>";
		  echo "<td width='120' class='normal333' valign=top>'<a href='logscan.php?kk=$row2[PCBID]' target=_blank>$row2[NoKK]</a><br>$row2[TglKK]</td>";
		  //---Dept Note
		  $sqlcarinotePCB=mssql_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  
		  $rowcarinotePCB=mssql_fetch_assoc($sqlcarinotePCB);
		  
		  $sqlcarinotePFPN=mssql_query("select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowcarinotePCB[ID]' order by Dated desc");
		  
		  $rowcarinotePFPN=mssql_fetch_assoc($sqlcarinotePFPN);
		  
		  $sqlPFDN=mssql_query("select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Note from ProcessFlowDetailsDeptNote where DepartmentID='$row2[deptID]' and ParentID ='$rowcarinotePFPN[ID]'");
		  
		  $PFDN=mssql_fetch_assoc($sqlPFDN);
		  
		  		  
		  //--end Dept Note ----- BYBO
		  $catatandept="$PFDN[Note]";
		  echo "<td class='normal333' valign=top>$catatandept</td>";
        echo "</tr>";

} //-------------------------------------------------end jika Kk sudah keluar        
		}
     echo "</table>";

			}else{
				echo "<br><br><font class='normal9black'>Nomor Bon Order : $nobo , TIDAK ditemukan !</font>";	
			}
	//--
	mssql_free_result($sql);
	mssql_close($conn);
	//--
}else if ($nopo <> ''){
//echo "No PO";
//--
$sql0="select top 1
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
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				
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
			where so.PONumber='$nopo' or soda.RefNo='$nopo' and pcb.Gross<>'0'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sql = mssql_query($sql0) 
    or die('A error occured : ');
 
$count = mssql_num_rows($sql);

			if ($count > 0 ){
			$row=mssql_fetch_assoc($sql);
			echo "<font class='blod9black'>Hasil Pencarian : (". date("d/m/y") .")</font><br><br>";

			echo "<table width='100%' border='0'>";
      echo "<tr>";
        echo "<td width='100' align='left' valign='middle' class='normal9black'>&nbsp;</td>";
        echo "<td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td align='left' valign='middle' class='normal9black'>No Bon Order </td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $row[DocumentNo]</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td align='left' valign='middle' class='normal9black'>Tgl Order </td>";
        echo "<td align='left' valign='middle' class='normal9black'>:  $row[TglSO]</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td align='left' valign='middle' class='normal9black'>No PO </td>";
		//--PO
		//if ($row[PONumber]==""){
			//$nomorPO=$nopo;
		//}else{
		
			//$nomorPO=$row[PONumber];
		//}
		//--
       echo " <td align='left' valign='middle' class='normal9black'>: $nopo</td>";
      echo "</tr>";
     echo " <tr>";
        echo "<td align='left' valign='middle' class='normal9black'>Buyer</td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $row[BuyerNumber] - $row[BuyerTitle] $row[BuyerName]</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td align='left' valign='middle' class='normal9black'>Customer</td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $row[CustomerNumber] - $row[CustomerTitle] $row[CustomerName]</td>";
     echo " </tr>";
     echo " <tr>";
      echo "  <td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
      echo "  <td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
     echo " </tr>";
      
     echo " <tr>";
      echo "  <td align='left' valign='middle' class='normal9black'>Detail</td>";
     echo "   <td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
     echo " </tr>";
      
    echo "</table>";
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	  echo "<td class='tombol'><div align='center'>No.</div></td>";
      echo "<td class='tombol'><div align='center'>No LOT</div></td>";
	   		echo "<td class='tombol'><div align='center'>Posisi Sebelumnya </div></td>";
          echo "<td class='tombol'><div align='center'>Posisi Terakhir </div></td>";
          echo "<td class='tombol'><div align='center'>No Warna </div></td>";
          echo "<td class='tombol'><div align='center'>Warna</div></td>";
		  echo "<td class='tombol'><div align='center'>Lebar</div></td>";
		   echo "<td class='tombol'><div align='center'>Gramasi</div></td>";
          echo "<td class='tombol'><div align='center'>Nett QTY Order</div></td>";
		  echo "<td class='tombol'><div align='center'>Roll</div></td>";
		  echo "<td class='tombol'><div align='center'>Bruto BagiKain</div></td>";
		   echo "<td class='tombol'><div align='center'>Tgl Dibutuhkan /Delivery</div></td>";
          echo "<td class='tombol'><div align='center'>Product Number </div></td>";
          echo "<td class='tombol'><div align='center'>Product Description </div></td>";
		  echo "   <td class='tombol'><div align='center'>Alur Proses </div></td>";
		  echo "   <td class='tombol'><div align='center'>No Kartu Kerja </div></td>";
		  echo "   <td class='tombol'><div align='center'>Dept. Note </div></td>";
		  
        echo "</tr>";
		//--
		$sqlpre02="select so.PONumber,jo.DocumentNo,pcb.ID as PCBID, pcb.DocumentNo as NoKK,pcb.Gross,soda.RefNo
from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID left join
				ProcessControlJO pcjo on sod.ID = pcjo.SODID left join
				ProcessControlBatches pcb on pcjo.PCID = pcb.PCID 
where so.PONumber='$nopo' or soda.RefNo='$nopo' and pcb.Gross<>'0'";
		$qrypre02=mssql_query($sqlpre02);
		//$rowpre02=mssql_fetch_row($qrypre02);

		//--
		$c=0;
		while ($rowpre02=mssql_fetch_assoc($qrypre02)){
		
		
		//-------begin		
		$sqlpre2=mssql_query("select top 1 ID,Dated,PCBID,DepartmentID from PCCardPosition where PCBID='$rowpre02[PCBID]' order by ID desc");
		$hit=mssql_num_rows($sqlpre2);
if ($hit > 0){ //---------------------------------------------jika KK sudah keluar
				$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
		$rowpre2=mssql_fetch_assoc($sqlpre2);
		
		//--
		//--
		$sql2="select
			x.*, 
			udq.UnitName, udq.DetailDigits,
			udw.UnitName as WeightUnitName, udw.DetailDigits as WeightDigits,
			udb.UnitName as BatchUnitName, udb.DetailDigits as BatchDigits,
			cust.PartnerNumber as CustomerNumber, cust.CompanyTitle as CustomerTitle, cust.PartnerName as CustomerName,
			buy.PartnerNumber as BuyerNumber, buy.CompanyTitle as BuyerTitle, buy.PartnerName as BuyerName,
			pm.ProductNumber, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
			pm.Weight as Gramasi,pm.CuttableWidth as Lebar,convert(varchar,pm.Note) as Alur,
			dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight,
			dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount,
			dep.DepartmentCode, dep.DepartmentName, pdep.DepartmentCode as RootDepartmentCode, pdep.DepartmentName as RootDepartmentName,
			dep.ID as deptID
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo,convert(char(10),sod.RequiredDate,103) as TglPerlu,
				pcb.ID as PCBID, pcb.DocumentNo as NoKK,convert(char(10),pcb.Dated,103) as TglKK, pcb.Gross as Bruto,
				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				
			from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID left join
				ProcessControlJO pcjo on sod.ID = pcjo.SODID left join
				ProcessControlBatches pcb on pcjo.PCID = pcb.PCID left join
				PCCardPosition pcblp on pcb.ID = pcblp.PCBID left join
				ProcessFlowProcessNo pfpn on pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID and pfpn.MachineType = 24 left join
				ProcessFlowDetailsNote pfdn on pfpn.EntryType = pfdn.EntryType and pfpn.ID = pfdn.ParentID
			where (so.PONumber='$nopo' or soda.RefNo='$nopo') and pcb.Gross<>'0' and pcblp.ID='$rowpre2[ID]'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sql2b = mssql_query($sql2) 
    or die('A error occured : ');
		//--
	//	$c=0;
	//	while ($row2=mssql_fetch_assoc($sql2b)){
	//	$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
	$row2=mssql_fetch_assoc($sql2b);
	
		//----cari salinan
			   $child=$row2[ChildLevel];
			
					if($child > 0){
						$sqlgetparent=mssql_query("select ID,LotNo from ProcessControlBatches where ID='$row2[RootID]' and ChildLevel='0'");
						$rowgp=mssql_fetch_assoc($sqlgetparent);
						
						//$nomLot=substr("$row2[LotNo]",0,1);
						$nomLot=$rowgp[LotNo];
						$nomorLot="$nomLot/K$row2[ChildLevel]&nbsp;";				
											
					}else{
						$nomorLot=$row2[LotNo];
							
					}
			  //--end salinan
			  
			$sqlkk=mssql_query("select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and CounterDepartmentID<>'$row2[DepartmentID]' order by Dated desc");
			$rowkk=mssql_fetch_row($sqlkk);
						
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td class='normal333' valign=top>$c</td>";
          //--lot
					  echo "<td class='normal333' valign=top>";
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='$row2[PCID]' and RootID='0' and LotNo < '1000'";
					  $qryLot = mssql_query($sqlLot) 
								or die('A error occured : ');
								
					  		$rowLot=mssql_fetch_assoc($qryLot);	
							echo "'$rowLot[TotalLot]-$nomorLot";
					  
					  echo "</td>";
					  //--
			//---POSISI SEBELUMnya
				
				$sqlpsb=mssql_query("Select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and Status ='0' and DepartmentID<>'$row2[DepartmentID]' order by Dated desc");
				$rowpsb=mssql_fetch_row($sqlpsb);
				
				$sqlkkpsb=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.DepartmentID  = dep.ID
where pcpos.ID='$rowpsb[0]' order by Dated desc");
		  $rowkkpsb=mssql_fetch_assoc($sqlkkpsb);		  
	
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='normal7black'>$rowkkpsb[DepOut]  <br>Out: $rowkkpsb[TglIn] $rowkkpsb[JamIn]</font></td>";
			
			//--end posisi sebelumnya
		  //--		  
		  //echo "tess :$rowkk[5]";
		  if ($rowkk[5]==0){ // =0 : out
		  //---1
		//  $sqlkk1=mssql_query("select top 1 ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition where PCBID='$row2[PCBID]' order by Dated desc");
		//	$rowkk1=mssql_fetch_assoc($sqlkk1);
		  //--
		  
							$sqlkk2=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.CounterDepartmentID  = dep.ID
where pcpos.ID='$rowkk[0]' order by Dated desc");
		  $rowkk2=mssql_fetch_assoc($sqlkk2);
		  
	//	  if ($rowkk1[PCBID]==$rowkk2[ID]){
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$row2[DepartmentName]<hr>Out:</font> <font class='normal7black'>$rowkk2[DepOut]  <br>$rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		//  }else{
        //  	echo "<td width='120' class='BoldCD6' align='center'><font class='blod9black'>$row2[DepartmentName]</font><br><font class='normal7black'>In: $rowkk1[TglIn] $rowkk1[JamIn]<br>Tujuan Out: $rowkk2[DepOut]  <br>$rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		//  }
		  //--
		  }elseif ($rowkk[5]<>0){ // =1 : in
		  	$sqlkk2=mssql_query("select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,DepartmentID  from PCCardPosition where ID='$rowkk[0]' order by Dated desc");
			$rowkk2=mssql_fetch_assoc($sqlkk2);
		//--warning	
			$cekTgl=$rowkk2[TglIn]; $cekDep=$rowkk2[DepartmentID];
			$pecah1 = explode("/", $cekTgl);
			$date1 = $pecah1[0];
			$month1 = $pecah1[1];
			$year1 = $pecah1[2];
			$pecah2 = explode("/", $row2[TglPerlu]);
			$date2 = $pecah2[0];
			$month2 = $pecah2[1];
			$year2 = $pecah2[2];
			$tglNow="$tanggal1/$tanggal2/$tanggal3";
			$now=strtotime(date("Y-m-d H:m:s"));
			$pecah3 = explode("/", $tglNow);
			$date3 = $pecah3[0];
			$month3 = $pecah3[1];
			$year3 = $pecah3[2];
			
				$jd1 = GregorianToJD($month1,$date1, $year1);
				//$new_jd1 = sprintf('%04d%02d%02d', $year1, $month1, $date1);
				$jd2 = GregorianToJD($month2,$date2,$year2);	
				//list($year, $month, $day) = explode('/', $row2[TglPerlu]);
				//$new_jd2 = sprintf('%04d%02d%02d', $year, $month, $day);
				$new_jd2="$year2-$month2-$date2 00:00:00";
				$new_jd2=strtotime($new_jd2);
				$jd3 = GregorianToJD($month3,$date3,$year3);
		//---
			echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$row2[DepartmentName]</font><hr><font class='normal7black'>In: $rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		  }
		  //--
		  //---setting
		  $sqlset=mssql_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  $cset=mssql_num_rows($sqlset);
		  if ($cset > 0 ){
		  	$rowset=mssql_fetch_assoc($sqlset);
				$sqlflow=mssql_query("select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='14' order by Dated desc");
				$cflow=mssql_num_rows($sqlflow);
				if ($cflow > 0 ){
					$rowflow=mssql_fetch_assoc($sqlflow);
						$sqlmsn="select 
		lt.ID, lt.ParentID, lt.MachineType,  
		dv.ValueI as ID1, dv.ValueD as Value1, dv.UnitID as UnitID1, dv.UnitMultiplier as UnitMultiplier1, 1 as ColVis1, 
		isnull(d.FormID,0) as FormID, isnull(md.Description,'''') as Description,ud.UnitName 
	from 
		ProcessFlowDetails lt inner join 
		ProcessFlowDetailsValues dv on lt.ID = dv.ParentID left join 
		MachineReadingSetting d on lt.MachineType = d.MachineType and lt.LineID = d.LineID left join 
		MachineReadingDescription md on d.DescriptionID = md.ID left join
		UnitDescription ud on dv.UnitID=ud.ID
	where lt.MachineType='14' and lt.ParentID ='$rowflow[ID]' and (md.Description='Machine No.' or md.Description='Overfeed' or md.Description='Speed' or md.Description='Temperature')
	order by 
		md.Description";
		
						$qrymsn=mssql_query($sqlmsn);
						$ketsetting="$rowflow[TglF] $rowflow[JamF]<br>";
						while ($rowmsn=mssql_fetch_assoc($qrymsn)){
						$val="".number_format($rowmsn[Value1],1)."";
							$ketsetting="$ketsetting $rowmsn[Description] : $val $rowmsn[UnitName] <br>";
						}
						
					
				}
		  
		  }
		  //--end setting
          echo "<td width='100' class='normal333' valign=top>$row2[ColorNo]</td>";
          echo "<td width='150' class='normal333' valign=top>$row2[Color]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Lebar],0). " inch</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Gramasi],0). " gr/m2</td>";
          echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Quantity],2). " $row2[UnitName]</td>";
		  echo "<td width='80' class='normal333' valign=top align=center>$row2[RollCount]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Weight],2). " Kg</td>";
		//---warning
		 if($now > $new_jd2)
		 {
		 	if ($cekDep==60){
				$selisih=$jd2 - $jd1;
				if ($selisih < 0){
					$selisih=abs($selisih);
					echo "<td width='140' class='normal333' valign=top>'$row2[TglPerlu]";
					echo "<br><font color=red><strong>Delay $selisih hari</stong></font>";
				}else{
					echo "<td width='140' class='normal333' valign=top>'$row2[TglPerlu]";
				}
			}else{
				$selisih=$jd3 - $jd2;
				$selisih=abs($selisih);
				echo "<td width='140' class='normal333' valign=top bgcolor='#FFFF00'>'$row2[TglPerlu]";
				echo "<br><font class='normal333blink'><Blink>Delay $selisih hari</Blink></font>";
			}
		 }else{
		 		$selisih=$jd3-$jd2;
				$selisih=abs($selisih);
		 	echo "<td width='120' class='normal333' valign=top>'$row2[TglPerlu] <br><br><strong>$selisih hari lagi</strong>";
		 }
		 		
		   echo "</td>";
		//---
          echo "<td width='120' class='normal333' valign=top>$row2[ProductNumber]";
		  
		  $ketsetting="";
   

		  $sqlset=mssql_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  $cset=mssql_num_rows($sqlset);
		  if ($cset > 0 ){		  
		  
		  	$rowset=mssql_fetch_assoc($sqlset);
				$sqlflow=mssql_query("select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='14' order by Dated desc");
				$cflow=mssql_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=mssql_fetch_assoc($sqlflow);
				echo "<hr>";
				$ketsetting="$rowflow[TglF] $rowflow[JamF]<br>";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=mssql_query("select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1499001'");
					$rownomes=mssql_fetch_assoc($sqlnomes);
					
					$sqlnomes2=mssql_query("select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='$rownomes[ID]'");
					$rownomes2=mssql_fetch_assoc($sqlnomes2);
					
					$sqlgnomes=mssql_query("select ID,Code,Description,MachineType from Machines where ID='$rownomes2[ValueI]'");
					$cgnomes=mssql_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=mssql_fetch_assoc($sqlgnomes);
						$ketsetting="$ketsetting $rowgnomes[Description]<br>";
					}
					//--
					//--cari speed
					$sqlspeed=mssql_query("select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401002'");
					$rowspeed=mssql_fetch_assoc($sqlspeed);
					
					$sqlspeed2=mssql_query("select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowspeed[ID]'");
					
					$cspeed=mssql_num_rows($sqlspeed2);
					
					if ($cspeed > 0){
						$rowspeed2=mssql_fetch_assoc($sqlspeed2);
						$ketsetting="$ketsetting Speed:" .number_format($rowspeed2[ValueD],2). " $rowspeed2[UnitName]<br>";
					}
					//--
					//--cari temperatur
					$sqltemp=mssql_query("select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401003'");
					$rowtemp=mssql_fetch_assoc($sqltemp);
					
					$sqltemp2=mssql_query("select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowtemp[ID]'");
					
					$ctemp=mssql_num_rows($sqltemp2);
					
					if ($ctemp > 0){
						$rowtemp2=mssql_fetch_assoc($sqltemp2);
						$ketsetting="$ketsetting suhu:" .number_format($rowtemp2[ValueD],2). " $rowtemp2[UnitName]<br>";
					}
					//--
					//--cari overfeed
					$sqlover=mssql_query("select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401004'");
					$rowover=mssql_fetch_assoc($sqlover);
					
					$sqlover2=mssql_query("select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowover[ID]'");
					
					$cover=mssql_num_rows($sqlover2);
					
					if ($cover > 0){
						$rowover2=mssql_fetch_assoc($sqlover2);
						$ketsetting="$ketsetting overfeed:" .number_format($rowover2[ValueD],1). " $rowover2[UnitName]<br>";
					}
					//--				
						
				}
		  
		  }
		  //--end setting
		  echo "<font size=0.1>$ketsetting</font></td>";
          echo "<td class='normal333' valign=top>$row2[ProductDesc]</td>";
		   echo "<td width='120' class='normal333' valign=top>$row2[Alur]</td>";
		  echo "<td width='120' class='normal333' valign=top>'<a href='logscan.php?kk=$row2[PCBID]' target=_blank>$row2[NoKK]</a><br>$row2[TglKK]</td>";
		  //---Dept Note
		  $sqlcarinotePCB=mssql_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  
		  $rowcarinotePCB=mssql_fetch_assoc($sqlcarinotePCB);
		  
		  $sqlcarinotePFPN=mssql_query("select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowcarinotePCB[ID]' order by Dated desc");
		  
		  $rowcarinotePFPN=mssql_fetch_assoc($sqlcarinotePFPN);
		  
		  $sqlcarinotePFDN=mssql_query("select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Note  from ProcessFlowDetailsDeptNote where DepartmentID='$row2[deptID]' and ParentID ='$rowcarinotePFPN[ID]'");
		  
		  $rowcarinotePFDN=mssql_fetch_assoc($sqlcarinotePFDN);
		  
		  		  
		  //--end Dept Note
		  $catatandept=$rowcarinotePFDN[Note];
		  echo "<td class='normal333' valign=top>$catatandept</td>";
        echo "</tr>";

} //-------------------------------end jika KK sudah keluar       
		}
     echo "</table>";

			}else{
				echo "<br><br><font class='normal9black'>Nomor Bon Order : $nobo , TIDAK ditemukan !</font>";	
			}
	//--
	mssql_free_result($sql);
	mssql_close($conn);
	//--
}else{
//---proses filter by customer
//echo "proses customer <br>";
$range=$_POST['range'];


		$tgldateDel=$_POST['tgldateDel']; $tglmonthDel=$_POST['tglmonthDel']; $tglyearDel=$_POST['tglyearDel'];
		$tgldateDelB=$_POST['tgldateDelB']; $tglmonthDelB=$_POST['tglmonthDelB']; $tglyearDelB=$_POST['tglyearDelB'];
		if ($range=="tglorder"){
			if ($tgldateDel<>"" && $tglmonthDel<>"" && $tglyearDel<>""){
				$tglDel="$tglyearDel-$tglmonthDel-$tgldateDel 00:00:00";
				$tglDisplay="$tgldateDel/$tglmonthDel/$tglyearDel";
			}else{
				$tglDel="0000-00-00";
				$tglDisplay=" - ";
			}
		}else{
			if ($tgldateDelB<>"" && $tglmonthDelB<>"" && $tglyearDelB<>""){
				$tglDel="$tglyearDelB-$tglmonthDelB-$tgldateDelB 00:00:00";
				$tglDisplay="$tgldateDelB/$tglmonthDelB/$tglyearDelB";
			}else{
				$tglDel="0000-00-00";
				$tglDisplay=" - ";
			}
		}
		
		$tgldateDel2=$_POST['tgldateDel2']; $tglmonthDel2=$_POST['tglmonthDel2']; $tglyearDel2=$_POST['tglyearDel2'];
		$tgldateDel2B=$_POST['tgldateDel2B']; $tglmonthDel2B=$_POST['tglmonthDel2B']; $tglyearDel2B=$_POST['tglyearDel2B'];
		if ($range=="tglorder"){
			if ($tgldateDel2<>"" && $tglmonthDel2<>"" && $tglyearDel2<>""){
				$tglDel2="$tglyearDel2-$tglmonthDel2-$tgldateDel2 23:59:59";
				$tglDisplay2="$tgldateDel2/$tglmonthDel2/$tglyearDel2";
			}else{
				$tglDel2="0000-00-00";
				$tglDisplay2=" - ";
			}
		}else{
			if ($tgldateDel2B<>"" && $tglmonthDel2B<>"" && $tglyearDel2B<>""){
				$tglDel2="$tglyearDel2B-$tglmonthDel2B-$tgldateDel2B 23:59:59";
				$tglDisplay2="$tgldateDel2B/$tglmonthDel2B/$tglyearDel2B";
			}else{
				$tglDel2="0000-00-00";
				$tglDisplay2=" - ";
			}
		}
		
If($range=="tglorder"){
$filtertgl="so.SODate between '$tglDel' and '$tglDel2'";
$notefilter="Order";
}else{
$filtertgl="sod.RequiredDate between '$tglDel' and '$tglDel2'";
$notefilter="Dibutuhkan";
}
		
	$sqlcust=mssql_query("Select ID,PartnerNumber,CompanyTitle,PartnerName,Address,City,Province,CountryID,PostalCode,PhoneNumber,FaxNumber,Email from Partners where ID='$codcust'");
	$rcust=mssql_fetch_assoc($sqlcust);
	$sqlcon=mssql_query("Select ID,CountryName from Countries where ID='$rcust[CountryID]'");
		$rcon=mssql_fetch_assoc($sqlcon);
		

$sql0b="select top 1
			x.*, 
			udq.UnitName, udq.DetailDigits,
			udw.UnitName as WeightUnitName, udw.DetailDigits as WeightDigits,
			udb.UnitName as BatchUnitName, udb.DetailDigits as BatchDigits,
			cust.PartnerNumber as CustomerNumber, cust.CompanyTitle as CustomerTitle, cust.PartnerName as CustomerName,
			buy.PartnerNumber as BuyerNumber, buy.CompanyTitle as BuyerTitle, buy.PartnerName as BuyerName,
			pm.ProductNumber, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
			pm.Weight as Gramasi,pm.CuttableWidth as Lebar,convert(varchar,pm.Note) as Alur,
			dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight,
			dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount,
			dep.DepartmentCode, dep.DepartmentName, pdep.DepartmentCode as RootDepartmentCode, pdep.DepartmentName as RootDepartmentName
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo,convert(char(10),sod.RequiredDate,103) as TglPerlu,
				pcb.ID as PCBID, pcb.DocumentNo as NoKK,convert(char(10),pcb.Dated,103) as TglKK, pcb.Gross as Bruto,
				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				
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
			where so.CustomerID='$codcust' and $filtertgl and pcb.Gross<>'0' --so.SODate between '$tglDel' and '$tglDel2'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sqlb = mssql_query($sql0b) 
    or die('A error occured :0');
 
$count = mssql_num_rows($sqlb);

			if ($count > 0 ){
			$row=mssql_fetch_assoc($sqlb);
			echo "<font class='blod9black'>Hasil Pencarian <br><br>";
			echo "<font class='blod9black'>Range Tanggal $notefilter : $tglDisplay s.d. $tglDisplay2</font><br><br>";
			
			echo "<table width='100%' border='0'>";
      echo "<tr>";
        echo "<td width='100' align='left' valign='middle' class='normal9black'>&nbsp;</td>";
        echo "<td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
      echo "</tr>";
	   echo " <tr>";
        echo "<td align='left' valign='middle' class='normal9black'>Buyer</td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $row[BuyerNumber] / $row[BuyerName], $row[BuyerTitle]</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td align='left' valign='middle' class='normal9black'>Customer</td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $rcust[PartnerNumber] / $rcust[PartnerName], $rcust[CompanyTitle]</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td align='left' valign='top' class='normal9black'>Alamat </td>";
        echo "<td align='left' valign='middle' class='normal9black'>:  $rcust[Address]<br>$rcust[City], $rcust[Province] $rcon[CountryName] (ZIP Code : $rcust[PostalCode])</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td align='left' valign='middle' class='normal9black'>Phone </td>";
       echo " <td align='left' valign='middle' class='normal9black'>: $rcust[PhoneNumber]</td>";
      echo "</tr>";
     echo " <tr>";
        echo "<td align='left' valign='middle' class='normal9black'>Fax</td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $rcust[FaxNumber]</td>";
      echo "</tr>";
      echo "<tr>";
        echo "<td align='left' valign='middle' class='normal9black'>Email</td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $rcust[Email]</td>";
     echo " </tr>";
     echo " <tr>";
      echo "  <td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
      echo "  <td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
     echo " </tr>";
      
     echo " <tr>";
      echo "  <td align='left' valign='middle' class='normal9black'>Detail</td>";
     echo "   <td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
     echo " </tr>";
      
    echo "</table>";
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	  echo "<td class='tombol'><div align='center'>No. </div></td>";
	   echo "<td class='tombol'><div align='center'>Tgl Order</div></td>";
	    echo "<td class='tombol'><div align='center'>No Bon Order</div></td>";
      echo "<td class='tombol'><div align='center'>No LOT</div></td>";
	   		echo "<td class='tombol'><div align='center'>Posisi Sebelumnya </div></td>";
          echo "<td class='tombol'><div align='center'>Posisi Terakhir </div></td>";
          echo "<td class='tombol'><div align='center'>No Warna </div></td>";
          echo "<td class='tombol'><div align='center'>Warna</div></td>";
		  echo "<td class='tombol'><div align='center'>Lebar</div></td>";
		   echo "<td class='tombol'><div align='center'>Gramasi</div></td>";
          echo "<td class='tombol'><div align='center'>Nett QTY Order</div></td>";
		  echo "<td class='tombol'><div align='center'>Roll</div></td>";
		  echo "<td class='tombol'><div align='center'>Bruto BagiKain</div></td>";
		   echo "<td class='tombol'><div align='center'>Tgl Dibutuhkan /Delivery</div></td>";
          echo "<td class='tombol'><div align='center'>Product Number </div></td>";
          echo "<td class='tombol'><div align='center'>Product Description </div></td>";
		  echo "   <td class='tombol'><div align='center'>Alur Proses </div></td>";
		  echo "   <td class='tombol'><div align='center'>No Kartu Kerja </div></td>";
		  echo "   <td class='tombol'><div align='center'>Dept. Note </div></td>";
		  
        echo "</tr>";
		//--
		$sql2="select
			x.*, 
			udq.UnitName, udq.DetailDigits,
			udw.UnitName as WeightUnitName, udw.DetailDigits as WeightDigits,
			udb.UnitName as BatchUnitName, udb.DetailDigits as BatchDigits,
			cust.PartnerNumber as CustomerNumber, cust.CompanyTitle as CustomerTitle, cust.PartnerName as CustomerName,
			buy.PartnerNumber as BuyerNumber, buy.CompanyTitle as BuyerTitle, buy.PartnerName as BuyerName,
			pm.ProductNumber, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
			pm.Weight as Gramasi,pm.CuttableWidth as Lebar,convert(varchar,pm.Note) as Alur,
			dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight,
			dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount,
			dep.DepartmentCode, dep.DepartmentName, pdep.DepartmentCode as RootDepartmentCode, pdep.DepartmentName as RootDepartmentName,
			dep.ID as deptID
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo,convert(char(10),sod.RequiredDate,103) as TglPerlu,
				pcb.ID as PCBID, pcb.DocumentNo as NoKK,convert(char(10),pcb.Dated,103) as TglKK, pcb.Gross as Bruto,
				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				
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
			where so.CustomerID='$codcust' and $filtertgl and pcb.Gross<>'0' --so.SODate between '$tglDel' and '$tglDel2'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sql2b = mssql_query($sql2) 
    or die('A error occured : 1');
		//--
		$c=0;
		while ($row2=mssql_fetch_assoc($sql2b)){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
		if($child > 0){
			$nomLot=substr("$row2[LotNo]",0,1);
			$nomorLot="$nomLot/K$row2[ChildLevel]&nbsp;";				
								
		}else{
			$nomorLot=$row2[LotNo];
				
		}
			$sqlkk=mssql_query("select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and CounterDepartmentID<>'$row2[DepartmentID]' order by Dated desc");
			$rowkk=mssql_fetch_row($sqlkk);
						
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td class='normal333' valign=top>$c</td>";
		 echo "<td class='normal333' valign=top>$row2[TglSO]</td>";
		  echo "<td class='normal333' valign=top>$row2[DocumentNo]</td>";
          //--lot
					  echo "<td class='normal333' valign=top>";
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='$row2[PCID]' and RootID='0' and LotNo < '1000'";
					  $qryLot = mssql_query($sqlLot) 
								or die('A error occured : ');
								
					  		$rowLot=mssql_fetch_assoc($qryLot);	
							echo "'$rowLot[TotalLot]-$nomorLot";
					  
					  echo "</td>";
					  //--
			//---POSISI SEBELUMnya
				
				$sqlpsb=mssql_query("Select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and Status ='0' and DepartmentID<>'$row2[DepartmentID]' order by Dated desc");
				$rowpsb=mssql_fetch_row($sqlpsb);
				
				$sqlkkpsb=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.DepartmentID  = dep.ID
where pcpos.ID='$rowpsb[0]' order by Dated desc");
		  $rowkkpsb=mssql_fetch_assoc($sqlkkpsb);		  
	
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='normal7black'>$rowkkpsb[DepOut]  <br>Out: $rowkkpsb[TglIn] $rowkkpsb[JamIn]</font></td>";
			
			//--end posisi sebelumnya
		  //--		  
		 
		  if ($rowkk[5]==0){ // =0 : out

		  
							$sqlkk2=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.CounterDepartmentID  = dep.ID
where pcpos.ID='$rowkk[0]' order by Dated desc");
		  $rowkk2=mssql_fetch_assoc($sqlkk2);
		  
	
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$row2[DepartmentName]<hr>Out:</font> <font class='normal7black'>$rowkk2[DepOut]  <br>$rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		
		  }elseif ($rowkk[5]<>0){ // =1 : in
		  	$sqlkk2=mssql_query("select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition where ID='$rowkk[0]' order by Dated desc");
			$rowkk2=mssql_fetch_assoc($sqlkk2);
			echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$row2[DepartmentName]</font><hr><font class='normal7black'>In: $rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		  }
		  //--
          echo "<td width='100' class='normal333' valign=top>$row2[ColorNo]</td>";
			
          echo "<td width='150' class='normal333' valign=top>$row2[Color0]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Lebar],0). " inch</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Gramasi],0). " gr/m2</td>";
          echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Quantity],2). " $row2[UnitName]</td>";
		  echo "<td width='80' class='normal333' valign=top align=center>$row2[RollCount]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Weight],2). " Kg</td>";
		   echo "<td width='120' class='normal333' valign=top>'$row2[TglPerlu]</td>";
          echo "<td width='120' class='normal333' valign=top>$row2[ProductNumber]";
		  
		  $ketsetting="";
   

		  $sqlset=mssql_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  $cset=mssql_num_rows($sqlset);
		  if ($cset > 0 ){		  
		  
		  	$rowset=mssql_fetch_assoc($sqlset);
				$sqlflow=mssql_query("select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='14' order by Dated desc");
				$cflow=mssql_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=mssql_fetch_assoc($sqlflow);
				echo "<hr>";
				$ketsetting="$rowflow[TglF] $rowflow[JamF]<br>";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=mssql_query("select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1499001'");
					$rownomes=mssql_fetch_assoc($sqlnomes);
					
					$sqlnomes2=mssql_query("select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='$rownomes[ID]'");
					$rownomes2=mssql_fetch_assoc($sqlnomes2);
					
					$sqlgnomes=mssql_query("select ID,Code,Description,MachineType from Machines where ID='$rownomes2[ValueI]'");
					$cgnomes=mssql_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=mssql_fetch_assoc($sqlgnomes);
						$ketsetting="$ketsetting $rowgnomes[Description]<br>";
					}
					//--
					//--cari speed
					$sqlspeed=mssql_query("select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401002'");
					$rowspeed=mssql_fetch_assoc($sqlspeed);
					
					$sqlspeed2=mssql_query("select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowspeed[ID]'");
					
					$cspeed=mssql_num_rows($sqlspeed2);
					
					if ($cspeed > 0){
						$rowspeed2=mssql_fetch_assoc($sqlspeed2);
						$ketsetting="$ketsetting Speed:" .number_format($rowspeed2[ValueD],2). " $rowspeed2[UnitName]<br>";
					}
					//--
					//--cari temperatur
					$sqltemp=mssql_query("select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401003'");
					$rowtemp=mssql_fetch_assoc($sqltemp);
					
					$sqltemp2=mssql_query("select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowtemp[ID]'");
					
					$ctemp=mssql_num_rows($sqltemp2);
					
					if ($ctemp > 0){
						$rowtemp2=mssql_fetch_assoc($sqltemp2);
						$ketsetting="$ketsetting suhu:" .number_format($rowtemp2[ValueD],2). " $rowtemp2[UnitName]<br>";
					}
					//--
					//--cari overfeed
					$sqlover=mssql_query("select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401004'");
					$rowover=mssql_fetch_assoc($sqlover);
					
					$sqlover2=mssql_query("select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowover[ID]'");
					
					$cover=mssql_num_rows($sqlover2);
					
					if ($cover > 0){
						$rowover2=mssql_fetch_assoc($sqlover2);
						$ketsetting="$ketsetting overfeed:" .number_format($rowover2[ValueD],1). " $rowover2[UnitName]<br>";
					}
					//--				
						
				}
		  
		  }
		  //--end setting
		  echo "<font size=0.1>$ketsetting</font></td>";

          echo "<td class='normal333' valign=top>$row2[ProductDesc]</td>";
		   echo "<td width='120' class='normal333' valign=top>$row2[Alur]</td>";
		  echo "<td width='120' class='normal333' valign=top>'$row2[NoKK]<br>$row2[TglKK]</td>";
		  //---Dept Note
		  $sqlcarinotePCB=mssql_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  
		  $rowcarinotePCB=mssql_fetch_assoc($sqlcarinotePCB);
		  
		  $sqlcarinotePFPN=mssql_query("select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowcarinotePCB[ID]' order by Dated desc");
		  
		  $rowcarinotePFPN=mssql_fetch_assoc($sqlcarinotePFPN);
		  
		  $sqlcarinotePFDN=mssql_query("select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Note  from ProcessFlowDetailsDeptNote where DepartmentID='$row2[deptID]' and ParentID ='$rowcarinotePFPN[ID]'");
		  
		  $rowcarinotePFDN=mssql_fetch_assoc($sqlcarinotePFDN);
		  
		  		  
		  //--end Dept Note
		  $catatandept=$rowcarinotePFDN[Note];
		  echo "<td class='normal333' valign=top>$catatandept</td>";
        echo "</tr>";
        
		}
     echo "</table>";

			}else{
				echo "<br><br><font class='normal9black'>Data TIDAK ditemukan !</font>";	
			}
	//--
	mssql_free_result($sql);
	mssql_close($conn);
	
//-------end Proses customer
}
//--
}
?></td>
                  </tr>
                  <tr>
                    <td class="normal9black">&nbsp;</td>
                  </tr>
              </table>
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