<?php
$host="10.0.0.4";
$username="timdit";
$password="4dm1n";
$db_name="TM";
//--
$act=$_REQUEST['act'];
$id=$_GET['id'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>::Online System | Kartu Kerja</title>
<link rel="stylesheet" href="css/styles.css" type="text/css" />
<link rel="stylesheet" href="css/main.css" type="text/css" />
</head>

<body>
<table width="90%" border="0">
  <tr>
    <td class="blod9blackunder">DATA HANGER PRODUCT MASTER </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td class="normal9black"><?php
echo "<hr><br>";
	set_time_limit(600);
	$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	//--

$sql0="select ID,HangerNo,ShortDescription,StockClass,Description from ProductMaster where StockClass='32' order by HangerNo";

$sql = mssql_query($sql0) 
    or die('A error occured : ERROR CONNECTION DATABASE ');
 
$count = mssql_num_rows($sql);

			if ($count > 0 ){
			//$row=mssql_fetch_assoc($sql);
			//$hanger=$row[0];
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
       echo "   <td class='tombol' width='60' ><div align='left'>NO. </div></td>";
          echo "<td class='tombol'  width='120' ><div align='left'>NOMOR HANGER</div></td>";
		  echo "<td class='tombol'  width='200' ><div align='left'>SHORT DESCRIPTION</div></td>";
          echo "<td class='tombol'><div align='left'>LONG DESCRIPTION</div></td>";
          //echo "<td class='tombol'><div align='center'>Warna</div></td>";
          //echo "<td class='tombol'><div align='center'>Nett QTY </div></td>";
		  //echo "<td class='tombol'><div align='center'>Bruto </div></td>";
          //echo "<td class='tombol'><div align='center'>Product Number </div></td>";
          //echo "<td class='tombol'><div align='center'>Product Description </div></td>";
        echo "</tr>";
		//--
		$c=0;
		while ($row=mssql_fetch_assoc($sql)){
		$bgcolor = ($c++ & 1) ? '#ffffff' : '#FFCC99'; 
		//$fontcolor = ($c++ & 1) ? '#000000' : '#ffffff'; 
						
        echo "<tr bgcolor='$bgcolor'>";
		//echo "<font color='$fontcolor'>";
          echo "<td class='normal333'>$c</td>";

          echo "<td class='BoldCD6' align='left'>$row[HangerNo] </td>";
		  
		  echo "<td class='normal333' align='left'>$row[ShortDescription]</td>";

          echo "<td class='normal333'>$row[Description]</td>";
        //echo "</font>";  
        echo "</tr>";
        
		}
     echo "</table>";

			}else{
				echo "<br><br><font class='normal9black'>Nomor Hanger TIDAK ditemukan !</font>";	
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
</body>
</html>
