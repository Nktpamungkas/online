<?php
ini_set("error_reporting", 1);
include "koneksi.php";
//--
$act=$_POST['act'];
$subid=$_GET['subid'];
$ceko=$_POST['ceko'];
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
                    <td><?php
if (!$act){   
?></td>
                  </tr>
                  <tr>
                    <td><form id="form1" name="form1" method="post" action="?">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="normal9black">
                          <tr>
                            <td colspan="2" class="boldCD6">LAPORAN SCAN KARTU KERJA MASUK PER DEPARTEMEN </td>
                          </tr>
                          
                          
                          <tr>
                            <td width="200" class="blod9black">&nbsp;</td>
                            <td class="normal9black"><input name="act" type="hidden" id="act" value="cari" /></td>
                          </tr>
                          <tr>
                            <td class="blod9black">Departemen</td>
                            <td class="normal9black"><select name="dep0" class="normal9black" id="dep0" onChange="window.location='?subid='+this.value">
                              <?php
							 //--
							 set_time_limit(600);
	//$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//sqlsrv_select_db($db_name) or die ("Under maintenance");
	//--
						  	if ($subid<>""){
								$sdep=sqlsrv_query($conn,"select ID,ParentID,DepartmentName from Departments where ID = '$subid'", array(), array("Scrollable"=>"buffered"));
								$rdep=sqlsrv_fetch_array($sdep,SQLSRV_FETCH_ASSOC);
								
								echo "<option value='".$rdep['ID']."' selected>".$rdep['DepartmentName']."</option>";
								$sqldep=sqlsrv_query($conn,"select ID,ParentID,DepartmentName from Departments where ParentID = '0' order by DepartmentName", array(), array("Scrollable"=>"buffered"));
								while($rjenis=sqlsrv_fetch_array($sqldep,SQLSRV_FETCH_ASSOC)){									
									echo "<option value=".$rjenis['ID'].">".$rjenis['DepartmentName']."</option>";
								}
							}else{
								echo "<option value='' selected></option>";
								$sqldep=sqlsrv_query($conn,"select ID,ParentID,DepartmentName from Departments where ParentID = '0' order by DepartmentName", array(), array("Scrollable"=>"buffered"));
								while($rjenis=sqlsrv_fetch_array($sqldep,SQLSRV_FETCH_ASSOC)){									
									echo "<option value=".$rjenis['ID'].">".$rjenis['DepartmentName']."</option>";
								}
							}
								?>
                            </select></td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">Sub Dept </td>
                            <td class="normal9black"><select name="dep" class="normal9black" id="dep">
							 <?php
							 //--
							 set_time_limit(600);
	//$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//sqlsrv_select_db($db_name) or die ("Under maintenance");
	//--
							if ($subid<>""){
								echo "<option value='' selected></option>";
								$sqldep=sqlsrv_query($conn,"select ID,ParentID,DepartmentName from Departments where ParentID = '$subid' order by DepartmentName", array(), array("Scrollable"=>"buffered"));
								while($rjenis=sqlsrv_fetch_array($sqldep,SQLSRV_FETCH_ASSOC)){									
									echo "<option value=".$rjenis['ID'].">".$rjenis['DepartmentName']."</option>";
								}
							}/*else{
						  		echo "<option value='' selected></option>";
								$sqldep=sqlsrv_query("select ID,ParentID,DepartmentName from Departments where ParentID <> '0' order by ParentID,ID");
								while($rjenis=sqlsrv_fetch_array($sqldep)){									
									echo "<option value=$rjenis[ID]>$rjenis[DepartmentName]</option>";
								}
							}*/
								?>
                            </select></td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">Range Scan IN </td>
                            <td class="normal9black"><select name="tgldateDel" class="normal9black" id="tgldateDel">
                                <option value="<?php echo $tanggal1 ; ?>" selected><?php echo $tanggal1 ; ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                              </select>
                              -
                              <select name="tglmonthDel" class="normal9black" id="tglmonthDel">
                                <option value="<?php echo $tanggal2; ?>" selected><?php echo $bulan; ?></option>
                                <option value="1">Jan</option>
                                <option value="2">Feb</option>
                                <option value="3">Mar</option>
                                <option value="4">Apr</option>
                                <option value="5">Mei</option>
                                <option value="6">Jun</option>
                                <option value="7">Jul</option>
                                <option value="8">Agt</option>
                                <option value="9">Sep</option>
                                <option value="10">Okt</option>
                                <option value="11">Nop</option>
                                <option value="12">Des</option>
                              </select>
                              -
                              <select name="tglyearDel" class="normal9black" id="tglyearDel">
                                <option value="<?php echo $tanggal3; ?>" selected><?php echo $tanggal3; ?></option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
								<option value="2022">2022</option>  
                              </select>
                              Sampai
                              <select name="tgldateDel2" class="normal9black" id="tgldateDel2">
                                <option value="<?php echo $tanggal1 ; ?>" selected><?php echo $tanggal1 ; ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                              </select>
                              -
                              <select name="tglmonthDel2" class="normal9black" id="tglmonthDel2">
                                <option value="<?php echo $tanggal2; ?>" selected><?php echo $bulan; ?></option>
                                <option value="1">Jan</option>
                                <option value="2">Feb</option>
                                <option value="3">Mar</option>
                                <option value="4">Apr</option>
                                <option value="5">Mei</option>
                                <option value="6">Jun</option>
                                <option value="7">Jul</option>
                                <option value="8">Agt</option>
                                <option value="9">Sep</option>
                                <option value="10">Okt</option>
                                <option value="11">Nop</option>
                                <option value="12">Des</option>
                              </select>
                              -
                              <select name="tglyearDel2" class="normal9black" id="tglyearDel2">
                                <option value="<?php echo $tanggal3; ?>" selected><?php echo $tanggal3; ?></option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
								<option value="2022">2022</option>  
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
                            <td class="normal9black"><label>
                              <input name="ceko" type="checkbox" id="ceko" value="YES" checked>
                              Hanya munculkan KK yang BELUM OUT </label></td>
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
	//$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//sqlsrv_select_db($db_name) or die ("Under maintenance");
	//--

$nokk=trim(strip_tags($_POST['nokk']));
$nobo=trim(strip_tags($_POST['nobo']));

$tgldateDel=$_POST['tgldateDel']; $tglmonthDel=$_POST['tglmonthDel']; $tglyearDel=$_POST['tglyearDel'];
if ($tgldateDel<>"" && $tglmonthDel<>"" && $tglyearDel<>""){
	$tglDel="$tglyearDel-$tglmonthDel-$tgldateDel 00:00:00";
	$tglDisplay="$tgldateDel/$tglmonthDel/$tglyearDel";
}else{
	$tglDel="0000-00-00";
	$tglDisplay=" - ";
}

$tgldateDel2=$_POST['tgldateDel2']; $tglmonthDel2=$_POST['tglmonthDel2']; $tglyearDel2=$_POST['tglyearDel2'];
if ($tgldateDel2<>"" && $tglmonthDel2<>"" && $tglyearDel2<>""){
	$tglDel2="$tglyearDel2-$tglmonthDel2-$tgldateDel2 23:59:59";
	$tglDisplay2="$tgldateDel2/$tglmonthDel2/$tglyearDel2";
}else{
	$tglDel2="0000-00-00";
	$tglDisplay2=" - ";
}

$dep0=trim(strip_tags($_POST['dep0']));
$dep=trim(strip_tags($_POST['dep']));


if($dep<>""){
		
		$sql0="select distinct(z.PCBID),z.ParentID,z.ID as DepartmentID,z.Status from
(
select x.PCBID,d.DepartmentName,d.ParentID,d.ID,x.Status from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
inner join ProcessControlBatches pcb on pcb.ID=x.PCBID
where x.Dated between '$tglDel' and '$tglDel2' and x.Status='1' and pcb.Gross<>'0'
) z
where z.ID='$dep' order by z.PCBID";

}else{


	$sql0="select distinct(z.PCBID),z.ParentID,z.ID as DepartmentID,z.Status from
	(
	select x.PCBID,d.DepartmentName,d.ParentID,d.ID,x.Status from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
	inner join ProcessControlBatches pcb on pcb.ID=x.PCBID
	where x.Dated between '$tglDel' and '$tglDel2' and x.Status='1' and pcb.Gross<>'0'
	) z
	where z.ParentID='$dep0' order by z.ID,z.PCBID";
}
	//}
//-

$sql = sqlsrv_query($conn,$sql0, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured : 0');
 
$count = sqlsrv_num_rows($sql);

			if ($count > 0 ){
			//$row=sqlsrv_fetch_array($sql);
			
			   if($dep<>""){
					$sqlDep0="select ID,ParentID,DepartmentName from Departments where ID='$dep'";			
					$sqlDep = sqlsrv_query($conn,$sqlDep0, array(), array("Scrollable"=>"buffered")) ;
					$rowDepA=sqlsrv_fetch_array($sqlDep,SQLSRV_FETCH_ASSOC);
					$subDep=$rowDepA['DepartmentName']; $parID=$rowDepA['ParentID'];
					
					$sqlDep1="select ID,ParentID,DepartmentName from Departments where ID='$parID'";			
					$sqlDepB = sqlsrv_query($conn,$sqlDep1, array(), array("Scrollable"=>"buffered")) ;
					$rowDepB=sqlsrv_fetch_array($sqlDepB,SQLSRV_FETCH_ASSOC);
					$ParentDep=$rowDepB['DepartmentName'];
				}else{
					
					$subDep="";
					
					$sqlDep1="select ID,ParentID,DepartmentName from Departments where ID='$dep0'";			
					$sqlDepB = sqlsrv_query($conn,$sqlDep1, array(), array("Scrollable"=>"buffered")) ;
					$rowDepB=sqlsrv_fetch_array($sqlDepB,SQLSRV_FETCH_ASSOC);
					$ParentDep=$rowDepB['DepartmentName'];
				}
			
			echo "<font class='blod9black'>Hasil Pencarian Departemen : $ParentDep ($subDep) <br><br>Tanggal SCAN IN :</font> $tglDisplay s.d. $tglDisplay2 <font class='blod9black'>( Total Kartu Kerja Masuk : $count )<br><br>";


echo "<font class='blod9black'><a href='inoutkk0-xls.php?dep0=$dep0&dep=$dep&d1=$tgldateDel&m1=$tglmonthDel&y1=$tglyearDel&d2=$tgldateDel2&m2=$tglmonthDel2&y2=$tglyearDel2&ceko=$ceko'> CETAK KE EXCEL </a> <font class='blod9black'><br><br>";
			
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
		$bagikg=0; $bagimet=0; $bagiyard=0;
		while ($row=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC)){
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
			where pcb.ID='".$row['PCBID']."' and pcb.Gross<>'0'
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

$sql2b = sqlsrv_query($conn,$sql2, array(), array("Scrollable"=>"buffered")) or die('A error occured : ');
$row2=sqlsrv_fetch_array($sql2b,SQLSRV_FETCH_ASSOC);
		//--
//--
if ($ceko=="YES"){
	///------------
	if($dep<>""){
		//--sub dept 	
		$sqlkkOYES=sqlsrv_query($conn,"select top 1 * from PCCardPosition where PCBID='".$row2['PCBID']."' and Status='0' and DepartmentID='$dep' order by Dated" , array(), array("Scrollable"=>"buffered"));// and Dated > //'$tglINakhir' order by Dated");
					
					 $numrowkkO=sqlsrv_num_rows($sqlkkOYES);
					 if ($numrowkkO > 0 ){
					 	$muncul="NO";
					 }else{
					 	$muncul="YES";
					 }
	}else{
	//---dept
	$sql0kkOY="select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.PCBID='".$row2['PCBID']."' and x.Status='0' 
) z
where z.DepartmentID='".$row['DepartmentID']."'
order by z.Dated"; //hilangkan x.Dated > '$tglINakhir'

		  $sqlkkOYES1=sqlsrv_query($conn,$sql0kkOY, array(), array("Scrollable"=>"buffered")) or die('A error occured : 1b out');	
			$numrowkk1=sqlsrv_num_rows($sqlkkOYES1);
					 if ($numrowkk1 > 0 ){
					 	$muncul="NO";
					 }else{
					 	$muncul="YES";
					 }
	}
	//-----
	
}else{
	$muncul="YES";
}
//------------------------		
if ($muncul=="YES")
{				
	$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
							
        echo "<tr bgcolor='$bgcolor'>";
		echo "   <td class='normal333'  valign=top>$c</td>";
		if($dep==""){
			$sqlgetdep=sqlsrv_query($conn,"select ID,DepartmentName from Departments where ID='".$row['DepartmentID']."'", array(), array("Scrollable"=>"buffered"));
			$rowgetdep=sqlsrv_fetch_array($sqlgetdep,SQLSRV_FETCH_ASSOC);
			
	  echo "   <td class='normal333'  valign=top>".$rowgetdep['DepartmentName']."</td>";
	  }
		echo "<td width='120' class='normal333'  valign=top>".$row2['CustomerName']."</td>";
		echo "<td width='120' class='normal333'  valign=top><a href='order.php?bin=".$row2['DocumentNo']."' target=_blank>".$row2['DocumentNo']."</a></td>";
          
		  //--lot
			  //----cari salinan
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
			  //--end salinan
					  echo "<td class='normal333' valign=top>";
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='".$row2['PCID']."' and LotNo < '1000'";
					  $qryLot = sqlsrv_query($conn,$sqlLot, array(), array("Scrollable"=>"buffered")) 
								or die('A error occured : ');
								
					  		$rowLot=sqlsrv_fetch_array($qryLot,SQLSRV_FETCH_ASSOC);	
							//echo "'$rowLot[TotalLot]-$row2[LotNo]";
							echo "'".$rowLot['TotalLot']."-$nomorLot";
					  
					  echo "</td>";
					  //--
					 
		  //--		  
		  //echo "tess :$rowkk[5]";
if($dep<>""){		  
//---dep
		  //----in
		  $sqlkk=sqlsrv_query($conn,"select * from PCCardPosition where PCBID='".$row2['PCBID']."' and Status='1' and Dated between '$tglDel' and '$tglDel2' and DepartmentID='$dep' order by Dated", array(), array("Scrollable"=>"buffered"));	
			$inoutIN="";
		  while ($rowkk=sqlsrv_fetch_array($sqlkk,SQLSRV_FETCH_ASSOC)){
		  		//$rowkk=sqlsrv_fetch_row($sqlkk);
			 
				$sqlkk2=sqlsrv_query($conn,"select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition where ID='".$rowkk['ID']."' and DepartmentID='$dep' order by Dated", array(), array("Scrollable"=>"buffered"));
				$rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);
				$inoutIN="$inoutIN <font class='Bold333'>".$rowkk2['TglIn']."</font> ".$rowkk2['JamIn']."|";
				$tglINakhir=$rowkk2['Dated']->format('Y-m-d H:i:s');
		  }
		  echo "<td width='120' class='BoldCD6' align='center' valign=top><font class='normal7black'>$inoutIN</font></td>";
		  //---
//--dep0
}else{
//----in
$sql0kk="select z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.PCBID='".$row2['PCBID']."' and x.Dated between '$tglDel' and '$tglDel2' and x.Status='1' 
) z
where z.DepartmentID='".$row['DepartmentID']."'
order by z.Dated";

		  $sqlkk=sqlsrv_query($conn,$sql0kk, array(), array("Scrollable"=>"buffered")) or die('A error occured : 1');	
			$inoutIN="";
		  while ($rowkk=sqlsrv_fetch_array($sqlkk,SQLSRV_FETCH_ASSOC)){
		  		//$rowkk=sqlsrv_fetch_row($sqlkk);
			 
				$sqlkk2=sqlsrv_query($conn,"select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,convert(varchar(20),Dated,120) as tgl_full, Dated  from PCCardPosition where ID='".$rowkk['ID']."' and DepartmentID='".$rowkk['DepartmentID']."' order by Dated", array(), array("Scrollable"=>"buffered"));
				$rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);
				$inoutIN="$inoutIN <font class='Bold333'>".$rowkk2['TglIn']."</font> ".$rowkk2['JamIn']."|";
				//$tglINakhir=$rowkk2['Dated'];
			  	$tglINakhir=$rowkk2['Dated']->format('Y-m-d H:i:s');
		  }
		  echo "<td width='120' class='BoldCD6' align='center' valign=top><font class='normal7black'>$inoutIN</font></td>";
		  //---
}
//---dep0 end		
 
