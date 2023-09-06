<?php

$host="10.0.0.4";
//$host="DIT\MSSQLSERVER08";
$username="timdit";
$password="4dm1n";
$db_name="TM";

$pcbid=$_GET['pcbid'];
$insno=$_GET['insno'];
$formno=$_GET['formno'];

?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Detail Inspection Report</title>
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
				<li class="selected">
					<a href="inspect.php">Inpect Report</a>				</li>
				<li>
					<a href="inoutkk-1.php">Scan In/Out </a>				</li>
				
			</ul>
		</div>
	</div>
	<div id="contents">
	  
		<div class="area">
			<div class="area">
				<table width="120%" border="0">                  
                  <tr>
                    <td class="normal9black"><?php
  
	//--
	set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	//--		

$sql0b="select top 1 y.* from
(
	select
			convert(char(10),pfipn.Dated,103) as TglInspek, pfipn.InspectionNo,
			pcb.DocumentNo as BatchNo,pfipn.Width as LebarInspek,pfipn.Density as GramInspek,
			pm.ProductNumber, pm.Description as ProductDescription, pm.ShortDescription as ProductShortDescription, pm.ColorNo, pm.Color, 
			pm.Weight as Gramasi, udd.UnitName as FabricDensityUnitName, udd.DetailDigits as FabricDensityDigits,
			(pm.Width - '2') as Width, udw.UnitName as FabricWidthUnitName, udw.DetailDigits as FabricWidthDigits,
			cust.PartnerName + ', ' + cust.CompanyTitle as Customer, buy.PartnerName + ', ' + buy.CompanyTitle as Buyer, 
			case when isnull(pp.ProductCode, '-') = '' then '-' else isnull(pp.ProductCode, '-') end as ItemNumber,
			isnull(sogs.OtherDesc, '') as Season,
			soda.PONumber, jo.DocumentNo as JONumber, pcjo.KONo as KONumber
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
					pfipn.EntryType = 2 and pfipn.ParentID = '$pcbid' and pfipn.MachineType = 17 and pfipn.InspectionNo = '$insno' and qap.PCBID='$pcbid'
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
	)y";

$sqlb = mssql_query($sql0b) 
    or die('A error occured :0C');
 
$count = mssql_num_rows($sqlb);

