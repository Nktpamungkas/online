<?php

$host="10.0.0.4";
//$host="DIT\MSSQLSERVER08";
$username="timdit";
$password="4dm1n";
$db_name="TM";
//--
$act=$_POST['act'];
$custid=trim($_GET['custid']);
$buyid=trim($_GET['buyid']);
$codcust=$_POST['kodebuyer'];
$buyer=$_POST['buyer'];

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
	<title>MEMO PPC With KK OK :: online system</title>
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
					<a href="kkmemoppc.php">MEMO PPC</a>				</li>
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
                    <td><form id="form1" name="form1" method="post" action="<?php echo "?custid=$custid&buyid=$buyid"; ?>">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="normal9black">
                          <tr>
                            <td colspan="2" class="boldCD6">Silahkan masukkan data yang ingin dicari </td>
                          </tr>
                          <tr>
                            <td width="200" class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black"><input name="nokk" type="hidden" class="normal9black" id="nokk" value="" /></td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black"></td>
                          </tr>
                          
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black"><input name="act" type="hidden" id="act" value="cari" /></td>
                          </tr>
                         
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black"> Customer </td>
                            <td class="normal9black"><select name="kodebuyer" class="normal9black" id="kodebuyer" onChange="window.location='?custid='+this.value">
							<?php
		 // echo "TEST";
		  	//--
			set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
		$sqlcus=mssql_query("select ID,PartnerNumber,PartnerName from Partners where ID='$custid'");
		$rcus=mssql_fetch_assoc($sqlcus);
		echo "<option value='$rcus[ID]' selected>$rcus[PartnerNumber] / $rcus[PartnerName]</option>";
	//--
		  	$sqlBuyer="select ID,PartnerNumber,PartnerName  from Partners where Status ='1' or Status='3' or Status='5' or Status='7' order by PartnerNumber";

$qryBuyer = mssql_query($sqlBuyer) 
    or die('A error occured : ');
 
$countBuyer = mssql_num_rows($qryBuyer);

		if ($countBuyer > 0 ){
				//echo "<select name=kodebuyer class='normal9black'  onChange='window.location=?subid=+this.value'>";
				//echo "<option value='' selected></option>";
			while($rowBuyer=mssql_fetch_assoc($qryBuyer)){
				$IDBuyer=$rowBuyer[ID]; $Kdbuyer=$rowBuyer[PartnerNumber]; $NamaBuyer=$rowBuyer[PartnerName];
				
				echo "<option value='$IDBuyer'>$Kdbuyer / $NamaBuyer </option>";
				
			}
			//echo "</select";
		}	
			//--
	mssql_free_result($qryBuyer);
	mssql_close($conn);
	//--
		  ?>
		  </select></td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">Buyer</td>
                            <td class="normal9black"><select name="buyer" class="normal9black" id="select7" onChange="window.location='?buyid='+this.value">
                              <?php
		 // echo "TEST";
		  	//--
			set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
		$sqlbuy=mssql_query("select ID,PartnerNumber,PartnerName from Partners where ID='$buyid'");
		$rbuy=mssql_fetch_assoc($sqlbuy);
		echo "<option value='$rbuy[ID]' selected>$rbuy[PartnerNumber] / $rbuy[PartnerName]</option>";
	//--
		  	$sqlBuyer="select ID,PartnerNumber,PartnerName  from Partners where Status > '3' order by PartnerName";

$qryBuyer = mssql_query($sqlBuyer) 
    or die('A error occured : ');
 
