<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for add courses
if(isset($_POST['submit']))
{
	$roomtype=$_POST['seater'];
	if(in_array($roomtype, array('B- Single with fan', 'D- Single with Air-Cond'))) {
		$seater= 1;
	}
	else
	{
		$seater = 2;
	}
		
	$roomno=$_POST['rmno'];
	$fees=$_POST['fee'];
	$block=$_POST['block'];
	$sql="SELECT room_no FROM rooms where room_no=?";
	$stmt1 = $mysqli->prepare($sql);
	$stmt1->bind_param('s',$roomno);
	$stmt1->execute();
	$stmt1->store_result(); 
	$row_cnt=$stmt1->num_rows;;
	if($row_cnt>0)
	{
		echo"<script>alert('Room already exist');</script>";
		$_SESSION['msg']="Room already exist !!";
	}
	else
	{
		$query="insert into  rooms (seater,room_no,fees,RoomType,block) values(?,?,?,?,?)";
		$stmt = $mysqli->prepare($query);
		$rc=$stmt->bind_param('isiss',$seater,$roomno,$fees,$roomtype,$block);
		$stmt->execute();
		echo"<script>alert('Room has been added successfully');</script>";
		$_SESSION['msg']="Room {$roomno} has been added successfully !!";
	}
}
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
	<title>Create Room</title>
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
	
	<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
	<script type="text/javascript" src="js/validation.min.js"></script>

	<style>
		/* FOR BEAUTIFY DROPDOWN LIST */
		select:invalid { color: #a9a9a9; }
		option { color: black; }
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
						<h2 class="page-title">Add a Room </h2>
	
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Add a Room</div>
									<div class="panel-body">
										<?php if(isset($_POST['submit']))
										{ ?>
										<p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']=""); ?></p>
										<?php 
										} ?>

										<form method="post" class="form-horizontal">
											
											<div class="hr-dashed">
											</div>

											<div class="form-group">
												<label class="col-sm-12 control-label">
													<div class="col-sm-2">
														Room No. <span style="color:red">*</span>
													</div> 
													<div class="col-sm-8">
														<input type="text" class="form-control" name="rmno" id="rmno" value="" placeholder="e.g. HL001" required="required">
													</div>
												</label>
											</div>

											<div class="form-group">
												<label class="col-sm-12 control-label">
													<div class="col-sm-2">
														Room Type <span style="color:red">*</span>
													</div> 
													<div class="col-sm-8">
														<Select name="seater" class="form-control" required>
															<option value="" disabled selected hidden>Select Room Options</option>
															<option value="A- Twin with fan">A- Twin with fan</option>
															<option value="B- Single with fan">B- Single with fan</option>
															<option value="C- Twin with Air-Cond">C- Twin with Air-Cond</option>
															<option value="D- Single with Air-Cond">D- Single with Air-Cond</option>
														</Select>
													</div>
												</label>
											</div>

											<div class="form-group">
												<label class="col-sm-12 control-label">
													<div class="col-sm-2">
														Rental (RM/week) <span style="color:red">*</span>
													</div>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="fee" id="fee" value="" placeholder="e.g. 100" required="required">
													</div>
												</label>
											</div>

											<div class="form-group">
												<label class="col-sm-12 control-label">
													<div class="col-sm-2">
														Building/Block <span style="color:red">*</span>
													</div>
													<div class="col-sm-8">
														<Select name="block" class="form-control" required>
															<option value="" disabled selected hidden>Select Building/Block</option>
															<option value="H">H (Male)</option>
															<option value="HL">HL (Male)</option>
															<option value="HM">HM (Female)</option>
														</Select>
													</div>
												</label>
											</div>

											<div class="col-sm-8 col-sm-offset-2">
												<input class="btn btn-primary" type="submit" name="submit" value="Create Room ">
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</script>
</body>

</html>