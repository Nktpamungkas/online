<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=bon-order.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php

//$host="dybin";
$host="10.0.0.4";
//$host="DIT\MSSQLSERVER08";
$username="sa";
$password="ditbin";
$db_name="TM";
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
ini_set('display_errors',0);
	include"koneksiQC.php";
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<?php {    
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

$sql = mssql_query($sql0) 
    or die('A error occured : ');
 
$count = mssql_num_rows($sql);

			if ($count > 0 ){
			$row=mssql_fetch_assoc($sql);
			$ponya=trim($row[PONumber]);
			
     echo " <table width='100%' border='1'>";
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

$sql2b = mssql_query($sql2) 
    or die('A error occured : ');
		//--
		$c=0;
		while ($row2=mssql_fetch_assoc($sql2b)){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
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
							
			$sqlkk=mssql_query("select top 1 p.*,d.DepartmentName from PCCardPosition p left join Departments d on p.DepartmentID=d.ID where PCBID='$row2[PCBID]' order by p.ID desc");
			$rowkk=mssql_fetch_row($sqlkk);
						
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
					  $qryLot = mssql_query($sqlLot) 
								or die('A error occured : ');							
							
								
					  		$rowLot=mssql_fetch_assoc($qryLot);	
							echo "'$rowLot[TotalLot]-$nomorLot";
					  
					  echo "</td>";
					  //--
			//---POSISI SEBELUMnya
				
				$sqlpsb=mssql_query("Select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and Status ='0' and DepartmentID<>'$rowkk[DepartmentID]' order by ID desc");
				$rowpsb=mssql_fetch_row($sqlpsb);
				
				$sqlkkpsb=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.DepartmentID  = dep.ID
where pcpos.ID='$rowpsb[0]' order by pcpos.ID desc");
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
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$rowkk[8]<br>Out:</font> <font class='normal7black'>$rowkk2[DepOut]  <br>$rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		//  }else{
        //  	echo "<td width='120' class='BoldCD6' align='center'><font class='blod9black'>$row2[DepartmentName]</font><br><font class='normal7black'>In: $rowkk1[TglIn] $rowkk1[JamIn]<br>Tujuan Out: $rowkk2[DepOut]  <br>$rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		//  }
		  //--
		  }elseif ($rowkk[5]<>0){ // =1 : in
		  	$sqlkk2=mssql_query("select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,DepartmentID  from PCCardPosition where ID='$rowkk[0]' order by ID desc");
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
				//---cek surat jalan
			  $kirim="";
		  if ($rowkk[8]=="KK Oke"){
			  $sqlsj="select a.nokk,a.refno,b.no_sj,b.tgl_update from detail_pergerakan_stok a  inner JOIN
packing_list b on a.refno=b.listno
where a.nokk='$row2[NoKK]' limit 1";
			$data=mysql_query($sqlsj);
			$sjrow=mysql_num_rows($data);
			if ($sjrow>0){
				$rowsj=mysql_fetch_array($data);
				$kirim="<br>No SJ : $rowsj[no_sj] <br> Tgl Kirim : $rowsj[tgl_update]";
			}else{
				$kirim="";
			}
				
		  }
		  
		  //--end surat jalan

			echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$rowkk[8]</font><font size=0.1><br>$ketsetting</font><br><font class='normal7black'>In: $rowkk2[TglIn] $rowkk2[JamIn] $kirim</font></td>";
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
				echo "<br>";
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
          echo "<td class='normal333' valign=top>$row2[ItemNo]/ $row2[ProductDesc]</td>";
		   echo "<td width='120' class='normal333' valign=top>$row2[Alur]</td>";
		  echo "<td width='120' class='normal333' valign=top>'<a href='logscan.php?kk=$row2[PCBID]' target=_blank>$row2[NoKK]</a><br>$row2[TglKK]</td>";
		  //---Dept Note
		  $sqlcarinotePCB=mssql_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  
		  $rowcarinotePCB=mssql_fetch_assoc($sqlcarinotePCB);
		  
		  $sqlcarinotePFPN=mssql_query("select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowcarinotePCB[ID]' order by Dated desc");
		  
		  $rowcarinotePFPN=mssql_fetch_assoc($sqlcarinotePFPN); //---dari sini get id
		  
		  $sqlPFDN=mssql_query("select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Note from ProcessFlowDetailsDeptNote where DepartmentID='$row2[deptID]' and ParentID ='$rowcarinotePFPN[ID]'");
		  
		  $PFDN=mssql_fetch_assoc($sqlPFDN);
		  
		  //---note begin
		  $sqlnote0=mssql_query("Select top 1 id,parentid,machinetype from Processflowprocessno where parentid='$rowcarinotePCB[ID]' and machinetype='24' order by id desc");
		  $rownote0=mssql_fetch_assoc($sqlnote0);
		  
		   $sqlPFnote=mssql_query("select top 1 ParentID,cast(Note as nvarchar(200)) as Note from ProcessFlowDetailsNote where ParentID ='$rownote0[id]' order by entrytype desc");
		  
		  $PFnote=mssql_fetch_assoc($sqlPFnote);
		  
		  $catatan="$PFnote[Note]";
		  echo "<td class='normal333' valign=top>$catatan</td>";
		  		  
		  //--end Dept Note ----- BYBO
		  $catatandept="$PFDN[Note]";
		  echo "<td class='normal333' valign=top>$catatandept</td>";
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
?>