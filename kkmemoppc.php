<?php
ini_set("error_reporting", 1);
include "koneksi.php";
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
	<title>posisi KK :: online system</title>
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
			set_time_limit(3600);
	//$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//sqlsrv_select_db($db_name) or die ("Under maintenance");
		$sqlcus=sqlsrv_query($conn,"select ID,PartnerNumber,PartnerName from Partners where ID='$custid'", array(), array("Scrollable"=>"buffered"));
		$rcus=sqlsrv_fetch_array($sqlcus,SQLSRV_FETCH_ASSOC);
		echo "<option value='$rcus[ID]' selected>$rcus[PartnerNumber] / $rcus[PartnerName]</option>";
	//--
		  	$sqlBuyer="select ID,PartnerNumber,PartnerName  from Partners where Status ='1' or Status='3' or Status='5' or Status='7' order by PartnerNumber";

$qryBuyer = sqlsrv_query($conn,$sqlBuyer, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured : ');
 
$countBuyer = sqlsrv_num_rows($qryBuyer);

		if ($countBuyer > 0 ){
				//echo "<select name=kodebuyer class='normal9black'  onChange='window.location=?subid=+this.value'>";
				//echo "<option value='' selected></option>";
			while($rowBuyer=sqlsrv_fetch_array($qryBuyer,SQLSRV_FETCH_ASSOC)){
				$IDBuyer=$rowBuyer['ID']; $Kdbuyer=$rowBuyer['PartnerNumber']; $NamaBuyer=$rowBuyer['PartnerName'];
				
				echo "<option value='$IDBuyer'>$Kdbuyer / $NamaBuyer </option>";
				
			}
			//echo "</select";
		}	
			//--
	//sqlsrv_free_result($qryBuyer);
	//sqlsrv_close($conn);
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
	//$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//sqlsrv_select_db($db_name) or die ("Under maintenance");
		$sqlbuy=sqlsrv_query($conn,"select ID,PartnerNumber,PartnerName from Partners where ID='$buyid'", array(), array("Scrollable"=>"buffered"));
		$rbuy=sqlsrv_fetch_array($sqlbuy,SQLSRV_FETCH_ASSOC);
		echo "<option value='$rbuy[ID]' selected>$rbuy[PartnerNumber] / $rbuy[PartnerName]</option>";
	//--
		  	$sqlBuyer="select ID,PartnerNumber,PartnerName  from Partners where Status > '3' order by PartnerName";

$qryBuyer = sqlsrv_query($conn,$sqlBuyer, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured : ');
 
$countBuyer = sqlsrv_num_rows($qryBuyer);

		if ($countBuyer > 0 ){
				//echo "<select name=kodebuyer class='normal9black'  onChange='window.location=?subid=+this.value'>";
				//echo "<option value='' selected></option>";
			while($rowBuyer=sqlsrv_fetch_array($qryBuyer,SQLSRV_FETCH_ASSOC)){
				$IDBuyer=$rowBuyer['ID']; $Kdbuyer=$rowBuyer['PartnerNumber']; $NamaBuyer=$rowBuyer['PartnerName'];
				
				echo "<option value='$IDBuyer'>$Kdbuyer / $NamaBuyer </option>";
				
			}
			//echo "</select";
		}	
			//--
	//sqlsrv_free_result($qryBuyer);
	//sqlsrv_close($conn);
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
                            <td class="normal9black"><input type="checkbox" name="kkoksaja" id="checkbox" value=1>
                              Hanya KK OK ----- <input type="checkbox" name="belumbagikain" id="checkbox" value=1>
                              BELUM BAGI KAIN ----- <input type="checkbox" name="belumcelup" id="checkbox" value=1>
                              BELUM CELUP</td>
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
	$sqlcust=sqlsrv_query($conn,"Select ID,PartnerNumber,CompanyTitle,PartnerName,Address,City,Province,CountryID,PostalCode,PhoneNumber,FaxNumber,Email from Partners where ID='$codcust'", array(), array("Scrollable"=>"buffered"));
	$rcust=sqlsrv_fetch_array($sqlcust,SQLSRV_FETCH_ASSOC);
	$sqlcon=sqlsrv_query($conn,"Select ID,CountryName from Countries where ID='$rcust[CountryID]'", array(), array("Scrollable"=>"buffered"));
		$rcon=sqlsrv_fetch_array($sqlcon,SQLSRV_FETCH_ASSOC);

$filterbuy="so.CustomerID='$codcust'";

}//--filter cust

if($buyid<>""){		
	$sqlbuy=sqlsrv_query($conn,"Select ID,PartnerNumber,CompanyTitle,PartnerName,Address,City,Province,CountryID,PostalCode,PhoneNumber,FaxNumber,Email from Partners where ID='$buyer'", array(), array("Scrollable"=>"buffered"));
	$rbuy=sqlsrv_fetch_array($sqlbuy,SQLSRV_FETCH_ASSOC);
	$sqlcon=sqlsrv_query($conn,"Select ID,CountryName from Countries where ID='$rbuy[CountryID]'", array(), array("Scrollable"=>"buffered"));
		$rcon=sqlsrv_fetch_array($sqlcon,SQLSRV_FETCH_ASSOC);

$filterbuy="so.BuyerID='$buyer'";

}//--filter buy
	
if (($custid=="")&&($buyid=="")){  //tambahan update 5 juli 2018
	
	$filterbuy="so.BuyerID > '0'";
}
	$kkoksaja=$_POST['kkoksaja'];
	if($kkoksaja==1){
		$kkok="OK";
	}else{
		$kkok="NO";	
	}
	
	$belumbagikain=$_POST['belumbagikain'];
	$belumcelup=$_POST['belumcelup'];
	
	
//---
//--mulai program
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

$sqlb = sqlsrv_query($conn,$sql0b, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured :0C');
 
$count = sqlsrv_num_rows($sqlb);

			if ($count > 0 ){
			$row=sqlsrv_fetch_array($sqlb,SQLSRV_FETCH_ASSOC);
			echo "<font class='blod9black'>Hasil Pencarian <br><br>";
			echo "<font class='blod9black'>Range Tanggal $notefilter : $tglDisplay s.d. $tglDisplay2</font><br><br>";
			
			echo "<table width='100%' border='0'>";
      echo "<tr>";
        echo "<td width='100' align='left' valign='middle' class='normal9black'>&nbsp;</td>";
        echo "<td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
      echo "</tr>";
	   echo " <tr>";
        echo "<td align='left' valign='middle' class='normal9black'>Buyer</td>";
				if ($custid<>"" || $buyid<>""){
					echo "<td align='left' valign='middle' class='normal9black'>: $row[BuyerNumber] / $row[BuyerName], $row[BuyerTitle]</td>";
				}else{
					echo "<td align='left' valign='middle' class='normal9black'>: ALL </td>";
				}
        
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
     echo "   <td align='left' valign='middle' class='normal9black'>| <a href='kkmemoppc-xls.php?custid=$custid&buyid=$buyid&range=$range&tglDel=$tgldateDel&tglDel2=$tgldateDelB&tglDel2A=$tgldateDel2&tglDel2B=$tgldateDel2B&codcust=$codcust&buyer=$buyer&kkok=$kkok'> CETAK KE EXCEL </a></td>";
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
		echo "<td class='tombol'><div align='center'>No PO</div></td>";		
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
		$sqlpre02="select so.PONumber,jo.DocumentNo,pcb.ID as PCBID, pcb.DocumentNo as NoKK,pcb.Gross,soda.RefNo,pm.Description
from
				SalesOrders so inner join
				JobOrders jo on jo.SOID=so.ID inner join
				SODetails sod on so.ID = sod.SOID inner join
				ProductMaster pm on sod.ProductID = pm.ID inner join
				SODetailsAdditional soda on sod.ID = soda.SODID left join
				ProcessControlJO pcjo on sod.ID = pcjo.SODID left join
				ProcessControlBatches pcb on pcjo.PCID = pcb.PCID 
where $filterbuy and $filtertgl and pcb.Gross<>'0' order by jo.DocumentNo,pm.Description";
		$qrypre02=sqlsrv_query($conn,$sqlpre02, array(), array("Scrollable"=>"buffered"));
		//$rowpre02=sqlsrv_fetch_row($qrypre02);

		//--
		$c=0;
		while ($rowpre02=sqlsrv_fetch_array($qrypre02,SQLSRV_FETCH_ASSOC)){
//---------------------------------------------------------------------------------------cek tambahan		
		//-------begin		
		$sqlpre2=sqlsrv_query($conn,"select top 1 ID,Dated,PCBID,DepartmentID from PCCardPosition where PCBID='$rowpre02[PCBID]' order by ID desc", array(), array("Scrollable"=>"buffered"));
		$hit=sqlsrv_num_rows($sqlpre2);
if ($hit > 0){ //---------------------------------------------jika KK sudah keluar
				//$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 
		$rowpre2=sqlsrv_fetch_array($sqlpre2,SQLSRV_FETCH_ASSOC);
		
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
			order by
				x.SODID, x.PCBID";

$sql2b = sqlsrv_query($conn,$sql2, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured : 1');
		//--
$row2=sqlsrv_fetch_array($sql2b,SQLSRV_FETCH_ASSOC);
	
		//----cari salinan
			   $child=$row2['ChildLevel'];
			
					if($child > 0){
						$sqlgetparent=sqlsrv_query($conn,"select ID,LotNo from ProcessControlBatches where ID='$row2[RootID]' and ChildLevel='0'", array(), array("Scrollable"=>"buffered"));
						$rowgp=sqlsrv_fetch_array($sqlgetparent,SQLSRV_FETCH_ASSOC);
						
						//$nomLot=substr("$row2[LotNo]",0,1);
						$nomLot=$rowgp['LotNo'];
						$nomorLot="$nomLot/K$row2[ChildLevel]&nbsp;";				
											
					}else{
						$nomorLot=$row2['LotNo'];
							
					}
			  //--end salinan
			  
			$sqlkk=sqlsrv_query($conn,"select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and CounterDepartmentID<>'$row2[DepartmentID]' order by Dated desc", array(), array("Scrollable"=>"buffered"));
			$rowkk=sqlsrv_fetch_array($sqlkk);
   if ($kkok=="NO"){
		//----jika bukan KK OK 
		if ($row2['DepartmentName']=="KK Oke"){
			$Muncul="TIDAK";
		}else if ($row2['DepartmentName']=="Oper Warna"){
			$Muncul="TIDAK";
		}else if ($row2['DepartmentName']=="PPC BS"){
			$Muncul="TIDAK";
		}else if ($row2['DepartmentName']=="KAIN JADI BS"){
			$Muncul="TIDAK";
		}else{
			$Muncul="YA";
		}
   }else{
		if ($row2['DepartmentName']=="KK Oke"){
			$Muncul="YA";
		}else{
			$Muncul="TIDAK";
		}
   }
//---------------------------tambahan belum celup /bagi kain	
	if ($belumcelup==1){
		$sqlbcl=sqlsrv_query($conn,"select count(x.PCBID) as jumlah from
(
select p.PCBID,p.Status,d.DepartmentName as DepIn,d2.DepartmentName as DepOut from PCCardPosition p left join 
Departments d on d.ID=p.DepartmentID left join
Departments d2 on d2.ID=p.CounterDepartmentID
where p.PCBID='$row2[PCBID]' and (p.DepartmentID='116' and p.status=1)

)x", array(), array("Scrollable"=>"buffered"));
		$rowbelumcelup=sqlsrv_fetch_array($sqlbcl);
		$countbelumcelup=$rowbelumcelup['jumlah'];
		
		if ($countbelumcelup > 0){
			$Muncul="TIDAK";
		}else{
			$Muncul="YA"	;	
		}
		
	}
	
	if ($belumbagikain==1){
		$sqlbagik=sqlsrv_query($conn,"select count(x.PCBID) as jumlah from
(
select p.PCBID,p.Status,d.DepartmentName as DepIn,d2.DepartmentName as DepOut from PCCardPosition p left join 
Departments d on d.ID=p.DepartmentID left join
Departments d2 on d2.ID=p.CounterDepartmentID
where p.PCBID='$row2[PCBID]' and (p.DepartmentID='59' and p.status=1)

)x", array(), array("Scrollable"=>"buffered"));
		$rowbelumbagikain=sqlsrv_fetch_array($sqlbagik);
		$countbelumbagikain=$rowbelumbagikain['jumlah'];
		
		if ($countbelumbagikain > 0){
			$Muncul="TIDAK";
		}else{
			$Muncul="YA";		
		}
		
	}
	
//-----------------------------end tambahan
	if ($Muncul=="YA"){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 			
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td class='normal333' valign=top>$c</td>";
		//----
	//	if($buyid<>""){	
		$sqlgetcust=sqlsrv_query($conn,"Select ID,PartnerNumber from Partners where ID='$row2[CustomerID]'", array(), array("Scrollable"=>"buffered"));
		$rowgetcust=sqlsrv_fetch_array($sqlgetcust,SQLSRV_FETCH_ASSOC);
		echo "<td class='normal333' valign=top>$rowgetcust[PartnerNumber] / $row2[BuyerNumber]</td>";
		
	//	}		
		//---
	//	 echo "<td class='normal333' valign=top>$row2[TglSO]</td>";	
		  echo "<td class='normal333' valign=top>$row2[DocumentNo] $countbelumbagikain - </td>";
		  echo "<td class='normal333' valign=top>$row2[PONumber]</td>";
		   echo "<td class='normal333' valign=top>$row2[ProductDesc]</td>"; //rubah dari short desc
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Lebar'],0). "</td>";
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Gramasi'],0). "</td>";
		    echo "<td width='150' class='normal333' valign=top>$row2[Color]</td>";
		    echo "<td width='100' class='normal333' valign=top>$row2[ColorNo]</td>";
         
          //--lot
					  echo "<td class='normal333' valign=top>";
					  $sqlLot="Select count(*) as TotalLot From ProcessControlBatches where PCID='$row2[PCID]' and RootID='0' and LotNo < '1000'";
					  $qryLot = sqlsrv_query($conn,$sqlLot, array(), array("Scrollable"=>"buffered")) 
								or die('A error occured : ');
								
					  		$rowLot=sqlsrv_fetch_array($qryLot,SQLSRV_FETCH_ASSOC);	
							echo "'$rowLot[TotalLot]-$nomorLot";
					  
					  echo "</td>";
					  //--
					  
					   //---warning
					   //---hitung selisiih
					   //--warning	
					
					if($row2['TglPerlu']!=""){
					$pecah2A = explode("/", $row2['TglPerlu']);
					$date2A = $pecah2A[1];
					$month2A = $pecah2A[0];
					$year2A = $pecah2A[2];
					}
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
		   echo "<td width='80' class='normal333' valign=top>" .number_format($row2['Weight'],2). "</td>";
		   
		    echo "<td width='80' class='normal333' valign=top align=right>$delay</td>";
		    
			//---POSISI SEBELUMnya
				
				$sqlpsb=sqlsrv_query($conn,"Select top 2 * from PCCardPosition where PCBID='$row2[PCBID]' and Status ='0' and DepartmentID<>'$row2[DepartmentID]' order by Dated desc", array(), array("Scrollable"=>"buffered"));
				$rowpsb=sqlsrv_fetch_array($sqlpsb);
				
				$sqlkkpsb=sqlsrv_query($conn,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.DepartmentID  = dep.ID
where pcpos.ID='$rowpsb[0]' order by Dated desc", array(), array("Scrollable"=>"buffered"));
		  $rowkkpsb=sqlsrv_fetch_array($sqlkkpsb,SQLSRV_FETCH_ASSOC);		  
	
	//--150605	  	echo "<td width='120' class='BoldCD6' valign='top'><font class='normal7black'>$rowkkpsb[DepOut]  <br>Out: $rowkkpsb[TglIn] $rowkkpsb[JamIn]</font></td>";
			
			//--end posisi sebelumnya
		  //--		  
		  //--Kode Dept
			$DepKode=sqlsrv_query($conn,"Select ParentID,ID from Departments where ID='$row2[deptID]'", array(), array("Scrollable"=>"buffered"));
			$RKodeDep=sqlsrv_fetch_array($DepKode,SQLSRV_FETCH_ASSOC);
			$KodeDep=$RKodeDep['ParentID'];
			
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
					if ($RKodeDep['ID']==39)
					{
						$KD="G";
					}else if ($RKodeDep['ID']==43)
					{
						$KD="J";
					}else{
						$KD="J";
					}
					break;
				case 23:
					$KD="L";
					break;
				case 24:
					$KD="Q";
					break;
				case 69:
					if ($RKodeDep['ID']==110)
					{
						$KD="LAP";
					}else{
						$KD="Q2";	
					}
					break;
				case 4:
					$KD="F";
					break;
				case 49:
					if ($RKodeDep['ID']==53)
					{
						$KD="P";
					}else if ($RKodeDep['ID']==78)
					{
						$KD="R";
					}else if ($RKodeDep['ID']==79)
					{
						$KD="P";
					}else if ($RKodeDep['ID']==80)
					{
						$KD="Y/D";
					}else if ($RKodeDep['ID']==83)
					{
						$KD="P";
					}else if ($RKodeDep['ID']==108)
					{
						$KD="P1";
					}else if ($RKodeDep['ID']==109)
					{
						$KD="P2";
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

		  
							$sqlkk2=sqlsrv_query($conn,"select pcpos.*,dep.DepartmentName as DepOut,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn  from PCCardPosition pcpos 
inner join
Departments dep on pcpos.CounterDepartmentID  = dep.ID
where pcpos.ID='$rowkk[0]' order by Dated desc", array(), array("Scrollable"=>"buffered"));
		  $rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);
		  
			echo "<td class='normal333' valign=top align=center>$KD </td>";
		  	echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$row2[DepartmentName]<hr>Out:</font> <font class='normal7black'>$rowkk2[DepOut]  <br>$rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		
		  }elseif ($rowkk[5]<>0){ // =1 : in
		  	$sqlkk2=sqlsrv_query($conn,"select ID,convert(char(10),Dated,103) as TglIn,convert(char(10),Dated,108) as JamIn,DepartmentID  from PCCardPosition where ID='$rowkk[0]' order by Dated desc", array(), array("Scrollable"=>"buffered"));
			$rowkk2=sqlsrv_fetch_array($sqlkk2,SQLSRV_FETCH_ASSOC);
			//--warning	
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
		//---
			
			echo "<td class='normal333' valign=top align=center>$KD </td>";
			echo "<td width='120' class='BoldCD6' valign='top'><font class='blod9black'>$row2[DepartmentName]</font><hr><font class='normal7black'>In: $rowkk2[TglIn] $rowkk2[JamIn]</font></td>";
		  }
		  //--
         
		   
         
		  
		//---setting
		  $sqlset=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"buffered"));
		  $cset=sqlsrv_num_rows($sqlset);
		  if ($cset > 0 ){
		  	$rowset=sqlsrv_fetch_array($sqlset,SQLSRV_FETCH_ASSOC);
				$sqlflow=sqlsrv_query($conn,"select top 1 *,convert(char(10),Dated,103) as TglF,convert(char(10),Dated,108) as JamF from ProcessFlowProcessNo where ParentID='$rowset[ID]' and MachineType='14' order by Dated desc", array(), array("Scrollable"=>"buffered"));
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
		
						$qrymsn=sqlsrv_query($conn,$sqlmsn, array(), array("Scrollable"=>"buffered"));
						$ketsetting="$rowflow[TglF] $rowflow[JamF]<br>";
						while ($rowmsn=sqlsrv_fetch_array($qrymsn)){
						$val="".number_format($rowmsn['Value1'],1)."";
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
		  $CatPOG=str_replace("\n","<br \>",$row2['KetPO']);
		  echo "<td class='normal333' valign=top>$CatPOG</td>";
		  
		  //---Dept Note
		  $sqlcarinotePCB=sqlsrv_query($conn,"select ID,DocumentNo from ProcessControlBatches where DocumentNo='$row2[NoKK]'", array(), array("Scrollable"=>"buffered"));
		  
		  $rowcarinotePCB=sqlsrv_fetch_array($sqlcarinotePCB,SQLSRV_FETCH_ASSOC);
		  
		  $sqlcarinotePFPN=sqlsrv_query($conn,"select top 1 ID,ParentID,Dated from ProcessFlowProcessNo where ParentID='$rowcarinotePCB[ID]' order by Dated desc", array(), array("Scrollable"=>"buffered"));
		  
		  $rowcarinotePFPN=sqlsrv_fetch_array($sqlcarinotePFPN,SQLSRV_FETCH_ASSOC);
		  
		  $sqlcarinotePFDN=sqlsrv_query($conn,"select ParentID,DepartmentID,cast(Note as nvarchar(200)) as Cat  from ProcessFlowDetailsDeptNote where DepartmentID='$row2[deptID]' and ParentID ='$rowcarinotePFPN[ID]'", array(), array("Scrollable"=>"buffered"));
		  
		  $rowcarinotePFDN=sqlsrv_fetch_array($sqlcarinotePFDN,SQLSRV_FETCH_ASSOC);
		  
		  		  
		  //--end Dept Note  ----BYCUST
		  $catatandept=$rowcarinotePFDN['Cat'];
		 // echo "<td class='normal333' valign=top>$catatandept</td>";
		 
        echo "</tr>";
 	
	}//----end jika bukan KK Ok
	
 } //---------------------------------end jika KK sudah keluar   
 
     
			
//---------------------------------------------------------------------end tambahan			
		} //-----------------------------------------------------------end of while
     echo "</table>";

			}else{
				echo "<br><br><font class='normal9black'>Data TIDAK ditemukan ! $tglDisplay - $tglDisplay2 $tglDel $tglDel2</font>";	
			}
	//--
	//sqlsrv_free_result($sql);
	//sqlsrv_close($conn);
	
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