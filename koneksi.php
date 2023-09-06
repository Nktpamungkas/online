<?php
date_default_timezone_set('Asia/Jakarta');

$hostname_db2 = "10.0.0.21";
$username_db2 = "db2admin";
$database_db2 = "NOWPRD";
$password_db2 = "Sunkam@24809";
$port_db2 = "25000";

$conn_string_db2 = "DRIVER={IBM ODBC DB2 DRIVER}; HOSTNAME=$hostname_db2; PORT=$port_db2; PROTOCOL=TCPIP; UID=$username_db2; PWD=$password_db2; DATABASE=$database_db2;";
$conn_db2 = db2_connect($conn_string_db2, "", "");

if (!$conn_db2) {
    exit("DB2 Connection failed");
}

$host = "10.0.0.4";
$username = "timdit";
$password = "4dm1n";
$db_name = "TM";
$connInfo = array("Database" => $db_name, "UID" => $username, "PWD" => $password);
$conn = sqlsrv_connect($host, $connInfo);
$con = mysqli_connect("10.0.0.10", "dit", "4dm1n", "db_qc");

?>