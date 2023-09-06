<?php

$host="10.0.0.4";
//$host="DIT\MSSQLSERVER08";
$username="sa";
$password="ditbin";
$db_name="TM";
//--
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
$dep0=$_GET['dep0'];
$Gdep=$_GET['dep'];
$num=$_GET['num'];
if($num==1){
	$ket="satu sampai dua hari ";
}elseif($num==2){
	$ket="dua sampai tiga hari ";
}elseif($num==3){
	$ket="tiga sampai empat hari ";
}elseif($num==4){
	$ket="empat sampai lima hari ";
}elseif($num==5){
	$ket="lima sampai enam hari ";
}elseif($num==6){
	$ket="enam sampai tujuh hari ";
}elseif($num==7){
	$ket="lebih dari seminggu ";
}else{
	$ket="lebih dari 2 hari ";
}
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>KK belum keluar :: online system</title>
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
                    <td>
<?php  
set_time_limit(600);
	//--
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	//--


$tgldateDel=$_GET['td']; $tglmonthDel=$_GET['tm']; $tglyearDel=$_GET['ty'];
if ($tgldateDel<>"" && $tglmonthDel<>"" && $tglyearDel<>""){
	$tglDel="$tglyearDel-$tglmonthDel-$tgldateDel 00:00:00";
	$tglDisplay="$tgldateDel/$tglmonthDel/$tglyearDel";
}else{
	$tglDel="0000-00-00";
	$tglDisplay=" - ";
}

$tgldateDel2=$_GET['td2']; $tglmonthDel2=$_GET['tm2']; $tglyearDel2=$_GET['ty2'];
if ($tgldateDel2<>"" && $tglmonthDel2<>"" && $tglyearDel2<>""){
	$tglDel2="$tglyearDel2-$tglmonthDel2-$tgldateDel2 23:59:59";
	$tglDisplay2="$tgldateDel2/$tglmonthDel2/$tglyearDel2";
}else{
	$tglDel2="0000-00-00";
	$tglDisplay2=" - ";
}



if ($dep0==4){ // FIN
	$dep=19; $dname="FIN";
	$depor="z.DepartmentID='28' or z.DepartmentID='57' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
}elseif ($dep0==24){ //QCF
	$dep=28; $dname="QCF";
	$depor="z.DepartmentID='19' or z.DepartmentID='57' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
}elseif ($dep0==2){ //Brushing
	$dep=57; $dname="BRS";
	$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
}elseif ($dep0==58){ //buka kain
	$dep=59; $dname="Buka Kain";
	$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='57' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
}elseif ($dep0==62){ //TAS
	$dep=63; $dname="TAS";
	$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='57' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
}elseif ($dep0==1){ //Dyeing
	$dep=66; $dname="DYEING";
	$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='57'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
}elseif ($dep0==23){ //LAB
	$dep=67; $dname="LAB";
	$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='57' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43'";
}elseif ($dep0==49){ //PPC2
	$dep=68; $dname="PPC";
	$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='57' or z.DepartmentID='70' or z.DepartmentID='39' or z.DepartmentID='43' or z.DepartmentID='60'";
}elseif ($dep0==69){ //QC2
	$dep=70; $dname="QC2";
	$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='57' or z.DepartmentID='39' or z.DepartmentID='43'";
}elseif ($dep0==34){ //Warehouse
	
	//$zdep="(z.DepartmentID='39' or z.DepartmentID='43')"; // Greige atau Kain Jadi
	if ($Gdep==39){	
	$dep=39;	
	$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='57' or z.DepartmentID='43'";
	$dname="GREIGE";
	
	}elseif ($Gdep==43){
	$dep=43;	
	$depor="z.DepartmentID='28' or z.DepartmentID='19' or z.DepartmentID='59' or z.DepartmentID='63' or z.DepartmentID='66'
			or z.DepartmentID='67' or z.DepartmentID='68' or z.DepartmentID='70' or z.DepartmentID='57' or z.DepartmentID='39'";
	$dname="KAIN JADI";
	}
	
}
//echo "$dep02 , $dep ,'$tglDel' and '$tglDel2'";

/*************/
			
