<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for add courses
if(isset($_POST['submit']))
{
	$coursecode=$_POST['cc'];
	$coursesn=$_POST['cns'];
	$coursefn=$_POST['cnf'];
	$weeks=$_POST['cd'];
	$renewal=$_POST['rn'];
	$id=$_GET['id'];
	$query="update courses set course_code=?,course_sn=?,course_fn=?,numberOfWeeks=?,renewalNotice=? where id=?";
	$stmt = $mysqli->prepare($query);
	$rc=$stmt->bind_param('sssisi',$coursecode,$coursesn,$coursefn,$weeks,$renewal,$id);
	$stmt->execute();
	echo"<script>alert('Course has been Updated successfully');window.location = './manage-courses.php';</script>";
    die();
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
	<title>Edit Course</title>
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
						<h2 class="page-title">Edit Course </h2>
	
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										Edit courses
									</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal">
										
										<?php	
											$id=$_GET['id'];
											$ret="select * from courses where id=?";
											$stmt= $mysqli->prepare($ret) ;
											$stmt->bind_param('i',$id);
											$stmt->execute() ;//ok
											$res=$stmt->get_result();
											//$cnt=1;
											while($row=$res->fetch_object())
											{
										?>											
											<div class="hr-dashed">
											</div>

											<div class="form-group">
												<label class="col-sm-12 control-label">
													<div class="col-sm-2">
														Course Code  <span style="color:red">*</span>
													</div>
													<div class="col-sm-8">
														<input type="text"  name="cc" value="<?php echo $row->course_code;?>"  class="form-control">
													</div>
												</label>
											</div>

											<div class="form-group">
												<label class="col-sm-12 control-label">
													<div class="col-sm-2">
														Course Name (Short)  <span style="color:red">*</span>
													</div>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="cns" id="cns" value="<?php echo $row->course_sn;?>" required="required">
													</div>
												</label>
											</div>

											<div class="form-group">
												<label class="col-sm-12 control-label">
													<div class="col-sm-2">
														Course Name (Full)  <span style="color:red">*</span>
													</div>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="cnf" value="<?php echo $row->course_fn;?>" >
													</div>
												</label>
											</div>

											<div class="form-group">
												<label class="col-sm-12 control-label">
													<div class="col-sm-2">
														Course Duration (weeks)  <span style="color:red">*</span>
													</div>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="cd" value="<?php echo $row->numberOfWeeks;?>" required="required">
													</div>
												</label>
											</div>
                                            
                                            <div class="form-group">
												<label class="col-sm-12 control-label">
													<div class="col-sm-2">
														Renewal Notice  <span style="color:red">*</span>
													</div>
													<div class="col-sm-2">
														<input type="date" class="form-control" name="rn" value="<?php echo $row->renewalNotice;?>" required="required">
													</div>
												</label>
											</div>

										<?php
											}
										?>

											<div class="col-sm-8 col-sm-offset-2">
												<input class="btn btn-primary" type="submit" name="submit" value="Update Course">
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
