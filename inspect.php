<?php
ini_set("error_reporting", 1);
include "koneksi.php";
//--
//$act=isset($_POST['act']);
//$custid=trim(isset($_GET['custid']));
//$buyid=trim(isset($_GET['buyid']));
//$codcust=isset($_POST['kodebuyer']);
//$buyer=isset($_POST['buyer']);
$act=$_POST['act'];
$custid=trim($_GET['custid']);
$buyid=trim($_GET['buyid']);
$codcust=$_POST['kodebuyer'];
$buyer=$_POST['buyer'];
$formno=$_POST['formno'];
$bo=$_POST['bo'];

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
	<title>Summary Inspection Report</title>
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
	//$conn=sqlsrv_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	//sqlsrv_select_db($db_name) or die ("Under maintenance");
		$sqlcus=sqlsrv_query($conn,"select ID,PartnerNumber,PartnerName from Partners where ID='$custid'", array(), array("Scrollable"=>"buffered"));
		$rcus=sqlsrv_fetch_array($sqlcus,SQLSRV_FETCH_ASSOC);
		echo "<option value='".$rcus['ID']."' selected>".$rcus['PartnerNumber']." / ".$rcus['PartnerName']."</option>";
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
//	sqlsrv_free_result($qryBuyer);
//	sqlsrv_close($conn);
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
		echo "<option value='".$rbuy['ID']."' selected>".$rbuy['PartnerNumber']." / ".$rbuy['PartnerName']."</option>";
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
                            Range Inspect Date</td>
                            <td class="normal9black"><input name="tglDel" type="text" class="normal9black" id="datepick" />
                            sampai
                          <input name="tglDel2" type="text" class="normal9black" id="datepick2" /></td>
                          </tr>						  
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="blod9black">Bon Order</td>
                            <td class="normal9black"><input name="bo" type="text" class="normal9black" id="bo"></td>
                          </tr>
                          <tr>
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">&nbsp;</td>
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
                            <td class="blod9black">&nbsp;</td>
                            <td class="normal9black">Pilih Form 
                              <label for="formno">:</label>
                              <select name="formno" class="normal9black" id="formno">
                                <option value="-" selected="selected">-</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
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
	$sqlcust=sqlsrv_query($conn,"Select ID,PartnerNumber,CompanyTitle,PartnerName,Address,City,Province,CountryID,PostalCode,PhoneNumber,FaxNumber,Email from Partners where ID='$codcust'", array(), array("Scrollable"=>"buffered"));
	$rcust=sqlsrv_fetch_array($sqlcust,SQLSRV_FETCH_ASSOC);
	$sqlcon=sqlsrv_query($conn,"Select ID,CountryName from Countries where ID='".$rcust['CountryID']."'", array(), array("Scrollable"=>"buffered"));
		$rcon=sqlsrv_fetch_array($sqlcon,SQLSRV_FETCH_ASSOC);

$filterbuy="so.CustomerID='$codcust'";

}//--filter cust

if($buyid<>""){		
	$sqlbuy=sqlsrv_query($conn,"Select ID,PartnerNumber,CompanyTitle,PartnerName,Address,City,Province,CountryID,PostalCode,PhoneNumber,FaxNumber,Email from Partners where ID='$buyer'", array(), array("Scrollable"=>"buffered"));
	$rbuy=sqlsrv_fetch_array($sqlbuy,SQLSRV_FETCH_ASSOC);
	$sqlcon=sqlsrv_query($conn,"Select ID,CountryName from Countries where ID='".$rbuy['CountryID']."'", array(), array("Scrollable"=>"buffered"));
		$rcon=sqlsrv_fetch_array($sqlcon,SQLSRV_FETCH_ASSOC);

$filterbuy="so.BuyerID='$buyer'";

}//--filter buy

if(($buyid=="") && ($custid=="")){		
	$sqlbuy=sqlsrv_query($conn,"Select ID,PartnerNumber,CompanyTitle,PartnerName,Address,City,Province,CountryID,PostalCode,PhoneNumber,FaxNumber,Email from Partners", array(), array("Scrollable"=>"buffered"));
	$rbuy=sqlsrv_fetch_array($sqlbuy,SQLSRV_FETCH_ASSOC);
	$sqlcon=sqlsrv_query($conn,"Select ID,CountryName from Countries where ID='".$rbuy['CountryID']."'", array(), array("Scrollable"=>"buffered"));
		$rcon=sqlsrv_fetch_array($sqlcon,SQLSRV_FETCH_ASSOC);

$filterbuy="";

}//--filter tanggal saja