//--Out	
if($dep<>""){
//--dep 	
$sqlkkO=sqlsrv_query($conn,"select top 1 * from PCCardPosition where PCBID='".$row2['PCBID']."' and Status='0' and Dated > '$tglINakhir' and DepartmentID='$dep' order by Dated", array(), array("Scrollable"=>"static"));
			$inoutOut="";
			
			 $rowkkO=sqlsrv_fetch_array($sqlkkO,SQLSRV_FETCH_ASSOC,SQLSRV_FETCH_ASSOC);
						$sqlkk2b=sqlsrv_query($conn,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,Dated  from PCCardPosition pcpos 
	left join
	Departments dep on pcpos.CounterDepartmentID  = dep.ID
	where pcpos.ID='".$rowkkO['ID']."' and pcpos.DepartmentID='$dep' order by Dated desc", array(), array("Scrollable"=>"buffered"));
	$countOut=sqlsrv_num_rows($sqlkk2b);
			  $rowkk2b=sqlsrv_fetch_array($sqlkk2b,SQLSRV_FETCH_ASSOC);
			  $InoutOUT="<font class='Bold333'>".$rowkk2b['TglIn']."</font> ".$rowkk2b['JamIn']." <font class='blod9black'>".$rowkk2b['DepOut']."</font>";
		//--out
}else{
//-dep0		
//--Out		
$sql0kkO="select top 1 z.* from
(
select x.*,d.DepartmentName,d.ParentID from PCCardPosition x left join Departments d on d.ID=x.DepartmentID
where x.PCBID='".$row2['PCBID']."' and x.Dated > '$tglINakhir' and x.Status='0' 
) z
where z.DepartmentID='".$row['DepartmentID']."'
order by z.Dated";

		  $sqlkkO=sqlsrv_query($conn,$sql0kkO, array(), array("Scrollable"=>"buffered")) or die('A error occured : 1b out');	
			$inoutOut="lll";
			
			 $rowkkO=sqlsrv_fetch_array($sqlkkO,SQLSRV_FETCH_ASSOC);
						$sqlkk2b=sqlsrv_query($conn,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn, convert(varchar(20),Dated,120) as tgl_full,Dated  from PCCardPosition pcpos 
						left join
						Departments dep on pcpos.CounterDepartmentID  = dep.ID
						where pcpos.ID='".$rowkkO['ID']."' and pcpos.DepartmentID='".$row['DepartmentID']."' order by Dated desc", array(), array("Scrollable"=>"buffered"));
	$countOut=sqlsrv_num_rows($sqlkk2b);
			  $rowkk2b=sqlsrv_fetch_array($sqlkk2b,SQLSRV_FETCH_ASSOC);
			  $InoutOUT="<font class='Bold333'>".$rowkk2b['TglIn']."</font> ".$rowkk2b['JamIn']." <font class='blod9black'>".$rowkk2b['DepOut']."</font>";
		//--out
//--dep0 end
}			  
		  	if ($countOut==0){
				$noOut=$noOut + 1;
			}
		  echo "<td width='120' class='BoldCD6' align='center' valign=top><font class='normal7black'>$InoutOUT</font></td>";
		  //--end in out
		  //--hitung lama waktu
			
			if($rowkk2['TglIn']!=""){$pecah1 = explode("/", $rowkk2['TglIn']);
			$date1 = $pecah1[0];
			$month1 = $pecah1[1];
			$year1 = $pecah1[2];}
			if($rowkk2b['TglIn']!=""){$pecah2 = explode("/", $rowkk2b['TglIn']);
			$date2 = $pecah2[0];
			$month2 = $pecah2[1];
			$year2 = $pecah2[2];}
			$jd1 = GregorianToJD($month1,$date1,$year1);
			$jd2 = GregorianToJD($month2,$date2,$year2);
				$selisih=$jd2 - $jd1;
				$selisih=abs($selisih);
				if($rowkk2['Dated']!=""){$tgl1		= $rowkk2['Dated']->format('Y-m-d H:i:s');}
				if($rowkk2b['Dated']!=""){$tgl2		= $rowkk2b['Dated']->format('Y-m-d H:i:s');}
				$time		= round((strtotime($tgl2) - strtotime($tgl1))/3600,1);
				
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
			  $timelos=round((strtotime($timenow) - strtotime($tgl1))/3600,1);
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
          echo "<td width='100' class='normal333' valign=top>".$row2['ColorNo']."</td>";
          echo "<td width='150' class='normal333' valign=top>".$row2['Color']."</td>";
          echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Quantity'],2). " ".$row2['UnitName']."</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Weight'],2). " ".$row2['UnitName']."</td>"; //$row2[UnitName]</td>";
		   //---HITUNG TOTAL KG DAN METER
			if ($row2['UnitName']=="kg"){				
				$bagikg=$bagikg + $row2['Weight'];
			}
			if ($row2['UnitName']=="meter"){				
				$bagimet=$bagimet + $row2['Weight'];
			}
			if ($row2['UnitName']=="yard"){				
				$bagiyard=$bagiyard + $row2['Weight'];
			}			
			//--
          echo "<td width='120' class='normal333' valign=top>".$row2['ProductNumber']."";
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
						$ketsetting="$ketsetting ".$rowgnomes['Description']."<br>";
					}
					//--
					//--cari speed
					$sqlspeed=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='".$rowflow['ID']."' and LineID = '$linespeed'", array(), array("Scrollable"=>"buffered"));
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
					$sqltemp=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='".$rowflow['ID']."' and LineID = '$linesuhu'", array(), array("Scrollable"=>"buffered"));
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
					$sqlover=sqlsrv_query($conn,"select ID,ParentID,LineID from ProcessFlowDetails where ParentID ='".$rowflow['ID']."' and LineID = '$lineover'", array(), array("Scrollable"=>"buffered"));
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
} //---end stenter		  
		  echo "<font size=0.1>$ketsetting</font></td>";
          echo "<td class='normal333' valign=top>".$row2['ProductDesc']."</td>";
		  echo "<td width='120' class='normal333' valign=top>'<a href='logscan.php?kk=".$row2['PCBID']."' target=_blank>".$row2['NoKK']."</a><br>".$row2['TglKK']."</td>";
		  //---Dept Note
		  $sqlcarinotePCB=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='".$row2['NoKK']."'", array(), array("Scrollable"=>"buffered"));
		  
		  $rowcarinotePCB=sqlsrv_fetch_array($sqlcarinotePCB,SQLSRV_FETCH_ASSOC);
		  
		  $sqlcarinotePFPN=sqlsrv_query($conn,"select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='".$rowcarinotePCB['ID']."' order by Dated desc", array(), array("Scrollable"=>"buffered"));
		  
		  $rowcarinotePFPN=sqlsrv_fetch_array($sqlcarinotePFPN,SQLSRV_FETCH_ASSOC);
		  
		  $sqlcarinotePFDN=sqlsrv_query($conn,"select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Cat  from ProcessFlowDetailsDeptNote where DepartmentID='".$row2['deptID']."' and ParentID ='".$rowcarinotePFPN['ID']."'", array(), array("Scrollable"=>"buffered"));
		  
		  $rowcarinotePFDN=sqlsrv_fetch_array($sqlcarinotePFDN,SQLSRV_FETCH_ASSOC);
		  
		  		  
		  //--end Dept Note  ----BYCUST
		  $catatandept=$rowcarinotePFDN['Cat'];
		  echo "<td class='normal333' valign=top>$catatandept</td>";
        echo "</tr>";
 }//--end muncul       
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
			  if ($bagiyard > 0){
			  	$displaybagiy="" .number_format($bagiyard,2). "yard";
			  }else{
			  	$displaybagiy="";
			  }			  
			 
			  $viewtotalbagi="$displaybagi<br>$displaybagim<br>$displaybagiy";
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
	//sqlsrv_free_result($sql);
	//sqlsrv_close($conn);
	//--
//}
//--

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