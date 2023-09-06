<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=deptkk".date("Ymd-His").".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
ini_set("error_reporting", 1);
session_start();
$host="10.0.0.4";
$username="sa";
$password="ditbin";
$db_name="TM";
$connInfo = array( "Database"=>$db_name, "UID"=>$username, "PWD"=>$password);
$conn1     = sqlsrv_connect( $host, $connInfo);
//--
$act=$_POST['act'];
$subid=$_GET['subid'];
$ceko=$_GET['ceko'];

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

	//--
$tglDel="0000-00-00";


$dep0=trim(strip_tags($_GET['dep0'])); //--departemennya
$dep=trim(strip_tags($_GET['dep'])); //----sub departemennya
//$now=date();

if($dep<>""){
	
	if ($tglDel=="0000-00-00"){
		
	//	$sql0="select distinct(z.PCBID),z.ParentID,z.ID as DepartmentID,z.Status from
	//(
	//select x.PCBID,d.DepartmentName,d.ParentID,d.ID,x.Status from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
	//inner join ProcessControlBatches pcb on pcb.ID=x.PCBID
	//where x.Dated > '$now' and x.Status='1' and pcb.Gross<>'0'
	//) z
	//where z.ID='$dep' order by z.PCBID";
	$sql0="select distinct(z.PCBID),z.ParentID,z.ID as DepartmentID from
	(
	select x.PCBID,d.DepartmentName,d.ParentID,d.ID from processcontrolbatcheslastposition x left join Departments d on d.ID=x.DepartmentID
	inner join ProcessControlBatches pcb on pcb.ID=x.PCBID
	inner join PCCardPosition y on pcb.ID=y.PCBID
	where pcb.Gross<>'0' 
	) z
	where z.ID='$dep' order by z.PCBID desc";	
	

	}else{
	//---normal		
	//		$sql0="select distinct(z.PCBID),z.ParentID,z.ID as DepartmentID,z.Status from
	//(
	//select x.PCBID,d.DepartmentName,d.ParentID,d.ID,x.Status from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
	//inner join ProcessControlBatches pcb on pcb.ID=x.PCBID
	//where x.Dated > '$tglDel' and x.Status='1' and pcb.Gross<>'0'
	//) z
	//where z.ID='$dep' order by z.PCBID";
	
	$sql0="select distinct(z.PCBID),z.ParentID,z.ID as DepartmentID from
	(
	select x.PCBID,d.DepartmentName,d.ParentID,d.ID from processcontrolbatcheslastposition x left join Departments d on d.ID=x.DepartmentID
	inner join ProcessControlBatches pcb on pcb.ID=x.PCBID
	inner join PCCardPosition y on pcb.ID=y.PCBID
	where pcb.Gross<>'0' and y.dated between '$tglDel' and '$tglDel2'
	) z
	where z.ID='$dep' order by z.PCBID desc";
	
	}
	//---

}else{

	if ($tglDel=="0000-00-00"){
	//$sql0="select distinct(z.PCBID),z.ParentID,z.ID as DepartmentID,z.Status from
	//(
	//select x.PCBID,d.DepartmentName,d.ParentID,d.ID,x.Status from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
	//inner join ProcessControlBatches pcb on pcb.ID=x.PCBID
	//where x.Dated > '$now' and x.Status='1' and pcb.Gross<>'0'
	//) z
	//where z.ParentID='$dep0' order by z.ID,z.PCBID";
	$sql0="select distinct(z.PCBID),z.ParentID,z.ID as DepartmentID from
	(
	select x.PCBID,d.DepartmentName,d.ParentID,d.ID from processcontrolbatcheslastposition x left join Departments d on d.ID=x.DepartmentID
	inner join ProcessControlBatches pcb on pcb.ID=x.PCBID
	inner join PCCardPosition y on pcb.ID=y.PCBID
	where pcb.Gross<>'0'
	) z
	where z.ParentID='$dep0' order by z.PCBID desc";	
	
	
	}else{
	//---normal
	//$sql0="select distinct(z.PCBID),z.ParentID,z.ID as DepartmentID,z.Status from
	//(
	//select x.PCBID,d.DepartmentName,d.ParentID,d.ID,x.Status from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
	//inner join ProcessControlBatches pcb on pcb.ID=x.PCBID
	//where x.Dated > '$tglDel' and x.Status='1' and pcb.Gross<>'0'
	//) z
	//where z.ParentID='$dep0' order by z.ID,z.PCBID";
	
	$sql0="select distinct(z.PCBID),z.ParentID,z.ID as DepartmentID from
	(
	select x.PCBID,d.DepartmentName,d.ParentID,d.ID from processcontrolbatcheslastposition x left join Departments d on d.ID=x.DepartmentID
	inner join ProcessControlBatches pcb on pcb.ID=x.PCBID
	inner join PCCardPosition y on pcb.ID=y.PCBID
	where pcb.Gross<>'0' and y.dated between '$tglDel' and '$tglDel2'
	) z
	where z.ParentID='$dep0' order by z.PCBID desc";	
	
	}
}
	//}