if($bo<>""){
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
			oad.ID > 0 and jo.DocumentNo='$bo'
)x order by x.PCBID";

}
		
elseif(($buyid=="") && ($custid=="")){
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

$sqlb = sqlsrv_query($conn,$sql0b, array(), array("Scrollable"=>"buffered")) 
    or die('A error occured :0C');
 
$count = sqlsrv_num_rows($sqlb);

			if ($count > 0 ){
			$row=sqlsrv_fetch_array($sqlb,SQLSRV_FETCH_ASSOC);
			echo "<font class='blod9black'>Summary Inspection Report <br><br>";
			if ($bo<>""){
				echo "<font class='blod9black'>No Bon Order : $bo</font><br><br>";
			}else{
				echo "<font class='blod9black'>Tanggal Inspeksi : $tglDisplay s.d. $tglDisplay2</font><br><br>";	
			}
			
			echo "<table width='100%' border='0'>";
      echo "<tr>";
        echo "<td width='100' align='left' valign='middle' class='normal9black'>&nbsp;</td>";
        echo "<td align='left' valign='middle' class='normal9black'>&nbsp;</td>";
      echo "</tr>";
	   echo " <tr>";
	   if ($buyid<>"")
	   {
        echo "<td align='left' valign='middle' class='normal9black'>Buyer</td>";
        echo "<td align='left' valign='middle' class='normal9black'>: ".$row['Buyer']."</td>";
	   }
	   
      echo "</tr>";
	  if ($custid<>""){
      echo "<tr>";	  	
        echo "<td align='left' valign='middle' class='normal9black'>Customer</td>";		
        echo "<td align='left' valign='middle' class='normal9black'>: ".$row['Customer']."</td>";
      echo "</tr>";
	  
	//  echo "<tr>";	       
	//	echo "<td align='left' valign='middle' class='normal9black'>Buyer</td>";
     //   echo "<td align='left' valign='middle' class='normal9black'>: $row[Buyer]</td>";		
      //echo "</tr>";
      }
      
     echo " <tr>";
      echo "  <td align='left' valign='middle' class='normal9black'>Detail</td>";
     echo "   <td align='left' valign='middle' class='normal9black'>| <a href='inspect-xls.php?custid=$custid&buyid=$buyid&range=$range&tglDel=$tgldateDel&tglDel2=$tgldateDelB&codcust=$codcust&buyer=$buyer&formno=$formno&bo=$bo'> CETAK KE EXCEL </a></td>";
     echo " </tr>";
      
    echo "</table>";
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	   echo "<td class='tombol'><div align='center'>No.</div></td>";
	  //if($buyid<>""){	
	   echo "<td class='tombol'><div align='center'>UOM</div></td>";
	  // }
	  // echo "<td class='tombol'><div align='center'>Tgl Order</div></td>";
	    echo "<td class='tombol'><div align='center'>No KK</div></td>";
		
		if ($filterbuy==""){
			echo "<td class='tombol'><div align='center'>Buyer</div></td>";
			echo "<td class='tombol'><div align='center'>Customer</div></td>";
		}else{
			if ($buyid<>""){
			 echo "<td class='tombol'><div align='center'>Customer</div></td>";
			 }else{
			  echo "<td class='tombol'><div align='center'>Buyer</div></td>";
			 }
		}
		  echo "<td class='tombol'><div align='center'>Item</div></td>";
		  echo "<td class='tombol'><div align='center'>Description</div></td>";
		   echo "<td class='tombol'><div align='center'>Season</div></td>";
		    echo "<td class='tombol'><div align='center'>Color</div></td>";
			 echo "<td class='tombol'><div align='center'>PO Number </div></td>";
			 
      echo "<td class='tombol'><div align='center'>Bon Order</div></td>";
	   echo "<td class='tombol'><div align='center'>LOT</div></td>";
	    echo "<td class='tombol'><div align='center'>Tgl inspek</div></td>";
		echo "<td class='tombol'><div align='center'>Roll</div></td>";
		  echo "<td class='tombol'><div align='center'>QTY</div></td>";
		   echo "<td class='tombol'><div align='center'>Yard</div></td>";
          echo "<td class='tombol'><div align='center'>Width</div></td>";
		  
	  //--150605 		echo "<td class='tombol'><div align='center'>Posisi Sebelumnya </div></td>";
          echo "<td class='tombol'><div align='center'>Gramasi </div></td>";
         
         
		 
         
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
			  echo "   <td class='tombol'><div align='center'>Jmh A</div></td>";
			  echo "   <td class='tombol'><div align='right'>Kg A</div></td>";
			  echo "   <td class='tombol'><div align='right'>Yd A</div></td>";
			  echo "   <td class='tombol'><div align='center'>Jmh B</div></td>";
			  echo "   <td class='tombol'><div align='right'>Kg B</div></td>";
			  echo "   <td class='tombol'><div align='right'>Yd B</div></td>";
			  echo "   <td class='tombol'><div align='center'>Jmh C/X</div></td>";
			  echo "   <td class='tombol'><div align='right'>Kg C/X</div></td>";
			  echo "   <td class='tombol'><div align='right'>Yd C/X</div></td>";
			  
		  
        echo "</tr>";
		//--
if($bo<>""){
	
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
			oad.ID > 0 and jo.DocumentNo='$bo'
)x order by x.PCBID";

}

elseif(($buyid=="") && ($custid=="")){
	
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

		$qrypre02=sqlsrv_query($conn,$sqlpre02, array(), array("Scrollable"=>"buffered"));
		//$rowpre02=sqlsrv_fetch_row($qrypre02);

		//--
		$c=0;
		while ($rowpre02=sqlsrv_fetch_array($qrypre02,SQLSRV_FETCH_ASSOC)){
		
		//-------begin			
		
		$PCBID=$rowpre02['PCBID'];
		
		//---cari data inspection no terakhir
		$sqlInsNo="select top 1 a.* from 
(
select distinct(InspectionNo) from ProcessFlowInspectionProcessNo where ParentID='$PCBID' group by InspectionNo 
)a
order by a.InspectionNo desc";
	$qryInsNo=sqlsrv_query($conn,$sqlInsNo, array(), array("Scrollable"=>"buffered"));
		$rowInsNo=sqlsrv_fetch_array($qryInsNo,SQLSRV_FETCH_ASSOC);
		$NoInspek=$rowInsNo['InspectionNo'];

//---------SQL INTI
$sqlINTI="declare @LotNo nvarchar(12), @TotalLots int
select @LotNo = LotNo, @TotalLots = TotalLot from dbo.fn_ProcessControlBatches_GetLotNo(0, 0, '$PCBID')

select (TotalPoint*100)/Yard as UOM,zz.* 
from
(
select z.* ,(A_Slub+A_Barre+A_UnevenYarn+A_YarnContamination+A_NEPSCotton+A_Misc+B_MissingLine+B_Holes+B_Streaks+
B_MisKnit+B_Knot_Count1+B_OilMark+B_FlyWaste+B_Misc+C_Hairiness+C_Holes+C_ColorTone+C_Abrasion+C_DyeSpot+C_Wrinkles+
C_BowingSkew+C_PinHoles+C_PickSnag+C_Knot+C_Misc+D_UnevenShearing+D_Stains+D_OilSpot+D_Dirt+D_WaterMarks+
D_Misc+E_Print+E_Misc) as TotalPoint
from
(
select y.BatchNo,y.Customer,y.ItemNumber,y.Season,y.Color,y.PONumber,y.JONumber,y.Buyer,y.ProductDescription,
	@LotNo as LotNo, y.TglInspek,count(y.rollno) as jmlROll,sum(y.Weight) as QTY,sum(y.LENGTH) as Yard,y.Width,y.Gramasi,
	avg(NULLIF(y.LebarInspek,0)) as LebarIns,avg(NULLIF(y.GramInspek,0)) as GramIns,
		sum(y.A_Slub_Count1) as A_Slub,
		sum(y.A_Barre_Count1) as A_Barre,
					sum(y.A_UnevenYarn_Count1) as A_UnevenYarn,
					sum(y.A_YarnContamination_Count1) as A_YarnContamination,
					sum(y.A_NEPSCotton_Count1) as A_NEPSCotton,
					sum(y.A_Misc_Count1) as A_Misc,
					sum(y.B_MissingLine_Count1) as B_MissingLine,
					sum(y.B_Holes_Count1) as B_Holes,
					sum(y.B_Streaks_Count1) as B_Streaks,
					sum(y.B_MisKnit_Count1) as B_MisKnit,
					sum(y.B_Knot_Count1) as B_Knot_Count1,
					sum(y.B_OilMark_Count1) as B_OilMark,
					sum(y.B_FlyWaste_Count1) as B_FlyWaste,
					sum(y.B_Misc_Count1) as B_Misc,
					sum(y.C_Hairiness_Count1) as C_Hairiness,
					sum(y.C_Holes_Count1) as C_Holes,
					sum(y.C_ColorTone_Count1) as C_ColorTone,
					sum(y.C_Abrasion_Count1) as C_Abrasion,
					sum(y.C_DyeSpot_Count1) as C_DyeSpot,
					sum(y.C_Wrinkles_Count1) as C_Wrinkles,
					sum(y.C_BowingSkew_Count1) as C_BowingSkew,
					sum(y.C_PinHoles_Count1) as C_PinHoles,
					sum(y.C_PickSnag_Count1) as C_PickSnag,
					sum(y.C_Knot_Count1) as C_Knot,
					sum(y.C_Misc_Count1) as C_Misc,
					sum(y.D_UnevenShearing_Count1) as D_UnevenShearing,
					sum(y.D_Stains_Count1) as D_Stains,
					sum(y.D_OilSpot_Count1) as D_OilSpot,
					sum(y.D_Dirt_Count1) as D_Dirt,
					sum(y.D_WaterMarks_Count1) as D_WaterMarks,
					sum(y.D_Misc_Count1) as D_Misc,
					sum(y.E_Print_Count1) as E_Print,
					sum(y.E_Misc_Count1) as E_Misc
				
from
(
select
			pfipn.RollNo, convert(char(10),pfipn.Dated,103) as TglInspek, pfipn.InspectionNo,
			pcb.DocumentNo as BatchNo,pfipn.Width as LebarInspek,pfipn.Density as GramInspek,
			pm.ProductNumber, pm.Description as ProductDescription, pm.ShortDescription as ProductShortDescription, pm.ColorNo, pm.Color, 
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
group by y.BatchNo,y.TglInspek,y.JONumber,y.Color,y.Customer,y.PONumber,y.ItemNumber,y.Season,y.Gramasi,y.Width,y.Buyer,y.ProductDescription
)z
)zz";

$qryINTI=sqlsrv_query($conn,$sqlINTI, array(), array("Scrollable"=>"buffered"));
$rowINTI=sqlsrv_fetch_array($qryINTI,SQLSRV_FETCH_ASSOC);

//---END SQL INTI
	if ($rowINTI['BatchNo']<>""){
		$Muncul="YA";
	}else{
		$Muncul="TIDAK";
	}
	
	if ($Muncul=="YA"){
		$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 			
        echo "<tr bgcolor='$bgcolor'>";
		echo "<td class='normal333'><div align='center'>$c</div></td>";
		
		
	  //if($buyid<>""){	
	   echo "<td class='normal333'><div align='right'>".number_format($rowINTI['UOM'],2)."</div></td>";
	  // }
	  // echo "<td class='normal333'><div align='center'>Tgl Order</div></td>";
	    echo "<td class='normal333'><div align='left'><a href='inspect-kk.php?pcbid=$PCBID&insno=$NoInspek&formno=$formno' target=_blank>".$rowINTI['BatchNo']."</a></div></td>";
		
		if ($filterbuy==""){
			echo "<td class='normal333'><div align='left'>".$rowINTI['Buyer']."</div></td>";
			 echo "<td class='normal333'><div align='left'>".$rowINTI['Customer']."</div></td>";
		}else{
			if ($buyid<>""){
			 echo "<td class='normal333'><div align='left'>".$rowINTI['Customer']."</div></td>";
			 }else{
			 echo "<td class='normal333'><div align='left'>".$rowINTI['Buyer']."</div></td>";
			 }
		}
		
		
		  echo "<td class='normal333'><div align='left'>".$rowINTI['ItemNumber']."</div></td>";
		  echo "<td class='normal333'><div align='left'>".$rowINTI['ProductDescription']."</div></td>";
		   echo "<td class='normal333'><div align='left'>".$rowINTI['Season']."</div></td>";
		    echo "<td class='normal333'><div align='left'>".$rowINTI['Color']."</div></td>";
			 echo "<td class='normal333'><div align='left'>".$rowINTI['PONumber']."</div></td>";
			 
      echo "<td class='normal333'><div align='left'>".$rowINTI['JONumber']."</div></td>";
	   echo "<td class='normal333'><div align='left'>".$rowINTI['LotNo']."</div></td>";
	    echo "<td class='normal333'><div align='left'>".$rowINTI['TglInspek']."</div></td>";
		echo "<td class='normal333'><div align='left'>".$rowINTI['jmlROll']."</div></td>";
		  echo "<td class='normal333'><div align='right'>".number_format($rowINTI['QTY'],2)."</div></td>";
		   echo "<td class='normal333'><div align='right'>".number_format($rowINTI['Yard'],2)."</div></td>";
          echo "<td class='normal333'><div align='right'>".number_format($rowINTI['Width'],0)."</div></td>";
		  
	  //--150605 		echo "<td class='normal333'><div align='right'>Posisi Sebelumnya </div></td>";
          echo "<td class='normal333'><div align='right'>".number_format($rowINTI['Gramasi'],0)." </div></td>";
         
		  echo "   <td class='normal333'><div align='right'>".number_format($rowINTI['LebarIns'],0)." </div></td>";
		  
		  echo "   <td class='normal333'><div align='right'>".number_format($rowINTI['GramIns'],0)." </div></td>";
		  echo "   <td class='normal333'><div align='center'>".$rowINTI['A_Slub']." </div></td>";
		  //--tambahan 2016.01.19
		  echo "   <td class='normal333'><div align='center'>".$rowINTI['A_Barre']."</div></td>";
		   echo "   <td class='normal333'><div align='center'>".$rowINTI['A_UnevenYarn']."</div></td>";
		    echo "   <td class='normal333'><div align='center'>".$rowINTI['A_YarnContamination']."</div></td>";
			 echo "   <td class='normal333'><div align='center'>".$rowINTI['A_NEPSCotton']."</div></td>";
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['A_Misc']."</div></td>";
		  
		  echo "   <td class='normal333'><div align='center'>".$rowINTI['B_MissingLine']."</div></td>";
		  echo "   <td class='normal333'><div align='center'>".$rowINTI['B_Holes']."</div></td>";
		   echo "   <td class='normal333'><div align='center'>".$rowINTI['B_Streaks']."</div></td>";
		    echo "   <td class='normal333'><div align='center'>".$rowINTI['B_MisKnit']."</div></td>";
			 echo "   <td class='normal333'><div align='center'>".$rowINTI['B_Knot_Count1']."</div></td>";
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['B_OilMark']."</div></td>";
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['B_FlyWaste']."</div></td>";
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['B_Misc']."</div></td>";
			  
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['C_Hairiness']."</div></td>";
		  echo "   <td class='normal333'><div align='center'>".$rowINTI['C_Holes']."</div></td>";
		   echo "   <td class='normal333'><div align='center'>".$rowINTI['C_ColorTone']."</div></td>";
		    echo "   <td class='normal333'><div align='center'>".$rowINTI['C_Abrasion']."</div></td>";
			 echo "   <td class='normal333'><div align='center'>".$rowINTI['C_DyeSpot']."</div></td>";
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['C_Wrinkles']."</div></td>";
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['C_BowingSkew']."</div></td>";
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['C_PinHoles']."</div></td>";
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['C_PickSnag']."</div></td>";
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['C_Knot']."</div></td>";
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['C_Misc']."</div></td>";
			  
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['D_UnevenShearing']."</div></td>";
		  echo "   <td class='normal333'><div align='center'>".$rowINTI['D_Stains']."</div></td>";
		   echo "   <td class='normal333'><div align='center'>".$rowINTI['D_OilSpot']."</div></td>";
		    echo "   <td class='normal333'><div align='center'>".$rowINTI['D_Dirt']."</div></td>";
			 echo "   <td class='normal333'><div align='center'>".$rowINTI['D_WaterMarks']."</div></td>";
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['D_Misc']."</div></td>";
			  
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['E_Print']."</div></td>";
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['E_Misc']."</div></td>";
			  echo "   <td class='normal333'><div align='center'>".$rowINTI['TotalPoint']."</div></td>";
			  
			  //-------------penambahan grade
			  $sqlINTIform="select
			pfipn.RollNo, pfipn.Width as LebarInspek,pfipn.Density as GramInspek,		
			x.WEIGHT as Weight,x.LENGTH,(A_Slub_Count1+A_Barre_Count1+A_UnevenYarn_Count1+A_YarnContamination_Count1+A_NEPSCotton_Count1+A_NEPSCotton_Count1+A_Misc_Count1+B_MissingLine_Count1+B_Holes_Count1+B_Streaks_Count1+B_MisKnit_Count1+B_Knot_Count1+B_OilMark_Count1+B_FlyWaste_Count1+B_Misc_Count1+C_Hairiness_Count1+C_Holes_Count1+C_ColorTone_Count1+C_Abrasion_Count1+C_DyeSpot_Count1+C_Wrinkles_Count1+C_BowingSkew_Count1+C_PinHoles_Count1+C_PickSnag_Count1+C_Knot_Count1+C_Misc_Count1+D_UnevenShearing_Count1+D_Stains_Count1+D_OilSpot_Count1+D_Dirt_Count1+D_WaterMarks_Count1+D_Misc_Count1+E_Print_Count1+E_Misc_Count1) as TPoint
			
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
order by pfipn.RollNo";
		

//---END SQL INTI
		$qryINTIform=sqlsrv_query($conn,$sqlINTIform, array(), array("Scrollable"=>"buffered"));
	//--
				
		$jmlgradeA=0;
		$jmlgradeB=0;
		$jmlgradeC=0;
		$kgGA=0;
		$kgGB=0;
		$kgGC=0;
		$ydGA=0;
		$ydGB=0;
		$ydGC=0;
		while ($rowINTIform=sqlsrv_fetch_array($qryINTIform,SQLSRV_FETCH_ASSOC)){
		
			$totalpointx=$rowINTIform["TPoint"];
			$yardx=$rowINTIform["LENGTH"];
			$kgx=$rowINTIform["Weight"];
			
			$hitung=($totalpointx/$yardx)*100;
			
			if ($formno==1){
				if ($hitung < 21){
					//$grade="A";
					$jmlgradeA=$jmlgradeA + 1;
					$kgGA=$kgGA + $kgx;
					$ydGA=$ydGA + $yardx;
					
				}else if($hitung < 31){
					//$grade="B";
					$jmlgradeB=$jmlgradeB + 1;
					$kgGB=$kgGB + $kgx;
					$ydGB=$ydGB + $yardx;
					
				}else{
					//$grade="C";
					$jmlgradeC=$jmlgradeC + 1;
					$kgGC=$kgGC + $kgx;
					$ydGC=$ydGC + $yardx;
				}
				
			}else if($formno==2){
				if ($hitung < 16){
					//$grade="A";
					$jmlgradeA=$jmlgradeA + 1;
					$kgGA=$kgGA + $kgx;
					$ydGA=$ydGA + $yardx;
					
				}else if($hitung < 31){
					//$grade="B";
					$jmlgradeB=$jmlgradeB + 1;
					$kgGB=$kgGB + $kgx;
					$ydGB=$ydGB + $yardx;
					
				}else{
					//$grade="C";
					$jmlgradeC=$jmlgradeC + 1;
					$kgGC=$kgGC + $kgx;
					$ydGC=$ydGC + $yardx;
					
				}
				
			}else{
				$jmlgradeA="-";
				$jmlgradeB="-";
				$jmlgradeC="-";
			}
     
		}
    
			  
			  
			  //---
			  echo "   <td class='normal333'><div align='center'>$jmlgradeA</div></td>";
			  echo "<td class='normal333'><div align='right'>".number_format($kgGA,2)."</div></td>";
		   	  echo "<td class='normal333'><div align='right'>".number_format($ydGA,2)."</div></td>";
			  
			  echo "   <td class='normal333'><div align='center'>$jmlgradeB</div></td>";
			  echo "<td class='normal333'><div align='right'>".number_format($kgGB,2)."</div></td>";
		   	  echo "<td class='normal333'><div align='right'>".number_format($ydGB,2)."</div></td>";
			  
			  echo "   <td class='normal333'><div align='center'>$jmlgradeC</div></td>";
			  echo "<td class='normal333'><div align='right'>".number_format($kgGC,2)."</div></td>";
		   	  echo "<td class='normal333'><div align='right'>".number_format($ydGC,2)."</div></td>";
			  
			  
			  //---end penambahan grade
		 
        echo "</tr>";
 	
	}//----end jika bukan KK Ok
	
 } //---------------------------------end jika KK sudah keluar   
 
     
		}
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