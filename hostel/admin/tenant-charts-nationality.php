<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

$hm_m ="SELECT count(*) AS total FROM registration inner join rooms on registration.roomno = rooms.room_no where corresState != 'Others' AND block='HM'";
$stmt1 = $mysqli->prepare($hm_m);
$stmt1->execute();
$hm_m_num=$stmt1->get_result()->fetch_object();

$h_m ="SELECT count(*) AS total FROM registration inner join rooms on registration.roomno = rooms.room_no where corresState != 'Others' AND block='H'";
$stmt2 = $mysqli->prepare($h_m);
$stmt2->execute();
$h_m_num=$stmt2->get_result()->fetch_object();

$hl_m ="SELECT count(*) AS total FROM registration inner join rooms on registration.roomno = rooms.room_no where corresState != 'Others' AND block='HL'";
$stmt3 = $mysqli->prepare($hl_m);
$stmt3->execute();
$hl_m_num=$stmt3->get_result()->fetch_object();

$hm_o ="SELECT count(*) AS total FROM registration inner join rooms on registration.roomno = rooms.room_no where corresState = 'Others' AND block='HM'";
$stmt1 = $mysqli->prepare($hm_o);
$stmt1->execute();
$hm_o_num=$stmt1->get_result()->fetch_object();

$h_o ="SELECT count(*) AS total FROM registration inner join rooms on registration.roomno = rooms.room_no where corresState = 'Others' AND block='H'";
$stmt2 = $mysqli->prepare($h_o);
$stmt2->execute();
$h_o_num=$stmt2->get_result()->fetch_object();