//-

$sql = sqlsrv_query($conn1,$sql0, array(), array("Scrollable"=>"static")) 
    or die('A error occured : 0');
 
$count = sqlsrv_num_rows($sql);

			if ($count > 0 ){	
			//$row=sqlsrv_fetch_array($sql);
			
			   if($dep<>""){
					$sqlDep0="select ID,ParentID,DepartmentName from Departments where ID='$dep'";			
					$sqlDep = sqlsrv_query($conn1,$sqlDep0) ;
					$rowDepA=sqlsrv_fetch_array($sqlDep);
					$subDep=$rowDepA['DepartmentName']; $parID=$rowDepA['ParentID'];
					
					$sqlDep1="select ID,ParentID,DepartmentName from Departments where ID='$parID'";			
					$sqlDepB = sqlsrv_query($conn1,$sqlDep1) ;
					$rowDepB=sqlsrv_fetch_array($sqlDepB);
					$ParentDep=$rowDepB['DepartmentName'];
				}else{
					
					$subDep="";
					
					$sqlDep1="select ID,ParentID,DepartmentName from Departments where ID='$dep0'";			
					$sqlDepB = sqlsrv_query($conn1,$sqlDep1) ;
					$rowDepB=sqlsrv_fetch_array($sqlDepB);
					$ParentDep=$rowDepB['DepartmentName'];
				}
			
			echo "<font class='blod9black'>Hasil Pencarian Departemen : $ParentDep ($subDep) <br><br>";			
			
			
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	  echo "   <td class='tombol'><div align='center'>No. </div></td>";
	  if($dep==""){	  
	  echo "   <td class='tombol'><div align='center'>Sub Dept. </div></td>";
	  }
	  echo "   <td class='tombol'><div align='center'>Langganan </div></td>";
	  echo "   <td class='tombol'><div align='center'>No BOn ORder </div></td>";
       
	   echo "   <td class='tombol'><div align='center'>No LOT </div></td>";
          echo "<td class='tombol'><div align='center'>KK IN</div></td>";
		  echo "<td class='tombol'><div align='center'>KK OUT</div></td>";
		   echo "<td class='tombol'><div align='center'>Lama_Waktu</div></td>";
          echo "<td class='tombol'><div align='center'>No Warna </div></td>";
          echo "<td class='tombol'><div align='center'>Warna</div></td>";
          echo "<td class='tombol'><div align='center'>Nett QTY </div></td>";
		  echo "<td class='tombol'><div align='center'>Bruto BagiKain</div></td>";
          echo "<td class='tombol'><div align='center'>Product Number </div></td>";
          echo "<td class='tombol'><div align='center'>Product Description </div></td>";
		  echo "   <td class='tombol'><div align='center'>No Kartu Kerja </div></td>";
		   echo "   <td class='tombol'><div align='center'>Dept. Note </div></td>";
        echo "</tr>";
		
		$c=0;
		$noOut=0;
		$bagikg=0; $bagimet=0;
//---------------------------------------------------------BEGIN LOOPING-------------------------990
		while ($row=sqlsrv_fetch_array($sql)){
			

		//$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
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
			dep.DepartmentCode, dep.DepartmentName, pdep.DepartmentCode as RootDepartmentCode, pdep.DepartmentName as RootDepartmentName,
			dep.ID as deptID
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
			--where jo.DocumentNo='$nobo'
			--where so.SODate between '$tglDel' and '$tglDel2'
			where pcb.ID='$row[PCBID]' and pcb.Gross<>'0' and pcb.DocumentNo like '1020%'
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
			--where dep.ID='$dep'
			order by
				x.SODID desc, x.PCBID";

$sql2b = sqlsrv_query($conn1,$sql2, array(), array("Scrollable"=>"static")) or die('A error occured : ');
$row2=sqlsrv_fetch_array($sql2b);
		//--
//-------------------------------------------------------------------BEGIN ROW------------------------------------
//--CEK DATA IN DULU
		  
if($dep<>""){		  
//---SUB dep
		  //----in
		  $sqlkkCEK=sqlsrv_query($conn1,"select top 1 * from PCCardPosition where PCBID='$row2[PCBID]' and Status='1' and Dated between '$tglDel' and '$tglDel2' and DepartmentID='$dep' order by ID DESC");	
			$inoutINCEK="";
		  while ($rowkkCEK=sqlsrv_fetch_array($sqlkkCEK)){
		  		//$rowkk=sqlsrv_fetch_row($sqlkk);
			 
				$sqlkk2CEK=sqlsrv_query($conn1,"select top 1 ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition where ID='$rowkkCEK[ID]' and DepartmentID='$dep' order by ID DESC");
				$rowkk2CEK=sqlsrv_fetch_array($sqlkk2CEK);
				
				$tglINakhirCEK=$rowkk2CEK['Dated'];
		  }
		 
		  //---
//--dep0
}else{
//----in
$sql0kkCEK="select z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.PCBID='$row2[PCBID]' and x.Dated between '$tglDel' and '$tglDel2' and x.Status='1' 
) z
where z.DepartmentID='$row[DepartmentID]'
order by z.Dated";

		  $sqlkkCEK=sqlsrv_query($conn1,$sql0kkCEK) or die('A error occured : CEK IN DULU');	
			$inoutINCEK="";
		  while ($rowkkCEK=sqlsrv_fetch_array($sqlkkCEK)){
		  		//$rowkk=sqlsrv_fetch_row($sqlkk);
			 
				$sqlkk2CEK=sqlsrv_query($conn1,"select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition where ID='$rowkkCEK[ID]' and DepartmentID='$rowkkCEK[DepartmentID]' order by Dated");
				$rowkk2CEK=sqlsrv_fetch_array($sqlkk2CEK);
				
				$tglINakhirCEK=$rowkk2CEK['Dated'];
		  }
		 		  //---
}
//---END DATA IN

//------CEK DATA OUT

//--Out	
if($dep<>""){
//--SUB dep 	
$sqlkkOCEK=sqlsrv_query($conn1,"select top 1 * from PCCardPosition where PCBID='$row2[PCBID]' and Status='0' and Dated > '$tglINakhirCEK' and DepartmentID='$dep' order by ID DESC");
			$inoutOutCEK="";
			
			 $rowkkOCEK=sqlsrv_fetch_array($sqlkkOCEK);
						$sqlkk2bCEK=sqlsrv_query($conn1,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated,dep.ParentID as DEPTID  from PCCardPosition pcpos 
	left join
	Departments dep on pcpos.CounterDepartmentID  = dep.ID
	where pcpos.ID='$rowkkOCEK[ID]' and pcpos.DepartmentID='$dep' order by Dated desc", array(), array("Scrollable"=>"static"));
	$countOutCEK=sqlsrv_num_rows($sqlkk2bCEK);
			  $rowkk2bCEK=sqlsrv_fetch_array($sqlkk2bCEK);
			  $CEKdept=$rowkk2bCEK['DEPTID'];
			  $InoutOUTCEK="<font class='Bold333'>$rowkk2b[TglIn]</font> $rowkk2b[JamIn] <font class='blod9black'>$rowkk2b[DepOut]</font>"; 
		
	//if  (($countOutCEK == 0) || ($CEKdept=='2')){
	if ($countOutCEK == 0){
		$showRow="OK";
	}else{
		$showRow="NO";
	}
		//--out
}else{
//-dep0		
//--Out		
//-----------CEK 1
$sql0kkOCEK1="select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.PCBID='$row2[PCBID]' and x.Dated > '$tglINakhirCEK' and x.Status='0' 
) z
--where z.DepartmentID='$row[DepartmentID]'
order by z.Dated desc";

		  $sqlkkOCEK1=sqlsrv_query($conn1,$sql0kkOCEK1) or die('A error occured : CEK 1 out');	
			$inoutOutCEK1="lll";
			
			 $rowkkOCEK1=sqlsrv_fetch_array($sqlkkOCEK1);
			 $deptParentID1= $rowkkOCEK1['ParentID'];
			 
						$sqlkk2bCEK1=sqlsrv_query($conn1,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated,dep.ParentID as DEPID  from PCCardPosition pcpos 
	left join
	Departments dep on pcpos.CounterDepartmentID  = dep.ID
	where pcpos.ID='$rowkkOCEK1[ID]' and pcpos.DepartmentID='$row[DepartmentID]' order by Dated desc", array(), array("Scrollable"=>"static"));
	$countOutCEK1=sqlsrv_num_rows($sqlkk2bCEK1);
			  $rowkk2bCEK1=sqlsrv_fetch_array($sqlkk2bCEK1);
			  $deptCEK1=$rowkk2bCEK1['DEPID'];

	if ($deptCEK1==$dep0){	
		$showRow="OK";
	}else{
		$showRow="NO";
	}

//-----------END CEK 1
if ($showRow=="NO"){	

$sql0kkOCEK="select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.PCBID='$row2[PCBID]' and x.Dated > '$tglINakhirCEK' and x.Status='0' 
) z
where z.DepartmentID='$row[DepartmentID]'
order by z.Dated desc";

		  $sqlkkOCEK=sqlsrv_query($conn1,$sql0kkOCEK, array(), array("Scrollable"=>"static")) or die('A error occured : CEK out');	
			$inoutOutCEK="lll";
			$numCount1=sqlsrv_num_rows($sqlkkOCEK);
			$rowkkOCEK=sqlsrv_fetch_array($sqlkkOCEK);
			 $deptParentID= $rowkkOCEK['ParentID'];
			
	if ($numCount1 == 0 ){			 //TAMBAHAN
			 
						$sqlkk2bCEK=sqlsrv_query($conn1,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated,dep.ParentID as DEPID  from PCCardPosition pcpos 
	left join
	Departments dep on pcpos.CounterDepartmentID  = dep.ID
	where pcpos.ID='$rowkkOCEK[ID]' and pcpos.DepartmentID='$row[DepartmentID]' order by Dated desc", array(), array("Scrollable"=>"static"));
	$countOutCEK=sqlsrv_num_rows($sqlkk2bCEK);
			  $rowkk2bCEK=sqlsrv_fetch_array($sqlkk2bCEK);
			  $deptCEK=$rowkk2bCEK['DEPID'];
			  
			  if ($countOutCEK == 0){
				$showRow="OK";
			  }else{
				$showRow="NO";
			  }
			  //-------------
	}else{
		//-------
		$sql0kkOCEK2="select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.PCBID='$row2[PCBID]' and x.Dated > '$tglINakhirCEK'
) z
where z.ParentID='$dep0'
order by z.Dated desc";

		  $sqlkkOCEK2=sqlsrv_query($conn1,$sql0kkOCEK2, array(), array("Scrollable"=>"static")) or die('A error occured : CEK 2 out');	
			$inoutOutCEK2="lll";
			$numCount2=sqlsrv_num_rows($sqlkkOCEK2);
			$rowkkOCEK2=sqlsrv_fetch_array($sqlkkOCEK2);
			 $deptParentID2= $rowkkOCEK2['ParentID'];
		
		//--------
	 		  if ($numCount2 == 0){
				$showRow="OK";
			  }else{
				$showRow="NO";
			  }
	}								//----END TAMBAHAN
		
			  //$InoutOUTCEK="<font class='Bold333'>$rowkk2b[TglIn]</font> $rowkk2b[JamIn] <font class='blod9black'>$rowkk2b[DepOut]</font>";
   
	
	
}//----END if $showRow=NO
		//--out
//--dep0 end
}	


//---END CEK DATA OUT

//---update cek apakah kartu kerja nya masih di $dep0 atau di $dep (sub)

$sqlcek1= sqlsrv_query($conn1,"select top 1 * from pccardposition where PCBID='$row[PCBID]' order by dated desc");
	$rowpc=sqlsrv_fetch_array($sqlcek1);
	$pcidcek=$rowpc['ID'];
	
	$querycek2="select a.*,b.Departmentname from PCCardPosition a inner join departments b
on a.departmentid=b.id
where b.parentid='$dep0' and a.ID='$pcidcek'
order by a.pcbid,a.id desc";
	
	$sqlcek2=sqlsrv_query($conn1,$querycek2, array(), array("Scrollable"=>"static"));
	
$count2 = sqlsrv_num_rows($sqlcek2);

if ($count2 > 0 ){	
	$showRow="OK";
			  }else{
				$showRow="NO";
			  }


//--tambahan 2020-09-28, ambil kartu kerja diatas tahun 2020 ('1020---')
$count3=sqlsrv_num_rows($sql2b);
	if ($count3 > 0 ){	
		$showRow="OK";
	}else{
		$showRow="NO";
	}
			  
//------------------------------------SHOW ROW------------------


if ($showRow=="OK")
{ //---display row
   $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
   $noOut=$noOut + 1;
   
        echo "<tr bgcolor='$bgcolor'>";
		echo "   <td class='normal333'  valign=top>$c</td>"; //---NO
		if($dep==""){
			$sqlgetdep=sqlsrv_query($conn1,"select ID,DepartmentName from Departments where ID='$row[DepartmentID]'");
			$rowgetdep=sqlsrv_fetch_array($sqlgetdep);
			
	  echo "   <td class='normal333'  valign=top>$rowgetdep[DepartmentName]</td>"; //---Sub DEPT
	  }
		echo "<td width='120' class='normal333'  valign=top>$row2[CustomerName]</td>"; //---LANGGANAN
		echo "<td width='120' class='normal333'  valign=top><a href='order.php?bin=$row2[DocumentNo]' target=_blank>$row2[DocumentNo]</a></td>"; //-----------NO BON ORDER
          
		  //--lot
			  //----cari salinan
			   $child=$row2['ChildLevel'];
			
					if($child > 0){
						$sqlgetparent=sqlsrv_query($conn1,"select ID,LotNo from ProcessControlBatches where ID='$row2[RootID]' and ChildLevel='0'");
						$rowgp=sqlsrv_fetch_array($sqlgetparent);
						
						//$nomLot=substr("$row2[LotNo]",0,1);
						$nomLot=$rowgp['LotNo'];
						$nomorLot="$nomLot/K$row2[ChildLevel]&nbsp;";				
											
					}else{
						$nomorLot=$row2['LotNo'];
							
					}
			  //--end salinan
					  echo "<td class='normal333' valign=top>";
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='$row2[PCID]' and LotNo < '1000'";
					  $qryLot = sqlsrv_query($conn1,$sqlLot) 
								or die('A error occured : ');
								
					  		$rowLot=sqlsrv_fetch_array($qryLot);	
							//echo "'$rowLot[TotalLot]-$row2[LotNo]";
							echo "'$rowLot[TotalLot]-$nomorLot";
					  
					  echo "</td>"; //---------------NO LOT
					  //--
					 
		  //--		  
		  //echo "tess :$rowkk[5]";
//---------------------------------------------------------HIDE 

if($dep<>""){		  
//---dep
		  //----in
		  $sqlkk=sqlsrv_query($conn1,"select top 1 * from PCCardPosition where PCBID='$row2[PCBID]' and Status='1' and DepartmentID='$dep' order by ID desc");	
			$inoutIN="";
		  while ($rowkk=sqlsrv_fetch_array($sqlkk)){
		  		//$rowkk=sqlsrv_fetch_row($sqlkk);
			 
				$sqlkk2=sqlsrv_query($conn1,"select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition where ID='$rowkk[ID]' and DepartmentID='$dep' order by Dated");
				$rowkk2=sqlsrv_fetch_array($sqlkk2);
				$inoutIN="$inoutIN <font class='Bold333'>$rowkk2[TglIn]</font> $rowkk2[JamIn]|";
				$tglINakhir=$rowkk2['Dated'];
		  }
		  echo "<td width='120' class='BoldCD6' align='center' valign=top><font class='normal7black'>$inoutIN</font></td>"; //-----KK IN
		  //---
//--dep0
} else{
//----in
$sql0kk="select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.PCBID='$row2[PCBID]' and x.Status='1' 
) z
where z.DepartmentID='$row[DepartmentID]'
order by z.ID desc";

		  $sqlkk=sqlsrv_query($conn1,$sql0kk) or die('A error occured : 1');	
			$inoutIN="";
		  while ($rowkk=sqlsrv_fetch_array($sqlkk)){
		  		//$rowkk=sqlsrv_fetch_row($sqlkk);
			 
				$sqlkk2=sqlsrv_query($conn1,"select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition where ID='$rowkk[ID]' and DepartmentID='$rowkk[DepartmentID]' order by Dated");
				$rowkk2=sqlsrv_fetch_array($sqlkk2);
				$inoutIN="$inoutIN <font class='Bold333'>$rowkk2[TglIn]</font> $rowkk2[JamIn]|";
				$tglINakhir=$rowkk2['Dated'];
		  }
		  echo "<td width='120' class='BoldCD6' align='center' valign=top><font class='normal7black'>$inoutIN</font></td>"; //-----KK IN
		  //---
}
//---dep0 end		
 
//--Out	
if($dep<>""){
//--dep 	
$sqlkkO=sqlsrv_query($conn1,"select top 1 * from PCCardPosition where PCBID='$row2[PCBID]' and Status='0' and Dated >= '$tglINakhir' and DepartmentID='$dep' order by ID desc");
			$inoutOut="";
			
			 $rowkkO=sqlsrv_fetch_array($sqlkkO);
						$sqlkk2b=sqlsrv_query($conn1,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition pcpos 
	left join
	Departments dep on pcpos.CounterDepartmentID  = dep.ID
	where pcpos.ID='$rowkkO[ID]' and pcpos.DepartmentID='$dep' order by Dated desc", array(), array("Scrollable"=>"static"));
	$countOut=sqlsrv_num_rows($sqlkk2b);
			  $rowkk2b=sqlsrv_fetch_array($sqlkk2b);
			  $InoutOUT="<font class='Bold333'>$rowkk2b[TglIn]</font> $rowkk2b[JamIn] <font class='blod9black'>$rowkk2b[DepOut]</font>"; 
		//--out
}else{
//-dep0		
//--Out		
$sql0kkO="select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.PCBID='$row2[PCBID]' and x.Dated >= '$tglINakhir' and x.Status='0' 
) z
where z.DepartmentID='$row[DepartmentID]'
order by z.ID desc";

		  $sqlkkO=sqlsrv_query($conn1,$sql0kkO) or die('A error occured : 1b out');	
			$inoutOut="lll";
			
			 $rowkkO=sqlsrv_fetch_array($sqlkkO);
						$sqlkk2b=sqlsrv_query($conn1,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition pcpos 
	left join
	Departments dep on pcpos.CounterDepartmentID  = dep.ID
	where pcpos.ID='$rowkkO[ID]' and pcpos.DepartmentID='$row[DepartmentID]' order by Dated desc", array(), array("Scrollable"=>"static"));
	$countOut=sqlsrv_num_rows($sqlkk2b);
			  $rowkk2b=sqlsrv_fetch_array($sqlkk2b);
			  $InoutOUT="<font class='Bold333'>$rowkk2b[TglIn]</font> $rowkk2b[JamIn] <font class='blod9black'>$rowkk2b[DepOut]</font>";
		//--out
//--dep0 end
}			  
		  //	if ($countOut==0){----2015-04-16 update
		//		$noOut=$noOut + 1;
		//	}
		
		  echo "<td width='120' class='BoldCD6' align='center' valign=top><font class='normal7black'>$InoutOUT</font></td>"; //-----KK OUT
		  //--end in out
		  //--hitung lama waktu
			
			$pecah1 = explode("/", $rowkk2['TglIn']);
			$date1 = $pecah1[0];
			$month1 = $pecah1[1];
			$year1 = $pecah1[2];
			$pecah2 = explode("/", $rowkk2b['TglIn']);
			$date2 = $pecah2[0];
			$month2 = $pecah2[1];
			$year2 = $pecah2[2];
			$jd1 = GregorianToJD($month1,$date1, $year1);
			
			if ($month2 <>""){
				$jd2 = GregorianToJD($month2,$date2,$year2);
			}else{
				$jd2 = GregorianToJD(00,00,00);
			}
				$selisih=$jd2 - $jd1;
				$selisih=abs($selisih);
				$time=round((strtotime($rowkk2b['Dated']) - strtotime($rowkk2['Dated']))/3600,1);
				
				//$time=date("h:i",$time);
		  //-----lama waktu
		  if ($selisih > 0){
			  if ($time > 0){
			  	$time2=round($time/24,1);
				  if($time2 >=1 ){
					  echo "<td width='100' class='normal333' valign=top align=center>$time2 hari</td>";
				  }else{
				  		echo "<td width='100' class='normal333' valign=top align=center>$time jam</td>";
				  }
				 
			  //echo "<td width='100' class='normal333' valign=top>$selisih hari</td>";
			  }else{
			  
			  $timenow=date("Y-m-d H:i:s");
			  $timelos=round((strtotime($timenow) - strtotime($rowkk2['Dated']))/3600,1);
			  $timelos=abs($timelos);
			  $time2los=round($timelos/24,1);
				  if($time2los >=1 ){
					  echo "<td width='100' class='normal333' valign=top align=center bgcolor='#f2b522'>$time2los hari</td>";
				  }else{
				  		echo "<td width='100' class='normal333' valign=top align=center bgcolor='#f2b522'>$timelos jam</td>";
				  }
			  //echo "<td width='100' class='normal333' valign=top align=center bgcolor='#f2b522'></td>";
			  }
		  }else{
		   echo "<td width='100' class='normal333' valign=top align=center>$time jam</td>";
		  }
		  //--
		  //---
          echo "<td width='100' class='normal333' valign=top>$row2[ColorNo]</td>"; //---NO WARNA
          echo "<td width='150' class='normal333' valign=top>$row2[Color]</td>"; //-----WARNA
          echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Quantity'],2). " $row2[UnitName]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Weight'],2). " Kg</td>"; //$row2[UnitName]</td>";
		   //---HITUNG TOTAL KG DAN METER
			if ($row2['UnitName']=="kg"){				
				$bagikg=$bagikg + $row2['Weight'];
			}
			if ($row2['UnitName']=="meter"){				
				$bagimet=$bagimet + $row2['Weight'];
			}			
			//--
          echo "<td width='120' class='normal333' valign=top>$row2[ProductNumber]";
		  $ketsetting="";
		  $mtp="";
		   //---setting
