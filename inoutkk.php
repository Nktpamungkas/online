<?php

$host="10.0.0.4";
//$host="DIT\MSSQLSERVER08";
$username="sa";
$password="ditbin";
$db_name="TM";
//--
$act=$_POST['act'];
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
					<a href="infobruto.php">Info Bruto </a>				</li>
				<li  class="selected">
					<a href="inoutkk.php">In / Out KK  </a>				</li>
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
                            <td colspan="2" class="boldCD6">&nbsp;</td>
                          </tr>
                          
                          <tr>
                            <td width="110" class="blod9black">&nbsp;</td>
                            <td class="normal9black"><input name="nokk" type="hidden" class="normal9black" id="nokk" value="" /></td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black"></td>
                          </tr>
                          <tr>
                            <td class="blod9black">No Bon Order </td>
                            <td class="normal9black"><input name="nobo" type="text" class="normal9black" id="nobo" size="25" /></td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black"><input name="act" type="hidden" id="act" value="cari" /></td>
                          </tr>
                          <tr>
                            <td class="blod9black">Departemen</td>
                            <td class="normal9black"><select name="dep" class="normal9black" id="dep">
							 <?php
							 //--
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	//--
						  		echo "<option value='' selected></option>";
								$sqldep=mssql_query("select ID,ParentID,DepartmentName from Departments where ParentID <> '0' order by ParentID,ID");
								while($rjenis=mssql_fetch_assoc($sqldep)){									
									echo "<option value=$rjenis[ID]>$rjenis[DepartmentName]</option>";
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
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	//--

$nokk=trim(strip_tags($_POST['nokk']));
$nobo=trim(strip_tags($_POST['nobo']));
if ($nokk <> ''){

$sql0="select pcb.ID as PCBID, pcb.DocumentNo as BatchNo, 
				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID,  pcb.ProductionScheduledDate,
				pcblp.DepartmentID,dept.DepartmentName as DepName,unit.UnitName as UnName, convert(char(10),pcb.ScheduledDate,103) as Jadwal
from				
				ProcessControlBatches pcb left join
				ProcessControlBatchesLastPosition pcblp on pcb.ID = pcblp.PCBID left join
				Departments dept on pcblp.DepartmentID=dept.ID left join
				UnitDescription unit on pcb.UnitID=unit.ID
where pcb.DocumentNo='$nokk'";

$sql = mssql_query($sql0) 
    or die('A error occured : ');
 
$count = mssql_num_rows($sql);

		if ($count > 0 ){
			$row=mssql_fetch_assoc($sql);
			echo "Hasil Pencarian : (". date("d/m/y") .")<br><br>";
			echo "No KK           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: $row[BatchNo] <br>";
			echo "QTY            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: " .number_format($row[BatchQuantity],2). " $row[UnName] <br>";
			echo "Jadwal Celup    &nbsp;: $row[Jadwal] <br>";
			echo "Posisi terakhir : $row[DepName]";

			}else{
				echo "Nomor KK : $nokk , TIDAK ditemukan";	
			}
	//--
	mssql_free_result($sql);
	mssql_close($conn);
	//--
}else{
//echo "No Bon ORder";
//--
$dep=$_POST['dep'];
$sql0="select
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
			--where jo.DocumentNo='$nobo'
			where so.SODate between '2013-08-01 00:00:00' and '2013-08-20 00:00:00'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
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
			where dep.ID='$dep'
			order by
				x.SODID, x.PCBID";

$sql = mssql_query($sql0) 
    or die('A error occured : ');
 
$count = mssql_num_rows($sql);

			if ($count > 0 ){
			$row=mssql_fetch_assoc($sql);
			$sqlDep0="select ID,ParentID,DepartmentName from Departments where ID='$dep'";			
			$sqlDep = mssql_query($sqlDep0) ;
			$rowDepA=mssql_fetch_assoc($sqlDep);
			$subDep=$rowDepA[DepartmentName]; $parID=$rowDepA[ParentID];
			
			$sqlDep1="select ID,ParentID,DepartmentName from Departments where ID='$parID'";			
			$sqlDepB = mssql_query($sqlDep1) ;
			$rowDepB=mssql_fetch_assoc($sqlDepB);
			$ParentDep=$rowDepB[DepartmentName];
			
			echo "Hasil Pencarian Departemen : $ParentDep - $subDep<br><br>";

			/*echo "<table width='100%' border='0'>";
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
       echo " <td align='left' valign='middle' class='normal9black'>: $row[PONumber]</td>";
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
      
    echo "</table>";*/
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	  echo "   <td class='tombol'><div align='center'>No BOn ORder </div></td>";
       echo "   <td class='tombol'><div align='center'>No Kartu Kerja </div></td>";
          echo "<td class='tombol'><div align='center'>KK IN</div></td>";
		  echo "<td class='tombol'><div align='center'>KK OUT</div></td>";
          echo "<td class='tombol'><div align='center'>No Warna </div></td>";
          echo "<td class='tombol'><div align='center'>Warna</div></td>";
          echo "<td class='tombol'><div align='center'>Nett QTY </div></td>";
		  echo "<td class='tombol'><div align='center'>Bruto </div></td>";
          echo "<td class='tombol'><div align='center'>Product Number </div></td>";
          echo "<td class='tombol'><div align='center'>Product Description </div></td>";
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
			dep.DepartmentCode, dep.DepartmentName, pdep.DepartmentCode as RootDepartmentCode, pdep.DepartmentName as RootDepartmentName
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo,
				pcb.ID as PCBID, pcb.DocumentNo as NoKK, pcb.Gross as Bruto,
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
			--where jo.DocumentNo='$nobo'
			where so.SODate between '2013-08-01 00:00:00' and '2013-08-20 00:00:00'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
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
			where dep.ID='$dep'
			order by
				x.SODID desc, x.PCBID";

$sql2b = mssql_query($sql2) 
    or die('A error occured : ');
		//--
		$c=0;
		while ($row2=mssql_fetch_assoc($sql2b)){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
			
						
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td width='120' class='normal333'>$row2[DocumentNo]</td>";
          echo "<td width='120' class='normal333'>$row2[NoKK]</td>";
		  //--		  
		  //echo "tess :$rowkk[5]";
		  //----in
		  $sqlkk=mssql_query("select * from PCCardPosition where PCBID='$row2[PCBID]' and Status='1' order by Dated DESC");	
			$inoutIN="";
		  while ($rowkk=mssql_fetch_assoc($sqlkk)){
		  		//$rowkk=mssql_fetch_row($sqlkk);
			 
				$sqlkk2=mssql_query("select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition where ID='$rowkk[ID]' order by Dated");
				$rowkk2=mssql_fetch_assoc($sqlkk2);
				$inoutIN="$inoutIN $rowkk2[TglIn] $rowkk2[JamIn]|";
		  }
		  echo "<td width='120' class='BoldCD6' align='center'><font class='normal7black'>$inoutIN</font></td>";
		  //---
		  
		  //--Out
		  $sqlkkO=mssql_query("select * from PCCardPosition where PCBID='$row2[PCBID]' and Status='0' order by Dated DESC");
			$inoutOut="";
			 while ($rowkkO=mssql_fetch_assoc($sqlkkO)){
						$sqlkk2b=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
	left join
	Departments dep on pcpos.CounterDepartmentID  = dep.ID
	where pcpos.ID='$rowkkO[ID]' order by Dated desc");
			  $rowkk2b=mssql_fetch_assoc($sqlkk2b);
			  $InoutOUT="$InoutOUT $rowkk2b[TglIn] $rowkk2b[JamIn] | "; // to $rowkk2b[DepOut] |";
			  //echo "<td width='120' class='BoldCD6' align='center'>$row2[DepartmentName]<br><font class='normal7black'>Tujuan Out: $rowkk2[DepOut]  <br>$rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
			  //--
			  }		  
		  
		  echo "<td width='120' class='BoldCD6' align='center'><font class='normal7black'>$InoutOUT</font></td>";
		  //--
          echo "<td width='100' class='normal333'>$row2[ColorNo]</td>";
          echo "<td width='150' class='normal333'>$row2[Color]</td>";
          echo "<td width='80' class='normal333'>" .number_format($row2[Quantity],2). " $row2[UnitName]</td>";
		   echo "<td width='80' class='normal333'>" .number_format($row2[Bruto],2). " $row2[UnitName]</td>";
          echo "<td width='120' class='normal333'>$row2[ProductNumber]</td>";
          echo "<td class='normal333'>$row2[ProductDesc]</td>";
        echo "</tr>";
        
		}
     echo "</table>";

			}else{
				echo "<br><br><font class='normal9black'>Nomor Bon Order : $nobo , TIDAK ditemukan !</font>";	
			}
	//--
	mssql_free_result($sql);
	mssql_close($conn);
	//--
}
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