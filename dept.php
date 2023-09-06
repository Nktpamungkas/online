<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<?php
$host="10.0.0.4";
//$host="DIT\MSSQLSERVER08";
$username="sa";
$password="ditbin";
$db_name="TM";

$conn=mssql_connect($host,$username,$password) or die ("Sorry our web is under maintenance. Please visit us later");
	mssql_select_db($db_name) or die ("Under maintenance");
	
$sql0="select ID,ParentID,DepartmentCode,DepartmentName from Departments where ParentID='0' order by DepartmentName"; 

$sql = mssql_query($sql0) 
    or die('A error occured : ');
 
$count = mssql_num_rows($sql);

			if ($count > 0 ){
			
			

			
     echo " <table width='100%' border='0'>";
      echo "  <tr>";
	  echo "   <td class='tombol'><div align='center'>Departement</div></td>";
       echo "   <td class='tombol'><div align='center'>Sub Department</div></td>";
	    echo "   <td class='tombol'><div align='center'>Catatan</div></td>";
 $c=0;	      
while($row=mssql_fetch_assoc($sql)){	
 
		 $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; 				
        echo "<tr bgcolor='$bgcolor'>"; 
		echo "<td width='120' class='normal333'  valign=top>".$row['DepartmentName']."</td>";
	  //-------------------------------
	  $sqlc=mssql_query("select ID,ParentID,DepartmentCode,DepartmentName from Departments where ParentID='".$row['ID']."' order by DepartmentName");
      
	  $sub="";
	  while ($rowJum=mssql_fetch_assoc($sqlc)){
	  		$sub="$sub ".$rowJum['DepartmentName']."<br>";
	  		
	  }
	  echo "<td width='120' class='normal333'  valign=top>$sub</td>";
	  
						
}
	  //--
		//--
		

	//---------------------------------------------

        echo "</tr>";
		
     echo "</table>";

			}else{
				echo "<br><br><font class='normal9black'>Data TIDAK ditemukan !</font>";	
			}
	//--
	mssql_free_result($sql);
	mssql_close($conn);
?>
<body>
</body>
</html>