if ($dep=="18"){ //stenter
	//$desmesin="mc.Description like 'Mesin Stenter%'";
	$mtp=14;  //type : finishing
	$linemesin="1499001";
	$linespeed="1401002";
	$linesuhu="1401003";
	$lineover="1401004";
//}	
}elseif ($dep=="15"){ //belah
	$mtp=4;  //type : oven
	$linemesin="499001";
	$linespeed="";
	$linesuhu="401001";
	$lineover="401002";

}elseif ($dep=="20"){ //compact
	$mtp=15;  //type : compact
	$linemesin="1599001";
	$linespeed="1501001";
	$linesuhu="1501002";
	$lineover="1501003";
}elseif ($dep=="41"){ //Lipat
	//$mtp=99; tidak ada setting mesin
}elseif ($dep=="16"){ //oven
	$mtp=4;  //type : oven
	$linemesin="499001";
	$linespeed="";
	$linesuhu="401001";
	$lineover="401002";
}elseif ($dep=="65"){ //Preset - Fin
	$mtp=2;  //type : preset
	$linemesin="299001";
	$linespeed="201002";
	$linesuhu="201003";
	$lineover="201004";
}elseif ($dep=="17"){ //Setting
	//tidak ada setting mesin
}

if ($mtp<>""){	   
echo "<hr>";
		  $sqlset=sqlsrv_query($conn1,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"static"));
		  $cset=sqlsrv_num_rows($sqlset);
		  if ($cset > 0 ){		  
		  
		  	$rowset=sqlsrv_fetch_array($sqlset);
				$sqlflow=sqlsrv_query($conn1,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='$mtp' order by Dated desc", array(), array("Scrollable"=>"static"));
				$cflow=sqlsrv_num_rows($sqlflow);
				if ($cflow > 0 ){
				$rowflow=sqlsrv_fetch_array($sqlflow);
				$ketsetting="$rowflow[TglF] $rowflow[JamF]<br>";
				//echo $rowset[ID];
					//--cari no mesin
					$sqlnomes=sqlsrv_query($conn1,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '$linemesin'");
					$rownomes=sqlsrv_fetch_array($sqlnomes);
					
					$sqlnomes2=sqlsrv_query($conn1,"select ID,ParentID,ValueI from ProcessFlowDetailsvalues where ParentID='$rownomes[ID]'");
					$rownomes2=sqlsrv_fetch_array($sqlnomes2);
					
					$sqlgnomes=sqlsrv_query($conn1,"select ID,Code,Description,MachineType from Machines where ID='$rownomes2[ValueI]'", array(), array("Scrollable"=>"static"));
					$cgnomes=sqlsrv_num_rows($sqlgnomes);
					if ($cgnomes > 0){
						$rowgnomes=sqlsrv_fetch_array($sqlgnomes);
						$ketsetting="$ketsetting $rowgnomes[Description]<br>";
					}
					//--
					//--cari speed
					$sqlspeed=sqlsrv_query($conn1,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '$linespeed'");
					$rowspeed=sqlsrv_fetch_array($sqlspeed);
					
					$sqlspeed2=sqlsrv_query($conn1,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowspeed[ID]'");
					
					$cspeed=sqlsrv_num_rows($sqlspeed2);
					
					if ($cspeed > 0){
						$rowspeed2=sqlsrv_fetch_array($sqlspeed2);
						$ketsetting="$ketsetting Speed:" .number_format($rowspeed2['ValueD'],2). " $rowspeed2[UnitName]<br>";
					}
					//--
					//--cari temperatur
					$sqltemp=sqlsrv_query($conn1,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '$linesuhu'");
					$rowtemp=sqlsrv_fetch_array($sqltemp);
					
					$sqltemp2=sqlsrv_query($conn1,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowtemp[ID]'", array(), array("Scrollable"=>"static"));
					
					$ctemp=sqlsrv_num_rows($sqltemp2);
					
					if ($ctemp > 0){
						$rowtemp2=sqlsrv_fetch_array($sqltemp2);
						$ketsetting="$ketsetting suhu:" .number_format($rowtemp2['ValueD'],2). " $rowtemp2[UnitName]<br>";
					}
					//--
					//--cari overfeed
					$sqlover=sqlsrv_query($conn1,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='$rowflow[ID]' and LineID = '$lineover'");
					$rowover=sqlsrv_fetch_array($sqlover);
					
					$sqlover2=sqlsrv_query($conn1,"select a.ID,a.ParentID,a.ValueI,a.ValueD,b.UnitName from ProcessFlowDetailsvalues a inner join
UnitDescription b on a.UnitID=b.ID where a.ParentID='$rowover[ID]'", array(), array("Scrollable"=>"static"));
					
					$cover=sqlsrv_num_rows($sqlover2);
					
					if ($cover > 0){
						$rowover2=sqlsrv_fetch_array($sqlover2);
						$ketsetting="$ketsetting overfeed:" .number_format($rowover2['ValueD'],1). " $rowover2[UnitName]<br>";
					}
					//--				
						
				}
		  
		  }
		  //--end setting
} //---end stenter		  
		  echo "<font size=0.1>$ketsetting</font></td>";
          echo "<td class='normal333' valign=top>$row2[ProductDesc]</td>";
		  echo "<td width='120' class='normal333' valign=top>'<a href='logscan.php?kk=$row2[PCBID]' target=_blank>$row2[NoKK]</a><br>$row2[TglKK]</td>";
		  //---Dept Note
		  $sqlcarinotePCB=sqlsrv_query($conn1,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  
		  $rowcarinotePCB=sqlsrv_fetch_array($sqlcarinotePCB);
		  
		  $sqlcarinotePFPN=sqlsrv_query($conn1,"select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowcarinotePCB[ID]' order by Dated desc");
		  
		  $rowcarinotePFPN=sqlsrv_fetch_array($sqlcarinotePFPN);
		  
		  $sqlcarinotePFDN=sqlsrv_query($conn1,"select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Cat  from ProcessFlowDetailsDeptNote where DepartmentID='$row2[deptID]' and ParentID ='$rowcarinotePFPN[ID]'");
		  
		  $rowcarinotePFDN=sqlsrv_fetch_array($sqlcarinotePFDN);
		  
		  		  
		  //--end Dept Note  ----BYCUST
		  $catatandept=$rowcarinotePFDN['Cat'];
		  echo "<td class='normal333' valign=top>$catatandept</td>";
        echo "</tr>";

//---end display row
}
//------------------------------------------------------------------END ROW------------------------------------------------

        
		}
		//--total
		echo "  <tr>";
	  echo "   <td class='tombol'><div align='center'></div></td>"; //--No. 
	  if($dep==""){	  
	  echo "   <td class='tombol'><div align='center'></div></td>"; //Sub Dept. 
	  }
	  echo "   <td class='tombol'><div align='center'></div></td>"; //Langganan 
	  echo "   <td class='tombol'><div align='center'></div></td>";//No BOn ORder 
       
	   echo "   <td class='tombol'><div align='center'></div></td>";//No LOT 
          echo "<td class='tombol'><div align='center'></div></td>";//KK IN
		  echo "<td class='tombol'><div align='center'></div></td>";//KK OUT
		   echo "<td class='tombol'><div align='center'></div></td>";//Lama_Waktu
          echo "<td class='tombol'><div align='center'></div></td>";//No Warna 
          echo "<td class='tombol'><div align='center'></div></td>";//Warna
          echo "<td class='tombol'><div align='center'>Total:</div></td>";//Nett QTY 
		  	  //---display total
			  if ($bagikg > 0){
			  	$displaybagi="" .number_format($bagikg,2). "Kg";
			  }else{
			  	$displaybagi="";
			  }			 
			  if ($bagimet > 0){
			  	$displaybagim="" .number_format($bagimet,2). "meter";
			  }else{
			  	$displaybagim="";
			  }			  
			 
			  $viewtotalbagi="$displaybagi<br>$displaybagim";
			  //--
		  echo "<td class='tombol'><div align='center'>$viewtotalbagi</div></td>";//Bruto BagiKain
          echo "<td class='tombol'><div align='center'></div></td>";//Product Number 
          echo "<td class='tombol'><div align='center'></div></td>";//Product Description 
		  echo "   <td class='tombol'><div align='center'></div></td>";//No Kartu Kerja 
		   echo "   <td class='tombol'><div align='center'></div></td>";//Dept. Note
        echo "</tr>";
		//--
     echo "</table>";
	 echo "<br>Kartu Kerja Belum Keluar : $noOut";

		
			}else{
				echo "<br><br><font class='normal9black'>Data TIDAK ditemukan !</font>";	
			}
	//--
	// sqlsrv_free_result($sql);
	// sqlsrv_close($conn);
	//--
//}
//--

//--
?>