if($dep<>""){
		//$sql0="select * from PCCardPosition where Dated between '$tglDel' and '$tglDel2' and DepartmentID='$dep' and Status='1' order by Dated";
		//if ($dep0<>34){
		$sql0="select distinct(z.PCBID) from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.Dated between '$tglDel' and '$tglDel2' and x.Status='1' 
) z
where z.ParentID='$dep0' and z.DepartmentID='$dep'";
		/*}else{
		$sql0="select distinct(z.PCBID) from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.Dated between '$tglDel' and '$tglDel2' and x.Status='1' 
) z
where z.ParentID='$dep0' and z.DepartmentID='$dep'";
		}*/

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
			
			echo "<font class='blod9black'>Hasil Pencarian Departemen : $dname<br><br>Tanggal SCAN IN :</font> $tglDisplay s.d. $tglDisplay2 <font class='blod9black'><br><br>";

			
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	 // if($dep==""){
	 // echo "   <td class='tombol'><div align='center'>Sub Dept. </div></td>";
	 // }
	  echo "   <td class='tombol'><div align='center'>No. </div></td>";
	  echo "   <td class='tombol'><div align='center'>Langganan </div></td>";
	  echo "   <td class='tombol'><div align='center'>No BOn ORder </div></td>";
       
	   echo "   <td class='tombol'><div align='center'>No LOT </div></td>";
	   
          echo "<td class='tombol'><div align='center'>IN $dname</div></td>";
		
		  echo "<td class='tombol'><div align='center'>IN Dept Tujuan</div></td>";
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
		
		$c=0; $c2=0;
		$noOut=0;
		$lebih=0;
		$bagikg=0; $bagimet=0;
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
			where pcb.ID='$row[PCBID]' --and pcb.Gross<>'0'
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
//------------ambil datanya dulu
  $sqlkkG=mssql_query("select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.Dated between '$tglDel' and '$tglDel2' and x.Status='1' and PCBID='$row2[PCBID]'
) z
where z.ParentID='$dep0' and z.DepartmentID='$dep'
order by z.DepartmentName,z.Dated");	  

		  $rowkkG=mssql_fetch_assoc($sqlkkG);
		  		//$rowkk=mssql_fetch_row($sqlkk);
			 
				$sqlkk2G=mssql_query("select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition where ID='$rowkkG[ID]' and DepartmentID='$dep' order by Dated");
				$rowkk2G=mssql_fetch_assoc($sqlkk2G);
						  
if ($dep0=='49'){
$sqlkkOG=mssql_query("select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.Status='1' and PCBID='$row2[PCBID]' and x.Dated >= '$rowkk2G[Dated]'
) z
where $depor
order by z.Dated");
}else{
$sqlkkOG=mssql_query("select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.Status='1' and PCBID='$row2[PCBID]' and x.Dated >= '$rowkk2G[Dated]'
) z
where z.ParentID<>'$dep0' and ($depor)
order by z.Dated");
}

			 $rowkkOG=mssql_fetch_assoc($sqlkkOG);
						$sqlkk2bG=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition pcpos 
	left join
	Departments dep on pcpos.CounterDepartmentID  = dep.ID
	where pcpos.ID='$rowkkOG[ID]' and pcpos.DepartmentID='$rowkkOG[DepartmentID]' order by Dated desc");
	$countOutG=mssql_num_rows($sqlkk2bG);
			  $rowkk2bG=mssql_fetch_assoc($sqlkk2bG);
			  
		//--hitung lama
			
			$pecah1G = explode("/", $rowkk2G[TglIn]);
			$date1G = $pecah1G[0];
			$month1G = $pecah1G[1];
			$year1G = $pecah1G[2];
			$pecah2G = explode("/", $rowkk2bG[TglIn]);
			$date2G = $pecah2G[0];
			$month2G = $pecah2G[1];
			$year2G = $pecah2G[2];
			$jd1G = GregorianToJD($month1G,$date1G, $year1G);
			$jd2G = GregorianToJD($month2G,$date2G,$year2G);
				$selisihG=$jd2G - $jd1G;
				$selisihG=abs($selisihG);
				$timeG=round((strtotime($rowkk2bG[Dated]) - strtotime($rowkk2G[Dated]))/3600,1);
				//$time=date("h:i",$time);
