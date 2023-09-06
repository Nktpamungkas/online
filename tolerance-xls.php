<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=tolerancesum".date("Ymd-His").".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda

$host="10.0.0.4";
//$host="DIT\MSSQLSERVER08";
$username="timdit";
$password="4dm1n";
$db_name="TM";
//--

$custid=trim($_GET['custid']);
$buyid=trim($_GET['buyid']);
$codcust=$_GET['codcust'];
$buyer=$_GET['buyer'];
$tolerance=$_GET['tol'];

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
//echo "$custid - $buyid - $codcust - $buyer - $tgldateDel2A - $tgldateDel2B";
	//--
	set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	//--




if ($codcust<>"/"){
//---proses filter by customer
//echo "proses customer <br>";
$range=$_GET['range'];


		$tgldateDel=$_GET['tglDel']; 
		$tgldateDelB=$_GET['tglDel2']; 
		$tempDate = explode('-',$tgldateDel);
		$tempDate2 = explode('-',$tgldateDelB);
			
		if ($range=="tglorder"){
			if ($tgldateDel<>""){
				$tglDel="$tgldateDel 00:00:00";
				$tglDisplay=$tempDate[2].'/'.$tempDate[1].'/'.$tempDate[0];
			}else{
				$tglDel="0000-00-00";
				$tglDisplay=" - ";
			}
		//}else{
			if ($tgldateDelB<>""){
				$tglDel2="$tgldateDelB 23:59:59";
				$tglDisplay2=$tempDate2[2].'/'.$tempDate2[1].'/'.$tempDate2[0];
			}else{
				$tglDel2="0000-00-00";
				$tglDisplay2=" - ";
			}
		}
		
If($range=="tglorder"){
$filtertgl="pfipn.Dated between '$tglDel' and '$tglDel2'";
$notefilter="Inspection Dated";
}

if($custid<>""){		
	$sqlcust=mssql_query("Select ID,PartnerNumber,CompanyTitle,PartnerName,Address,City,Province,CountryID,PostalCode,PhoneNumber,FaxNumber,Email from Partners where ID='$codcust'");
	$rcust=mssql_fetch_assoc($sqlcust);
	$sqlcon=mssql_query("Select ID,CountryName from Countries where ID='$rcust[CountryID]'");
		$rcon=mssql_fetch_assoc($sqlcon);

$filterbuy="so.CustomerID='$codcust'";

}//--filter cust

if($buyid<>""){		
	$sqlbuy=mssql_query("Select ID,PartnerNumber,CompanyTitle,PartnerName,Address,City,Province,CountryID,PostalCode,PhoneNumber,FaxNumber,Email from Partners where ID='$buyer'");
	$rbuy=mssql_fetch_assoc($sqlbuy);
	$sqlcon=mssql_query("Select ID,CountryName from Countries where ID='$rbuy[CountryID]'");
		$rcon=mssql_fetch_assoc($sqlcon);

$filterbuy="so.BuyerID='$buyer'";

}//--filter buy

if(($buyid=="") && ($custid=="")){		
	$sqlbuy=mssql_query("Select ID,PartnerNumber,CompanyTitle,PartnerName,Address,City,Province,CountryID,PostalCode,PhoneNumber,FaxNumber,Email from Partners");
	$rbuy=mssql_fetch_assoc($sqlbuy);
	$sqlcon=mssql_query("Select ID,CountryName from Countries where ID='$rbuy[CountryID]'");
		$rcon=mssql_fetch_assoc($sqlcon);

$filterbuy="";

}//--filter tanggal saja
		
if(($buyid=="") && ($custid=="")){
$sql0b="select distinct(x.PCBID),x.Buyer,x.Customer from
(
select
			so.BuyerID,so.CustomerID,pfipn.Dated, pfipn.InspectionNo,pcb.ID as PCBID,
			cust.PartnerName + ', ' + cust.CompanyTitle as Customer, buy.PartnerName + ', ' + buy.CompanyTitle as Buyer
		from 
			ProcessFlowInspectionProcessNo pfipn inner join			
			ProcessControlBatches pcb on pfipn.ParentID = pcb.ID inner join
			ProcessControl pc on pcb.PCID = pc.ID inner join
			ProductMaster pm on pc.ProductID = pm.ID left join
			ProductPartner pp on pm.ID = pp.ProductID left join			
			OrderAssignmentDetails oad on pfipn.ID = oad.PFIPNID left join
			OrderAssignment oa on oad.OrderAssignmentID = oa.ID left join
			ProcessControlJO pcjo on oa.PCJOID = pcjo.ID left join
			SODetails sod on pcjo.SODID = sod.ID left join
			SalesOrders so on sod.SOID = so.ID left join
			SODetailsAdditional soda on sod.ID = soda.SODID left join
			SOSeason sos on so.ID = sos.SOID left join
			SOGarmentStyle sogs on so.ID = sogs.SOID left join
			JobOrders jo on so.ID = jo.SOID left join
			Partners cust on so.CustomerID = cust.ID left join
			Partners buy on so.BuyerID = buy.ID
		where
			oad.ID > 0 and $filtertgl
)x order by x.PCBID";

}else{
	$sql0b="select distinct(x.PCBID),x.Buyer,x.Customer from
(
select
			so.BuyerID,so.CustomerID,pfipn.Dated, pfipn.InspectionNo,pcb.ID as PCBID,
			cust.PartnerName + ', ' + cust.CompanyTitle as Customer, buy.PartnerName + ', ' + buy.CompanyTitle as Buyer
		from 
			ProcessFlowInspectionProcessNo pfipn inner join			
			ProcessControlBatches pcb on pfipn.ParentID = pcb.ID inner join
			ProcessControl pc on pcb.PCID = pc.ID inner join
			ProductMaster pm on pc.ProductID = pm.ID left join
			ProductPartner pp on pm.ID = pp.ProductID left join			
			OrderAssignmentDetails oad on pfipn.ID = oad.PFIPNID left join
			OrderAssignment oa on oad.OrderAssignmentID = oa.ID left join
			ProcessControlJO pcjo on oa.PCJOID = pcjo.ID left join
			SODetails sod on pcjo.SODID = sod.ID left join
			SalesOrders so on sod.SOID = so.ID left join
			SODetailsAdditional soda on sod.ID = soda.SODID left join
			SOSeason sos on so.ID = sos.SOID left join
			SOGarmentStyle sogs on so.ID = sogs.SOID left join
			JobOrders jo on so.ID = jo.SOID left join
			Partners cust on so.CustomerID = cust.ID left join
			Partners buy on so.BuyerID = buy.ID
		where
			$filterbuy and oad.ID > 0 and $filtertgl
)x order by x.PCBID";
}

$sqlb = mssql_query($sql0b) 
    or die('A error occured :0C');
 
$count = mssql_num_rows($sqlb);

			if ($count > 0 ){
			$row=mssql_fetch_assoc($sqlb);
			echo "<font class='blod9black'>Summary Tolerance Inspection Report <br><br>";
			echo "<font class='blod9black'>Tanggal Inspeksi : $tglDisplay s.d. $tglDisplay2</font><br><br>";
			
			echo "<table width='100%' border='0'>";
      echo "<tr>";
        echo "<td width='100' align='left' valign='middle' class='normal9black'>&nbsp;</td>";
        echo "<td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
      echo "</tr>";
	   echo " <tr>";
	   if ($buyid<>"")
	   {
        echo "<td align='left' valign='middle' class='normal9black'>Buyer</td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $row[Buyer]</td>";
	   }
	   
      echo "</tr>";
	  if ($custid<>""){
      echo "<tr>";	  	
        echo "<td align='left' valign='middle' class='normal9black'>Customer</td>";		
        echo "<td align='left' valign='middle' class='normal9black'>: $row[Customer]</td>";
      echo "</tr>";
	  
	//  echo "<tr>";	       
	//	echo "<td align='left' valign='middle' class='normal9black'>Buyer</td>";
     //   echo "<td align='left' valign='middle' class='normal9black'>: $row[Buyer]</td>";		
      //echo "</tr>";
      }
      
     echo " <tr>";
      echo "  <td align='left' valign='middle' class='normal9black'>Detail</td>";
    // echo "   <td align='left' valign='middle' class='normal9black'>| <a href='inspek-xls.php?custid=$custid&buyid=$buyid&range=$range&tglDel=$tgldateDel&tglDel2=$tgldateDelB&codcust=$codcust&buyer=$buyer'> CETAK KE EXCEL </a></td>";
     echo " </tr>";
      
    echo "</table>";
     echo " <table width='100%' border='1'>";
      echo "  <tr>";
	   echo "<td class='tombol'><div align='center'>No.</div></td>";
	  
	  // echo "<td class='tombol'><div align='center'>Tgl Order</div></td>";
	   
		echo "<td class='tombol'><div align='center'>Bon Order</div></td>";
		
		if ($buyid<>""){
		 echo "<td class='tombol'><div align='center'>Factory</div></td>";
		 }else{
		  echo "<td class='tombol'><div align='center'>Buyer</div></td>";
		 }
		  
		  echo "<td class='tombol'><div align='center'>Item</div></td>";
		   echo "<td class='tombol'><div align='center'>Declared Weight (gsm) </div></td>";
		   
		   echo "<td class='tombol'><div align='center'>Tolerance (%)</div></td>";
		    echo "<td class='tombol'><div align='center'>Color</div></td>";
			// echo "<td class='tombol'><div align='center'>PO Number </div></td>";
			 
      
	   echo "<td class='tombol'><div align='center'>LOT</div></td>";
	   
	   echo "<td class='tombol'><div align='center'>Reading 1</div></td>";
	   echo "<td class='tombol'><div align='center'>Reading 2</div></td>";
	   echo "<td class='tombol'><div align='center'>Reading 3</div></td>";
	   echo "<td class='tombol'><div align='center'>Reading 4</div></td>";
	   echo "<td class='tombol'><div align='center'>Reading 5</div></td>";
	   echo "<td class='tombol'><div align='center'>Reading 6</div></td>";
	   echo "<td class='tombol'><div align='center'>Reading 7</div></td>";
	   
	   echo "<td class='tombol'><div align='center'>Average</div></td>";
	   echo "<td class='tombol'><div align='center'>StDev</div></td>";
	   echo "<td class='tombol'><div align='center'>2x StDev (95%)</div></td>";
	   echo "<td class='tombol'><div align='center'>Upper Limit</div></td>";
	   echo "<td class='tombol'><div align='center'>Lower Limit</div></td>";
	   echo "<td class='tombol'><div align='center'>Declared +5%</div></td>";
	   echo "<td class='tombol'><div align='center'>Declared -5%</div></td>";
	   echo "<td class='tombol'><div align='center'>Upper Spec</div></td>";
	   echo "<td class='tombol'><div align='center'>Lower Spec</div></td>";
	   echo "<td class='tombol'><div align='center'>Comment ts</div></td>";
	    echo "<td class='tombol'><div align='center'>Card No</div></td>";
	   // echo "<td class='tombol'><div align='center'>Tgl inspek</div></td>";
		//echo "<td class='tombol'><div align='center'>Roll</div></td>";
		//  echo "<td class='tombol'><div align='center'>QTY</div></td>";
		 //  echo "<td class='tombol'><div align='center'>Yard</div></td>";
        //  echo "<td class='tombol'><div align='center'>Width</div></td>";
		  
	  //--150605 		echo "<td class='tombol'><div align='center'>Posisi Sebelumnya </div></td>";
         
         
         
		 
         
		//  echo "   <td class='tombol'><div align='center'>Lebar Inspek </div></td>";
		  
		//  echo "   <td class='tombol'><div align='center'>Gramasi Inspek </div></td>";
		  
			  
		  
        echo "</tr>";
		//--

if(($buyid=="") && ($custid=="")){
	
		$sqlpre02="select distinct(x.PCBID) from
(
select
			so.BuyerID,so.CustomerID,pfipn.Dated, pfipn.InspectionNo,pcb.ID as PCBID
		from 
			ProcessFlowInspectionProcessNo pfipn inner join			
			ProcessControlBatches pcb on pfipn.ParentID = pcb.ID inner join
			ProcessControl pc on pcb.PCID = pc.ID inner join
			ProductMaster pm on pc.ProductID = pm.ID left join
			ProductPartner pp on pm.ID = pp.ProductID left join			
			OrderAssignmentDetails oad on pfipn.ID = oad.PFIPNID left join
			OrderAssignment oa on oad.OrderAssignmentID = oa.ID left join
			ProcessControlJO pcjo on oa.PCJOID = pcjo.ID left join
			SODetails sod on pcjo.SODID = sod.ID left join
			SalesOrders so on sod.SOID = so.ID left join
			SODetailsAdditional soda on sod.ID = soda.SODID left join
			SOSeason sos on so.ID = sos.SOID left join
			SOGarmentStyle sogs on so.ID = sogs.SOID left join
			JobOrders jo on so.ID = jo.SOID left join
			Partners cust on so.CustomerID = cust.ID left join
			Partners buy on so.BuyerID = buy.ID
		where
			oad.ID > 0 and $filtertgl
)x order by x.PCBID";

}else{
$sqlpre02="select distinct(x.PCBID) from
(
select
			so.BuyerID,so.CustomerID,pfipn.Dated, pfipn.InspectionNo,pcb.ID as PCBID
		from 
			ProcessFlowInspectionProcessNo pfipn inner join			
			ProcessControlBatches pcb on pfipn.ParentID = pcb.ID inner join
			ProcessControl pc on pcb.PCID = pc.ID inner join
			ProductMaster pm on pc.ProductID = pm.ID left join
			ProductPartner pp on pm.ID = pp.ProductID left join			
			OrderAssignmentDetails oad on pfipn.ID = oad.PFIPNID left join
			OrderAssignment oa on oad.OrderAssignmentID = oa.ID left join
			ProcessControlJO pcjo on oa.PCJOID = pcjo.ID left join
			SODetails sod on pcjo.SODID = sod.ID left join
			SalesOrders so on sod.SOID = so.ID left join
			SODetailsAdditional soda on sod.ID = soda.SODID left join
			SOSeason sos on so.ID = sos.SOID left join
			SOGarmentStyle sogs on so.ID = sogs.SOID left join
			JobOrders jo on so.ID = jo.SOID left join
			Partners cust on so.CustomerID = cust.ID left join
			Partners buy on so.BuyerID = buy.ID
		where
			$filterbuy and oad.ID > 0 and $filtertgl
)x order by x.PCBID";	
}

		$qrypre02=mssql_query($sqlpre02);
		//$rowpre02=mssql_fetch_row($qrypre02);

		//--
		$c=0;
		while ($rowpre02=mssql_fetch_assoc($qrypre02)){
		
		//-------begin			
		
		$PCBID=$rowpre02[PCBID];
		
		//---cari data inspection no terakhir
		$sqlInsNo="select top 1 a.* from 
(
select distinct(InspectionNo) from ProcessFlowInspectionProcessNo where ParentID='$PCBID' group by InspectionNo 
)a
order by a.InspectionNo desc";
	$qryInsNo=mssql_query($sqlInsNo);
		$rowInsNo=mssql_fetch_assoc($qryInsNo);
		$NoInspek=$rowInsNo[InspectionNo];

//---------SQL INTI
$sqlINTI="declare @LotNo nvarchar(12), @TotalLots int
select @LotNo = LotNo, @TotalLots = TotalLot from dbo.fn_ProcessControlBatches_GetLotNo(0, 0, '$PCBID')

select zz.* 
from
(
select z.* 
from
(
select y.BatchNo,y.Customer,y.ItemNumber,y.Season,y.Color,y.PONumber,y.JONumber,y.Buyer,
	@LotNo as LotNo, y.TglInspek,count(y.rollno) as jmlROll,sum(y.Weight) as QTY,sum(y.LENGTH) as Yard,y.Width,y.Gramasi,
	avg(NULLIF(y.LebarInspek,0)) as LebarIns,avg(NULLIF(y.GramInspek,0)) as GramIns
		
				
from
	(
	select
			pfipn.RollNo, convert(char(10),pfipn.Dated,103) as TglInspek, pfipn.InspectionNo,
			pcb.DocumentNo as BatchNo,pfipn.Width as LebarInspek,pfipn.Density as GramInspek,
			pm.ProductNumber, pm.Description as ProductDescription, pm.ShortDescription as ProductShortDescription, 			pm.ColorNo, pm.Color, 
			pm.Weight as Gramasi, udd.UnitName as FabricDensityUnitName, udd.DetailDigits as FabricDensityDigits,
			(pm.Width - '2') as Width, udw.UnitName as FabricWidthUnitName, udw.DetailDigits as FabricWidthDigits,
			cust.PartnerName + ', ' + cust.CompanyTitle as Customer, buy.PartnerName + ', ' + buy.CompanyTitle as Buyer, 
			case when isnull(pp.ProductCode, '-') = '' then '-' else isnull(pp.ProductCode, '-') end as ItemNumber,
			isnull(sogs.OtherDesc, '') as Season,
			soda.PONumber, jo.DocumentNo as JONumber, pcjo.KONo as KONumber, 			
			x.*
			
		from 
			ProcessFlowInspectionProcessNo pfipn inner join
			(
				select
					pfipn.ID,			
					qap.WEIGHT as Weight,qap.LENGTH
					
				from 
					ProcessFlowInspectionProcessNo pfipn inner join
					ProcessFlowInspection pfi on pfipn.EntryType = pfi.EntryType and pfipn.ID = pfi.ParentID and pfipn.MachineType = pfi.MachineType left join
					QtyAfterPacking qap on pfipn.RollNo = qap.ROLLNO
				where
					pfipn.EntryType = 2 and pfipn.ParentID = '$PCBID' and pfipn.MachineType = 17 and pfipn.InspectionNo = '$NoInspek' and qap.PCBID='$PCBID'
				group by
					pfipn.ID,qap.WEIGHT,qap.LENGTH
			) x on pfipn.ID = x.ID inner join
			ProcessControlBatches pcb on pfipn.ParentID = pcb.ID inner join
			ProcessControl pc on pcb.PCID = pc.ID inner join
			ProductMaster pm on pc.ProductID = pm.ID left join
			ProductPartner pp on pm.ID = pp.ProductID left join
			UnitDescription udd on pm.WeightUnitID = udd.ID left join
			UnitDescription udw on pm.WidthUnitID = udw.ID left join		
			OrderAssignmentDetails oad on pfipn.ID = oad.PFIPNID left join
			OrderAssignment oa on oad.OrderAssignmentID = oa.ID left join
			ProcessControlJO pcjo on oa.PCJOID = pcjo.ID left join
			SODetails sod on pcjo.SODID = sod.ID left join
			SalesOrders so on sod.SOID = so.ID left join
			SODetailsAdditional soda on sod.ID = soda.SODID left join
			SOSeason sos on so.ID = sos.SOID left join
			SOGarmentStyle sogs on so.ID = sogs.SOID left join
			JobOrders jo on so.ID = jo.SOID left join
			Partners cust on so.CustomerID = cust.ID left join
			Partners buy on so.BuyerID = buy.ID
)y
group by y.BatchNo,y.TglInspek,y.JONumber,y.Color,y.Customer,y.PONumber,y.ItemNumber,y.Season,y.Gramasi,y.Width,y.Buyer
)z
)zz";

$qryINTI=mssql_query($sqlINTI);
$rowINTI=mssql_fetch_assoc($qryINTI);

//---END SQL INTI
	if ($rowINTI[BatchNo]<>""){
		$Muncul="YA";
	}else{
		$Muncul="TIDAK";
	}
	
	if ($Muncul=="YA"){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 			
        echo "<tr>"; // bgcolor='$bgcolor'>";
		echo "<td class='normal333'><div align='center'>$c</div></td>";
		
		
	  //if($buyid<>""){	
	   //echo "<td class='normal333'><div align='right'>".number_format($rowINTI[UOM],2)."</div></td>";
	  // }
	  // echo "<td class='normal333'><div align='center'>Tgl Order</div></td>";
	    
		
		echo "<td class='normal333'><div align='left'>$rowINTI[JONumber]</div></td>";
		
		if ($buyid<>""){
		 echo "<td class='normal333'><div align='left'>$rowINTI[Customer]</div></td>";
		 }else{
		 echo "<td class='normal333'><div align='left'>$rowINTI[Buyer]</div></td>";
		 }
		  echo "<td class='normal333'><div align='left'>$rowINTI[ItemNumber]</div></td>";
		  echo "<td class='normal333'><div align='center'>".number_format($rowINTI[Gramasi],0)." </div></td>";
		  
		  echo "<td class='normal333'><div align='center'>$tolerance %</div></td>";
		    echo "<td class='normal333'><div align='left'>$rowINTI[Color]</div></td>";
			// echo "<td class='normal333'><div align='left'>$rowINTI[PONumber]</div></td>";
			 
      
	   echo "<td class='normal333'><div align='left'>'$rowINTI[LotNo]</div></td>";
	   
	   //------------------------ambil data gramasi inspek di roll nya
	   
	   $sqlGRAM="select
			pfipn.RollNo, pfipn.Width as LebarInspek,pfipn.Density as GramInspek,		
			x.*
			
		from 
			ProcessFlowInspectionProcessNo pfipn inner join
			(
				select
					pfipn.ID,					
					qap.WEIGHT as Weight,qap.LENGTH
					
				from 
					ProcessFlowInspectionProcessNo pfipn inner join
					ProcessFlowInspection pfi on pfipn.EntryType = pfi.EntryType and pfipn.ID = pfi.ParentID and pfipn.MachineType = pfi.MachineType left join
					QtyAfterPacking qap on pfipn.RollNo = qap.ROLLNO
				where
					pfipn.EntryType = 2 and pfipn.ParentID = '$PCBID' and pfipn.MachineType = 17 and pfipn.InspectionNo = '$NoInspek' and qap.PCBID='$PCBID' and pfipn.Density > 0
				group by
					pfipn.ID,qap.WEIGHT,qap.LENGTH
			) x on pfipn.ID = x.ID 
order by pfipn.RollNo";
	   
	   $qryGRAM=mssql_query($sqlGRAM);
	//--
			$countGram=mssql_num_rows($qryGRAM);
		if 	($countGram >0){
			$i=0; $tgr=0;
			while ($res=mssql_fetch_assoc($qryGRAM)){
				$i++;
				
				${"gr".$i}=$res[GramInspek];
				
			//	$tgr=$tgr + $res[GramInspek];
			}
		
			//	$avg=$tgr / $i;
		}else{
			$i=1;		
			while($i<=7)
			  {
			 		${"gr".$i}=0;				
				//	$avg=0;
					$i++;
			  }
			
		}
		
	   //----end of ambil data
	   
	   echo "<td class='normal333'><div align='center'>".number_format($gr1,0)."</div></td>";
	   echo "<td class='normal333'><div align='center'>".number_format($gr2,0)."</div></td>";
	   echo "<td class='normal333'><div align='center'>".number_format($gr3,0)."</div></td>";
	   echo "<td class='normal333'><div align='center'>".number_format($gr4,0)."</div></td>";
	   echo "<td class='normal333'><div align='center'>".number_format($gr5,0)."</div></td>";
	   echo "<td class='normal333'><div align='center'>".number_format($gr6,0)."</div></td>";
	   echo "<td class='normal333'><div align='center'>".number_format($gr7,0)."</div></td>";
	   
	   $tgr=$gr1 + $gr2 + $gr3 + $gr4 + $gr5 + $gr6 + $gr7;
	   $avg=$tgr / $i;
	   $persen=$tolerance/100;
	   $dectplus=$rowINTI[Gramasi] * (1 + $persen);
	   $dectmin=$rowINTI[Gramasi] * (1 - $persen);
	   
	//   $array=array($gr1,$gr2,$gr3,$gr4,$gr5,$gr6,$gr7);
	//   $mean=array_sum($array)/count($array);
	   $mean=$avg;
	    $var0=0 ;
	   
	   	  if ($gr7<>0){
		   
	  		$varian0=array(pow($gr1 - $mean,2) ,pow($gr2 - $mean,2),pow($gr3 - $mean,2),pow($gr4 - $mean,2),pow($gr5 - $mean,2),pow($gr6 - $mean,2),pow($gr7 - $mean,2)) ;
	   
	   }
	   
	   if($gr7==0){
		   
		   $varian0=array(pow($gr1 - $mean,2) ,pow($gr2 - $mean,2),pow($gr3 - $mean,2),pow($gr4 - $mean,2),pow($gr5 - $mean,2),pow($gr6 - $mean,2)) ;
		   
	   }
	   
	   if($gr6==0){
		   
		   $varian0=array(pow($gr1 - $mean,2) ,pow($gr2 - $mean,2),pow($gr3 - $mean,2),pow($gr4 - $mean,2),pow($gr5 - $mean,2)) ;
		   
	   }
	    if($gr5==0){
		   
		   $varian0=array(pow($gr1 - $mean,2) ,pow($gr2 - $mean,2),pow($gr3 - $mean,2),pow($gr4 - $mean,2)) ;
		   
	   }
	   
	   if ($gr4==0){
		   $varian0=array(pow($gr1 - $mean,2) ,pow($gr2 - $mean,2),pow($gr3 - $mean,2)) ;
		   		   
	   }
	   
	   if ($gr3==0){
		   $varian0=array(pow($gr1 - $mean,2) ,pow($gr2 - $mean,2)) ;
		   		   
	   }
	   
	   if ($gr2==0){
		  // $varian0=array(pow($gr1 - $mean,2)) ;
		  $var0=1; 		   
	   }
	   
	   if ($gr1==0){
		   $var0=1 ;
		   		   
	   }
	
	//for ($j=0; $j <= $i; $j++){
	//	$varian0=array(pow($;
	//}
	
	   if ($var0 ==1){
		   $stdev=0;
		   $stdev2=0;
		   $uplimit=0;
		   $lowlimit=0;
		   
	   }else{
		   $varian=array_sum($varian0);
		   $bagi=$varian / ($i - 1);
		   $stdev=sqrt($bagi);
		   
		   $stdev2=2 * $stdev;
		   $uplimit=$avg + $stdev2;
		   $lowlimit=$avg - $stdev2;
		   		
	   }
	   
	   $cekupspec=$dectplus - $uplimit;
	   if ($cekupspec > 0 ){
		   $upspec="OK";
	   }else{
			$upspec="FAIL";   
	   }
	   
	    $ceklowspec=$dectmin - $lowlimit;
	   if ($ceklowspec < 0 ){
		   $lowspec="OK";
	   }else{
			$lowspec="FAIL";   
	   }
		  
	//		   // Function to calculate square of value - mean
//		function sd_square($x, $mean) { return pow($x - $mean,2); }
		
		// Function to calculate standard deviation (uses sd_square)    
//		function sd($array) {
			// square root of sum of squares devided by N-1
//			return sqrt(array_sum(array_map("sd_square", $array, array_fill(0,count($array), (array_sum($array) / count($array)) ) ) ) / (count($array)-1) );
	//	}
	   
	
	   echo "<td class='normal333'><div align='center'>".number_format($avg,2)."</div></td>";
	   echo "<td class='normal333'><div align='center'>".number_format($stdev,2)."</div></td>";
	   echo "<td class='normal333'><div align='center'>".number_format($stdev2,2)."</div></td>";
	   echo "<td class='normal333'><div align='center'>".number_format($uplimit,2)."</div></td>";
	   echo "<td class='normal333'><div align='center'>".number_format($lowlimit,2)."</div></td>";
	   echo "<td class='normal333'><div align='center'>".number_format($dectplus,2)."</div></td>";
	   echo "<td class='normal333'><div align='center'>".number_format($dectmin,2)."</div></td>";
	   echo "<td class='normal333'><div align='center'>$upspec</div></td>";
	   echo "<td class='normal333'><div align='center'>$lowspec</div></td>";
	   echo "<td class='normal333'><div align='center'> </div></td>";
	   
	   
	   //echo "<td class='normal333'><div align='left'><a href='inspect-kk.php?pcbid=$PCBID&insno=$NoInspek' target=_blank>$rowINTI[BatchNo]</a></div></td>";
	   
	   echo "<td class='normal333'><div align='left'>'$rowINTI[BatchNo]</div></td>";
	  //  echo "<td class='normal333'><div align='left'>$rowINTI[TglInspek]</div></td>";
		//echo "<td class='normal333'><div align='left'>$rowINTI[jmlROll]</div></td>";
		//  echo "<td class='normal333'><div align='right'>".number_format($rowINTI[QTY],2)."</div></td>";
		//   echo "<td class='normal333'><div align='right'>".number_format($rowINTI[Yard],2)."</div></td>";
        //  echo "<td class='normal333'><div align='right'>".number_format($rowINTI[Width],0)."</div></td>";
		  
	  //--150605 		echo "<td class='normal333'><div align='right'>Posisi Sebelumnya </div></td>";
          
         
		///  echo "   <td class='normal333'><div align='right'>".number_format($rowINTI[LebarIns],0)." </div></td>";
		  
		//  echo "   <td class='normal333'><div align='right'>".number_format($rowINTI[GramIns],0)." </div></td>";
		 
		 
        echo "</tr>";
		
		$gr1=0; $gr2=0;  $gr3=0; $gr4=0; $gr5=0; $gr6=0; $gr7=0;
		 
        echo "</tr>";
 	
	}//----end jika bukan KK Ok
	
 } //---------------------------------end jika KK sudah keluar  
 
 		
		}
     echo "</table>";
	 
	// echo "<table>";
	// echo "<tr><td></td><td></td></tr>";
	//	echo "<tr><td></td><td></td></tr>";
		echo "<br><br>";
		echo "Keterangan :<br>";
		echo "(E) Declared Weight (gsm) berisi gramasi permintaan<br>";
		echo "( I - O ) Reading 1 s/d 7 adalah banyak roll yang dicek gramasi<br>";
		//echo "Reading 1 -7 adalah Roll<br>";
		//echo "Reading 2 : Roll 7<br>";
		//echo "Reading 3 : Roll 14<br>";
		//echo "dst...<br>";
     
	// echo "</table>";

			}else{
				echo "<br><br><font class='normal9black'>Data TIDAK ditemukan ! $tglDisplay - $tglDisplay2 $tglDel $tglDel2</font>";	
			}
	//--
	//mssql_free_result($sql);
	mssql_close($conn);
	
//-------end Proses customer
//}
//--

?>