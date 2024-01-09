<?php
ini_set("error_reporting", 1);
set_time_limit(600);
include "koneksi.php";

$dep0 = trim($_GET['dep0']);
$tglDel = trim($_GET['tglDel']);
$tglDel2 = trim($_GET['tglDel2']);
$time1 = trim($_GET['time1']);
$time2 = trim($_GET['time2']);

if($_GET['jns_tgl'] == 'KK IN'){
	if ($time1 && $time2) {
		$_time1_1		= substr($time1, 0, 2);
		$_time1_2		= substr($time1, 3, 2);
		$_time1		= $_time1_1 . '.' . $_time1_2;

		$_time2_1		= substr($time2, 0, 2);
		$_time2_2		= substr($time2, 3, 2);
		$_time2		= $_time2_1 . '.' . $_time2_2;

		$where_datetime	 = "AND iptip.MULAI BETWEEN '$tglDel $_time1' AND '$tglDel2 $_time2'";
	} else {
		$where_datetime	 = "AND	SUBSTR(iptip.MULAI, 1,10) BETWEEN '$tglDel' AND '$tglDel2'";
	}
	$operation_query = "SELECT 
						p.STEPNUMBER,
						ip.LANGGANAN,
						TRIM(p.OPERATIONCODE) AS OPERATIONCODE,
						p2.DESCRIPTION AS LOT,
						p.PRODUCTIONORDERCODE,
						p.PRODUCTIONDEMANDCODE,
						p2.ORIGDLVSALORDLINESALORDERCODE,
						p2.SUBCODE05 AS NO_WARNA,
						i.WARNA,
						iptip.MULAI,
						CASE
							WHEN TRIM(o.EXTERNALITEMCODE) IS NULL THEN '-'
							ELSE TRIM(o.EXTERNALITEMCODE)
						END || ' / '|| 
						TRIM(p2.SUBCODE01) || '-' || TRIM(p2.SUBCODE02) || '-' || 
						TRIM(p2.SUBCODE03) || '-' || TRIM(p2.SUBCODE04) || '-' ||
						TRIM(p2.SUBCODE05) || '-' || TRIM(p2.SUBCODE06) || '-' || 
						TRIM(p2.SUBCODE07) || '-' || TRIM(p2.SUBCODE08) AS PRODUCT_NUMBER,
						CASE
							WHEN PRODUCT.LONGDESCRIPTION IS NULL THEN s2.ITEMDESCRIPTION
							ELSE PRODUCT.LONGDESCRIPTION
						END || ' ' || 
						CASE
							WHEN TRIM(s.INTERNALREFERENCE) IS NULL THEN '-'
							ELSE TRIM(s.INTERNALREFERENCE)
						END AS ITEMDESCRIPTION
					FROM 
						ITXVIEW_POSISIKK_TGL_IN_PRODORDER iptip
					LEFT JOIN PRODUCTIONDEMANDSTEP p ON p.PRODUCTIONORDERCODE = iptip.PRODUCTIONORDERCODE AND p.STEPNUMBER = iptip.DEMANDSTEPSTEPNUMBER
					LEFT JOIN OPERATION o ON o.CODE = p.OPERATIONCODE
					LEFT JOIN PRODUCTIONDEMAND p2 ON p2.CODE = p.PRODUCTIONDEMANDCODE 
					LEFT JOIN ITXVIEWCOLOR i ON i.ITEMTYPECODE = p2.ITEMTYPEAFICODE
						AND i.SUBCODE01 = p2.SUBCODE01
						AND i.SUBCODE02 = p2.SUBCODE02
						AND i.SUBCODE03 = p2.SUBCODE03
						AND i.SUBCODE04 = p2.SUBCODE04
						AND i.SUBCODE05 = p2.SUBCODE05
						AND i.SUBCODE06 = p2.SUBCODE06
						AND i.SUBCODE07 = p2.SUBCODE07
						AND i.SUBCODE08 = p2.SUBCODE08
						AND i.SUBCODE09 = p2.SUBCODE09
						AND i.SUBCODE10 = p2.SUBCODE10
					LEFT JOIN SALESORDER s ON s.CODE = p2.ORIGDLVSALORDLINESALORDERCODE 
					LEFT JOIN SALESORDERLINE s2 ON s2.SALESORDERCODE = p2.ORIGDLVSALORDLINESALORDERCODE AND s2.ORDERLINE = p2.ORIGDLVSALORDERLINEORDERLINE
					LEFT JOIN ORDERITEMORDERPARTNERLINK o ON o.INACTIVE = 0
						AND o.ORDPRNCUSTOMERSUPPLIERCODE = s.ORDPRNCUSTOMERSUPPLIERCODE
						AND o.ITEMTYPEAFICODE = p2.ITEMTYPEAFICODE
						AND o.SUBCODE01 = p2.SUBCODE01
						AND o.SUBCODE02 = p2.SUBCODE02
						AND o.SUBCODE03 = p2.SUBCODE03
						AND o.SUBCODE04 = p2.SUBCODE04
						AND o.SUBCODE05 = p2.SUBCODE05
						AND o.SUBCODE06 = p2.SUBCODE06
						AND o.SUBCODE07 = p2.SUBCODE07
						AND o.SUBCODE08 = p2.SUBCODE08
						AND o.SUBCODE09 = p2.SUBCODE09
						AND o.SUBCODE10 = p2.SUBCODE10
					LEFT JOIN PRODUCT PRODUCT ON PRODUCT.ITEMTYPECODE = p2.ITEMTYPEAFICODE
						AND PRODUCT.SUBCODE01 = p2.SUBCODE01
						AND PRODUCT.SUBCODE02 = p2.SUBCODE02
						AND PRODUCT.SUBCODE03 = p2.SUBCODE03
						AND PRODUCT.SUBCODE04 = p2.SUBCODE04
						AND PRODUCT.SUBCODE05 = p2.SUBCODE05
						AND PRODUCT.SUBCODE06 = p2.SUBCODE06
						AND PRODUCT.SUBCODE07 = p2.SUBCODE07
						AND PRODUCT.SUBCODE08 = p2.SUBCODE08
						AND PRODUCT.SUBCODE09 = p2.SUBCODE09
						AND PRODUCT.SUBCODE10 = p2.SUBCODE10
					LEFT JOIN ITXVIEW_PELANGGAN ip ON ip.ORDPRNCUSTOMERSUPPLIERCODE = s.ORDPRNCUSTOMERSUPPLIERCODE 
						AND ip.CODE = s.CODE 
					WHERE
						o.OPERATIONGROUPCODE = '$dep0' 
						$where_datetime
					ORDER BY 
						iptip.MULAI ASC";
}elseif ($_GET['jns_tgl'] == 'KK OUT') {
	if ($time1 && $time2) {
		$_time1_1		= substr($time1, 0, 2);
		$_time1_2		= substr($time1, 3, 2);
		$_time1		= $_time1_1 . '.' . $_time1_2;

		$_time2_1		= substr($time2, 0, 2);
		$_time2_2		= substr($time2, 3, 2);
		$_time2		= $_time2_1 . '.' . $_time2_2;

		$where_datetime	 = "AND iptop.SELESAI BETWEEN '$tglDel $_time1' AND '$tglDel2 $_time2'";
	} else {
		$where_datetime	 = "AND	SUBSTR(iptop.SELESAI, 1,10) BETWEEN '$tglDel' AND '$tglDel2'";
	}
	$operation_query = "SELECT 
							p.STEPNUMBER,
							ip.LANGGANAN,
							TRIM(p.OPERATIONCODE) AS OPERATIONCODE,
							p2.DESCRIPTION AS LOT,
							p.PRODUCTIONORDERCODE,
							p.PRODUCTIONDEMANDCODE,
							p2.ORIGDLVSALORDLINESALORDERCODE,
							p2.SUBCODE05 AS NO_WARNA,
							i.WARNA,
							iptop.SELESAI,
							CASE
								WHEN TRIM(o.EXTERNALITEMCODE) IS NULL THEN '-'
								ELSE TRIM(o.EXTERNALITEMCODE)
							END || ' / '|| 
							TRIM(p2.SUBCODE01) || '-' || TRIM(p2.SUBCODE02) || '-' || 
							TRIM(p2.SUBCODE03) || '-' || TRIM(p2.SUBCODE04) || '-' ||
							TRIM(p2.SUBCODE05) || '-' || TRIM(p2.SUBCODE06) || '-' || 
							TRIM(p2.SUBCODE07) || '-' || TRIM(p2.SUBCODE08) AS PRODUCT_NUMBER,
							CASE
								WHEN PRODUCT.LONGDESCRIPTION IS NULL THEN s2.ITEMDESCRIPTION
								ELSE PRODUCT.LONGDESCRIPTION
							END || ' ' || 
							CASE
								WHEN TRIM(s.INTERNALREFERENCE) IS NULL THEN '-'
								ELSE TRIM(s.INTERNALREFERENCE)
							END AS ITEMDESCRIPTION
						FROM 
							ITXVIEW_POSISIKK_TGL_OUT_PRODORDER iptop 
						LEFT JOIN PRODUCTIONDEMANDSTEP p ON p.PRODUCTIONORDERCODE = iptop.PRODUCTIONORDERCODE AND p.STEPNUMBER = iptop.DEMANDSTEPSTEPNUMBER
						LEFT JOIN OPERATION o ON o.CODE = p.OPERATIONCODE
						LEFT JOIN PRODUCTIONDEMAND p2 ON p2.CODE = p.PRODUCTIONDEMANDCODE 
						LEFT JOIN ITXVIEWCOLOR i ON i.ITEMTYPECODE = p2.ITEMTYPEAFICODE
							AND i.SUBCODE01 = p2.SUBCODE01
							AND i.SUBCODE02 = p2.SUBCODE02
							AND i.SUBCODE03 = p2.SUBCODE03
							AND i.SUBCODE04 = p2.SUBCODE04
							AND i.SUBCODE05 = p2.SUBCODE05
							AND i.SUBCODE06 = p2.SUBCODE06
							AND i.SUBCODE07 = p2.SUBCODE07
							AND i.SUBCODE08 = p2.SUBCODE08
							AND i.SUBCODE09 = p2.SUBCODE09
							AND i.SUBCODE10 = p2.SUBCODE10
						LEFT JOIN SALESORDER s ON s.CODE = p2.ORIGDLVSALORDLINESALORDERCODE 
						LEFT JOIN SALESORDERLINE s2 ON s2.SALESORDERCODE = p2.ORIGDLVSALORDLINESALORDERCODE AND s2.ORDERLINE = p2.ORIGDLVSALORDERLINEORDERLINE
						LEFT JOIN ORDERITEMORDERPARTNERLINK o ON o.INACTIVE = 0
							AND o.ORDPRNCUSTOMERSUPPLIERCODE = s.ORDPRNCUSTOMERSUPPLIERCODE
							AND o.ITEMTYPEAFICODE = p2.ITEMTYPEAFICODE
							AND o.SUBCODE01 = p2.SUBCODE01
							AND o.SUBCODE02 = p2.SUBCODE02
							AND o.SUBCODE03 = p2.SUBCODE03
							AND o.SUBCODE04 = p2.SUBCODE04
							AND o.SUBCODE05 = p2.SUBCODE05
							AND o.SUBCODE06 = p2.SUBCODE06
							AND o.SUBCODE07 = p2.SUBCODE07
							AND o.SUBCODE08 = p2.SUBCODE08
							AND o.SUBCODE09 = p2.SUBCODE09
							AND o.SUBCODE10 = p2.SUBCODE10
						LEFT JOIN PRODUCT PRODUCT ON PRODUCT.ITEMTYPECODE = p2.ITEMTYPEAFICODE
							AND PRODUCT.SUBCODE01 = p2.SUBCODE01
							AND PRODUCT.SUBCODE02 = p2.SUBCODE02
							AND PRODUCT.SUBCODE03 = p2.SUBCODE03
							AND PRODUCT.SUBCODE04 = p2.SUBCODE04
							AND PRODUCT.SUBCODE05 = p2.SUBCODE05
							AND PRODUCT.SUBCODE06 = p2.SUBCODE06
							AND PRODUCT.SUBCODE07 = p2.SUBCODE07
							AND PRODUCT.SUBCODE08 = p2.SUBCODE08
							AND PRODUCT.SUBCODE09 = p2.SUBCODE09
							AND PRODUCT.SUBCODE10 = p2.SUBCODE10
						LEFT JOIN ITXVIEW_PELANGGAN ip ON ip.ORDPRNCUSTOMERSUPPLIERCODE = s.ORDPRNCUSTOMERSUPPLIERCODE 
							AND ip.CODE = s.CODE 
						WHERE
							o.OPERATIONGROUPCODE = '$dep0' 
							$where_datetime
						ORDER BY
							iptop.SELESAI ASC";
}