//-----lama waktu

if ($selisihG > 0){
	//if ($timeG < 0){
	if ($timeG > 0 ){
			$time2G=round($timeG/24,1);
			//---number hit
			if ($num==1){
				  if(($time2G >= 1) && ($time2G < 2)){
			  			$muncul="true";
						$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			}
			if($num==2){
				  if(($time2G >= 2) && ($time2G < 3)){
			  			$muncul="true";
						$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			}
			if($num==3){
				  if(($time2G >= 3) && ($time2G < 4)){
			  			$muncul="true";
						$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			}
			if($num==4){
				  if(($time2G >= 4) && ($time2G < 5)){
			  			$muncul="true";
						$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			}
			if($num==5){
				  if(($time2G >= 5) && ($time2G < 6)){
			  			$muncul="true";
						$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			}
			if($num==6){
				  if(($time2G >= 6) && ($time2G < 7)){
			  			$muncul="true";
						$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			}
			if($num==7){
				  if($time2G > 7 ){
			  			$muncul="true";
						$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			}
			
			if($num==21){
				  if($time2G > 2 ){
			  			$muncul="true";
						$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			}
			//---
	}else{		  
			  $timenowG=date("Y-m-d H:i:s");
			  $timelosG=round((strtotime($timenowG) - strtotime($rowkk2G[Dated]))/3600,1);
			  $timelosG=abs($timelosG);
			  $time2losG=round($timelosG/24,1);
			  //---number hit
			  if ($num==1){
				  if(($time2losG >= 1) && ($time2losG < 2)){
				  	$muncul="true";
					$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			  }
			  if ($num==2){
			  	  if(($time2losG >= 2) && ($time2losG < 3)){
				  	$muncul="true";
					$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			  }
			  if ($num==3){
			  	  if(($time2losG >= 3) && ($time2losG < 4)){
				  	$muncul="true";
					$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			  }
			  if ($num==4){
			  	  if(($time2losG >= 4) && ($time2losG < 5)){
				  	$muncul="true";
					$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			  }
			  if ($num==5){
			  	  if(($time2losG >= 5) && ($time2losG < 6)){
				  	$muncul="true";
					$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			  }
			  if ($num==6){
			  	  if(($time2losG >= 6) && ($time2losG < 7)){
				  	$muncul="true";
					$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			  }
			  if ($num==7){
			  	  if($time2losG > 7 ){
				  	$muncul="true";
					$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			  }
			  
			  if ($num==21){
			  	  if($time2losG > 2 ){
				  	$muncul="true";
					$lebih=$lebih + 1;
				  }else{
				  	$muncul="false";
				  }
			  }
			  //--end number hit
	}
}else{
	$muncul="false";
}
				//	  echo "<td width='100' class='normal333' valign=top align=center bgcolor='#f2b522'>$time2los hari</td>";
				//  }else{
				//  		echo "<td width='100' class='normal333' valign=top align=center bgcolor='#f2b522'>$timelos jam</td>";
				//  }
if ($muncul=="true"){
//------------------------------------------------------mulai baris

        echo "<tr bgcolor='$bgcolor'>";
		$c2++;
		echo "<td class='normal333'  valign=top>$c2</td>";
			echo "<td width='120' class='normal333'  valign=top>$row2[CustomerName]</td>";
		echo "<td width='120' class='normal333'  valign=top><a href='order.php?bin=$row2[DocumentNo]' target=_blank>$row2[DocumentNo]</a></td>";
          
		  //--lot
					  echo "<td class='normal333' valign=top>";
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='$row2[PCID]' and LotNo < '1000'";
					  $qryLot = mssql_query($sqlLot) 
								or die('A error occured : ');
								
					  		$rowLot=mssql_fetch_assoc($qryLot);	
							echo "'$rowLot[TotalLot]-$row2[LotNo]";
					  
					  echo "</td>";
					  //--
		  //--		  
		  //echo "tess :$rowkk[5]";
	  
//---dep
		  //----in
		  /*$sqlkk=mssql_query("select * from PCCardPosition where PCBID='$row2[PCBID]' and Status='1' and Dated between '$tglDel' and '$tglDel2' and DepartmentID='$dep' order by Dated");	*/
		  $sqlkk=mssql_query("select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.Dated between '$tglDel' and '$tglDel2' and x.Status='1' and PCBID='$row2[PCBID]'
) z
where z.ParentID='$dep0' and z.DepartmentID='$dep'
order by z.DepartmentName,z.Dated");	  
		  
			$inoutIN="";
		  while ($rowkk=mssql_fetch_assoc($sqlkk)){
		  		//$rowkk=mssql_fetch_row($sqlkk);
			 
				$sqlkk2=mssql_query("select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition where ID='$rowkk[ID]' and DepartmentID='$dep' order by Dated");
				$rowkk2=mssql_fetch_assoc($sqlkk2);
				$inoutIN="$inoutIN <font class='Bold333'>$rowkk2[TglIn]</font> $rowkk2[JamIn]|";
				$tglINakhir=$rowkk2[Dated];
		  }
		  echo "<td width='120' class='BoldCD6' align='center' valign=top><font class='normal7black'>$inoutIN <br>$rowkk[DepartmentName]</font></td>";
		  //---

//---dep0 end		
 
//--Out	

//--dep 	
/*$sqlkkO=mssql_query("select top 1 * from PCCardPosition where PCBID='$row2[PCBID]' and Status='0' and Dated > '$tglINakhir' and DepartmentID='$dep' order by Dated");*/
if ($dep0=='49'){
$sqlkkO=mssql_query("select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.Status='1' and PCBID='$row2[PCBID]' and x.Dated >= '$rowkk2[Dated]'
) z
where $depor
order by z.Dated");
}else{
$sqlkkO=mssql_query("select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.Status='1' and PCBID='$row2[PCBID]' and x.Dated >= '$rowkk2[Dated]'
) z
where z.ParentID<>'$dep0' and ($depor)
order by z.Dated");
}

			$inoutOut="";
			
			 $rowkkO=mssql_fetch_assoc($sqlkkO);
						$sqlkk2b=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition pcpos 
	left join
	Departments dep on pcpos.CounterDepartmentID  = dep.ID
	where pcpos.ID='$rowkkO[ID]' and pcpos.DepartmentID='$rowkkO[DepartmentID]' order by Dated desc");
	$countOut=mssql_num_rows($sqlkk2b);
			  $rowkk2b=mssql_fetch_assoc($sqlkk2b);
			  $InoutOUT="<font class='Bold333'>$rowkk2b[TglIn]</font> $rowkk2b[JamIn] <font class='blod9black'>$rowkkO[DepartmentName]</font>";
		//--hitung lama
			
			$pecah1 = explode("/", $rowkk2[TglIn]);
			$date1 = $pecah1[0];
			$month1 = $pecah1[1];
			$year1 = $pecah1[2];
			$pecah2 = explode("/", $rowkk2b[TglIn]);
			$date2 = $pecah2[0];
			$month2 = $pecah2[1];
			$year2 = $pecah2[2];
			$jd1 = GregorianToJD($month1,$date1, $year1);
			$jd2 = GregorianToJD($month2,$date2,$year2);
				$selisih=$jd2 - $jd1;
				$selisih=abs($selisih);
				$time=round((strtotime($rowkk2b[Dated]) - strtotime($rowkk2[Dated]))/3600,1);
				//$time=date("h:i",$time);
				
		//--	  
		  	if ($countOut==0){
				$noOut=$noOut + 1;
			}
		  echo "<td width='120' class='BoldCD6' align='center' valign=top><font class='normal7black'>$InoutOUT</font></td>";
		  //--
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
			  $timelos=round((strtotime($timenow) - strtotime($rowkk2[Dated]))/3600,1);
			  $timelos=abs($timelos);
			  $time2los=round($timelos/24,1);
				  if($time2los >=1 ){
					  echo "<td width='100' class='normal333' valign=top align=center bgcolor='#f2b522'>$time2los hari</td>";
				  }else{
				  		echo "<td width='100' class='normal333' valign=top align=center bgcolor='#f2b522'>$timelos jam</td>";
				  }
			  }
		  }else{
		   echo "<td width='100' class='normal333' valign=top align=center>$time jam</td>";
		  }
		  //--
          echo "<td width='100' class='normal333' valign=top>$row2[ColorNo]</td>";
          echo "<td width='150' class='normal333' valign=top>$row2[Color]</td>";
          echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Quantity],2). " $row2[UnitName]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Weight],2). " $row2[UnitName]</td>";
		   //---HITUNG TOTAL KG DAN METER
			if ($row2[UnitName]=="kg"){				
				$bagikg=$bagikg + $row2[Weight];
			}
			if ($row2[UnitName]=="meter"){				
				$bagimet=$bagimet + $row2[Weight];
			}			
			//--
          echo "<td width='120' class='normal333' valign=top>$row2[ProductNumber]</td>";
          echo "<td class='normal333' valign=top>$row2[ProductDesc]</td>";
		  echo "<td width='120' class='normal333' valign=top>'<a href='logscan.php?kk=$row2[PCBID]' target=_blank>$row2[NoKK]</a><br>$row2[TglKK]</td>";
		  //---Dept Note
		  $sqlcarinotePCB=mssql_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  
		  $rowcarinotePCB=mssql_fetch_assoc($sqlcarinotePCB);
		  
		  $sqlcarinotePFPN=mssql_query("select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowcarinotePCB[ID]' order by Dated desc");
		  
		  $rowcarinotePFPN=mssql_fetch_assoc($sqlcarinotePFPN);
		  
		  $notedep="";
		  $sqlcarinotePFDN=mssql_query("select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Cat  from ProcessFlowDetailsDeptNote where ParentID ='$rowcarinotePFPN[ID]'");
		  
		  while($rowcarinotePFDN=mssql_fetch_assoc($sqlcarinotePFDN)){
		  	
		  $catatandept="$notedep $rowcarinotePFDN[Cat]<br>";
		  }
		  		  
		  //--end Dept Note  ----BYCUST
		  
		  echo "<td class='normal333' valign=top>$catatandept</td>";
		  
        echo "</tr>";
 //--
 
}
 //--       
		}
		//------total
			  echo "  <tr>";
			  echo "   <td class='tombol'><div align='center'></div></td>"; //No. 
			  echo "   <td class='tombol'><div align='center'></div></td>"; //Langganan 
			  echo "   <td class='tombol'><div align='center'></div></td>";       //No BOn ORder 
		      echo "   <td class='tombol'><div align='center'></div></td>"; //No LOT 
		     // echo "   <td class='tombol'><div align='center'></div></td>";	   //Tgl Dibutuhkan /Delivery 
              echo "<td class='tombol'><div align='center'></div></td>";		 //IN $dname
			  echo "<td class='tombol'><div align='center'></div></td>"; //IN Dept Tujuan
			  echo "<td class='tombol'><div align='center'></div></td>"; //Lama_Waktu
			  echo "<td class='tombol'><div align='center'></div></td>"; //No Warna 
			  echo "<td class='tombol'><div align='center'></div></td>"; //Warna
			 
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
			  echo "<td class='tombol'><div align='center'>Total:</div></td>"; //Nett QTY 
			  echo "<td class='tombol'><div align='center'>$viewtotalbagi</div></td>"; //Bruto BagiKain
			  echo "<td class='tombol'><div align='center'></div></td>"; //Product Number 
			  echo "<td class='tombol'><div align='center'></div></td>"; //Product Description 
			  echo "   <td class='tombol'><div align='center'></div></td>"; //No Kartu Kerja 
			  echo "   <td class='tombol'><div align='center'> </div></td>"; //Dept. Note
       		  echo "</tr>";
		//--end total
     echo "</table>";
	 echo "<br>KK $ket = $lebih , KK Belum Keluar = $noOut";

			}else{
				echo "<br><br><font class='normal9black'>Data TIDAK ditemukan !</font>";	
			}
	//--
	mssql_free_result($sql);
	mssql_close($conn);
//--

?></td>
                  </tr>
                  <tr>
                    <td class="normal9black">&nbsp;</td>
                  </tr>
              </table>
				<div id="features"><ul><li></li>
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