$countBuyer = mssql_num_rows($qryBuyer);

		if ($countBuyer > 0 ){
				//echo "<select name=kodebuyer class='normal9black'  onChange='window.location=?subid=+this.value'>";
				//echo "<option value='' selected></option>";
			while($rowBuyer=mssql_fetch_assoc($qryBuyer)){
				$IDBuyer=$rowBuyer[ID]; $Kdbuyer=$rowBuyer[PartnerNumber]; $NamaBuyer=$rowBuyer[PartnerName];
				
				echo "<option value='$IDBuyer'>$Kdbuyer / $NamaBuyer </option>";
				
			}
			//echo "</select";
		}	
			//--
	mssql_free_result($qryBuyer);
	mssql_close($conn);
	//--
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
                            <td class="blod9black"><input name="range" type="radio" value="tglorder" checked>
                            Range Tgl Order </td>
                            <td class="normal9black"><input name="tglDel" type="text" class="normal9black" id="datepick" />
                            sampai
                          <input name="tglDel2" type="text" class="normal9black" id="datepick2" /></td>
                          </tr>						  
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black"><input name="range" type="radio" value="tglperlu">
                            Range Tgl dibutuhkan </td>
                            <td class="normal9black"><input name="tglDel2A" type="text" class="normal9black" id="datepick3" />
                            sampai
                          <input name="tglDel2B" type="text" class="normal9black" id="datepick4" /></td>
                          </tr>
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
			
		</script>
                          <tr>
                            <td class="blod9black">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Tgl Delivery )</td>
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
	set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	//--



