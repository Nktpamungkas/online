<?php
ini_set("error_reporting", 1);
set_time_limit(600);

include "koneksi.php";
//--
$act = $_POST['act'];
$subid = $_GET['subid'];
//---tanggal
$tanggal1 = date("d");
$tanggal2 = date("m");
$tanggal3 = date("Y");
switch ($tanggal2) {
	case "01":
		$bulan = "Jan";
		break;
	case "02":
		$bulan = "Feb";
		break;
	case "03":
		$bulan = "Mar";
		break;
	case "04":
		$bulan = "Apr";
		break;
	case "05":
		$bulan = "Mei";
		break;
	case "06":
		$bulan = "Jun";
		break;
	case "07":
		$bulan = "Jul";
		break;
	case "08":
		$bulan = "Agt";
		break;
	case "09":
		$bulan = "Sep";
		break;
	case "10":
		$bulan = "Okt";
		break;
	case "11":
		$bulan = "Nop";
		break;
	case "12":
		$bulan = "Des";
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
			<div id="logo"> <img src="images/logo.png" alt="LOGO" height="86" width="151" /> </div>
			<ul id="navigation">
				<li>
					<a href="index.html">Home</a>
				</li>
				<li>
					<a href="kk0.php">Posisi KK </a>
				</li>
				<li class="selected">
					<a href="inoutkk-1.php">Scan In/Out </a>
				</li>
				<li>
					<a href="rptscan.php">Report </a>
				</li>
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
							if (!$act) {
								?>
							</td>
						</tr>
						<tr>
							<td>
								<form id="form1" name="form1" method="post" action="?">
									<table width="100%" border="0" cellpadding="0" cellspacing="0" class="normal9black">
										<tr>
											<td colspan="2" class="boldCD6">LAPORAN SCAN KARTU KERJA MASUK PER DEPARTEMEN
											</td>
										</tr>


										<tr>
											<td width="200" class="blod9black">&nbsp;</td>
											<td class="normal9black">
												<input name="act" type="hidden" id="act" value="cari" />
											</td>
										</tr>
										<tr>
											<td class="blod9black">Departemen</td>
											<td class="normal9black">
												<select name="dep0" class="normal9black" id="dep0"
													onChange="window.location='?subid='+this.value">
													<?php

													$operation_group_query = "SELECT CODE, SHORTDESCRIPTION FROM DB2ADMIN.OPERATIONGROUP";
													$operation_group_stmt = db2_exec($conn_db2, $operation_group_query);

													if ($operation_group_stmt) {
														while ($row = db2_fetch_assoc($operation_group_stmt)) {
															?>
															<option value="<?= trim($row['CODE']) ?>" <?= trim($row['CODE']) == $subid ? 'selected' : '' ?>>
																<?= ucwords(strtolower($row['SHORTDESCRIPTION'])) ?>
															</option>

															<?php
														}
													}

													?>
												</select>
											</td>

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
											<td class="blod9black">Range Scan IN </td>
											<td class="normal9black"><select name="tgldateDel" class="normal9black"
													id="tgldateDel">
													<option value="<?php echo $tanggal1; ?>" selected><?php echo $tanggal1; ?></option>
													<option value="01">1</option>
													<option value="02">2</option>
													<option value="03">3</option>
													<option value="04">4</option>
													<option value="05">5</option>
													<option value="06">6</option>
													<option value="07">7</option>
													<option value="08">8</option>
													<option value="09">9</option>
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
													<option value="<?php echo $tanggal2; ?>" selected><?php echo $bulan; ?>
													</option>
													<option value="01">Jan</option>
													<option value="02">Feb</option>
													<option value="03">Mar</option>
													<option value="04">Apr</option>
													<option value="05">Mei</option>
													<option value="06">Jun</option>
													<option value="07">Jul</option>
													<option value="08">Agt</option>
													<option value="09">Sep</option>
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
													<option value="<?php echo $tanggal1; ?>" selected><?php echo $tanggal1; ?></option>
													<option value="01">1</option>
													<option value="02">2</option>
													<option value="03">3</option>
													<option value="04">4</option>
													<option value="05">5</option>
													<option value="06">6</option>
													<option value="07">7</option>
													<option value="08">8</option>
													<option value="09">9</option>
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
													<option value="<?php echo $tanggal2; ?>" selected><?php echo $bulan; ?>
													</option>
													<option value="01">Jan</option>
													<option value="02">Feb</option>
													<option value="03">Mar</option>
													<option value="04">Apr</option>
													<option value="05">Mei</option>
													<option value="06">Jun</option>
													<option value="07">Jul</option>
													<option value="08">Agt</option>
													<option value="09">Sep</option>
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
												</select>
											</td>
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
											<td class="normal9black">&nbsp;</td>
										</tr>
										<tr>
											<td class="blod9black">&nbsp;</td>
											<td class="normal9black">
												<input name="button" type="submit" class="tombol" id="button"
													value="CARI DATA" />
											</td>
										</tr>
										<tr>
											<td class="blod9black">&nbsp;</td>
											<td class="normal9black">&nbsp;</td>
										</tr>
									</table>
								</form>
							</td>
						</tr>
						<tr>
							<td class="normal9black">
								<?php
							} else {

								$dep0 = trim($_POST['dep0']);

								$tgldateDel = $_POST['tgldateDel'];
								$tglmonthDel = $_POST['tglmonthDel'];
								$tglyearDel = $_POST['tglyearDel'];
								if ($tgldateDel != "" && $tglmonthDel != "" && $tglyearDel != "") {
									$tglDel = "$tglyearDel-$tglmonthDel-$tgldateDel";
									$tglDisplay = "$tgldateDel/$tglmonthDel/$tglyearDel";
								} else {
									$tglDel = "0000-00-00";
									$tglDisplay = " - ";
								}

								$tgldateDel2 = $_POST['tgldateDel2'];
								$tglmonthDel2 = $_POST['tglmonthDel2'];
								$tglyearDel2 = $_POST['tglyearDel2'];
								if ($tgldateDel2 != "" && $tglmonthDel2 != "" && $tglyearDel2 != "") {
									$tglDel2 = "$tglyearDel2-$tglmonthDel2-$tgldateDel2";
									$tglDisplay2 = "$tgldateDel2/$tglmonthDel2/$tglyearDel2";
								} else {
									$tglDel2 = "0000-00-00";
									$tglDisplay2 = " - ";
								}

								$operation_query = "SELECT
									p.PRODUCTIONORDERCODE,
									p.STEPNUMBER AS STEPNUMBER,
									TRIM(p.OPERATIONCODE) AS OPERATIONCODE,
									o.LONGDESCRIPTION,
									CASE
										WHEN p.PROGRESSSTATUS = 0 THEN 'Entered'
										WHEN p.PROGRESSSTATUS = 1 THEN 'Planned'
										WHEN p.PROGRESSSTATUS = 2 THEN 'Progress'
										WHEN p.PROGRESSSTATUS = 3 THEN 'Closed'
									END AS STATUS_OPERATION,
									iptip.MULAI,
									iptop.SELESAI,
									p.PRODUCTIONORDERCODE,
									p.PRODUCTIONDEMANDCODE
									FROM 
										PRODUCTIONDEMANDSTEP p 
									LEFT JOIN OPERATION o ON o.CODE = p.OPERATIONCODE 
									LEFT JOIN ITXVIEW_POSISIKK_TGL_IN_PRODORDER iptip ON iptip.PRODUCTIONORDERCODE = p.PRODUCTIONORDERCODE AND iptip.DEMANDSTEPSTEPNUMBER = p.STEPNUMBER
									LEFT JOIN ITXVIEW_POSISIKK_TGL_OUT_PRODORDER iptop ON iptop.PRODUCTIONORDERCODE = p.PRODUCTIONORDERCODE AND iptop.DEMANDSTEPSTEPNUMBER = p.STEPNUMBER
									WHERE
									o.OPERATIONGROUPCODE = '" . $dep0 . "' 
									AND SUBSTR(iptip.MULAI, 1, 10) BETWEEN '" . $tglDel . "' AND '" . $tglDel2 . "'  
									ORDER BY p.STEPNUMBER DESC";

								$operation_stmt = db2_exec($conn_db2, $operation_query);

								if ($operation_stmt) {
									$operation_query_count = "SELECT
										COUNT(*) AS jumlah
										FROM 
											PRODUCTIONDEMANDSTEP p 
										LEFT JOIN OPERATION o ON o.CODE = p.OPERATIONCODE 
										LEFT JOIN ITXVIEW_POSISIKK_TGL_IN_PRODORDER iptip ON iptip.PRODUCTIONORDERCODE = p.PRODUCTIONORDERCODE AND iptip.DEMANDSTEPSTEPNUMBER = p.STEPNUMBER
										LEFT JOIN ITXVIEW_POSISIKK_TGL_OUT_PRODORDER iptop ON iptop.PRODUCTIONORDERCODE = p.PRODUCTIONORDERCODE AND iptop.DEMANDSTEPSTEPNUMBER = p.STEPNUMBER
										WHERE
										o.OPERATIONGROUPCODE = '" . $dep0 . "' 
										AND SUBSTR(iptip.MULAI, 1, 10) BETWEEN '" . $tglDel . "' AND '" . $tglDel2 . "'";

									$operation_stmt_count = db2_exec($conn_db2, $operation_query_count);
									$row_count = db2_fetch_assoc($operation_stmt_count);
									?>
									<span class='blod9black'>
										Hasil Pencarian Departemen :
										<?= $dep0 ?>
										<br><br>
										Tanggal SCAN IN :
									</span>
									<?= $tglDisplay . " s.d " . $tglDisplay2 ?>
									<span class='blod9black'>
										( Total Kartu Kerja Masuk :
										<?= $row_count["JUMLAH"] ?> )
									</span><br><br>


									<font class='blod9black'>
										<a target="_blank"
											href='inoutkk0-xls.php?dep0=<?= $dep0 ?>&d1=<?= $tgldateDel ?>&m1=<?= $tglmonthDel ?>&y1=<?= $tglyearDel ?>&d2=<?= $tgldateDel2 ?>&m2=<?= $tglmonthDel2 ?>&y2=<?= $tglyearDel2 ?>&ceko=<?= $ceko ?: "" ?>'>
											CETAK KE EXCEL </a>
									</font>
									<!-- <font class='blod9black'> -->
									<br><br>
									<table width='100%' border='0'>
										<tr>
											<td class='tombol'>
												<div align='center'>NO.</div>
											</td>
											<td class='tombol'>
												<div align='center'>STEPNUMBER</div>
											</td>
											<td class='tombol'>
												<div align='center'>TANGGAL IN</div>
											</td>
											<td class='tombol'>
												<div align='center'>TANGGAL OUT</div>
											</td>
											<td class='tombol'>
												<div align='center'>OPERATION</div>
											</td>
											<td class='tombol'>
												<div align='center'>LONGDESCRIPTION</div>
											</td>
											<td class='tombol'>
												<div align='center'>STATUS</div>
											</td>
											<td class='tombol'>
												<div align='center'>PROD.ORDER</div>
											</td>
											<td class='tombol'>
												<div align='center'>PROD.DEMAND</div>
											</td>
										</tr>
										<?php

										$no = 1;
										$c = 0;
										while ($row = db2_fetch_assoc($operation_stmt)) {
											$bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';

											?>
											<tr bgcolor="<?= $bgcolor ?>">
												<td class="normal333" style="padding: 5px; vertical-align: top;">
													<?= $no ?>
												</td>
												<td class="normal333" style="padding: 5px; vertical-align: top;">
													<?= $row["STEPNUMBER"] ?>
												</td>
												<td class="normal333" style="padding: 5px; vertical-align: top;">
													<?= date_format(date_create($row["MULAI"]), 'Y/m/d H:i:s') ?>
												</td>
												<td class="normal333" style="padding: 5px; vertical-align: top;">
													<?= date_format(date_create($row["SELESAI"]), 'Y/m/d H:i:s') ?>
												</td>
												<td class="normal333" style="padding: 5px; vertical-align: top;">
													<?= $row["OPERATIONCODE"] ?>
												</td>
												<td class="normal333" style="padding: 5px; vertical-align: top;">
													<?= $row["LONGDESCRIPTION"] ?>
												</td>
												<td class="normal333" style="padding: 5px; vertical-align: top;">
													<?= $row["STATUS_OPERATION"] ?>
												</td>
												<td class="normal333" style="padding: 5px; vertical-align: top;">
													<?= $row["PRODUCTIONORDERCODE"] ?>
												</td>
												<td class="normal333" style="padding: 5px; vertical-align: top;">
													<?= $row["PRODUCTIONDEMANDCODE"] ?>
												</td>
											</tr>
											<?php
											$no++;
										}
										?>
									</table>
									<?php
								}
							}
							?>
						</td>
					</tr>
					<tr>
						<td class="normal9black">&nbsp;</td>
					</tr>
					<tr>
						<td class="normal9black">
							<p>&nbsp;</p>
						</td>
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

			<p><a href="http://www.bintoro.my.id" target="_blank"><img src="images/logodit13.png" width="150"
						height="62" border="0"></a><br>
				© 2013 - PT Indo Taichen Textile Industry </p>
		</div>
	</div>
</body>

</html>