$hl_o ="SELECT count(*) AS total FROM registration inner join rooms on registration.roomno = rooms.room_no where corresState = 'Others' AND block='HL'";
$stmt3 = $mysqli->prepare($hl_o);
$stmt3->execute();
$hl_o_num=$stmt3->get_result()->fetch_object();
/* 
$m_nation ="SELECT count(*) AS total FROM registration where corresState!='Others'";
$stmt7 = $mysqli->prepare($m_nation);
$stmt7->execute();
$m_nation=$stmt7->get_result()->fetch_object();

$other_nation ="SELECT count(*) AS total FROM registration where corresState='Others'";
$stmt8 = $mysqli->prepare($other_nation);
$stmt8->execute();
$other_nation=$stmt8->get_result()->fetch_object();

$hm_students ="SELECT count(*) AS total FROM registration inner join rooms on registration.roomno = rooms.room_no where block='HM'";
$stmt9 = $mysqli->prepare($hm_students);
$stmt9->execute();
$hm_students=$stmt9->get_result()->fetch_object();

$h_students ="SELECT count(*) AS total FROM registration inner join rooms on registration.roomno = rooms.room_no where block='H'";
$stmt10 = $mysqli->prepare($h_students);
$stmt10->execute();
$h_students=$stmt10->get_result()->fetch_object();

$hl_students ="SELECT count(*) AS total FROM registration inner join rooms on registration.roomno = rooms.room_no where block='HL'";
$stmt11 = $mysqli->prepare($hl_students);
$stmt11->execute();
$hl_students=$stmt11->get_result()->fetch_object();
 */

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<title>Tenant Nationality Charts</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="../../wp-content/themes/swinburne-sarawak-byhds/bootstrap/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="../../wp-content/themes/swinburne-sarawak-byhds/fonts/font-awesome.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="../../wp-content/themes/swinburne-sarawak-byhds/style.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="../../wp-content/themes/swinburne-sarawak-byhds/menus.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="../../wp-content/themes/swinburne-sarawak-byhds/responsive.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="../../wp-content/themes/swinburne-sarawak-byhds/flexslider.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="../../wp-content/themes/swinburne-sarawak-byhds/slider.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="../../wp-content/themes/swinburne-sarawak-byhds/isotope.css" media="screen" rel="stylesheet" type="text/css">
	<link href="../../wp-content/themes/swinburne-sarawak-byhds/magnific-popup.css" media="screen" rel="stylesheet" type="text/css">
	
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-3d.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>

	<style>
		#container, #sliders {
			min-width: 310px; 
			max-width: 600px;
			margin: 0 auto;
		}
		#container {
		}
		th {
			padding: 5px;
			padding-left:15px;
			padding-right:15px;
		}
		td {
			padding-left: 0px;
		}
	</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<br/><br/><br/>
						<h2 class="page-title">
							Tenant Charts
							<button class="btn btn-primary" onclick="location.href='tenant-charts.php';">
								<span class="glyphicon glyphicon-refresh"></span>
								Tenancy Rate
							</button>
						</h2>
						<div class="panel panel-default">
							<div class="panel-heading">Chart of Tenant Nationality</div>
							<div class="panel-body">
								<!-- <div id="container" style="height: 400px; max-width: 600px; margin: 0 auto"> -->
								<!-- </div> -->
								<div class="col-md-5">
									<table border="1" style="text-align: center;margin:auto;">
										<tr>
											<th colspan="4" bgcolor="#95B3D7" style="text-align: center;">Nationality Ratio (Malaysian vs International)</th>
										</tr>
										<tr>
											<th bgcolor="#FFC000">Building</th>
											<th bgcolor="#CF756B">Malaysian</th>
											<th bgcolor="#53CD79">Others</th>
											<th bgcolor="#00B0F0">Total Students</th>
										</tr>
										<tr>
											<td bgcolor="#DFE886">HM</td>
											<td id="hm_m_students"><?php echo $hm_m_num->total; ?></td>
											<td id="hm_o_students"><?php echo $hm_o_num->total; ?></td>
											<td id="hm_total_students"><?php echo $hm_m_num->total+$hm_o_num->total; ?></td>
										</tr>
										<tr>
											<td bgcolor="#DFE886">H</td>
											<td id="h_m_students"><?php echo $h_m_num->total; ?></td>
											<td id="h_o_students"><?php echo $h_o_num->total; ?></td>
											<td id="h_total_students"><?php echo $h_m_num->total+$h_o_num->total; ?></td>
										</tr>
										<tr>
											<td bgcolor="#DFE886">HL</td>
											<td id="hl_m_students"><?php echo $hl_m_num->total; ?></td>
											<td id="hl_o_students"><?php echo $hl_o_num->total; ?></td>
											<td id="hl_total_students"><?php echo $hl_m_num->total+$hl_o_num->total; ?></td>
										</tr>
									</table>
								</div>
								
								<div class="col-md-7">
									<div id="container"></div>
									<br/>
									<div id="sliders">
										<table>
											<tr>
												<td>Alpha Angle</td>
												<td>&nbsp;</td>
												<td style="width:300px;"><input id="alpha" type="range" min="0" max="45" value="15"/></td>
												<td>&nbsp;</td>
												<td><span id="alpha-value" class="value"></span></td>
											</tr>
											<tr>
												<td>Beta Angle</td>
												<td>&nbsp;</td>
												<td><input id="beta" type="range" min="-45" max="45" value="0"/></td>
												<td>&nbsp;</td>
												<td><span id="beta-value" class="value"></span></td>
											</tr>
											<tr>
												<td>Depth</td>
												<td>&nbsp;</td>
												<td><input id="depth" type="range" min="20" max="100" value="50"/></td>
												<td>&nbsp;</td>
												<td><span id="depth-value" class="value"></span></td>
											</tr>
										</table>
									</div>
								</div> <!-- col-md-7 div -->

							</div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script src="js/highchart-dark.js"></script>
	<script>
		var hm_m_students = document.getElementById("hm_m_students").innerText;
		var hm_o_students = document.getElementById("hm_o_students").innerText;
		var hm_total_students = document.getElementById("hm_total_students").innerText;

		var h_m_students = document.getElementById("h_m_students").innerText;
		var h_o_students = document.getElementById("h_o_students").innerText;
		var h_total_students = document.getElementById("h_total_students").innerText;

		var hl_m_students = document.getElementById("hl_m_students").innerText;
		var hl_o_students = document.getElementById("hl_o_students").innerText;
		var hl_total_students = document.getElementById("hl_total_students").innerText;
		//alert(hm_students+' '+h_students+' '+hl_students);

		// Set up the chart
		var chart = new Highcharts.Chart({
			chart: {
				renderTo: 'container',
				type: 'column',
				options3d: {
					enabled: true,
					alpha: 15,
					beta: 0,
					depth: 50,
					viewDistance: 25
				}
			},
			title: {
				text: 'Nationality Ratio'
			},
			subtitle: {
				text: 'Malaysian vs International'
			},
			xAxis: {
				categories: ['HM', 'H', 'HL'],
				labels: {
					skew3d: true,
					style: {
						fontSize: '16px'
					}
				}
			},
			yAxis: {
				allowDecimals: true,
				min: 0.00,
        		max: 100.00,
				title: {
					text: '',
					skew3d: true
				},
				labels: {
					format: '{value:.2f}%'
				}
			},
			plotOptions: {
				column: {
					depth: 25
				}
			},
			series: [{
				name: 'Malaysian',
				//data: [parseInt(hm_m_students), parseInt(h_m_students), parseInt(hl_m_students)],
				data: [parseInt((hm_m_students/hm_total_students)*100), parseInt((h_m_students/h_total_students)*100), parseInt((hl_m_students/hl_total_students)*100)],
				stack: 'malaysian'
			}, {
				name: 'Others',
				//data: [parseInt(hm_o_students), parseInt(h_o_students), parseInt(hl_o_students)],
				data: [parseInt((hm_o_students/hm_total_students)*100), parseInt((h_o_students/h_total_students)*100), parseInt((hl_o_students/hl_total_students)*100)],
				stack: 'others'
			}]
		});

		function showValues() {
			$('#alpha-value').html(chart.options.chart.options3d.alpha);
			$('#beta-value').html(chart.options.chart.options3d.beta);
			$('#depth-value').html(chart.options.chart.options3d.depth);
		}

		// Activate the sliders
		$('#sliders input').on('input change', function () {
			chart.options.chart.options3d[this.id] = parseFloat(this.value);
			showValues();
			chart.redraw(false);
		});

		showValues();
	</script>
<!-- 	<script>
	Highcharts.chart('container', {
		chart: {
			type: 'column',
			options3d: {
				enabled: true,
				alpha: 15,
				beta: 15,
				viewDistance: 25,
				depth: 40
			}
		},

		title: {
			text: 'Tenancy Rate (New vs Continuing)'
		},

		xAxis: {
			categories: ['HM', 'H', 'HL'],
			labels: {
				skew3d: true,
				style: {
					fontSize: '16px'
				}
			}
		},

		yAxis: {
			allowDecimals: true,
			min: 0.00,
			title: {
				text: '',
				skew3d: true
			}
		},

		tooltip: {
			headerFormat: '<b>{point.key}</b><br>',
			pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
		},

		plotOptions: {
			column: {
				stacking: 'normal',
				depth: 40
			}
		},

		series: [{
			name: 'New Student',
			data: [0, 31, 31],
			stack: 'new'
		}, {
			name: 'Continuing Student',
			data: [0, 59, 59],
			stack: 'continuing'
		}]
	});

	</script> -->


</body>

</html>
