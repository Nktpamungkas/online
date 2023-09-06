<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=bon-order.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php

$host="10.0.0.4";
$username="timdit";
$password="4dm1n";
$db_name="TM";
$connInfo = array( "Database"=>$db_name, "UID"=>$username, "PWD"=>$password);
$conn     = sqlsrv_connect( $host, $connInfo);
//--
//$nobo=strip_tags($_GET['order']); //trim(strip_tags($_POST['nobo']));
$nobo=$_GET['order'];
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
ini_set("error_reporting", 1);
	include "koneksi.php";
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<?php {    
	//--
	set_time_limit(600);
	//$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//sqlsrv_select_db($db_name) or die ("Under maintenance");
	//--
//start nokk
if ($nokk <> ''){

//echo "No Bon ORder";
//--
$sql0="select top 1
			x.*, 
			udq.UnitName, udq.DetailDigits,
			udw.UnitName as WeightUnitName, udw.DetailDigits as WeightDigits,
			udb.UnitName as BatchUnitName, udb.DetailDigits as BatchDigits,
			cust.PartnerNumber as CustomerNumber, cust.CompanyTitle as CustomerTitle, cust.PartnerName as CustomerName,
			buy.PartnerNumber as BuyerNumber, buy.CompanyTitle as BuyerTitle, buy.PartnerName as BuyerName,
			pm.ProductNumber, pmp.ProductCode as ItemNo, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
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
			where pcb.DocumentNo='$nokk' and pcb.Gross<>'0'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				ProductPartner pmp on x.ProductID=pmp.ProductID and x.BuyerID=pmp.PartnerID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sql = sqlsrv_query($conn,$sql0, array(), array("Scrollable"=>"static")) 
    or die('A error occured : ');
 
$count = sqlsrv_num_rows($sql);

			if ($count > 0 ){
			$row=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC);
			$ponya=trim($row['PONumber']);
			echo "<font class='blod9black'>Hasil Pencarian : (". date("d/m/y") .")</font>  ";

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
		   echo "   <td class='tombol'><div align='center'>Note </div></td>";
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
			pm.ProductNumber, pmp.ProductCode as ItemNo, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
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
			where pcb.DocumentNo='$nokk' and pcb.Gross<>'0'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				ProductPartner pmp on x.ProductID=pmp.ProductID and x.BuyerID=pmp.PartnerID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sql2b = sqlsrv_query($conn,$sql2, array(), array("Scrollable"=>"static")) 
    or die('A error occured : ');
		//--
		$c=0;
		while ($row2=sqlsrv_fetch_array($sql2b,SQLSRV_FETCH_ASSOC)){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
		$child=$row2['ChildLevel'];
		
		if($child > 0){
			$sqlgetparent=sqlsrv_query($conn,"select ID,LotNo from ProcessControlBatches where ID='$row2[RootID]' and ChildLevel='0'", array(), array("Scrollable"=>"static"));
			$rowgp=sqlsrv_fetch_array($sqlgetparent,SQLSRV_FETCH_ASSOC);
			
			//$nomLot=substr("$row2[LotNo]",0,1);
			$nomLot=$rowgp['LotNo'];
			$nomorLot="$nomLot/K$row2[ChildLevel]&nbsp;";				
								
		}else{
			$nomorLot=$row2['LotNo'];
				
		}
							
			$sqlkk=sqlsrv_query($conn,"select top 1 p.*,d.DepartmentName from PCCardPosition p left join Departments d on p.DepartmentID=d.ID where PCBID='$row2[PCBID]' order by p.ID desc", array(), array("Scrollable"=>"static"));
			$rowkk=sqlsrv_fetch_array($sqlkk);
									
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
					  $qryLot = sqlsrv_query($conn,$sqlLot, array(), array("Scrollable"=>"static")) 
								or die('A error occured : ');							
							
								
					  		$rowLot=sqlsrv_fetch_array($qryLot,SQLSRV_FETCH_ASSOC);	
							echo "'$rowLot[TotalLot]-$nomorLot";
					  
					  echo "</td>";
					  //--
			//---POSISI SEBELUMnya
				
				$sqlpsb=sqlsrv_query($conn,"Select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and Status ='0' and DepartmentID<>'$rowkk[DepartmentID]' order by ID desc", array(), array("Scrollable"=>"static"));
				$rowpsb=sqlsrv_fetch_array($sqlpsb);
				
				$sqlkkpsb=sqlsrv_query($conn,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.DepartmentID  = dep.ID
where pcpos.ID='$rowpsb[0]' order by pcpos.ID desc", array(), array("Scrollable"=>"static"));
		  $rowkkpsb=sqlsrv_fetch_array($sqlkkpsb,SQLSRV_FETCH_ASSOC);		  
	
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='normal7black'>$rowkkpsb[DepOut] Out: $rowkkpsb[TglIn] $rowkkpsb[JamIn]</font></td>";
			
			//--end posisi sebelumnya
			//---if stenter cek no mesin
			$ketsetting="";
			
			if ($row2['DepartmentCode']==44){
				$mtp=14;  //type : finishing
				$linemesin="1499001";
				 $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  		$cset=sqlsrv_num_rows($sqlset);
			  if ($cset > 0 ){		  
		  
				$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='$mtp' order by Dated desc", array(), array("Scrollable"=>"static"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
				$ketsetting="$rowflow[TglF] $rowflow[JamF] ";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '$linemesin'", array(), array("Scrollable"=>"static"));
					$rownomes=sqlsrv_fetch_array($sqlnomes,SQLSRV_FETCH_ASSOC);
					
					$sqlnomes2=sqlsrv_query($conn,"select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='$rownomes[ID]'", array(), array("Scrollable"=>"static"));
					$rownomes2=sqlsrv_fetch_array($sqlnomes2,SQLSRV_FETCH_ASSOC);
					
					$sqlgnomes=sqlsrv_query($conn,"select ID,Code,Description,MachineType from Machines where ID='$rownomes2[ValueI]'", array(), array("Scrollable"=>"static"));
					$cgnomes=sqlsrv_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=sqlsrv_fetch_array($sqlgnomes,SQLSRV_FETCH_ASSOC);
						$ketsetting="$rowgnomes[Description] ";
					}	
				  }
				}		
			
			}//---end  if stenter
			//--begin inspec note
			if ($row2['DepartmentCode']==34){
				$sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  		$cset=sqlsrv_num_rows($sqlset);
			  if ($cset > 0 ){		  
		  
				$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowset[ID]' order by Dated desc", array(), array("Scrollable"=>"static"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
				//$ketsetting="$rowflow[TglF] $rowflow[JamF] ";
				//echo $rowset[ID];
					//--cari noote
					$sqlnomes=sqlsrv_query($conn,"select cast(Note as nvarchar(50)) as Note from ProcessFlowDetailsDeptNote where DepartmentID='30' and ParentID ='$rowflow[ID]'", array(), array("Scrollable"=>"static"));
										
					$cgnomes=sqlsrv_num_rows($sqlnomes);
					if ($cgnomes > 0){
						$rownomes=sqlsrv_fetch_array($sqlnomes,SQLSRV_FETCH_ASSOC);
						$ketsetting="$rownomes[Note] ";
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
where pcpos.ID='$rowkk[0]' order by Dated desc", array(), array("Scrollable"=>"static"));
		  $rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);
		  
	//	  if ($rowkk1[PCBID]==$rowkk2[ID]){
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$rowkk[8] Out:</font> <font class='normal7black'>$rowkk2[DepOut] $rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		//  }else{
        //  	echo "<td width='120' class='BoldCD6' align='center'><font class='blod9black'>$row2[DepartmentName]</font> <font class='normal7black'>In: $rowkk1[TglIn] $rowkk1[JamIn] Tujuan Out: $rowkk2[DepOut]   $rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		//  }
		  //--
		  }elseif ($rowkk[5]<>0){ // =1 : in
		  	$sqlkk2=sqlsrv_query($conn,"select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,DepartmentID  from PCCardPosition where ID='$rowkk[0]' order by ID desc", array(), array("Scrollable"=>"static"));
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
				//---cek surat jalan
			  $kirim="";
		  if ($rowkk[8]=="KK Oke"){
			  $sqlsj="select a.nokk,a.refno,b.no_sj,b.tgl_update from detail_pergerakan_stok a  inner JOIN
packing_list b on a.refno=b.listno
where a.nokk='$row2[NoKK]' limit 1";
			$data=mysqli_query($con,$sqlsj);
			$sjrow=mysqli_num_rows($data);
			if ($sjrow>0){
				$rowsj=mysqli_fetch_array($data);
				$kirim=" No SJ : $rowsj[no_sj] Tgl Kirim : $rowsj[tgl_update]";
			}else{
				$kirim="";
			}
				
		  }
		  
		  //--end surat jalan
			  
			echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$rowkk[8]</font><font size=0.1> $ketsetting</font> <font class='normal7black'>In: $rowkk2[TglIn] $rowkk2[JamIn] $kirim</font></td>";
		  }
		  //--
		  
		  //---setting
		  $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  $cset=sqlsrv_num_rows($sqlset);
		  if ($cset > 0 ){
		  	$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='14' order by Dated desc", array(), array("Scrollable"=>"static"));
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
	where lt.MachineType='14' and lt.ParentID ='$rowflow[ID]' and (md.Description='Machine No.' or md.Description='Overfeed' or md.Description='Speed' or md.Description='Temperature') and dv.ValueI='40'
	order by 
		md.Description";
		
						$qrymsn=sqlsrv_query($conn,$sqlmsn, array(), array("Scrollable"=>"static"));
						$ketsetting="$rowflow[TglF] $rowflow[JamF] ";
						while ($rowmsn=sqlsrv_fetch_array($qrymsn,SQLSRV_FETCH_ASSOC)){
							$decmes=trim($rowmsn['Description']);
							if ($decmes=='Machine no.'){
								$sqlmes=sqlsrv_query($conn,"select ID,Description from Machines where ID='$rowmsn[ID1]'", array(), array("Scrollable"=>"static"));
								$rowmes=sqlsrv_fetch_array($sqlmes,SQLSRV_FETCH_ASSOC);
								$val="$rowmes[Description]";
							}else{
								$val="".number_format($rowmsn['Value1'],1)."";
							}
							$ketsetting="$ketsetting $rowmsn[Description]: $val $rowmsn[UnitName]  ";
						}
						
					
				}
		  
		  }
		  //--end setting
		  
		  
          echo "<td width='100' class='normal333' valign=top>$row2[ColorNo]</td>";
          echo "<td width='150' class='normal333' valign=top>$row2[Color]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Lebar'],0). " inch</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Gramasi'],0). " gr/m2</td>";
          echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Quantity'],2). " $row2[UnitName]</td>";
		  echo "<td width='80' class='normal333' valign=top align=center>$row2[RollCount]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Weight'],2). " Kg "; //$row2[UnitName] ";
		   echo "<font size=0.1>$row2[TglBagiKain]</font></td>";		 
		   //echo "<td width='120' class='normal333' valign=top>'$row2[TglPerlu]";
		  // if ($cekDep<>60){
		  // echo "c";
		   //$selisih=$row2[TglPerlu] - $cekTgl;
		   		//if ($cekTgl > $row2[TglPerlu]){
						//echo " Delay $selisih hari $tglNow";
				//}
		 //  }
		 if($now > $new_jd2)
		 {
		 	if ($cekDep==60){
				$selisih=$jd2 - $jd1;
				if ($selisih < 0){
					$selisih=abs($selisih);
					echo "<td width='140' class='normal333' valign=top>'$row2[TglPerlu]";
					echo " <font color=red><strong>Delay $selisih hari</stong></font>";
				}else{
					echo "<td width='140' class='normal333' valign=top>'$row2[TglPerlu]";
				}
			}else{
				$selisih=$jd3 - $jd2;
				$selisih=abs($selisih);
				echo "<td width='140' class='normal333' valign=top bgcolor='#FFFF00'>'$row2[TglPerlu]";
				echo " <font class='normal333blink'><Blink>Delay $selisih hari</Blink></font>";
			}
		 }else{
		 		$selisih=$jd3-$jd2;
				$selisih=abs($selisih);
		 	echo "<td width='120' class='normal333' valign=top>'$row2[TglPerlu] <strong>$selisih hari lagi</strong>";
		 }
		 
		
		   echo "</td>";
         echo "<td width='120' class='normal333' valign=top>$row2[ProductNumber]";
		  
		  $ketsetting="";
   

		  $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  $cset=sqlsrv_num_rows($sqlset);
		  if ($cset > 0 ){		  
		  
		  	$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='14' order by Dated desc", array(), array("Scrollable"=>"static"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
				echo " ";
				$ketsetting="$rowflow[TglF] $rowflow[JamF] ";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1499001'", array(), array("Scrollable"=>"static"));
					$rownomes=sqlsrv_fetch_array($sqlnomes,SQLSRV_FETCH_ASSOC);
					
					$sqlnomes2=sqlsrv_query($conn,"select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='$rownomes[ID]'", array(), array("Scrollable"=>"static"));
					$rownomes2=sqlsrv_fetch_array($sqlnomes2,SQLSRV_FETCH_ASSOC);
					
					$sqlgnomes=sqlsrv_query($conn,"select ID,Code,Description,MachineType from Machines where ID='$rownomes2[ValueI]'", array(), array("Scrollable"=>"static"));
					$cgnomes=sqlsrv_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=sqlsrv_fetch_array($sqlgnomes,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting $rowgnomes[Description] ";
					}
					//--
					//--cari speed
					$sqlspeed=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401002'", array(), array("Scrollable"=>"static"));
					$rowspeed=sqlsrv_fetch_array($sqlspeed,SQLSRV_FETCH_ASSOC);
					
					$sqlspeed2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowspeed[ID]'", array(), array("Scrollable"=>"static"));
					
					$cspeed=sqlsrv_num_rows($sqlspeed2);
					
					if ($cspeed > 0){
						$rowspeed2=sqlsrv_fetch_array($sqlspeed2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting Speed:" .number_format($rowspeed2['ValueD'],2). " $rowspeed2[UnitName] ";
					}
					//--
					//--cari temperatur
					$sqltemp=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401003'", array(), array("Scrollable"=>"static"));
					$rowtemp=sqlsrv_fetch_array($sqltemp,SQLSRV_FETCH_ASSOC);
					
					$sqltemp2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowtemp[ID]'", array(), array("Scrollable"=>"static"));
					
					$ctemp=sqlsrv_num_rows($sqltemp2);
					
					if ($ctemp > 0){
						$rowtemp2=sqlsrv_fetch_array($sqltemp2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting suhu:" .number_format($rowtemp2['ValueD'],2). " $rowtemp2[UnitName] ";
					}
					//--
					//--cari overfeed
					$sqlover=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401004'", array(), array("Scrollable"=>"static"));
					$rowover=sqlsrv_fetch_array($sqlover,SQLSRV_FETCH_ASSOC);
					
					$sqlover2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowover[ID]'", array(), array("Scrollable"=>"static"));
					
					$cover=sqlsrv_num_rows($sqlover2);
					
					if ($cover > 0){
						$rowover2=sqlsrv_fetch_array($sqlover2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting overfeed:" .number_format($rowover2['ValueD'],1). " $rowover2[UnitName] ";
					}
					//--				
						
				}
		  
		  }
		  //--end setting
		  echo "<font size=0.1>$ketsetting</font></td>";
          echo "<td class='normal333' valign=top>$row2[ItemNo]/ $row2[ProductDesc]</td>";
		   echo "<td width='120' class='normal333' valign=top>$row2[Alur]</td>";
		  echo "<td width='120' class='normal333' valign=top>'<a href='logscan.php?kk=$row2[PCBID]' target=_blank>$row2[NoKK]</a> $row2[TglKK]</td>";
		  //---Dept Note
		  $sqlcarinotePCB=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  
		  $rowcarinotePCB=sqlsrv_fetch_array($sqlcarinotePCB,SQLSRV_FETCH_ASSOC);
		  
		  $sqlcarinotePFPN=sqlsrv_query($conn,"select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowcarinotePCB[ID]' order by Dated desc", array(), array("Scrollable"=>"static"));
		  
		  $rowcarinotePFPN=sqlsrv_fetch_array($sqlcarinotePFPN,SQLSRV_FETCH_ASSOC); //---dari sini get id
		  
		  $sqlPFDN=sqlsrv_query($conn,"select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Note from ProcessFlowDetailsDeptNote where DepartmentID='$row2[deptID]' and ParentID ='$rowcarinotePFPN[ID]'", array(), array("Scrollable"=>"static"));
		  
		  $PFDN=sqlsrv_fetch_array($sqlPFDN,SQLSRV_FETCH_ASSOC);
		  
		  //---note begin
		  $sqlnote0=sqlsrv_query($conn,"Select top 1 id,parentid,machinetype from Processflowprocessno where parentid='$rowcarinotePCB[ID]' and machinetype='24' order by id desc", array(), array("Scrollable"=>"static"));
		  $rownote0=sqlsrv_fetch_array($sqlnote0,SQLSRV_FETCH_ASSOC);
		  
		   $sqlPFnote=sqlsrv_query($conn,"select top 1 ParentID,cast(Note as nvarchar(200)) as Note from ProcessFlowDetailsNote where ParentID ='$rownote0[id]' order by entrytype desc", array(), array("Scrollable"=>"static"));
		  
		  $PFnote=sqlsrv_fetch_array($sqlPFnote,SQLSRV_FETCH_ASSOC);
		  
		  $catatan="$PFnote[Note]";
		  echo "<td class='normal333' valign=top>$catatan</td>";
		  		  
		  //--end Dept Note ----- BYBO
		  $catatandept="$PFDN[Note]";
		  echo "<td class='normal333' valign=top>$catatandept</td>";
        echo "</tr>";
        
		}
     echo "</table>";

			}else{
				echo "  <font class='normal9black'>Nomor Kartu Kerja : $nokk , TIDAK ditemukan !</font>";	
			}
	//--
	//sqlsrv_free_result($sql);
	//sqlsrv_close($conn);
	//--
//end nokk
}else if ($nobo <> ''){

//echo "No Bon ORder";
//--
$sql0="select top 1
			x.*, 
			udq.UnitName, udq.DetailDigits,
			udw.UnitName as WeightUnitName, udw.DetailDigits as WeightDigits,
			udb.UnitName as BatchUnitName, udb.DetailDigits as BatchDigits,
			cust.PartnerNumber as CustomerNumber, cust.CompanyTitle as CustomerTitle, cust.PartnerName as CustomerName,
			buy.PartnerNumber as BuyerNumber, buy.CompanyTitle as BuyerTitle, buy.PartnerName as BuyerName,
			pm.ProductNumber,pmp.ProductCode as ItemNo, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
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
			where jo.DocumentNo='$nobo' and pcb.Gross<>'0'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				ProductPartner pmp on x.ProductID=pmp.ProductID and x.BuyerID=pmp.PartnerID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sql = sqlsrv_query($conn,$sql0, array(), array("Scrollable"=>"static")) 
    or die('A error occured : ');
 
$count = sqlsrv_num_rows($sql);

			if ($count > 0 ){
			$row=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC);
			$ponya=trim($row['PONumber']);
			echo "<font class='blod9black'>Hasil Pencarian : (". date("d/m/y") .")</font>  ";

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
     echo " <table width='100%' border='1'>";
      echo "<tr>";
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
		  echo "<td class='tombol'><div align='center'>Lebar Actual</div></td>";
		  echo "<td class='tombol'><div align='center'>Gramasi Actual</div></td>";		
          echo "<td class='tombol'><div align='center'>Nett QTY Order</div></td>";
		  echo "<td class='tombol'><div align='center'>Roll</div></td>";
		  echo "<td class='tombol'><div align='center'>Bruto BagiKain</div></td>";
		  echo "<td class='tombol'><div align='center'>Tgl BagiKain</div></td>";		
		 echo "<td class='tombol'><div align='center'>Roll Packing</div></td>";
		  echo "<td class='tombol'><div align='center'>Qty Packing</div></td>";
          echo "<td class='tombol'><div align='center'>Yard Packing</div></td>";				
		  echo "<td class='tombol'><div align='center'>Loss</div></td>";		
		   echo "<td class='tombol'><div align='center'>Tgl Dibutuhkan /Delivery</div></td>";
		   echo "<td class='tombol'><div align='center'>Total Hari</div></td>";		
          echo "<td class='tombol'><div align='center'>Product Number </div></td>";
          echo "<td class='tombol'><div align='center'>Product Description </div></td>";
		  echo "   <td class='tombol'><div align='center'>Alur Proses </div></td>";
		  echo "   <td class='tombol'><div align='center'>No Kartu Kerja </div></td>";
		  echo "   <td class='tombol'><div align='center'>Tgl KK </div></td>";		
		   echo "   <td class='tombol'><div align='center'>Note </div></td>";
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
			pm.ProductNumber, pmp.ProductCode as ItemNo, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
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
			where jo.DocumentNo='$nobo' and pcb.Gross<>'0'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				ProductPartner pmp on x.ProductID=pmp.ProductID and x.BuyerID=pmp.PartnerID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sql2b = sqlsrv_query($conn,$sql2, array(), array("Scrollable"=>"static")) 
    or die('A error occured : ');
		//--
		$c=0;
		while ($row2=sqlsrv_fetch_array($sql2b,SQLSRV_FETCH_ASSOC)){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
		$child=$row2['ChildLevel'];
		
		if($child > 0){
			$sqlgetparent=sqlsrv_query($conn,"select ID,LotNo from ProcessControlBatches where ID='$row2[RootID]' and ChildLevel='0'", array(), array("Scrollable"=>"static"));
			$rowgp=sqlsrv_fetch_array($sqlgetparent,SQLSRV_FETCH_ASSOC);
			
			//$nomLot=substr("$row2[LotNo]",0,1);
			$nomLot=$rowgp['LotNo'];
			$nomorLot="$nomLot/K$row2[ChildLevel]&nbsp;";				
								
		}else{
			$nomorLot=$row2['LotNo'];
				
		}
							
			$sqlkk=sqlsrv_query($conn,"select top 1 p.*,d.DepartmentName from PCCardPosition p left join Departments d on p.DepartmentID=d.ID where PCBID='$row2[PCBID]' order by p.ID desc", array(), array("Scrollable"=>"static"));
			$rowkk=sqlsrv_fetch_array($sqlkk);
			//---cek kk yg sudah ke kain jadi
			$sqlkkKJ=sqlsrv_query($conn,"select TOP 1 p.*,d.DepartmentName from PCCardPosition p left join Departments d on p.DepartmentID=d.ID where PCBID='$row2[PCBID]' and d.DepartmentName='KAIN JADI' order by p.ID desc", array(), array("Scrollable"=>"static"));
			$rowkkKJ=sqlsrv_fetch_array($sqlkkKJ);
			//--end kk yg sudah ke kain jadi

						
        echo "<tr>";
		echo "<td class='normal333' valign=top>$c</td>";
		//--cek PO
	  if ($ponya==''){
	  echo "<td class='normal333' valign=top>$row2[DetailRefNo]</td>";
	  }
	  //--
          //--lot
					  echo "<td class='normal333' valign=top>";
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='$row2[PCID]' and RootID='0' and LotNo < '1000'";
					  $qryLot = sqlsrv_query($conn,$sqlLot, array(), array("Scrollable"=>"static")) 
								or die('A error occured : ');							
							
								
					  		$rowLot=sqlsrv_fetch_array($qryLot,SQLSRV_FETCH_ASSOC);	
							echo "'$rowLot[TotalLot]-$nomorLot";
					  
					  echo "</td>";
					  //--
			//---POSISI SEBELUMnya
				
				$sqlpsb=sqlsrv_query($conn,"Select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and Status ='0' and DepartmentID<>'$rowkk[DepartmentID]' order by ID desc", array(), array("Scrollable"=>"static"));
				$rowpsb=sqlsrv_fetch_array($sqlpsb);
				
				$sqlkkpsb=sqlsrv_query($conn,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.DepartmentID  = dep.ID
where pcpos.ID='$rowpsb[0]' order by pcpos.ID desc", array(), array("Scrollable"=>"static"));
		  $rowkkpsb=sqlsrv_fetch_array($sqlkkpsb,SQLSRV_FETCH_ASSOC);		  
	
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='normal7black'>$rowkkpsb[DepOut] Out: $rowkkpsb[TglIn] $rowkkpsb[JamIn]</font></td>";
			
			//--end posisi sebelumnya
			//---if stenter cek no mesin
			$ketsetting="";
			
			if ($row2['DepartmentCode']==44){
				$mtp=14;  //type : finishing
				$linemesin="1499001";
				 $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  		$cset=sqlsrv_num_rows($sqlset);
			  if ($cset > 0 ){		  
		  
				$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='$mtp' order by Dated desc", array(), array("Scrollable"=>"static"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
				$ketsetting="$rowflow[TglF] $rowflow[JamF] ";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '$linemesin'", array(), array("Scrollable"=>"static"));
					$rownomes=sqlsrv_fetch_array($sqlnomes,SQLSRV_FETCH_ASSOC);
					
					$sqlnomes2=sqlsrv_query($conn,"select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='$rownomes[ID]'", array(), array("Scrollable"=>"static"));
					$rownomes2=sqlsrv_fetch_array($sqlnomes2,SQLSRV_FETCH_ASSOC);
					
					$sqlgnomes=sqlsrv_query($conn,"select ID,Code,Description,MachineType from Machines where ID='$rownomes2[ValueI]'", array(), array("Scrollable"=>"static"));
					$cgnomes=sqlsrv_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=sqlsrv_fetch_array($sqlgnomes,SQLSRV_FETCH_ASSOC);
						$ketsetting="$rowgnomes[Description] ";
					}	
				  }
				}		
			
			}//---end  if stenter
			//--begin inspec note
			if ($row2['DepartmentCode']==34){
				$sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  		$cset=sqlsrv_num_rows($sqlset);
			  if ($cset > 0 ){		  
		  
				$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowset[ID]' order by Dated desc", array(), array("Scrollable"=>"static"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
				//$ketsetting="$rowflow[TglF] $rowflow[JamF] ";
				//echo $rowset[ID];
					//--cari noote
					$sqlnomes=sqlsrv_query($conn,"select cast(Note as nvarchar(50)) as Note from ProcessFlowDetailsDeptNote where DepartmentID='30' and ParentID ='$rowflow[ID]'", array(), array("Scrollable"=>"static"));
										
					$cgnomes=sqlsrv_num_rows($sqlnomes);
					if ($cgnomes > 0){
						$rownomes=sqlsrv_fetch_array($sqlnomes,SQLSRV_FETCH_ASSOC);
						$ketsetting="$rownomes[Note] ";
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
where pcpos.ID='$rowkk[0]' order by Dated desc", array(), array("Scrollable"=>"static"));
		  $rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);
		  
	//	  if ($rowkk1[PCBID]==$rowkk2[ID]){
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$rowkk[8] Out:</font> <font class='normal7black'>$rowkk2[DepOut] $rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		//  }else{
        //  	echo "<td width='120' class='BoldCD6' align='center'><font class='blod9black'>$row2[DepartmentName]</font> <font class='normal7black'>In: $rowkk1[TglIn] $rowkk1[JamIn] Tujuan Out: $rowkk2[DepOut]   $rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		//  }
		  //--
		  }elseif ($rowkk[5]<>0){ // =1 : in
		  	$sqlkk2=sqlsrv_query($conn,"select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,DepartmentID  from PCCardPosition where ID='$rowkk[0]' order by ID desc", array(), array("Scrollable"=>"static"));
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
				//---cek surat jalan
			  $kirim="";
		  if ($rowkk[8]=="KK Oke"){
			  $sqlsj="select a.nokk,a.refno,b.no_sj,b.tgl_update from detail_pergerakan_stok a  inner JOIN
packing_list b on a.refno=b.listno
where a.nokk='$row2[NoKK]' limit 1";
			$data=mysqli_query($con,$sqlsj);
			$sjrow=mysqli_num_rows($data);
			if ($sjrow>0){
				$rowsj=mysqli_fetch_array($data);
				$kirim=" No SJ : $rowsj[no_sj] Tgl Kirim : $rowsj[tgl_update]";
			}else{
				$kirim="";
			}
				
		  }
		  
		  //--end surat jalan
		  //---cek kartu kerja yg ke kain jadi
		 // if ($rowkkKJ[8]=="KAIN JADI"){
			  
			  
			    	
		 // }
		  
		  //--end kartu kerja yg ke kain jadi
			echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$rowkk[8]</font><font size=0.1> $ketsetting</font> <font class='normal7black'>In: $rowkk2[TglIn] $rowkk2[JamIn] $kirim</font></td>";
		  }
		  //--
		  
		  //---setting
		  $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  $cset=sqlsrv_num_rows($sqlset);
		  if ($cset > 0 ){
		  	$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='14' order by Dated desc", array(), array("Scrollable"=>"static"));
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
	where lt.MachineType='14' and lt.ParentID ='$rowflow[ID]' and (md.Description='Machine No.' or md.Description='Overfeed' or md.Description='Speed' or md.Description='Temperature') and dv.ValueI='40'
	order by 
		md.Description";
		
						$qrymsn=sqlsrv_query($conn,$sqlmsn, array(), array("Scrollable"=>"static"));
						$ketsetting="$rowflow[TglF] $rowflow[JamF] ";
						while ($rowmsn=sqlsrv_fetch_array($qrymsn,SQLSRV_FETCH_ASSOC)){
							$decmes=trim($rowmsn['Description']);
							if ($decmes=='Machine no.'){
								$sqlmes=sqlsrv_query("select ID,Description from Machines where ID='$rowmsn[ID1]'");
								$rowmes=sqlsrv_fetch_array($sqlmes,SQLSRV_FETCH_ASSOC);
								$val="$rowmes[Description]";
							}else{
								$val="".number_format($rowmsn['Value1'],1)."";
							}
							$ketsetting="$ketsetting $rowmsn[Description]: $val $rowmsn[UnitName]  ";
						}
						
					
				}
		  
		  }
		  //--end setting
		  
		  $sqlkj2="SELECT lebar_act,berat_act FROM tbl_kite WHERE nokk='$row2[NoKK]' AND (user_packing LIKE 'PACKING%' OR user_packing LIKE 'INSPEK%') ORDER BY id DESC LIMIT 1";			  
			$datakj2=mysqli_query($con,$sqlkj2);
			$rowkj2=mysqli_num_rows($datakj2);
			$rowskj2=mysqli_fetch_array($datakj2);
          echo "<td width='100' class='normal333' valign=top>$row2[ColorNo]</td>";
          echo "<td width='150' class='normal333' valign=top>$row2[Color]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Lebar'],0). " inch</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Gramasi'],0). " gr/m2</td>";
		  echo "<td width='80' class='normal333' valign=top>".number_format($rowskj2['lebar_act'],2)."</td>";
          echo "<td width='80' class='normal333' valign=top>".number_format($rowskj2['berat_act'],2)." gr/m2</td>";	
          echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Quantity'],2). " $row2[UnitName]</td>";  	
		  echo "<td width='80' class='normal333' valign=top align=center>$row2[RollCount]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Weight'],2). "</td>"; //$row2[UnitName] ";
		   echo "<td width='80' class='normal333' valign=top><font size=0.1>$row2[TglBagiKain]</font></td>";
			
			$sqlkj1="SELECT count(*) as roll,sum(weight) as qty,sum(yard_) as yard,satuan from detail_pergerakan_stok WHERE nokk='$row2[NoKK]' and (transtatus='0' or transtatus='1') GROUP BY nokk";			  
			$datakj1=mysqli_query($con,$sqlkj1);
			$rowkj1=mysqli_num_rows($datakj1);
			if ($rowkj1>0){
				$rowskj1=mysqli_fetch_array($datakj1);
				$kjQty=$rowskj1['qty'];
				$kjYrd=$rowskj1['yard'];
			    $kjRol=$rowskj1['roll'];
				if($row2['Weight']==0){$loss=0;}else{$loss=(($row2['Weight']-$rowskj1['qty'])/$row2['Weight'])*100;}
			}else{
				$kjQty="0";
				$kjYrd="0";
			    $kjRol="0";
				$loss="0";
			}
			echo "<td width='80' class='normal333' valign=top align=center>$kjRol</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($kjQty,2). "</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($kjYrd,2)." ".$rowskj1['satuan']."</td>";	
		   echo "<td width='80' class='normal333' valign=top>" .number_format($loss,2). " %</td>";	
		   $kjQty="0";
		   $kjRol="0";
		   $loss="0";	
		   //echo "<td width='120' class='normal333' valign=top>'$row2[TglPerlu]";
		  // if ($cekDep<>60){
		  // echo "c";
		   //$selisih=$row2[TglPerlu] - $cekTgl;
		   		//if ($cekTgl > $row2[TglPerlu]){
						//echo " Delay $selisih hari $tglNow";
				//}
		 //  }
		 if($now > $new_jd2)
		 {
		 	if ($cekDep==60){
				$selisih=$jd2 - $jd1;
				if ($selisih < 0){
					$selisih=abs($selisih);
					echo "<td width='140' class='normal333' valign=top>'$row2[TglPerlu]</td>";
					echo "<td width='140' class='normal333' valign=top><font color=red><strong>Delay $selisih hari</stong></font></td>";
				}else{
					echo "<td width='140' class='normal333' valign=top>'$row2[TglPerlu]</td>";
				}
			}else{
				$selisih=$jd3 - $jd2;
				$selisih=abs($selisih);
				echo "<td width='140' class='normal333' valign=top bgcolor='#FFFF00'>'$row2[TglPerlu]</td>";
				echo "<td width='140' class='normal333' valign=top bgcolor='#FFFF00'><font class='normal333blink'><Blink>Delay $selisih hari</Blink></font></td>";
			}
		 }else{
		 		$selisih=$jd3-$jd2;
				$selisih=abs($selisih);
		 	echo "<td width='120' class='normal333' valign=top>'$row2[TglPerlu]</td>";
			echo "<td width='120' class='normal333' valign=top><strong>$selisih hari lagi</strong></td>"; 
		 }
		 
		
		   //echo "</td>";
         echo "<td width='120' class='normal333' valign=top>$row2[ProductNumber]";
		  
		  $ketsetting="";
   

		  $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  $cset=sqlsrv_num_rows($sqlset);
		  if ($cset > 0 ){		  
		  
		  	$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='14' order by Dated desc", array(), array("Scrollable"=>"static"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
				echo " ";
				$ketsetting="$rowflow[TglF] $rowflow[JamF] ";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1499001'", array(), array("Scrollable"=>"static"));
					$rownomes=sqlsrv_fetch_array($sqlnomes,SQLSRV_FETCH_ASSOC);
					
					$sqlnomes2=sqlsrv_query($conn,"select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='$rownomes[ID]'", array(), array("Scrollable"=>"static"));
					$rownomes2=sqlsrv_fetch_array($sqlnomes2,SQLSRV_FETCH_ASSOC);
					
					$sqlgnomes=sqlsrv_query($conn,"select ID,Code,Description,MachineType from Machines where ID='$rownomes2[ValueI]'", array(), array("Scrollable"=>"static"));
					$cgnomes=sqlsrv_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=sqlsrv_fetch_array($sqlgnomes,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting $rowgnomes[Description] ";
					}
					//--
					//--cari speed
					$sqlspeed=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401002'", array(), array("Scrollable"=>"static"));
					$rowspeed=sqlsrv_fetch_array($sqlspeed,SQLSRV_FETCH_ASSOC);
					
					$sqlspeed2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowspeed[ID]'", array(), array("Scrollable"=>"static"));
					
					$cspeed=sqlsrv_num_rows($sqlspeed2);
					
					if ($cspeed > 0){
						$rowspeed2=sqlsrv_fetch_array($sqlspeed2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting Speed:" .number_format($rowspeed2['ValueD'],2). " $rowspeed2[UnitName] ";
					}
					//--
					//--cari temperatur
					$sqltemp=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401003'", array(), array("Scrollable"=>"static"));
					$rowtemp=sqlsrv_fetch_array($sqltemp,SQLSRV_FETCH_ASSOC);
					
					$sqltemp2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowtemp[ID]'", array(), array("Scrollable"=>"static"));
					
					$ctemp=sqlsrv_num_rows($sqltemp2);
					
					if ($ctemp > 0){
						$rowtemp2=sqlsrv_fetch_array($sqltemp2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting suhu:" .number_format($rowtemp2['ValueD'],2). " $rowtemp2[UnitName] ";
					}
					//--
					//--cari overfeed
					$sqlover=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401004'", array(), array("Scrollable"=>"static"));
					$rowover=sqlsrv_fetch_array($sqlover,SQLSRV_FETCH_ASSOC);
					
					$sqlover2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowover[ID]'", array(), array("Scrollable"=>"static"));
					
					$cover=sqlsrv_num_rows($sqlover2);
					
					if ($cover > 0){
						$rowover2=sqlsrv_fetch_array($sqlover2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting overfeed:" .number_format($rowover2['ValueD'],1). " $rowover2[UnitName] ";
					}
					//--				
						
				}
		  
		  }
		  //--end setting
		  echo "<font size=0.1>$ketsetting</font></td>";
          echo "<td class='normal333' valign=top>$row2[ItemNo]/ $row2[ProductDesc]</td>";
		   echo "<td width='120' class='normal333' valign=top>$row2[Alur]</td>";
		  echo "<td width='120' class='normal333' valign=top>'<a href='logscan.php?kk=$row2[PCBID]' target=_blank>$row2[NoKK]</a></td>";
		  echo "<td width='120' class='normal333' valign=top>$row2[TglKK]</td>";	
		  //---Dept Note
		  $sqlcarinotePCB=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  
		  $rowcarinotePCB=sqlsrv_fetch_array($sqlcarinotePCB,SQLSRV_FETCH_ASSOC);
		  
		  $sqlcarinotePFPN=sqlsrv_query($conn,"select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowcarinotePCB[ID]' order by Dated desc", array(), array("Scrollable"=>"static"));
		  
		  $rowcarinotePFPN=sqlsrv_fetch_array($sqlcarinotePFPN,SQLSRV_FETCH_ASSOC); //---dari sini get id
		  
		  $sqlPFDN=sqlsrv_query($conn,"select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Note from ProcessFlowDetailsDeptNote where DepartmentID='$row2[deptID]' and ParentID ='$rowcarinotePFPN[ID]'", array(), array("Scrollable"=>"static"));
		  
		  $PFDN=sqlsrv_fetch_array($sqlPFDN,SQLSRV_FETCH_ASSOC);
		  
		  //---note begin
		  $sqlnote0=sqlsrv_query($conn,"Select top 1 id,parentid,machinetype from Processflowprocessno where parentid='$rowcarinotePCB[ID]' and machinetype='24' order by id desc", array(), array("Scrollable"=>"static"));
		  $rownote0=sqlsrv_fetch_array($sqlnote0,SQLSRV_FETCH_ASSOC);
		  
		   $sqlPFnote=sqlsrv_query($conn,"select top 1 ParentID,cast(Note as nvarchar(200)) as Note from ProcessFlowDetailsNote where ParentID ='$rownote0[id]' order by entrytype desc", array(), array("Scrollable"=>"static"));
		  
		  $PFnote=sqlsrv_fetch_array($sqlPFnote,SQLSRV_FETCH_ASSOC);
		  
		  $catatan="$PFnote[Note]";
		  echo "<td class='normal333' valign=top>$catatan</td>";
		  		  
		  //--end Dept Note ----- BYBO
		  $catatandept="$PFDN[Note]";
		  echo "<td class='normal333' valign=top>$catatandept</td>";
        echo "</tr>";
        
		}
     echo "</table>";

			}else{
				echo "  <font class='normal9black'>Nomor Bon Order : $nobo , TIDAK ditemukan !</font>";	
			}
	//--
	//sqlsrv_free_result($sql);
	//sqlsrv_close($conn);
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
			pm.ProductNumber,pmp.ProductCode as ItemNo, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
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
			where so.PONumber='$nopo' or soda.RefNo='$nopo' and pcb.Gross<>'0'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				ProductPartner pmp on x.ProductID=pmp.ProductID and x.BuyerID=pmp.PartnerID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sql = sqlsrv_query($conn,$sql0, array(), array("Scrollable"=>"static")) 
    or die('A error occured : ');
 
$count = sqlsrv_num_rows($sql);

			if ($count > 0 ){
			$row=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC);
			echo "<font class='blod9black'>Hasil Pencarian : (". date("d/m/y") .")</font>  ";

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
		  echo "   <td class='tombol'><div align='center'>Note </div></td>";
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
			pm.ProductNumber, pmp.ProductCode as ItemNo,pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
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
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel
				
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
					soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				ProductPartner pmp on x.ProductID=pmp.ProductID and x.BuyerID=pmp.PartnerID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sql2b = sqlsrv_query($conn,$sql2, array(), array("Scrollable"=>"static")) 
    or die('A error occured : ');
		//--
		$c=0;
		while ($row2=sqlsrv_fetch_array($sql2b,SQLSRV_FETCH_ASSOC)){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
		if($child > 0){
			$nomLot=substr("$row2[LotNo]",0,1);
			$nomorLot="$nomLot/K$row2[ChildLevel]&nbsp;";				
								
		}else{
			$nomorLot=$row2['LotNo'];
				
		}
			$sqlkk=sqlsrv_query($conn,"select top 1 p.*,d.DepartmentName from PCCardPosition p left join Departments d on p.DepartmentID=d.ID where PCBID='$row2[PCBID]' order by p.ID desc", array(), array("Scrollable"=>"static"));
			$rowkk=sqlsrv_fetch_array($sqlkk);		
			
						
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td class='normal333' valign=top>$c</td>";
          //--lot
					  echo "<td class='normal333' valign=top>";
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='$row2[PCID]' and RootID='0' and LotNo < '1000'";
					  $qryLot = sqlsrv_query($conn,$sqlLot, array(), array("Scrollable"=>"static")) 
								or die('A error occured : ');							
							
								
					  		$rowLot=sqlsrv_fetch_array($qryLot,SQLSRV_FETCH_ASSOC);	
							echo "'$rowLot[TotalLot]-$nomorLot";
					  
					  echo "</td>";
					  //--
			//---POSISI SEBELUMnya
				
				$sqlpsb=sqlsrv_query($conn,"Select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and Status ='0' and DepartmentID<>'$rowkk[DepartmentID]' order by ID desc", array(), array("Scrollable"=>"static"));
				$rowpsb=sqlsrv_fetch_array($sqlpsb);
				
				$sqlkkpsb=sqlsrv_query($conn,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.DepartmentID  = dep.ID
where pcpos.ID='$rowpsb[0]' order by pcpos.ID desc", array(), array("Scrollable"=>"static"));
		  $rowkkpsb=sqlsrv_fetch_array($sqlkkpsb,SQLSRV_FETCH_ASSOC);		  
	
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='normal7black'>$rowkkpsb[DepOut]   Out: $rowkkpsb[TglIn] $rowkkpsb[JamIn]</font></td>";
			
			//--end posisi sebelumnya
			//---if stenter cek no mesin
			$ketsetting="";
			
			if ($row2['DepartmentCode']==44){
				$mtp=14;  //type : finishing
				$linemesin="1499001";
				 $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  		$cset=sqlsrv_num_rows($sqlset);
			  if ($cset > 0 ){		  
		  
				$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='$mtp' order by Dated desc", array(), array("Scrollable"=>"static"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
				$ketsetting="$rowflow[TglF] $rowflow[JamF] ";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '$linemesin'", array(), array("Scrollable"=>"static"));
					$rownomes=sqlsrv_fetch_array($sqlnomes,SQLSRV_FETCH_ASSOC);
					
					$sqlnomes2=sqlsrv_query($conn,"select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='$rownomes[ID]'", array(), array("Scrollable"=>"static"));
					$rownomes2=sqlsrv_fetch_array($sqlnomes2,SQLSRV_FETCH_ASSOC);
					
					$sqlgnomes=sqlsrv_query($conn,"select ID,Code,Description,MachineType from Machines where ID='$rownomes2[ValueI]'", array(), array("Scrollable"=>"static"));
					$cgnomes=sqlsrv_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=sqlsrv_fetch_array($sqlgnomes,SQLSRV_FETCH_ASSOC);
						$ketsetting="$rowgnomes[Description] ";
					}	
				  }
				}		
			
			}//---end  if stenter
			//--begin inspec note
			if ($row2['DepartmentCode']==34){
				$sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  		$cset=sqlsrv_num_rows($sqlset);
			  if ($cset > 0 ){		  
		  
				$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowset[ID]' order by Dated desc", array(), array("Scrollable"=>"static"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
				//$ketsetting="$rowflow[TglF] $rowflow[JamF] ";
				//echo $rowset[ID];
					//--cari noote
					$sqlnomes=sqlsrv_query($conn,"select cast(Note as nvarchar(50)) as Note from ProcessFlowDetailsDeptNote where DepartmentID='30' and ParentID ='$rowflow[ID]'", array(), array("Scrollable"=>"static"));
										
					$cgnomes=sqlsrv_num_rows($sqlnomes);
					if ($cgnomes > 0){
						$rownomes=sqlsrv_fetch_array($sqlnomes,SQLSRV_FETCH_ASSOC);
						$ketsetting="$rownomes[Note] ";
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
where pcpos.ID='$rowkk[0]' order by Dated desc", array(), array("Scrollable"=>"static"));
		  $rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);
		  
	//	  if ($rowkk1[PCBID]==$rowkk2[ID]){
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$rowkk[8] Out:</font> <font class='normal7black'>$rowkk2[DepOut]   $rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		//  }else{
        //  	echo "<td width='120' class='BoldCD6' align='center'><font class='blod9black'>$row2[DepartmentName]</font> <font class='normal7black'>In: $rowkk1[TglIn] $rowkk1[JamIn] Tujuan Out: $rowkk2[DepOut]   $rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		//  }
		  //--
		  }elseif ($rowkk[5]<>0){ // =1 : in
		  	$sqlkk2=sqlsrv_query($conn,"select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,DepartmentID  from PCCardPosition where ID='$rowkk[0]' order by ID desc", array(), array("Scrollable"=>"static"));
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
				
				//---cek surat jalan
				$kirim="";
		  if ($rowkk[8]=="KK Oke"){
			  $sqlsj="select a.nokk,a.refno,b.no_sj,b.tgl_update from detail_pergerakan_stok a  inner JOIN
packing_list b on a.refno=b.listno
where a.nokk='$row2[NoKK]' limit 1";
			$data=mysqli_query($con,$sqlsj);
			$sjrow=mysqli_num_rows($data);
			if ($sjrow>0){
				$rowsj=mysqli_fetch_array($data);
				$kirim=" No SJ : $rowsj[no_sj]   Tgl Kirim : $rowsj[tgl_update]";
			}else{
				$kirim="";
			}
				
		  }
		  
		  //--end surat jalan
			  

			echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$rowkk[8]</font><font size=0.1> $ketsetting</font> <font class='normal7black'>In: $rowkk2[TglIn] $rowkk2[JamIn] $kirim</font></td>";
		  }
		  //--
		  //---setting
		  $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  $cset=sqlsrv_num_rows($sqlset);
		  if ($cset > 0 ){
		  	$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='14' order by Dated desc", array(), array("Scrollable"=>"static"));
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
	where lt.MachineType='14' and lt.ParentID ='$rowflow[ID]' and (md.Description='Machine No.' or md.Description='Overfeed' or md.Description='Speed' or md.Description='Temperature')
	order by 
		md.Description";
		
						$qrymsn=sqlsrv_query($conn,$sqlmsn, array(), array("Scrollable"=>"static"));
						$ketsetting="$rowflow[TglF] $rowflow[JamF] ";
						while ($rowmsn=sqlsrv_fetch_array($qrymsn,SQLSRV_FETCH_ASSOC)){
						$val="".number_format($rowmsn['Value1'],1)."";
							$ketsetting="$ketsetting $rowmsn[Description] : $val $rowmsn[UnitName]  ";
						}
						
					
				}
		  
		  }
		  //--end setting
          echo "<td width='100' class='normal333' valign=top>$row2[ColorNo]</td>";
          echo "<td width='150' class='normal333' valign=top>$row2[Color]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Lebar'],0). " inch</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Gramasi'],0). " gr/m2</td>";
          echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Quantity'],2). " $row2[UnitName]</td>";
		  echo "<td width='80' class='normal333' valign=top align=center>$row2[RollCount]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Weight'],2). " Kg</td>";
		//---warning
		 if($now > $new_jd2)
		 {
		 	if ($cekDep==60){
				$selisih=$jd2 - $jd1;
				if ($selisih < 0){
					$selisih=abs($selisih);
					echo "<td width='140' class='normal333' valign=top>'$row2[TglPerlu]";
					echo " <font color=red><strong>Delay $selisih hari</stong></font>";
				}else{
					echo "<td width='140' class='normal333' valign=top>'$row2[TglPerlu]";
				}
			}else{
				$selisih=$jd3 - $jd2;
				$selisih=abs($selisih);
				echo "<td width='140' class='normal333' valign=top bgcolor='#FFFF00'>'$row2[TglPerlu]";
				echo " <font class='normal333blink'><Blink>Delay $selisih hari</Blink></font>";
			}
		 }else{
		 		$selisih=$jd3-$jd2;
				$selisih=abs($selisih);
		 	echo "<td width='120' class='normal333' valign=top>'$row2[TglPerlu]   <strong>$selisih hari lagi</strong>";
		 }
		 		
		   echo "</td>";
		//---
          echo "<td width='120' class='normal333' valign=top>$row2[ProductNumber]";
		  
		  $ketsetting="";
   

		  $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  $cset=sqlsrv_num_rows($sqlset);
		  if ($cset > 0 ){		  
		  
		  	$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='14' order by Dated desc", array(), array("Scrollable"=>"static"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
				echo " ";
				$ketsetting="$rowflow[TglF] $rowflow[JamF] ";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1499001'", array(), array("Scrollable"=>"static"));
					$rownomes=sqlsrv_fetch_array($sqlnomes,SQLSRV_FETCH_ASSOC);
					
					$sqlnomes2=sqlsrv_query($conn,"select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='$rownomes[ID]'", array(), array("Scrollable"=>"static"));
					$rownomes2=sqlsrv_fetch_array($sqlnomes2,SQLSRV_FETCH_ASSOC);
					
					$sqlgnomes=sqlsrv_query($conn,"select ID,Code,Description,MachineType from Machines where ID='$rownomes2[ValueI]'", array(), array("Scrollable"=>"static"));
					$cgnomes=sqlsrv_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=sqlsrv_fetch_array($sqlgnomes,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting $rowgnomes[Description] ";
					}
					//--
					//--cari speed
					$sqlspeed=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401002'", array(), array("Scrollable"=>"static"));
					$rowspeed=sqlsrv_fetch_array($sqlspeed,SQLSRV_FETCH_ASSOC);
					
					$sqlspeed2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowspeed[ID]'", array(), array("Scrollable"=>"static"));
					
					$cspeed=sqlsrv_num_rows($sqlspeed2);
					
					if ($cspeed > 0){
						$rowspeed2=sqlsrv_fetch_array($sqlspeed2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting Speed:" .number_format($rowspeed2['ValueD'],2). " $rowspeed2[UnitName] ";
					}
					//--
					//--cari temperatur
					$sqltemp=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401003'", array(), array("Scrollable"=>"static"));
					$rowtemp=sqlsrv_fetch_array($sqltemp,SQLSRV_FETCH_ASSOC);
					
					$sqltemp2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowtemp[ID]'", array(), array("Scrollable"=>"static"));
					
					$ctemp=sqlsrv_num_rows($sqltemp2);
					
					if ($ctemp > 0){
						$rowtemp2=sqlsrv_fetch_array($sqltemp2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting suhu:" .number_format($rowtemp2['ValueD'],2). " $rowtemp2[UnitName] ";
					}
					//--
					//--cari overfeed
					$sqlover=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401004'", array(), array("Scrollable"=>"static"));
					$rowover=sqlsrv_fetch_array($sqlover,SQLSRV_FETCH_ASSOC);
					
					$sqlover2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowover[ID]'", array(), array("Scrollable"=>"static"));
					
					$cover=sqlsrv_num_rows($sqlover2);
					
					if ($cover > 0){
						$rowover2=sqlsrv_fetch_array($sqlover2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting overfeed:" .number_format($rowover2['ValueD'],1). " $rowover2[UnitName] ";
					}
					//--				
						
				}
		  
		  }
		  //--end setting
		  echo "<font size=0.1>$ketsetting</font></td>";
          echo "<td class='normal333' valign=top>$row2[ItemNo]/ $row2[ProductDesc]</td>";
		   echo "<td width='120' class='normal333' valign=top>$row2[Alur]</td>";
		  echo "<td width='120' class='normal333' valign=top>'<a href='logscan.php?kk=$row2[PCBID]' target=_blank>$row2[NoKK]</a> $row2[TglKK]</td>";
		  //---Dept Note
		  $sqlcarinotePCB=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  
		  $rowcarinotePCB=sqlsrv_fetch_array($sqlcarinotePCB,SQLSRV_FETCH_ASSOC);
		  
		  $sqlcarinotePFPN=sqlsrv_query($conn,"select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowcarinotePCB[ID]' order by Dated desc", array(), array("Scrollable"=>"static"));
		  
		  $rowcarinotePFPN=sqlsrv_fetch_array($sqlcarinotePFPN,SQLSRV_FETCH_ASSOC);
		  
		  $sqlcarinotePFDN=sqlsrv_query($conn,"select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Note  from ProcessFlowDetailsDeptNote where DepartmentID='$row2[deptID]' and ParentID ='$rowcarinotePFPN[ID]'", array(), array("Scrollable"=>"static"));
		  
		  $rowcarinotePFDN=sqlsrv_fetch_array($sqlcarinotePFDN,SQLSRV_FETCH_ASSOC);
		  
		  //---note begin
		  $sqlnote0=sqlsrv_query($conn,"Select top 1 id,parentid,machinetype from Processflowprocessno where parentid='$rowcarinotePCB[ID]' and machinetype='24' order by id desc", array(), array("Scrollable"=>"static"));
		  $rownote0=sqlsrv_fetch_array($sqlnote0,SQLSRV_FETCH_ASSOC);
		  
		   $sqlPFnote=sqlsrv_query($conn,"select top 1 ParentID,cast(Note as nvarchar(200)) as Note from ProcessFlowDetailsNote where ParentID ='$rownote0[id]' order by entrytype desc", array(), array("Scrollable"=>"static"));
		  
		  $PFnote=sqlsrv_fetch_array($sqlPFnote,SQLSRV_FETCH_ASSOC);
		  
		  $catatan="$PFnote[Note]";
		  echo "<td class='normal333' valign=top>$catatan</td>";
		  		  
		  //--end Dept Note
		  $catatandept=$rowcarinotePFDN['Note'];
		  echo "<td class='normal333' valign=top>$catatandept</td>";
        echo "</tr>";
        
		}
     echo "</table>";

			}else{
				echo "  <font class='normal9black'>Nomor Bon Order : $nobo , TIDAK ditemukan !</font>";	
			}
	//--
	//sqlsrv_free_result($sql);
	//sqlsrv_close($conn);
	//--
}else{
//---proses filter by customer
//echo "proses customer  ";
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
		
	$sqlcust=sqlsrv_query($conn,"Select ID,PartnerNumber,CompanyTitle,PartnerName,Address,City,Province,CountryID,PostalCode,PhoneNumber,FaxNumber,Email from Partners where ID='$codcust'", array(), array("Scrollable"=>"static"));
	$rcust=sqlsrv_fetch_array($sqlcust,SQLSRV_FETCH_ASSOC);
	$sqlcon=sqlsrv_query($conn,"Select ID,CountryName from Countries where ID='$rcust[CountryID]'", array(), array("Scrollable"=>"static"));
		$rcon=sqlsrv_fetch_array($sqlcon,SQLSRV_FETCH_ASSOC);
		

$sql0b="select top 1
			x.*, 
			udq.UnitName, udq.DetailDigits,
			udw.UnitName as WeightUnitName, udw.DetailDigits as WeightDigits,
			udb.UnitName as BatchUnitName, udb.DetailDigits as BatchDigits,
			cust.PartnerNumber as CustomerNumber, cust.CompanyTitle as CustomerTitle, cust.PartnerName as CustomerName,
			buy.PartnerNumber as BuyerNumber, buy.CompanyTitle as BuyerTitle, buy.PartnerName as BuyerName,
			pm.ProductNumber, pmp.ProductCode as ItemNo, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
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
			where so.CustomerID='$codcust' and $filtertgl and pcb.Gross<>'0' --so.SODate between '$tglDel' and '$tglDel2'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,
					pcb.ID, pcb.DocumentNo, pcb.Gross,
					pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				ProductPartner pmp on x.ProductID=pmp.ProductID and x.BuyerID=pmp.PartnerID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sqlb = sqlsrv_query($conn,$sql0b, array(), array("Scrollable"=>"static")) 
    or die('A error occured :0');
 
$count = sqlsrv_num_rows($sqlb);

			if ($count > 0 ){
			$row=sqlsrv_fetch_array($sqlb,SQLSRV_FETCH_ASSOC);
			echo "<font class='blod9black'>Hasil Pencarian   ";
			echo "<font class='blod9black'>Range Tanggal $notefilter : $tglDisplay s.d. $tglDisplay2</font>  ";
			
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
        echo "<td align='left' valign='middle' class='normal9black'>:  $rcust[Address] $rcust[City], $rcust[Province] $rcon[CountryName] (ZIP Code : $rcust[PostalCode])</td>";
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
		  echo "   <td class='tombol'><div align='center'>Note </div></td>";
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
			pm.ProductNumber, pmp.ProductCode as ItemNo, pm.Description as ProductDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
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
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel
				
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
					pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel
				) x inner join
				ProductMaster pm on x.ProductID = pm.ID left join
				ProductPartner pmp on x.ProductID=pmp.ProductID and x.BuyerID=pmp.PartnerID left join
				Departments dep on x.DepartmentID  = dep.ID left join
				Departments pdep on dep.RootID = pdep.ID left join				
				Partners cust on x.CustomerID = cust.ID left join
				Partners buy on x.BuyerID = buy.ID left join
				UnitDescription udq on x.UnitID = udq.ID left join
				UnitDescription udw on x.WeightUnitID = udw.ID left join
				UnitDescription udb on x.BatchUnitID = udb.ID
			order by
				x.SODID, x.PCBID";

$sql2b = sqlsrv_query($conn,$sql2, array(), array("Scrollable"=>"static")) 
    or die('A error occured : 1');
		//--
		$c=0;
		while ($row2=sqlsrv_fetch_array($sql2b,SQLSRV_FETCH_ASSOC)){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
		if($child > 0){
			$nomLot=substr("$row2[LotNo]",0,1);
			$nomorLot="$nomLot/K$row2[ChildLevel]&nbsp;";				
								
		}else{
			$nomorLot=$row2['LotNo'];
				
		}
			$sqlkk=sqlsrv_query($conn,"select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and CounterDepartmentID<>'$row2[DepartmentID]' order by Dated desc", array(), array("Scrollable"=>"static"));
			$rowkk=sqlsrv_fetch_array($sqlkk);
						
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td class='normal333' valign=top>$c</td>";
		 echo "<td class='normal333' valign=top>$row2[TglSO]</td>";
		  echo "<td class='normal333' valign=top>$row2[DocumentNo]</td>";
          //--lot
					  echo "<td class='normal333' valign=top>";
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='$row2[PCID]' and RootID='0' and LotNo < '1000'";
					  $qryLot = sqlsrv_query($conn,$sqlLot, array(), array("Scrollable"=>"static")) 
								or die('A error occured : ');
								
					  		$rowLot=sqlsrv_fetch_array($qryLot,SQLSRV_FETCH_ASSOC);	
							echo "'$rowLot[TotalLot]-$nomorLot";
					  
					  echo "</td>";
					  //--
			//---POSISI SEBELUMnya
				
				$sqlpsb=sqlsrv_query($conn,"Select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and Status ='0' and DepartmentID<>'$row2[DepartmentID]' order by Dated desc", array(), array("Scrollable"=>"static"));
				$rowpsb=sqlsrv_fetch_array($sqlpsb);
				
				$sqlkkpsb=sqlsrv_query($conn,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.DepartmentID  = dep.ID
where pcpos.ID='$rowpsb[0]' order by Dated desc", array(), array("Scrollable"=>"static"));
		  $rowkkpsb=sqlsrv_fetch_array($sqlkkpsb,SQLSRV_FETCH_ASSOC);		  
	
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='normal7black'>$rowkkpsb[DepOut]   Out: $rowkkpsb[TglIn] $rowkkpsb[JamIn]</font></td>";
			
			//--end posisi sebelumnya
		  //--		  
		 
		  if ($rowkk[5]==0){ // =0 : out

		  
							$sqlkk2=sqlsrv_query($conn,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.CounterDepartmentID  = dep.ID
where pcpos.ID='$rowkk[0]' order by Dated desc", array(), array("Scrollable"=>"static"));
		  $rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);
		  
	
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$row2[DepartmentName] Out:</font> <font class='normal7black'>$rowkk2[DepOut]   $rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		
		  }elseif ($rowkk[5]<>0){ // =1 : in
		  	$sqlkk2=sqlsrv_query($conn,"select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition where ID='$rowkk[0]' order by Dated desc", array(), array("Scrollable"=>"static"));
			$rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);
			echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$row2[DepartmentName]</font> <font class='normal7black'>In: $rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		  }
		  //--
          echo "<td width='100' class='normal333' valign=top>$row2[ColorNo]</td>";
			
          echo "<td width='150' class='normal333' valign=top>$row2[Color0]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Lebar'],0). " inch</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Gramasi'],0). " gr/m2</td>";
          echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Quantity'],2). " $row2[UnitName]</td>";
		  echo "<td width='80' class='normal333' valign=top align=center>$row2[RollCount]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Weight'],2). " Kg</td>";
		   echo "<td width='120' class='normal333' valign=top>'$row2[TglPerlu]</td>";
          echo "<td width='120' class='normal333' valign=top>$row2[ProductNumber]";
		  
		  $ketsetting="";
   

		  $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  $cset=sqlsrv_num_rows($sqlset);
		  if ($cset > 0 ){		  
		  
		  	$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='14' order by Dated desc", array(), array("Scrollable"=>"static"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow,SQLSRV_FETCH_ASSOC);
				echo " ";
				$ketsetting="$rowflow[TglF] $rowflow[JamF] ";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1499001'", array(), array("Scrollable"=>"static"));
					$rownomes=sqlsrv_fetch_array($sqlnomes,SQLSRV_FETCH_ASSOC);
					
					$sqlnomes2=sqlsrv_query($conn,"select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='$rownomes[ID]'", array(), array("Scrollable"=>"static"));
					$rownomes2=sqlsrv_fetch_array($sqlnomes2,SQLSRV_FETCH_ASSOC);
					
					$sqlgnomes=sqlsrv_query($conn,"select ID,Code,Description,MachineType from Machines where ID='$rownomes2[ValueI]'", array(), array("Scrollable"=>"static"));
					$cgnomes=sqlsrv_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=sqlsrv_fetch_array($sqlgnomes,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting $rowgnomes[Description] ";
					}
					//--
					//--cari speed
					$sqlspeed=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401002'", array(), array("Scrollable"=>"static"));
					$rowspeed=sqlsrv_fetch_array($sqlspeed,SQLSRV_FETCH_ASSOC);
					
					$sqlspeed2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowspeed[ID]'", array(), array("Scrollable"=>"static"));
					
					$cspeed=sqlsrv_num_rows($sqlspeed2);
					
					if ($cspeed > 0){
						$rowspeed2=sqlsrv_fetch_array($sqlspeed2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting Speed:" .number_format($rowspeed2['ValueD'],2). " $rowspeed2[UnitName] ";
					}
					//--
					//--cari temperatur
					$sqltemp=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401003'", array(), array("Scrollable"=>"static"));
					$rowtemp=sqlsrv_fetch_array($sqltemp,SQLSRV_FETCH_ASSOC);
					
					$sqltemp2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowtemp[ID]'", array(), array("Scrollable"=>"static"));
					
					$ctemp=sqlsrv_num_rows($sqltemp2);
					
					if ($ctemp > 0){
						$rowtemp2=sqlsrv_fetch_array($sqltemp2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting suhu:" .number_format($rowtemp2['ValueD'],2). " $rowtemp2[UnitName] ";
					}
					//--
					//--cari overfeed
					$sqlover=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '1401004'", array(), array("Scrollable"=>"static"));
					$rowover=sqlsrv_fetch_array($sqlover,SQLSRV_FETCH_ASSOC);
					
					$sqlover2=sqlsrv_query($conn,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowover[ID]'", array(), array("Scrollable"=>"static"));
					
					$cover=sqlsrv_num_rows($sqlover2);
					
					if ($cover > 0){
						$rowover2=sqlsrv_fetch_array($sqlover2,SQLSRV_FETCH_ASSOC);
						$ketsetting="$ketsetting overfeed:" .number_format($rowover2['ValueD'],1). " $rowover2[UnitName] ";
					}
					//--				
						
				}
		  
		  }
		  //--end setting
		  echo "<font size=0.1>$ketsetting</font></td>";

          echo "<td class='normal333' valign=top>$row2[ItemNo]/ $row2[ProductDesc]</td>";
		   echo "<td width='120' class='normal333' valign=top>$row2[Alur]</td>";
		  echo "<td width='120' class='normal333' valign=top>'$row2[NoKK] $row2[TglKK]</td>";
		  //---Dept Note
		  $sqlcarinotePCB=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  
		  $rowcarinotePCB=sqlsrv_fetch_array($sqlcarinotePCB,SQLSRV_FETCH_ASSOC);
		  
		  $sqlcarinotePFPN=sqlsrv_query($conn,"select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowcarinotePCB[ID]' order by Dated desc", array(), array("Scrollable"=>"static"));
		  
		  $rowcarinotePFPN=sqlsrv_fetch_array($sqlcarinotePFPN,SQLSRV_FETCH_ASSOC);
		  
		  $sqlcarinotePFDN=sqlsrv_query($conn,"select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Note  from ProcessFlowDetailsDeptNote where DepartmentID='$row2[deptID]' and ParentID ='$rowcarinotePFPN[ID]'", array(), array("Scrollable"=>"static"));
		  
		  $rowcarinotePFDN=sqlsrv_fetch_array($sqlcarinotePFDN,SQLSRV_FETCH_ASSOC);
		  
		  //---note begin
		  $sqlnote0=sqlsrv_query($conn,"Select top 1 id,parentid,machinetype from Processflowprocessno where parentid='$rowcarinotePCB[ID]' and machinetype='24' order by id desc", array(), array("Scrollable"=>"static"));
		  $rownote0=sqlsrv_fetch_array($sqlnote0,SQLSRV_FETCH_ASSOC);
		  
		   $sqlPFnote=sqlsrv_query($conn,"select top 1 ParentID,cast(Note as nvarchar(200)) as Note from ProcessFlowDetailsNote where ParentID ='$rownote0[id]' order by entrytype desc", array(), array("Scrollable"=>"static"));
		  
		  $PFnote=sqlsrv_fetch_array($sqlPFnote,SQLSRV_FETCH_ASSOC);
		  
		  $catatan="$PFnote[Note]";
		  echo "<td class='normal333' valign=top>$catatan</td>";
		  		  
		  //--end Dept Note
		  $catatandept=$rowcarinotePFDN['Note'];
		  echo "<td class='normal333' valign=top>$catatandept</td>";
        echo "</tr>";
        
		}
     echo "</table>";

			}else{
				echo "  <font class='normal9black'>Data TIDAK ditemukan !</font>";	
			}
	//--
	//sqlsrv_free_result($sql);
	//sqlsrv_close($conn);
	
//-------end Proses customer
}
//--
}
?>