header("content-type:application/vnd-ms-excel");
header("content-disposition:attachment;filename=Report $tglDel s/d $tglDel2.xls");
header('Cache-Control: max-age=0');
?>
<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>

<head>
	<meta charset="UTF-8">
</head>

<body>
	<?php
	$operation_query = "SELECT 
							p.STEPNUMBER,
							ip.LANGGANAN,
							TRIM(p.OPERATIONCODE) AS OPERATIONCODE,
							p2.DESCRIPTION AS LOT,
							p.PRODUCTIONORDERCODE,
							p.PRODUCTIONDEMANDCODE,
							p2.ORIGDLVSALORDLINESALORDERCODE,
							p2.SUBCODE05 AS NO_WARNA,
							i.WARNA,
							iptip.MULAI,
							CASE
								WHEN TRIM(o.EXTERNALITEMCODE) IS NULL THEN '-'
								ELSE TRIM(o.EXTERNALITEMCODE)
							END || ' / '|| 
							TRIM(p2.SUBCODE01) || '-' || TRIM(p2.SUBCODE02) || '-' || 
							TRIM(p2.SUBCODE03) || '-' || TRIM(p2.SUBCODE04) || '-' ||
							TRIM(p2.SUBCODE05) || '-' || TRIM(p2.SUBCODE06) || '-' || 
							TRIM(p2.SUBCODE07) || '-' || TRIM(p2.SUBCODE08) AS PRODUCT_NUMBER,
							CASE
								WHEN PRODUCT.LONGDESCRIPTION IS NULL THEN s2.ITEMDESCRIPTION
								ELSE PRODUCT.LONGDESCRIPTION
							END || ' ' || 
							CASE
								WHEN TRIM(s.INTERNALREFERENCE) IS NULL THEN '-'
								ELSE TRIM(s.INTERNALREFERENCE)
							END AS ITEMDESCRIPTION
						FROM 
							ITXVIEW_POSISIKK_TGL_IN_PRODORDER iptip
						LEFT JOIN PRODUCTIONDEMANDSTEP p ON p.PRODUCTIONORDERCODE = iptip.PRODUCTIONORDERCODE AND p.STEPNUMBER = iptip.DEMANDSTEPSTEPNUMBER
						LEFT JOIN OPERATION o ON o.CODE = p.OPERATIONCODE
						LEFT JOIN PRODUCTIONDEMAND p2 ON p2.CODE = p.PRODUCTIONDEMANDCODE 
						LEFT JOIN ITXVIEWCOLOR i ON i.ITEMTYPECODE = p2.ITEMTYPEAFICODE
							AND i.SUBCODE01 = p2.SUBCODE01
							AND i.SUBCODE02 = p2.SUBCODE02
							AND i.SUBCODE03 = p2.SUBCODE03
							AND i.SUBCODE04 = p2.SUBCODE04
							AND i.SUBCODE05 = p2.SUBCODE05
							AND i.SUBCODE06 = p2.SUBCODE06
							AND i.SUBCODE07 = p2.SUBCODE07
							AND i.SUBCODE08 = p2.SUBCODE08
							AND i.SUBCODE09 = p2.SUBCODE09
							AND i.SUBCODE10 = p2.SUBCODE10
						LEFT JOIN SALESORDER s ON s.CODE = p2.ORIGDLVSALORDLINESALORDERCODE 
						LEFT JOIN SALESORDERLINE s2 ON s2.SALESORDERCODE = p2.ORIGDLVSALORDLINESALORDERCODE AND s2.ORDERLINE = p2.ORIGDLVSALORDERLINEORDERLINE
						LEFT JOIN ORDERITEMORDERPARTNERLINK o ON o.INACTIVE = 0
							AND o.ORDPRNCUSTOMERSUPPLIERCODE = s.ORDPRNCUSTOMERSUPPLIERCODE
							AND o.ITEMTYPEAFICODE = p2.ITEMTYPEAFICODE
							AND o.SUBCODE01 = p2.SUBCODE01
							AND o.SUBCODE02 = p2.SUBCODE02
							AND o.SUBCODE03 = p2.SUBCODE03
							AND o.SUBCODE04 = p2.SUBCODE04
							AND o.SUBCODE05 = p2.SUBCODE05
							AND o.SUBCODE06 = p2.SUBCODE06
							AND o.SUBCODE07 = p2.SUBCODE07
							AND o.SUBCODE08 = p2.SUBCODE08
							AND o.SUBCODE09 = p2.SUBCODE09
							AND o.SUBCODE10 = p2.SUBCODE10
						LEFT JOIN PRODUCT PRODUCT ON PRODUCT.ITEMTYPECODE = p2.ITEMTYPEAFICODE
							AND PRODUCT.SUBCODE01 = p2.SUBCODE01
							AND PRODUCT.SUBCODE02 = p2.SUBCODE02
							AND PRODUCT.SUBCODE03 = p2.SUBCODE03
							AND PRODUCT.SUBCODE04 = p2.SUBCODE04
							AND PRODUCT.SUBCODE05 = p2.SUBCODE05
							AND PRODUCT.SUBCODE06 = p2.SUBCODE06
							AND PRODUCT.SUBCODE07 = p2.SUBCODE07
							AND PRODUCT.SUBCODE08 = p2.SUBCODE08
							AND PRODUCT.SUBCODE09 = p2.SUBCODE09
							AND PRODUCT.SUBCODE10 = p2.SUBCODE10
						LEFT JOIN ITXVIEW_PELANGGAN ip ON ip.ORDPRNCUSTOMERSUPPLIERCODE = s.ORDPRNCUSTOMERSUPPLIERCODE 
							AND ip.CODE = s.CODE 
						WHERE
							o.OPERATIONGROUPCODE = '$dep0' 
							AND	iptip.PROGRESSSTARTPROCESSDATE BETWEEN '$tglDel' AND '$tglDel2' 
							$where_time";

	$operation_stmt = db2_exec($conn_db2, $operation_query);

	if ($operation_stmt) {
		$operation_query_count = "SELECT 
										COUNT(*) as JUMLAH
									FROM 
										ITXVIEW_POSISIKK_TGL_IN_PRODORDER iptip
									LEFT JOIN PRODUCTIONDEMANDSTEP p ON p.PRODUCTIONORDERCODE = iptip.PRODUCTIONORDERCODE AND p.STEPNUMBER = iptip.DEMANDSTEPSTEPNUMBER
									LEFT JOIN OPERATION o ON o.CODE = p.OPERATIONCODE
									WHERE
										o.OPERATIONGROUPCODE = '$dep0' 
										AND	iptip.PROGRESSSTARTPROCESSDATE BETWEEN '$tglDel' AND '$tglDel2' 
										$where_time";

		$operation_stmt_count = db2_exec($conn_db2, $operation_query_count);
		$operation_row_count = db2_fetch_assoc($operation_stmt_count);
		?>
		<span class='blod9black'>
			Hasil Pencarian Departemen :
			<?= $dep0 ?>
			<br><br>
			Tanggal SCAN IN :
		</span>
		<?= $time1.' '.date_format(date_create($tglDel), "d/m/Y") . " s.d " . $time2.' '.date_format(date_create($tglDel2), "d/m/Y") ?>
		<span class='blod9black'>
			( Total Kartu Kerja Masuk :
			<?= $operation_row_count['JUMLAH'] ?>)
		</span>
		<br><br>
		<table width='100%' border='0' id="tablekk" border="1">
			<thead>
				<tr>
					<td class='tombol'>
						<div align='center'>NO.</div>
					</td>
					<td class='tombol'>
						<div align='center'>SUB DEPT</div>
					</td>
					<td class='tombol'>
						<div align='center'>LANGGANAN</div>
					</td>
					<td class='tombol'>
						<div align='center'>NO BON ORDER</div>
					</td>
					<td class='tombol'>
						<div align='center'>NO LOT</div>
					</td>
					<td class='tombol'>
						<div align='center'>KK IN</div>
					</td>
					<td class='tombol'>
						<div align='center'>KK OUT</div>
					</td>
					<td class='tombol'>
						<div align='center'>LAMA WAKTU</div>
					</td>
					<td class='tombol'>
						<div align='center'>NO WARNA</div>
					</td>
					<td class='tombol'>
						<div align='center'>WARNA</div>
					</td>
					<td class='tombol'>
						<div align='center'>NETT QTY</div>
					</td>
					<td class='tombol'>
						<div align='center'>BRUTO BAGI KAIN</div>
					</td>
					<td class='tombol'>
						<div align='center'>PRODUCT NUMBER</div>
					</td>
					<td class='tombol'>
						<div align='center'>PRODUCT DESCRIPTION</div>
					</td>
					<td class='tombol'>
						<div align='center'>NO KARTU KERJA</div>
					</td>
					<td class='tombol'>
						<div align='center'>NO DEMAND</div>
					</td>
					<td class='tombol'>
						<div align='center'>DEPT NOTE</div>
					</td>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				$c = 0;
				while ($row_operation = db2_fetch_assoc($operation_stmt)) {
					$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
					?>
					<tr bgcolor="<?= $bgcolor ?>">
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							<?= $no ?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							<?= $row_operation['OPERATIONCODE'] ?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							<?= $row_operation['LANGGANAN'] ?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							<?= $row_operation['ORIGDLVSALORDLINESALORDERCODE'] ?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							<?= $row_operation['LOT'] ?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							<?= date_format(date_create($row_operation['MULAI']), "Y-m-d H:i:s") ?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							<?php
							$kkout_stmt = db2_exec($conn_db2, "SELECT * FROM ITXVIEW_POSISIKK_TGL_OUT_PRODORDER WHERE DEMANDSTEPSTEPNUMBER = '$row_operation[STEPNUMBER]' AND PRODUCTIONORDERCODE = '$row_operation[PRODUCTIONORDERCODE]'");
							$row_kkout = db2_fetch_assoc($kkout_stmt);

							echo date_format(date_create($row_kkout['SELESAI']), "Y-m-d H:i:s");
							echo "<br>";

							// $progress_status_stmt = db2_exec($conn_db2, "SELECT 
							// 												p.PRODUCTIONORDERCODE AS PRODUCTIONORDERCODE, 
							// 												p.GROUPSTEPNUMBER AS GROUPSTEPNUMBER,
							// 												TRIM(p.PROGRESSSTATUS) AS PROGRESSSTATUS
							// 												FROM 
							// 													VIEWPRODUCTIONDEMANDSTEP p
							// 												WHERE
							// 													p.PRODUCTIONORDERCODE = '$row_operation[PRODUCTIONORDERCODE]' AND p.GROUPSTEPNUMBER = '$row_operation[STEPNUMBER]'
							// 												ORDER BY p.GROUPSTEPNUMBER DESC
							// 												LIMIT 1");
							$progress_status_stmt = db2_exec($conn_db2, "SELECT 
																								p.PRODUCTIONORDERCODE AS PRODUCTIONORDERCODE, 
																								p.STEPNUMBER AS GROUPSTEPNUMBER,
																								TRIM(p.PROGRESSSTATUS) AS PROGRESSSTATUS
																							FROM 
																								PRODUCTIONDEMANDSTEP p
																							WHERE
																								p.PRODUCTIONORDERCODE  = '$row_operation[PRODUCTIONORDERCODE]' 
																								AND p.PRODUCTIONDEMANDCODE = '$row_operation[PRODUCTIONDEMANDCODE]' 
																								AND p.STEPNUMBER = '$row_operation[STEPNUMBER]'
																							ORDER BY p.STEPNUMBER DESC
																							LIMIT 1");

							$row_progress_status = db2_fetch_assoc($progress_status_stmt);

							if ($row_progress_status['PROGRESSSTATUS'] == '3') {
								// $next_progress_stmt = db2_exec($conn_db2, "SELECT 
								// 											GROUPSTEPNUMBER,
								// 											TRIM(OPERATIONCODE) AS OPERATIONCODE,
								// 											o.LONGDESCRIPTION AS LONGDESCRIPTION,
								// 											PROGRESSSTATUS,
								// 											CASE
								// 												WHEN PROGRESSSTATUS = 0 THEN 'Entered'
								// 												WHEN PROGRESSSTATUS = 1 THEN 'Planned'
								// 												WHEN PROGRESSSTATUS = 2 THEN 'Progress'
								// 												WHEN PROGRESSSTATUS = 3 THEN 'Closed'
								// 											END AS STATUS_OPERATION
								// 											FROM 
								// 												VIEWPRODUCTIONDEMANDSTEP v
								// 											LEFT JOIN OPERATION o ON o.CODE = v.OPERATIONCODE
								// 											WHERE 
								// 												PRODUCTIONORDERCODE = '$row_operation[PRODUCTIONORDERCODE]' 
								// 												AND 
								// 												GROUPSTEPNUMBER > '$row_operation[STEPNUMBER]'
								// 											ORDER BY 
								// 												GROUPSTEPNUMBER ASC 
								// 												LIMIT 1");
								$next_progress_stmt = db2_exec($conn_db2, "SELECT 
																									STEPNUMBER,
																									TRIM(OPERATIONCODE) AS OPERATIONCODE,
																									o.LONGDESCRIPTION AS LONGDESCRIPTION,
																									PROGRESSSTATUS,
																									CASE
																										WHEN PROGRESSSTATUS = 0 THEN 'Entered'
																										WHEN PROGRESSSTATUS = 1 THEN 'Planned'
																										WHEN PROGRESSSTATUS = 2 THEN 'Progress'
																										WHEN PROGRESSSTATUS = 3 THEN 'Closed'
																									END AS STATUS_OPERATION
																								FROM 
																									PRODUCTIONDEMANDSTEP p
																								LEFT JOIN OPERATION o ON o.CODE = p.OPERATIONCODE
																								WHERE 
																									p.PRODUCTIONORDERCODE  = '$row_operation[PRODUCTIONORDERCODE]' 
																									AND p.PRODUCTIONDEMANDCODE = '$row_operation[PRODUCTIONDEMANDCODE]' 
																									AND p.STEPNUMBER > '$row_operation[STEPNUMBER]'
																								ORDER BY 
																									STEPNUMBER ASC 
																								LIMIT 1");

								$row_next_progress = db2_fetch_assoc($next_progress_stmt);
								echo "<b>" . $row_next_progress['LONGDESCRIPTION'] . "</b>";
							}
							?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							<?php
								$awal = strtotime(date_format(date_create(trim($row_operation['MULAI'])), "Y/m/d H:i:s"));
								$akhir = strtotime(date_format(date_create(trim($row_kkout['SELESAI'])), "Y/m/d H:i:s"));
								$diff = $akhir - $awal;

								$jam = floor($diff / (60 * 60));
								$menit_ = $diff - ($jam * (60 * 60));
								$menit = floor($menit_ / 60);
								$detik = $diff % 60;

								$waktu = "";
								if ($jam > 0)
									$waktu .= $jam . " jam ";
								if ($menit > 0)
									$waktu .= $menit . " menit ";
								if ($detik > 0)
									$waktu .= $detik . " detik";

								if(!empty($row_kkout['SELESAI'])){
									echo $waktu;
								}
							?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							<?= $row_operation['NO_WARNA'] ?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							<?= $row_operation['WARNA'] ?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">

						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							<?php
								$q_bruto_bagikain = db2_exec($conn_db2, "SELECT
																				PRODUCTIONORDERCODE,
																				INITIALUSERPRIMARYQUANTITY 
																			FROM
																				VIEWPRODUCTIONDEMANDSTEP v
																			WHERE
																				PRODUCTIONORDERCODE = '$row_operation[PRODUCTIONORDERCODE]'
																			ORDER BY
																				GROUPSTEPNUMBER ASC 
																			LIMIT 1");

								$q_bruto_bagikain = db2_fetch_assoc($q_bruto_bagikain);
								if(!empty($q_bruto_bagikain['INITIALUSERPRIMARYQUANTITY'])){
									echo number_format($q_bruto_bagikain['INITIALUSERPRIMARYQUANTITY'], 3);
								}
							?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							<?= $row_operation['PRODUCT_NUMBER'] ?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							<?= $row_operation['ITEMDESCRIPTION'] ?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							`<?= $row_operation['PRODUCTIONORDERCODE'] ?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">
							`<?= $row_operation['PRODUCTIONDEMANDCODE'] ?>
						</td>
						<td class="normal333" style="padding: 5px; vertical-align: top;">

						</td>

					</tr>
					<?php $no++;
				} ?>
			</tbody>
		</table>
	<?php } ?>
</body>

</html>