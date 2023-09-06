<?php
ini_set("error_reporting", 1);
include "koneksi.php";
//--
$act=$_POST['act'];
$kkok=$_POST['kkok'];
//---tanggal
$tanggal1=date("d");
$tanggal2=date("m");
$tanggal3=date("Y");

$tgl1=$_POST['tgl'];
$tgl2=$_POST['tgl2'];

$tang1=substr($tgl, -2);
$bul1=substr($tgl,-5, -3);
$tah1=substr($tgl,-0, -6);
$tang2=substr($tgl2, -2);
$bul2=substr($tgl2,-5, -3);
$tah2=substr($tgl2,-0, -6);

?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Dateline Order :: online system</title>
	<link rel="shortcut icon" href="images/dit.ico">
	<link rel="stylesheet" href="css/styles.css" type="text/css" />
	<link rel="stylesheet" href="css/main.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/css/datepickr.css" />
	
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
				<table width="120%" border="0">
                  <tr>
                    <td><?php
if (!$act){   
?></td>
                  </tr>
				  <tr>
                    <td class="boldCD6">DATELINE ORDER</td></tr>
				  <tr>
				    <td class="boldCD6">&nbsp;</td>
			      </tr>
				  <tr>
				    <td class="boldCD6">&nbsp;</td>
			      </tr>
					<tr>
                    <td class="boldCD6"></td></tr>
                  <tr>
                    <td  class="bold333"><form name="Filter" method="post" action="?">
                    Tanggal Delivery : 
                    <input name="tgl" type="text" class="normal9black" id="datepick" /> 
                  s.d. 
                  <input name="tgl2" type="text" class="normal9black" id="datepick2" />  
                  <input name="act" type="hidden" id="act" value="cari" />
                 
				  			
               <br><br>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="kkok" type="checkbox" id="kkok" value="yes">
               Tampilkan KK sudah OK
			    <br><br><br><br>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <input name="Submit2" type="submit" class="tombol" value="Searching....">
                  </form></td>
                  </tr>
                  <tr>
                    <td class="normal9black"><?php
}else{   
	//--
	set_time_limit(0);
	//$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//sqlsrv_select_db($db_name) or die ("Under maintenance");
	//--

//--
			echo "<font class='blod9black'>Pencarian Tanggal Delivery : $tgl1 sampai $tgl2 </font><br><br>";

			
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	  echo "<td class='tombol'><div align='center'>No.</div></td>";
	  echo "<td class='tombol'><div align='center'>Tgl Dibutuhkan /Delivery</div></td>";
	  echo "<td class='tombol'><div align='center'>No Bon Order</div></td>";
	echo "<td class='tombol'><div align='center'>Product Description </div></td>";
	 echo "<td class='tombol'><div align='center'>Warna</div></td>";
	 echo "<td class='tombol'><div align='center'>No Warna </div></td>";        
      echo "<td class='tombol'><div align='center'>No LOT</div></td>";
	   echo "<td class='tombol'><div align='center'>Lebar</div></td>";
		   echo "<td class='tombol'><div align='center'>Gramasi</div></td>";
		   echo "<td class='tombol'><div align='center'>Roll</div></td>";
		  echo "<td class='tombol'><div align='center'>Bruto BagiKain</div></td>";
		   
	   		echo "<td class='tombol'><div align='center'>Posisi Sebelumnya </div></td>";
          echo "<td class='tombol'><div align='center'>Posisi Terakhir </div></td>";
         
		
       //   echo "<td class='tombol'><div align='center'>Nett QTY Order</div></td>";
		  
		  
        //  echo "<td class='tombol'><div align='center'>Product Number </div></td>";
          
		  echo "   <td class='tombol'><div align='center'>Alur Proses </div></td>";
		//  echo "   <td class='tombol'><div align='center'>No Kartu Kerja </div></td>";
		//  echo "   <td class='tombol'><div align='center'>Dept. Note </div></td>";
		  
        echo "</tr>";
		if ($kkok=="yes"){
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
				ProcessControlBatchesLastPosition pcblp on pcb.ID = pcblp.PCBID left join
				ProcessFlowProcessNo pfpn on pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID and pfpn.MachineType = 24 left join
				ProcessFlowDetailsNote pfdn on pfpn.EntryType = pfdn.EntryType and pfpn.ID = pfdn.ParentID
			where sod.RequiredDate between '$tgl1' and '$tgl2' and pcb.Gross<>'0'
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
				x.TglPerlu, x.SODID, x.PCBID";
		}else{
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
				ProcessControlBatchesLastPosition pcblp on pcb.ID = pcblp.PCBID left join
				ProcessFlowProcessNo pfpn on pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID and pfpn.MachineType = 24 left join
				ProcessFlowDetailsNote pfdn on pfpn.EntryType = pfdn.EntryType and pfpn.ID = pfdn.ParentID
			where sod.RequiredDate between '$tgl1' and '$tgl2' and pcb.Gross<>'0'
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
			where dep.DepartmentCode<>'85'
			order by
				x.TglPerlu, x.SODID, x.PCBID";
		}

$sql2b = sqlsrv_query($conn,$sql2, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured : ');
	
 // if ($kkok=="yes"){  //------tampikan KK OK
		//--
		$c=0;
		while ($row2=sqlsrv_fetch_array($sql2b,SQLSRV_FETCH_ASSOC)){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
		$child=$row2['ChildLevel'];
		
		if($child > 0){
			$sqlgetparent=sqlsrv_query($conn,"select ID,LotNo from ProcessControlBatches where ID='".$row2['RootID']."' and ChildLevel='0'", array(), array("Scrollable"=>"buffered"));
			$rowgp=sqlsrv_fetch_array($sqlgetparent,SQLSRV_FETCH_ASSOC);
			
			//$nomLot=substr("$row2[LotNo]",0,1);
			$nomLot=$rowgp['LotNo'];
			$nomorLot="$nomLot/K".$row2['ChildLevel']."&nbsp;";				
								
		}else{
			$nomorLot=$row2['LotNo'];
				
		}
							
			$sqlkk=sqlsrv_query($conn,"select top 1 p.*,d.DepartmentName from PCCardPosition p left join Departments d on p.DepartmentID=d.ID where PCBID='".$row2['PCBID']."' order by p.ID desc", array(), array("Scrollable"=>"buffered"));
			$rowkk=sqlsrv_fetch_row($sqlkk);
						
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td class='normal333' valign=top>$c</td>";
		//---hitungan
		
				 
		  
			  //--
		  	$sqlkk2=sqlsrv_query($conn,"select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,DepartmentID  from PCCardPosition where ID='".$rowkk[0]."' order by ID desc", array(), array("Scrollable"=>"buffered"));
			$rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);
			
			$cekTgl=$rowkk2['TglIn']; $cekDep=$rowkk2['DepartmentID'];
			$pecah1 = explode("/", $cekTgl);
			$date1 = $pecah1[0];
			$month1 = $pecah1[1];
			$year1 = $pecah1[2];
			$pecah2 = explode("/", $row2['TglPerlu']);
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
		
		//--cek tgl perlu
	 if($now > $new_jd2)
		 {
		 	if ($cekDep==60){
				$selisih=$jd2 - $jd1;
				if ($selisih < 0){
					$selisih=abs($selisih);
					echo "<td width='140' class='normal333' valign=top>'".$row2['TglPerlu']."";
					echo "<br><font color=red><strong>Delay $selisih hari</stong></font>";
				}else{
					echo "<td width='140' class='normal333' valign=top>'".$row2['TglPerlu']."";
				}
			}else{
				$selisih=$jd3 - $jd2;
				$selisih=abs($selisih);
				echo "<td width='140' class='normal333' valign=top bgcolor='#FFFF00'>'".$row2['TglPerlu']."";
				echo "<br><font class='normal333blink'><Blink>Delay $selisih hari</Blink></font>";
			}
		 }else{
		 		$selisih=$jd3-$jd2;
				$selisih=abs($selisih);
		 	echo "<td width='120' class='normal333' valign=top>'".$row2['TglPerlu']." <br><br><strong>$selisih hari lagi</strong>";
		 }
		 
	  echo "<td class='normal333' valign=top>".$row2['DocumentNo']."</td>";
	  
	  echo "<td class='normal333' valign=top>".$row2['ProductDesc']."</td>";
	   echo "<td width='150' class='normal333' valign=top>".$row2['Color']."</td>";
	 echo "<td width='100' class='normal333' valign=top>".$row2['ColorNo']."</td>";
         
          //--lot
					  echo "<td class='normal333' valign=top>";
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='".$row2['PCID']."' and RootID='0' and LotNo < '1000'";
					  $qryLot = sqlsrv_query($conn,$sqlLot, array(), array("Scrollable"=>"buffered")) 
								or die('A error occured : ');							
							
								
					  		$rowLot=sqlsrv_fetch_array($qryLot,SQLSRV_FETCH_ASSOC);	
							echo "'".$rowLot['TotalLot']."-$nomorLot";
					  
					  echo "</td>";
					  //--
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Lebar'],0). " inch</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Gramasi'],0). " gr/m2</td>";
		  echo "<td width='80' class='normal333' valign=top align=center>".$row2['RollCount']."</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Weight'],2). " Kg<br>"; //$row2[UnitName]<br>";
		   echo "<font size=0.1>".$row2['TglBagiKain']."</font></td>";
		   //echo "<td width='120' class='normal333' valign=top>'$row2[TglPerlu]";
		  // if ($cekDep<>60){
		  // echo "c";
		   //$selisih=$row2[TglPerlu] - $cekTgl;
		   		//if ($cekTgl > $row2[TglPerlu]){
						//echo "<br>Delay $selisih hari $tglNow";
				//}
		 //  }
		
		   echo "</td>";
		
			//---POSISI SEBELUMnya
				
				$sqlpsb=sqlsrv_query($conn,"Select top 2 * from PCCardPosition where PCBID='".$row2['PCBID']."' and Status ='0' and DepartmentID<>'".$rowkk['DepartmentID']."' order by ID desc", array(), array("Scrollable"=>"buffered"));
				$rowpsb=sqlsrv_fetch_row($sqlpsb);
				
				$sqlkkpsb=sqlsrv_query($conn,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.DepartmentID  = dep.ID
where pcpos.ID='$rowpsb[0]' order by pcpos.ID desc", array(), array("Scrollable"=>"buffered"));
		  $rowkkpsb=sqlsrv_fetch_array($sqlkkpsb,SQLSRV_FETCH_ASSOC);		  
	
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='normal7black'>".$rowkkpsb['DepOut']."  <br>Out: ".$rowkkpsb['TglIn']." ".$rowkkpsb['JamIn']."</font></td>";
			
			//--end posisi sebelumnya
			//---if stenter cek no mesin
			$ketsetting="";
			
			if ($row2['DepartmentCode']==44){
				$mtp=14;  //type : finishing
				$linemesin="1499001";
				 $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='".$row2['NoKK']."'", array(), array("Scrollable"=>"buffered"));
		  		$cset=sqlsrv_num_rows($sqlset);
			  if ($cset > 0 ){		  
		  
				$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='".$rowset['ID']."' and MachineType='$mtp' order by Dated desc", array(), array("Scrollable"=>"buffered"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
				$ketsetting="".$rowflow['TglF']." ".$rowflow['JamF']."<br>";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='".$rowflow['ID']."' and LineID = '$linemesin'", array(), array("Scrollable"=>"buffered"));
					$rownomes=sqlsrv_fetch_array($sqlnomes,SQLSRV_FETCH_ASSOC);
					
					$sqlnomes2=sqlsrv_query($conn,"select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='".$rownomes['ID']."'", array(), array("Scrollable"=>"buffered"));
					$rownomes2=sqlsrv_fetch_array($sqlnomes2,SQLSRV_FETCH_ASSOC);
					
					$sqlgnomes=sqlsrv_query($conn,"select ID,Code,Description,MachineType from Machines where ID='".$rownomes2['ValueI']."'", array(), array("Scrollable"=>"buffered"));
					$cgnomes=sqlsrv_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=sqlsrv_fetch_array($sqlgnomes,SQLSRV_FETCH_ASSOC);
						$ketsetting="".$rowgnomes['Description']."<br>";
					}	
				  }
				}		
			
			}//---end  if stenter
			//--begin inspec note
			if ($row2['DepartmentCode']==34){
				$sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='".$row2['NoKK']."'", array(), array("Scrollable"=>"buffered"));
		  		$cset=sqlsrv_num_rows($sqlset);
			  if ($cset > 0 ){		  
		  
				$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='".$rowset['ID']."' order by Dated desc", array(), array("Scrollable"=>"buffered"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
				//$ketsetting="$rowflow[TglF] $rowflow[JamF]<br>";
				//echo $rowset[ID];
					//--cari noote
					$sqlnomes=sqlsrv_query($conn,"select cast(Note as nvarchar(50)) as Note from ProcessFlowDetailsDeptNote where DepartmentID='30' and ParentID ='".$rowflow['ID']."'", array(), array("Scrollable"=>"buffered"));
										
					$cgnomes=sqlsrv_num_rows($sqlnomes);
					if ($cgnomes > 0){
						$rownomes=sqlsrv_fetch_array($sqlnomes,SQLSRV_FETCH_ASSOC);
						$ketsetting="".$rownomes['Note']."<br>";
					}	
				  }
				}		
			
			}
			//--end inspek
		  //--		  
		  //echo "tess :$rowkk[5]";
		  if ($rowkk[5]==0){ // =0 : out
		  //---1
		//  $sqlkk1=sqlsrv_query("select top 1 ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition where PCBID='$row2[PCBID]' order by Dated desc");
		//	$rowkk1=sqlsrv_fetch_array($sqlkk1);
		  //--
		  
							$sqlkk2=sqlsrv_query($conn,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.CounterDepartmentID  = dep.ID
where pcpos.ID='".$rowkk[0]."' order by Dated desc", array(), array("Scrollable"=>"buffered"));
		  $rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);
		  
	//	  if ($rowkk1[PCBID]==$rowkk2[ID]){
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>".$rowkk[0]."<hr>Out:</font> <font class='normal7black'>".$rowkk2['DepOut']."  <br>".$rowkk2['TglIn']." ".$rowkk2['JamIn']."</font></td>";
		//  }else{
        //  	echo "<td width='120' class='BoldCD6' align='center'><font class='blod9black'>$row2[DepartmentName]</font><br><font class='normal7black'>In: $rowkk1[TglIn] $rowkk1[JamIn]<br>Tujuan Out: $rowkk2[DepOut]  <br>$rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		//  }
		  //--
		  }elseif ($rowkk[5]<>0){ // =1 : in
		  	$sqlkk2=sqlsrv_query($conn,"select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,DepartmentID  from PCCardPosition where ID='".$rowkk[0]."' order by ID desc", array(), array("Scrollable"=>"buffered"));
			$rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);
			
			$cekTgl=$rowkk2['TglIn']; $cekDep=$rowkk2['DepartmentID'];
			$pecah1 = explode("/", $cekTgl);
			$date1 = $pecah1[0];
			$month1 = $pecah1[1];
			$year1 = $pecah1[2];
			$pecah2 = explode("/", $row2['TglPerlu']);
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

			echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$rowkk[8]</font><font size=0.1><br>$ketsetting</font><hr><font class='normal7black'>In: ".$rowkk2['TglIn']." ".$rowkk2['JamIn']."</font></td>";
		  }
		  //--
		  
		  //---setting
		  $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='".$row2['NoKK']."'", array(), array("Scrollable"=>"buffered"));
		  $cset=sqlsrv_num_rows($sqlset);
		  if ($cset > 0 ){
		  	$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='".$rowset['ID']."' and MachineType='14' order by Dated desc", array(), array("Scrollable"=>"buffered"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
					$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
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
	where lt.MachineType='14' and lt.ParentID ='".$rowflow['ID']."' and (md.Description='Machine No.' or md.Description='Overfeed' or md.Description='Speed' or md.Description='Temperature') and dv.ValueI='40'
	order by 
		md.Description";
		
						$qrymsn=sqlsrv_query($conn,$sqlmsn, array(), array("Scrollable"=>"buffered"));
						$ketsetting="".$rowflow['TglF']." ".$rowflow['JamF']."<br>";
						while ($rowmsn=sqlsrv_fetch_array($qrymsn,SQLSRV_FETCH_ASSOC)){
							$decmes=trim($rowmsn['Description']);
							if ($decmes=='Machine no.'){
								$sqlmes=sqlsrv_query($conn,"select ID,Description from Machines where ID='".$rowmsn['ID1']."'", array(), array("Scrollable"=>"buffered"));
								$rowmes=sqlsrv_fetch_array($sqlmes,SQLSRV_FETCH_ASSOC);
								$val="".$rowmes['Description']."";
							}else{
								$val="".number_format($rowmsn['Value1'],1)."";
							}
							$ketsetting="$ketsetting ".$rowmsn['Description'].": $val ".$rowmsn['UnitName']." <br>";
						}
						
					
				}
		  
		  }
		  //--end setting
         
		
       //   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Quantity],2). " $row2[UnitName]</td>";
		
     //    echo "<td width='120' class='normal333' valign=top>$row2[ProductNumber]";
		  
		  $ketsetting="";
   

		  $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='".$row2['NoKK']."'", array(), array("Scrollable"=>"buffered"));
		  $cset=sqlsrv_num_rows($sqlset);
		  if ($cset > 0 ){		  
		  
		  	$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='".$rowset['ID']."' and MachineType='14' order by Dated desc", array(), array("Scrollable"=>"buffered"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
				echo "<hr>";
				$ketsetting="".$rowflow['TglF']." ".$rowflow['JamF']."<br>";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='".$rowflow['ID']."' and LineID = '1499001'", array(), array("Scrollable"=>"buffered"));
					$rownomes=sqlsrv_fetch_array($sqlnomes,SQLSRV_FETCH_ASSOC);
					
					$sqlnomes2=sqlsrv_query($conn,"select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='".$rownomes['ID']."'", array(), array("Scrollable"=>"buffered"));
					$rownomes2=sqlsrv_fetch_array($sqlnomes2,SQLSRV_FETCH_ASSOC);
					
					$sqlgnomes=sqlsrv_query($conn,"select ID,Code,Description,MachineType from Machines where ID='".$rownomes2['ValueI']."'", array(), array("Scrollable"=>"buffered"));
					$cgnomes=sqlsrv_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=sqlsrv_fetch_array($sqlgnomes,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting ".$rowgnomes['Description']."<br>";
					}
					//--
					//--cari speed
					$sqlspeed=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='".$rowflow['ID']."' and LineID = '1401002'", array(), array("Scrollable"=>"buffered"));
					$rowspeed=sqlsrv_fetch_array($sqlspeed,SQLSRV_FETCH_ASSOC);
					
					$sqlspeed2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='".$rowspeed['ID']."'", array(), array("Scrollable"=>"buffered"));
					
					$cspeed=sqlsrv_num_rows($sqlspeed2);
					
					if ($cspeed > 0){
						$rowspeed2=sqlsrv_fetch_array($sqlspeed2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting Speed:" .number_format($rowspeed2['ValueD'],2). " ".$rowspeed2['UnitName']."<br>";
					}
					//--
					//--cari temperatur
					$sqltemp=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='".$rowflow['ID']."' and LineID = '1401003'", array(), array("Scrollable"=>"buffered"));
					$rowtemp=sqlsrv_fetch_array($sqltemp,SQLSRV_FETCH_ASSOC);
					
					$sqltemp2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='".$rowtemp['ID']."'", array(), array("Scrollable"=>"buffered"));
					
					$ctemp=sqlsrv_num_rows($sqltemp2);
					
					if ($ctemp > 0){
						$rowtemp2=sqlsrv_fetch_array($sqltemp2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting suhu:" .number_format($rowtemp2['ValueD'],2). " ".$rowtemp2['UnitName']."<br>";
					}
					//--
					//--cari overfeed
					$sqlover=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='".$rowflow['ID']."' and LineID = '1401004'", array(), array("Scrollable"=>"buffered"));
					$rowover=sqlsrv_fetch_array($sqlover,SQLSRV_FETCH_ASSOC);
					
					$sqlover2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='".$rowover['ID']."'", array(), array("Scrollable"=>"buffered"));
					
					$cover=sqlsrv_num_rows($sqlover2);
					
					if ($cover > 0){
						$rowover2=sqlsrv_fetch_array($sqlover2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting overfeed:" .number_format($rowover2['ValueD'],1). " ".$rowover2['UnitName']."<br>";
					}
					//--				
						
				}
		  
		  }
		  //--end setting
		  echo "<font size=0.1>$ketsetting</font></td>";
       
		   echo "<td width='120' class='normal333' valign=top>".$row2['Alur']."</td>";
		//  echo "<td width='120' class='normal333' valign=top>'<a href='logscan.php?kk=$row2[PCBID]' target=_blank>$row2[NoKK]</a><br>$row2[TglKK]</td>";
		/*  //---Dept Note
		  $sqlcarinotePCB=sqlsrv_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  
		  $rowcarinotePCB=sqlsrv_fetch_array($sqlcarinotePCB);
		  
		  $sqlcarinotePFPN=sqlsrv_query("select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowcarinotePCB[ID]' order by Dated desc");
		  
		  $rowcarinotePFPN=sqlsrv_fetch_array($sqlcarinotePFPN);
		  
		  $sqlPFDN=sqlsrv_query("select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Note from ProcessFlowDetailsDeptNote where DepartmentID='$row2[deptID]' and ParentID ='$rowcarinotePFPN[ID]'");
		  
		  $PFDN=sqlsrv_fetch_array($sqlPFDN);
		  
		  		  
		  //--end Dept Note ----- BYBO
		  $catatandept="$PFDN[Note]";
		  echo "<td class='normal333' valign=top>$catatandept</td>";
		  */
        echo "</tr>";
        
		}
     echo "</table>";
  
//  }else{
  //--------------KK OK tidak ditampilkan
  
  
  //}///----KK OK end
	//--
	//sqlsrv_free_result($sql);
	//sqlsrv_close($conn);
	//--

}
//--
//}
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
<script type="text/javascript" src="css/css/datepickr.min.js"></script>
		<script type="text/javascript">
			new datepickr('datepick', {
				'dateFormat': 'Y-m-d'
			});	
			
			new datepickr('datepick2', {
				'dateFormat': 'Y-m-d'
			});		
			
			new datepickr('datepick3', {
				'dateFormat': 'Y-m-d'
			});		
			new datepickr('datepick4', {
				'dateFormat': 'Y-m-d'
			});	
			
			new datepickr('datepick5', {
				'dateFormat': 'Y-m-d'
			});	
			
			new datepickr('datepick6', {
				'dateFormat': 'Y-m-d'
			});	
		</script>	
</body>
</html>