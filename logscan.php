<?php
ini_set("error_reporting", 1);
include "koneksi.php";
//--
$idkk=$_GET['kk'];

//-
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Log Masuk Keluar KK :: online system</title>
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
                    <td><span class="boldCD6">DATA LOG SCAN IN/OUT KARTU KERJA</span></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="normal9black"><?php
   
	//--
	set_time_limit(600);
	//$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//sqlsrv_select_db($db_name) or die ("Under maintenance");
	//--
$sql="select
			x.SONumber,x.TglSO,x.PONumber,x.DocumentNo,x.Quantity,udq.UnitName,x.PCBID,x.PCID,x.NoKK,x.LotNo,x.TglKK,x.Bruto, 
			udw.UnitName as WeightUnitName, x.ChildLevel,x.RootID,
			cust.PartnerNumber as CustomerNumber, cust.CompanyTitle as CustomerTitle, cust.PartnerName as CustomerName,
			buy.PartnerNumber as BuyerNumber, buy.CompanyTitle as BuyerTitle, buy.PartnerName as BuyerName,
			pm.ProductNumber, pm.Description as ProductDesc, pm.ColorNo, pm.Color
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,103) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo,
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
			where pcb.ID='$idkk'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,pcb.Dated,
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
				x.SODID desc, x.PCBID";
				 //--lot
$qry=sqlsrv_query($conn,$sql, array(), array("Scrollable"=>"buffered"));
$row=sqlsrv_fetch_array($qry,SQLSRV_FETCH_ASSOC);

		$child=$row['ChildLevel'];
		
		if($child > 0){
			$sqlgetparent=sqlsrv_query($conn,"select ID,LotNo from ProcessControlBatches where ID='".$row['RootID']."' and ChildLevel='0'", array(), array("Scrollable"=>"buffered"));
			$rowgp=sqlsrv_fetch_array($sqlgetparent,SQLSRV_FETCH_ASSOC);
			
			//$nomLot=substr("$row2[LotNo]",0,1);
			$nomLot=$rowgp['LotNo'];
			$nomorLot="$nomLot/K".$row['ChildLevel']."&nbsp;";				
								
		}else{
			$nomorLot=$row['LotNo'];
				
		}
					
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='".$row['PCID']."' and LotNo < '1000'";
					  $qryLot = sqlsrv_query($conn,$sqlLot, array(), array("Scrollable"=>"buffered")) 
								or die('A error occured : ');
								
					  		$rowLot=sqlsrv_fetch_array($qryLot,SQLSRV_FETCH_ASSOC);	
						$lotnya="".$rowLot['TotalLot']."-$nomorLot";
					  
					
					  //--

echo "<table>";
echo "<tr><td>No Kartu Kerja / Lot </td><td>: ".$row['NoKK']." / $lotnya </td></tr>";
echo "<tr><td>Kode Produk </td><td>: ".$row['ProductNumber']." </td></tr>";
echo "<tr><td>Warna </td><td>: ".$row['Color']." </td></tr>";
echo "<tr><td>No Order </td><td>: ".$row['DocumentNo']." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>-> <a href='../lab/recipe.php?g=1&kk=".$row['NoKK']."'>BON RESEP</a> </strong></td></tr>";
echo"</table>";
echo "<hr>";		
     echo " <table width='50%' border='0'>";
      echo "  <tr>";
	  echo "   <td class='tombol'><div align='center'>No. </div></td>";
	 
	  echo "   <td class='tombol'><div align='center'>Tanggal Jam </div></td>";
	  echo "   <td class='tombol'><div align='center'>Status </div></td>";
       
	   echo "   <td class='tombol'><div align='center'>IN Dept </div></td>";
          echo "<td class='tombol'><div align='center'>OUT ke Dept</div></td>";
		  
        echo "</tr>";
		
		
//--
				
$sql2="select convert(char(10),p.Dated,103) as Tgl,convert(char(10),p.Dated,108) as Jam,p.PCBID,p.Status,d.DepartmentName as DepIn,d2.DepartmentName as DepOut from PCCardPosition p left join 
Departments d on d.ID=p.DepartmentID left join
Departments d2 on d2.ID=p.CounterDepartmentID
where p.PCBID='$idkk'
order by p.ID";
//order by p.Dated,d.DepIn,p.Status desc";

$sql2b = sqlsrv_query($conn,$sql2, array(), array("Scrollable"=>"buffered")) or die('A error occured : ');
		//--
		$c=0;
		while ($row2=sqlsrv_fetch_array($sql2b,SQLSRV_FETCH_ASSOC)){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
			
						
        echo "<tr bgcolor='$bgcolor'>";
		echo "   <td class='normal333'  valign=top>$c</td>";

	  echo "   <td class='normal333'  valign=top>".$row2['Tgl']."_".$row2['Jam']."</td>";
	  
	  if ($row2['Status']==1){
	  	$stat="IN";
	  }else{
	  	$stat="OUT";
	  }
		echo "<td class='normal333'  valign=top>$stat</td>";
		
	//	echo "<td width='120' class='normal333'  valign=top><a href='order.php?bin=$row2[DocumentNo]' target=_blank>$row2[DocumentNo]</a></td>";
          
		 
		  echo "<td class='normal333' valign=top>".$row2['DepIn']."</td>";
		  echo "<td class='normal333' valign=top>".$row2['DepOut']."</td>";
        echo "</tr>";
        
		}
		
		//echo "<tr><td>$c</td><td></td><td></td><td></td><td>---</td></tr>";
     echo "</table>";
	

	//--
	//sqlsrv_free_result($sql);
	//sqlsrv_close($conn);
	//--
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