if ($count > 0 ){
			$row=mssql_fetch_assoc($sqlb);
			echo "<font class='blod9black'>Detail Inspection Report <br><br>";
			echo "<font class='blod9black'>No Kartu Kerja : $row[BatchNo]</font><br><br>";
			echo "<font class='blod9black'>Buyer/ Customer : $row[Buyer]/ $row[Customer]</font><br>";
			
			echo "<table width='100%' border='0'>";
      echo "<tr>";
        echo "<td width='100' align='left' valign='middle' class='normal9black'>&nbsp;</td>";
        echo "<td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
      echo "</tr>";
	  echo " <tr>";	  
        echo "<td align='left' valign='middle' class='normal9black'>Tanggal Inspek</td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $row[TglInspek] | No Inspek : $row[InspectionNo]</td>";	  
      echo "</tr>";
	   echo " <tr>";	  
        echo "<td align='left' valign='middle' class='normal9black'>Produk</td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $row[ProductNumber] | $row[Color] | $row[ProductShortDescription] </td>";	  
      echo "</tr>";
	  
	  echo " <tr>";	  
        echo "<td align='left' valign='middle' class='normal9black'>Item</td>";
        echo "<td align='left' valign='middle' class='normal9black'>: $row[ItemNumber] | $row[Season] </td>";	  
      echo "</tr>";
	 
      echo "<tr>";	  	
        echo "<td align='left' valign='middle' class='normal9black'>Order Number</td>";		
        echo "<td align='left' valign='middle' class='normal9black'>: $row[JONumber] | PO : $row[PONumber] | Knitting : $row[KONumber] </td>";
      echo "</tr>";
	  
       echo "<tr>";	  	
        echo "<td align='left' valign='middle' class='normal9black'></td>";		
        echo "<td align='left' valign='middle' class='normal9black'></td>";
      echo "</tr>";
     echo " <tr>";
      echo "  <td align='left' valign='middle' class='normal9black'>Detail</td>";
     //echo "   <td align='left' valign='middle' class='normal9black'>| <a href='inspect-xls.php?custid=$custid&buyid=$buyid&range=$range&tglDel=$tgldateDel&tglDel2=$tgldateDelB&codcust=$codcust&buyer=$buyer'> CETAK KE EXCEL </a></td>";
     echo " </tr>";
      
    echo "</table>";
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	   echo "<td class='tombol'><div align='center'>No._</div></td>";
	  //if($buyid<>""){	
	   echo "<td class='tombol'><div align='center'>Nomor Roll</div></td>";
	  // }
	  // echo "<td class='tombol'><div align='center'>Tgl Order</div></td>";
	    echo "<td class='tombol'><div align='center'>QTY_</div></td>";
		
		  echo "<td class='tombol'><div align='center'>Yard__</div></td>";
		   
		  echo "   <td class='tombol'><div align='center'>Lebar Inspek </div></td>"; 
		  echo "   <td class='tombol'><div align='center'>Gramasi Inspek </div></td>";
		  
		  echo "   <td class='tombol'><div align='center'>A Slub </div></td>";
		  //--tambahan 2016.01.19
		  echo "   <td class='tombol'><div align='center'>A Barre</div></td>";
		   echo "   <td class='tombol'><div align='center'>A Univen</div></td>";
		    echo "   <td class='tombol'><div align='center'>A YarnContam</div></td>";
			 echo "   <td class='tombol'><div align='center'>A Neps</div></td>";
			  echo "   <td class='tombol'><div align='center'>A Misc</div></td>";
		  
		  echo "   <td class='tombol'><div align='center'>B Missing</div></td>";
		  echo "   <td class='tombol'><div align='center'>B Holes</div></td>";
		   echo "   <td class='tombol'><div align='center'>B Streak</div></td>";
		    echo "   <td class='tombol'><div align='center'>B MisKnit</div></td>";
			 echo "   <td class='tombol'><div align='center'>B Knot</div></td>";
			  echo "   <td class='tombol'><div align='center'>B Oil</div></td>";
			  echo "   <td class='tombol'><div align='center'>B Fly</div></td>";
			  echo "   <td class='tombol'><div align='center'>B Misc</div></td>";
			  
			  echo "   <td class='tombol'><div align='center'>C Hair</div></td>";
		  echo "   <td class='tombol'><div align='center'>C Holes</div></td>";
		   echo "   <td class='tombol'><div align='center'>C Color</div></td>";
		    echo "   <td class='tombol'><div align='center'>C Abra</div></td>";
			 echo "   <td class='tombol'><div align='center'>C Dye</div></td>";
			  echo "   <td class='tombol'><div align='center'>C Wrink</div></td>";
			  echo "   <td class='tombol'><div align='center'>C Bowing</div></td>";
			  echo "   <td class='tombol'><div align='center'>C Pin</div></td>";
			  echo "   <td class='tombol'><div align='center'>C Pick</div></td>";
			  echo "   <td class='tombol'><div align='center'>C Knot</div></td>";
			  echo "   <td class='tombol'><div align='center'>C Misc</div></td>";
			  
			  echo "   <td class='tombol'><div align='center'>D Uneven</div></td>";
		  echo "   <td class='tombol'><div align='center'>D Stains</div></td>";
		   echo "   <td class='tombol'><div align='center'>D Oil</div></td>";
		    echo "   <td class='tombol'><div align='center'>D Dirt</div></td>";
			 echo "   <td class='tombol'><div align='center'>D Water</div></td>";
			  echo "   <td class='tombol'><div align='center'>D Misc</div></td>";
			  
			  echo "   <td class='tombol'><div align='center'>E Print</div></td>";
			  echo "   <td class='tombol'><div align='center'>E Misc</div></td>";
			  echo "   <td class='tombol'><div align='center'>Total Point</div></td>";
			  echo "   <td class='tombol'><div align='center'>Grade</div></td>";
			  //echo "   <td class='tombol'><div align='center'>C_Misc</div></td>";
			  
		  
        echo "</tr>";
		//--
		$sqlINTI="select
			pfipn.RollNo, pfipn.Width as LebarInspek,pfipn.Density as GramInspek,		
			x.*,(A_Slub_Count1+A_Barre_Count1+A_UnevenYarn_Count1+A_YarnContamination_Count1+A_NEPSCotton_Count1+A_NEPSCotton_Count1+A_Misc_Count1+B_MissingLine_Count1+B_Holes_Count1+B_Streaks_Count1+B_MisKnit_Count1+B_Knot_Count1+B_OilMark_Count1+B_FlyWaste_Count1+B_Misc_Count1+C_Hairiness_Count1+C_Holes_Count1+C_ColorTone_Count1+C_Abrasion_Count1+C_DyeSpot_Count1+C_Wrinkles_Count1+C_BowingSkew_Count1+C_PinHoles_Count1+C_PickSnag_Count1+C_Knot_Count1+C_Misc_Count1+D_UnevenShearing_Count1+D_Stains_Count1+D_OilSpot_Count1+D_Dirt_Count1+D_WaterMarks_Count1+D_Misc_Count1+E_Print_Count1+E_Misc_Count1) as TPoint
			
		from 
			ProcessFlowInspectionProcessNo pfipn inner join
			(
				select
					pfipn.ID,

					sum(case when pfi.LineID = 100100 then pfi.Count else 0 end) as A_Slub_Count1,
					sum(case when pfi.LineID = 100200 then pfi.Count else 0 end) as A_Barre_Count1,
					sum(case when pfi.LineID = 100300 then pfi.Count else 0 end) as A_UnevenYarn_Count1,
					sum(case when pfi.LineID = 100400 then pfi.Count else 0 end) as A_YarnContamination_Count1,
					sum(case when pfi.LineID = 100500 then pfi.Count else 0 end) as A_NEPSCotton_Count1,
					sum(case when pfi.LineID = 109900 then pfi.Count else 0 end) as A_Misc_Count1,
					sum(case when pfi.LineID = 200100 then pfi.Count else 0 end) as B_MissingLine_Count1,
					sum(case when pfi.LineID = 200200 then pfi.Count else 0 end) as B_Holes_Count1,
					sum(case when pfi.LineID = 200300 then pfi.Count else 0 end) as B_Streaks_Count1,
					sum(case when pfi.LineID = 200400 then pfi.Count else 0 end) as B_MisKnit_Count1,
					sum(case when pfi.LineID = 200500 then pfi.Count else 0 end) as B_Knot_Count1,
					sum(case when pfi.LineID = 200600 then pfi.Count else 0 end) as B_OilMark_Count1,
					sum(case when pfi.LineID = 200700 then pfi.Count else 0 end) as B_FlyWaste_Count1,
					sum(case when pfi.LineID = 209900 then pfi.Count else 0 end) as B_Misc_Count1,
					sum(case when pfi.LineID = 300100 then pfi.Count else 0 end) as C_Hairiness_Count1,
					sum(case when pfi.LineID = 300200 then pfi.Count else 0 end) as C_Holes_Count1,
					sum(case when pfi.LineID = 300300 then pfi.Count else 0 end) as C_ColorTone_Count1,
					sum(case when pfi.LineID = 300400 then pfi.Count else 0 end) as C_Abrasion_Count1,
					sum(case when pfi.LineID = 300500 then pfi.Count else 0 end) as C_DyeSpot_Count1,
					sum(case when pfi.LineID = 300600 then pfi.Count else 0 end) as C_Wrinkles_Count1,
					sum(case when pfi.LineID = 300700 then pfi.Count else 0 end) as C_BowingSkew_Count1,
					sum(case when pfi.LineID = 300800 then pfi.Count else 0 end) as C_PinHoles_Count1,
					sum(case when pfi.LineID = 300900 then pfi.Count else 0 end) as C_PickSnag_Count1,
					sum(case when pfi.LineID = 301000 then pfi.Count else 0 end) as C_Knot_Count1,
					sum(case when pfi.LineID = 309900 then pfi.Count else 0 end) as C_Misc_Count1,
					sum(case when pfi.LineID = 400100 then pfi.Count else 0 end) as D_UnevenShearing_Count1,
					sum(case when pfi.LineID = 400200 then pfi.Count else 0 end) as D_Stains_Count1,
					sum(case when pfi.LineID = 400300 then pfi.Count else 0 end) as D_OilSpot_Count1,
					sum(case when pfi.LineID = 400400 then pfi.Count else 0 end) as D_Dirt_Count1,
					sum(case when pfi.LineID = 400500 then pfi.Count else 0 end) as D_WaterMarks_Count1,
					sum(case when pfi.LineID = 409900 then pfi.Count else 0 end) as D_Misc_Count1,
					sum(case when pfi.LineID = 500100 then pfi.Count else 0 end) as E_Print_Count1,
					sum(case when pfi.LineID = 509900 then pfi.Count else 0 end) as E_Misc_Count1,
					sum(pfi.Count1) as Points1,
					qap.WEIGHT as Weight,qap.LENGTH
					
				from 
					ProcessFlowInspectionProcessNo pfipn inner join
					ProcessFlowInspection pfi on pfipn.EntryType = pfi.EntryType and pfipn.ID = pfi.ParentID and pfipn.MachineType = pfi.MachineType left join
					QtyAfterPacking qap on pfipn.RollNo = qap.ROLLNO
				where
					pfipn.EntryType = 2 and pfipn.ParentID = '$pcbid' and pfipn.MachineType = 17 and pfipn.InspectionNo = '$insno' and qap.PCBID='$pcbid'
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
order by pfipn.RollNo";
		

//---END SQL INTI
		$qryINTI=mssql_query($sqlINTI);
	//--
				
		$c=0;
		while ($rowINTI=mssql_fetch_assoc($qryINTI)){
		
		//-------begin			
	
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 			
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td class='normal333'><div align='left'>$c</div></td>";
		
		
	  //if($buyid<>""){	
	  // echo "<td class='normal333'><div align='right'>".number_format($rowINTI[UOM],2)."</div></td>";
	  // }
	  // echo "<td class='normal333'><div align='center'>Tgl Order</div></td>";
	    echo "<td class='normal333'><div align='left'>$rowINTI[RollNo]</div></td>";
		 echo "<td class='normal333'><div align='right'>".number_format($rowINTI[Weight],2)."</div></td>";
		   echo "<td class='normal333'><div align='right'>".number_format($rowINTI[LENGTH],2)."</div></td>";
         
		  echo "   <td class='normal333'><div align='right'>".number_format($rowINTI[LebarInspek],0)." </div></td>";
		  
		  echo "   <td class='normal333'><div align='right'>".number_format($rowINTI[GramInspek],0)." </div></td>";
		  echo "   <td class='normal333'><div align='center'>$rowINTI[A_Slub_Count1] </div></td>";
		  //--tambahan 2016.01.19
		  echo "   <td class='normal333'><div align='center'>$rowINTI[A_Barre_Count1]</div></td>";
		   echo "   <td class='normal333'><div align='center'>$rowINTI[A_UnevenYarn_Count1]</div></td>";
		    echo "   <td class='normal333'><div align='center'>$rowINTI[A_YarnContamination_Count1]</div></td>";
			 echo "   <td class='normal333'><div align='center'>$rowINTI[A_NEPSCotton_Count1]</div></td>";
			  echo "   <td class='normal333'><div align='center'>$rowINTI[A_Misc_Count1]</div></td>";
		  
		  echo "   <td class='normal333'><div align='center'>$rowINTI[B_MissingLine_Count1]</div></td>";
		  echo "   <td class='normal333'><div align='center'>$rowINTI[B_Holes_Count1]</div></td>";
		   echo "   <td class='normal333'><div align='center'>$rowINTI[B_Streaks_Count1]</div></td>";
		    echo "   <td class='normal333'><div align='center'>$rowINTI[B_MisKnit_Count1]</div></td>";
			 echo "   <td class='normal333'><div align='center'>$rowINTI[B_Knot_Count1]</div></td>";
			  echo "   <td class='normal333'><div align='center'>$rowINTI[B_OilMark_Count1]</div></td>";
			  echo "   <td class='normal333'><div align='center'>$rowINTI[B_FlyWaste_Count1]</div></td>";
			  echo "   <td class='normal333'><div align='center'>$rowINTI[B_Misc_Count1]</div></td>";
			  
			  echo "   <td class='normal333'><div align='center'>$rowINTI[C_Hairiness_Count1]</div></td>";
		  echo "   <td class='normal333'><div align='center'>$rowINTI[C_Holes_Count1]</div></td>";
		   echo "   <td class='normal333'><div align='center'>$rowINTI[C_ColorTone_Count1]</div></td>";
		    echo "   <td class='normal333'><div align='center'>$rowINTI[C_Abrasion_Count1]</div></td>";
			 echo "   <td class='normal333'><div align='center'>$rowINTI[C_DyeSpot_Count1]</div></td>";
			  echo "   <td class='normal333'><div align='center'>$rowINTI[C_Wrinkles_Count1]</div></td>";
			  echo "   <td class='normal333'><div align='center'>$rowINTI[C_BowingSkew_Count1]</div></td>";
			  echo "   <td class='normal333'><div align='center'>$rowINTI[C_PinHoles_Count1]</div></td>";
			  echo "   <td class='normal333'><div align='center'>$rowINTI[C_PickSnag_Count1]</div></td>";
			  echo "   <td class='normal333'><div align='center'>$rowINTI[C_Knot_Count1]</div></td>";
			  echo "   <td class='normal333'><div align='center'>$rowINTI[C_Misc_Count1]</div></td>";
			  
			  echo "   <td class='normal333'><div align='center'>$rowINTI[D_UnevenShearing_Count1]</div></td>";
		  echo "   <td class='normal333'><div align='center'>$rowINTI[D_Stains_Count1]</div></td>";
		   echo "   <td class='normal333'><div align='center'>$rowINTI[D_OilSpot_Count1]</div></td>";
		    echo "   <td class='normal333'><div align='center'>$rowINTI[D_Dirt_Count1]</div></td>";
			 echo "   <td class='normal333'><div align='center'>$rowINTI[D_WaterMarks_Count1]</div></td>";
			  echo "   <td class='normal333'><div align='center'>$rowINTI[D_Misc_Count1]</div></td>";
			  
			  echo "   <td class='normal333'><div align='center'>$rowINTI[E_Print_Count1]</div></td>";
			  echo "   <td class='normal333'><div align='center'>$rowINTI[E_Misc_Count1]</div></td>";
			  echo "   <td class='normal333'><div align='center'>$rowINTI[TPoint]</div></td>";
			  
			
		//---------penambahan grade
			$totalpointx=$rowINTI["TPoint"];
			$yardx=$rowINTI["LENGTH"];
			
			$hitung=($totalpointx/$yardx)*100;
			
			if ($formno==1){
				if ($hitung < 21){
					$grade="A";
										
				}else if($hitung < 31){
					$grade="B";
					
				}else{
					$grade="C/X";
					
				}
				
			}else if($formno==2){
				if ($hitung < 16){
					$grade="A";
					
				}else if($hitung < 31){
					$grade="B";
					
				}else{
					$grade="C/X";
					
				}
				
			}else{
				$grade="-";
				
			}
     
			  //---
			  echo "   <td class='normal333'><div align='center'>$grade</div></td>";
			  
		 
        echo "</tr>";
 	
	
     
		}
     echo "</table>";

}else{
			echo "<br><br><font class='normal9black'>Data TIDAK ditemukan ! $pcbid</font>";	
}
	//--
	//mssql_free_result($sql);
	mssql_close($conn);
	


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