if ($codcust<>"/"){
//---proses filter by customer
//echo "proses customer <br>";
$range=$_POST['range'];


		$tgldateDel=$_POST['tglDel']; 
		$tgldateDelB=$_POST['tglDel2']; 
		$tempDate = explode('-',$tgldateDel);
		$tempDate2 = explode('-',$tgldateDelB);
		
		$tgldateDel2=$_POST['tglDel2A']; 
		$tgldateDel2B=$_POST['tglDel2B']; 
		$tempDate2A = explode('-',$tgldateDel2);
		$tempDate2B = explode('-',$tgldateDel2B);
		
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
		}else if ($range=="tglperlu"){
			if ($tgldateDel2<>""){
				$tglDel="$tgldateDel2 00:00:00";
				$tglDisplay=$tempDate2A[2].'/'.$tempDate2A[1].'/'.$tempDate2A[0];
			}else{
				$tglDel="0000-00-00";
				$tglDisplay=" - ";
			}
	//	}else{
			if ($tgldateDel2B<>""){
				$tglDel2="$tgldateDel2B 23:59:59";
				$tglDisplay2=$tempDate2B[2].'/'.$tempDate2B[1].'/'.$tempDate2B[0];
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
$notefilter="Dibutuhkan(Delivery)";
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
		

$sql0b="select top 1
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
			dep.DepartmentCode, dep.DepartmentName, pdep.DepartmentCode as RootDepartmentCode, pdep.DepartmentName as RootDepartmentName,
			dep.ID as deptID
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,101) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo,convert(char(10),sod.RequiredDate,101) as TglPerlu,
				pcb.ID as PCBID, pcb.DocumentNo as NoKK,convert(char(10),pcb.Dated,101) as TglKK, pcb.Gross as Bruto,
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
			where $filterbuy and $filtertgl and pcb.Gross<>'0' --so.SODate between '$tglDel' and '$tglDel2'
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
				x.SODID, x.PCBID";

$sqlb = mssql_query($sql0b) 
    or die('A error occured :0C');
 
$count = mssql_num_rows($sqlb);

			if ($count > 0 ){
			$row=mssql_fetch_assoc($sqlb);
			echo "<font class='blod9black'>Hasil Pencarian <br><br>";
			echo "<font class='blod9black'>Range Tanggal $notefilter : $tglDisplay s.d. $tglDisplay2</font><br><br>";
			
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
        echo "<td align='left' valign='middle' class='normal9black'>:  $rcust[Address]<br>$rcust[City], $rcust[Province] $rcon[CountryName] (ZIP Code : $rcust[PostalCode])</td>";
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
     echo "   <td align='left' valign='middle' class='normal9black'>| <a href='kkmemoppc-xls.php?custid=$custid&buyid=$buyid&range=$range&tglDel=$tgldateDel&tglDel2=$tgldateDelB&tglDel2A=$tgldateDel2&tglDel2B=$tgldateDel2B&codcust=$codcust&buyer=$buyer'> CETAK KE EXCEL </a></td>";
     echo " </tr>";
      
    echo "</table>";
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	   echo "<td class='tombol'><div align='center'>No.</div></td>";
	  //if($buyid<>""){	
	   echo "<td class='tombol'><div align='center'>Pelanggan</div></td>";
	  // }
	  // echo "<td class='tombol'><div align='center'>Tgl Order</div></td>";
	    echo "<td class='tombol'><div align='center'>No Order</div></td>";
		 echo "<td class='tombol'><div align='center'>Keterangan Produk</div></td>";
		  echo "<td class='tombol'><div align='center'>Lebar (inch)</div></td>";
		   echo "<td class='tombol'><div align='center'>Gramasi (gr/m2)</div></td>";
		    echo "<td class='tombol'><div align='center'>Warna</div></td>";
			 echo "<td class='tombol'><div align='center'>No Warna </div></td>";
			 
      echo "<td class='tombol'><div align='center'>LOT</div></td>";
	   echo "<td class='tombol'><div align='center'>Delivery</div></td>";
	    echo "<td class='tombol'><div align='center'>Bagi Kain Tgl </div></td>";
		echo "<td class='tombol'><div align='center'>Roll</div></td>";
		  echo "<td class='tombol'><div align='center'>Kg</div></td>";
		   echo "<td class='tombol'><div align='center'>Delay</div></td>";
          echo "<td class='tombol'><div align='center'>KD</div></td>";
		  
	  //--150605 		echo "<td class='tombol'><div align='center'>Posisi Sebelumnya </div></td>";
          echo "<td class='tombol'><div align='center'>Status Terakhir </div></td>";
         
         
		 
         
		  echo "   <td class='tombol'><div align='center'>Keterangan </div></td>";
		  
		  /*echo "   <td class='tombol'><div align='center'>ID </div></td>";*/
		  echo "   <td class='tombol'><div align='center'>No Kartu Kerja </div></td>";
		  //--tambahan 2016.01.19
		  echo "   <td class='tombol'><div align='center'>Catatan PO Greige </div></td>";
		  
        echo "</tr>";
		//--
		$sqlpre02="select so.PONumber,jo.DocumentNo,pcb.ID as PCBID, pcb.DocumentNo as NoKK,pcb.Gross,soda.RefNo
from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID left join
				ProcessControlJO pcjo on sod.ID = pcjo.SODID left join
				ProcessControlBatches pcb on pcjo.PCID = pcb.PCID 
where $filterbuy and $filtertgl and pcb.Gross<>'0' order by jo.DocumentNo";
		$qrypre02=mssql_query($sqlpre02);
		//$rowpre02=mssql_fetch_row($qrypre02);

		//--
		$c=0;
		while ($rowpre02=mssql_fetch_assoc($qrypre02)){
		
		//-------begin		
		$sqlpre2=mssql_query("select top 1 ID,Dated,PCBID,DepartmentID from PCCardPosition where PCBID='$rowpre02[PCBID]' order by ID desc");
		$hit=mssql_num_rows($sqlpre2);
if ($hit > 0){ //---------------------------------------------jika KK sudah keluar
				//$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
		$rowpre2=mssql_fetch_assoc($sqlpre2);
		
		//--
		//--
		$sql2="select
			x.*, 
			udq.UnitName, udq.DetailDigits,
			udw.UnitName as WeightUnitName, udw.DetailDigits as WeightDigits,
			udb.UnitName as BatchUnitName, udb.DetailDigits as BatchDigits,
			cust.PartnerNumber as CustomerNumber, cust.CompanyTitle as CustomerTitle, cust.PartnerName as CustomerName,
			buy.PartnerNumber as BuyerNumber, buy.CompanyTitle as BuyerTitle, buy.PartnerName as BuyerName,
			pm.ProductNumber, pm.Description as ProductDesc,pm.ShortDescription as ShortDesc, pm.ColorNo, pm.Color, udb.UnitName as NamaUnit,
			pm.Weight as Gramasi,pm.CuttableWidth as Lebar,convert(varchar,pm.Note) as Alur,
			dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight,
			dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount,
			convert(char(10),dbo.fn_StockMovementDetails_GetTglBagiKain(0, x.PCBID),101) as TglBagiKain,
			dep.DepartmentCode, dep.DepartmentName, pdep.DepartmentCode as RootDepartmentCode, pdep.DepartmentName as RootDepartmentName,
			dep.ID as deptID
		from
			(
			select
				so.SONumber, convert(char(10),so.SODate,101) as TglSO, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
				sod.ID as SODID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID, 
				soda.RefNo as DetailRefNo,convert(char(10),sod.RequiredDate,101) as TglPerlu,
				pcb.ID as PCBID, pcb.DocumentNo as NoKK,convert(char(10),pcb.Dated,101) as TglKK, pcb.Gross as Bruto,
				pcb.Quantity as BatchQuantity, pcb.UnitID as BatchUnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
				pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID,
				CAST(soda.Note as Varchar(200)) as KetPO
			from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID left join
				ProcessControlJO pcjo on sod.ID = pcjo.SODID left join
				ProcessControlBatches pcb on pcjo.PCID = pcb.PCID left join
				PCCardPosition pcblp on pcb.ID = pcblp.PCBID left join
				ProcessFlowProcessNo pfpn on pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID and pfpn.MachineType = 24 left join
				ProcessFlowDetailsNote pfdn on pfpn.EntryType = pfdn.EntryType and pfpn.ID = pfdn.ParentID
			where  $filterbuy and $filtertgl and pcb.Gross<>'0' and pcblp.ID='$rowpre2[ID]' --so.SODate between '$tglDel' and '$tglDel2'
				group by
					so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
					sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
					soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,CAST(soda.Note as Varchar(200)),
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
			"; //order by
				//x.SODID, x.PCBID";

$sql2b = mssql_query($sql2) 
    or die('A error occured : 1');
		//--
$row2=mssql_fetch_assoc($sql2b);
	
		//----cari salinan
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
			  //--end salinan
			  
			$sqlkk=mssql_query("select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and CounterDepartmentID<>'$row2[DepartmentID]' order by Dated desc");
			$rowkk=mssql_fetch_row($sqlkk);
	
	//----jika bukan KK OK
	if ($row2[DepartmentName]=="KK Oke"){
		//$Muncul="TIDAK";
		$Muncul="YA";
	}else if ($row2[DepartmentName]=="Oper Warna"){
		$Muncul="TIDAK";
	}else if ($row2[DepartmentName]=="PPC BS"){
		$Muncul="TIDAK";
	}else{
		$Muncul="YA";
	}
	
	if ($Muncul=="YA"){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 			
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td class='normal333' valign=top>$c</td>";
		//----
	//	if($buyid<>""){	
		$sqlgetcust=mssql_query("Select ID,PartnerNumber from Partners where ID='$row2[CustomerID]'");
		$rowgetcust=mssql_fetch_assoc($sqlgetcust);
		echo "<td class='normal333' valign=top>$rowgetcust[PartnerNumber] / $row2[BuyerNumber]</td>";
		
	//	}		
		//---
	//	 echo "<td class='normal333' valign=top>$row2[TglSO]</td>";
		  echo "<td class='normal333' valign=top>$row2[DocumentNo]</td>";
		   echo "<td class='normal333' valign=top>$row2[ProductDesc]</td>"; //rubah dari short desc
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Lebar],0). "</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Gramasi],0). "</td>";
		    echo "<td width='150' class='normal333' valign=top>$row2[Color]</td>";
		    echo "<td width='100' class='normal333' valign=top>$row2[ColorNo]</td>";
         
          //--lot
					  echo "<td class='normal333' valign=top>";
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='$row2[PCID]' and RootID='0' and LotNo < '1000'";
					  $qryLot = mssql_query($sqlLot) 
								or die('A error occured : ');
								
					  		$rowLot=mssql_fetch_assoc($qryLot);	
							echo "'$rowLot[TotalLot]-$nomorLot";
					  
					  echo "</td>";
					  //--
					  
					   //---warning
					   //---hitung selisiih
					   //--warning	
					
					$pecah2A = explode("/", $row2[TglPerlu]);
					$date2A = $pecah2A[1];
					$month2A = $pecah2A[0];
					$year2A = $pecah2A[2];
					$tglNowA="$tanggal1/$tanggal2/$tanggal3";
					$nowA=strtotime(date("Y-m-d H:m:s"));
					$pecah3A = explode("/", $tglNowA);
					$date3A = $pecah3A[0];
					$month3A = $pecah3A[1];
					$year3A = $pecah3A[2];
					
						
						$jd2A = GregorianToJD($month2A,$date2A,$year2A);	
						//list($year, $month, $day) = explode('/', $row2[TglPerlu]);
						//$new_jd2 = sprintf('%04d%02d%02d', $year, $month, $day);
						$new_jd2A="$year2A-$month2A-$date2A 00:00:00";
						$new_jd2A=strtotime($new_jd2A);
						$jd3A = GregorianToJD($month3A,$date3A,$year3A);
					   //---
		 if($nowA > $new_jd2A)
		 {
		 	
				$selisihA=$jd3A - $jd2A;
				$selisihA=abs($selisihA);
				echo "<td width='140' class='normal333' valign=top>'$row2[TglPerlu]";
				//echo "<br><font color=red><strong>Delay $selisihA hari</stong></font>";
				$delay=$selisihA;
			
		 }else{
		 		$selisihA=$jd3A-$jd2A;
				$selisihA=abs($selisihA);
		 	echo "<td width='120' class='normal333' valign=top>'$row2[TglPerlu]";
				$delay="- $selisihA";
		 }
		 		
		   echo "</td>";
		//---
		echo "<td width='120' class='normal333' valign=top>'$row2[TglBagiKain]</td>";
		
		 echo "<td width='80' class='normal333' valign=top align=center>$row2[RollCount]</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2[Weight],2). "</td>";
		   
		    echo "<td width='80' class='normal333' valign=top align=right>$delay</td>";
		    
			//---POSISI SEBELUMnya
				
				$sqlpsb=mssql_query("Select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and Status ='0' and DepartmentID<>'$row2[DepartmentID]' order by Dated desc");
				$rowpsb=mssql_fetch_row($sqlpsb);
				
				$sqlkkpsb=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.DepartmentID  = dep.ID
where pcpos.ID='$rowpsb[0]' order by Dated desc");
		  $rowkkpsb=mssql_fetch_assoc($sqlkkpsb);		  
	
	//--150605	  	echo "<td width='120' class='BoldCD6' valign='top'><font class='normal7black'>$rowkkpsb[DepOut]  <br>Out: $rowkkpsb[TglIn] $rowkkpsb[JamIn]</font></td>";
			
			//--end posisi sebelumnya
		  //--		  
		  //--Kode Dept
			$DepKode=mssql_query("Select ParentID,ID from Departments where ID='$row2[deptID]'");
			$RKodeDep=mssql_fetch_assoc($DepKode);
			$KodeDep=$RKodeDep[ParentID];
			
			switch ($KodeDep) {
				case 2 :
					$KD="B";
					break;
				case 1:
					$KD="D";
					break;
				case 4:
					$KD="F";
					break;
				case 34:
					$KD="G";
					break;
				case 23:
					$KD="L";
					break;
				case 24:
					$KD="Q";
					break;
				case 69:
					$KD="Q2";
					break;
				case 4:
					$KD="F";
					break;
				case 49:
					if ($RKodeDep[ID]==78)
					{
						$KD="R";
					}else if ($RKodeDep[ID]==79)
					{
						$KD="M";
					}else if ($RKodeDep[ID]==80)
					{
						$KD="Y/D";
					}else{
						$KD="P";
					}
					break;
				case 47:
					$KD="SPRT";
					break;
				case 48:
					$KD="PRT";
					break;	
				case 62:
					$KD="TAS";
					break;
				case 58:
					$KD="G";
					break;
					
				default:
					$KD="N/A";
			} 
			//-
		 
		  if ($rowkk[5]==0){ // =0 : out

		  
							$sqlkk2=mssql_query("select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.CounterDepartmentID  = dep.ID
where pcpos.ID='$rowkk[0]' order by Dated desc");
		  $rowkk2=mssql_fetch_assoc($sqlkk2);
		  
			echo "<td class='normal333' valign=top align=center>$KD </td>";
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$row2[DepartmentName]<hr>Out:</font> <font class='normal7black'>$rowkk2[DepOut]  <br>$rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		
		  }elseif ($rowkk[5]<>0){ // =1 : in
		  	$sqlkk2=mssql_query("select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,DepartmentID  from PCCardPosition where ID='$rowkk[0]' order by Dated desc");
			$rowkk2=mssql_fetch_assoc($sqlkk2);
			//--warning	
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
		//---
			
			echo "<td class='normal333' valign=top align=center>$KD </td>";
			echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$row2[DepartmentName]</font><hr><font class='normal7black'>In: $rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
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
	where lt.MachineType='14' and lt.ParentID ='$rowflow[ID]' and (md.Description='Machine No.' or md.Description='Overfeed' or md.Description='Speed' or md.Description='Temperature')
	order by 
		md.Description";
		
						$qrymsn=mssql_query($sqlmsn);
						$ketsetting="$rowflow[TglF] $rowflow[JamF]<br>";
						while ($rowmsn=mssql_fetch_assoc($qrymsn)){
						$val="".number_format($rowmsn[Value1],1)."";
							$ketsetting="$ketsetting $rowmsn[Description] : $val $rowmsn[UnitName] <br>";
						}
						
					
				}
		  
		  }
		  //--end setting
      //--150605    echo "<td width='120' class='normal333' valign=top>$row2[ProductNumber]<hr><font size=0.1>$ketsetting</font></td>";
         
		   echo "<td width='120' class='normal333' valign=top> </td>"; //--150605  $row2[Alur]</td>";
		   /*echo "<td class='normal333' valign=top> ID </td>";*/
		  echo "<td width='120' class='normal333' valign=top>'<a href='logscan.php?kk=$row2[PCBID]' target=_blank>$row2[NoKK]</a><br>$row2[TglKK]</td>";
		  //---tambahan 2016.01.19
		  $CatPOG=str_replace("\n","<br \>",$row2[KetPO]);
		  echo "<td class='normal333' valign=top>$CatPOG</td>";
		  
		  //---Dept Note
		  $sqlcarinotePCB=mssql_query("select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'");
		  
		  $rowcarinotePCB=mssql_fetch_assoc($sqlcarinotePCB);
		  
		  $sqlcarinotePFPN=mssql_query("select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowcarinotePCB[ID]' order by Dated desc");
		  
		  $rowcarinotePFPN=mssql_fetch_assoc($sqlcarinotePFPN);
		  
		  $sqlcarinotePFDN=mssql_query("select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Cat  from ProcessFlowDetailsDeptNote where DepartmentID='$row2[deptID]' and ParentID ='$rowcarinotePFPN[ID]'");
		  
		  $rowcarinotePFDN=mssql_fetch_assoc($sqlcarinotePFDN);
		  
		  		  
		  //--end Dept Note  ----BYCUST
		  $catatandept=$rowcarinotePFDN[Cat];
		 // echo "<td class='normal333' valign=top>$catatandept</td>";
		 
        echo "</tr>";
 	
	}//----end jika bukan KK Ok
	
 } //---------------------------------end jika KK sudah keluar   
 
     
		}
     echo "</table>";

			}else{
				echo "<br><br><font class='normal9black'>Data TIDAK ditemukan ! $tglDisplay - $tglDisplay2 $tglDel $tglDel2</font>";	
			}
	//--
	//mssql_free_result($sql);
	mssql_close($conn);
	
//-------end Proses customer
}
//--
}
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