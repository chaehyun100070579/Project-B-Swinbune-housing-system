<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
include('../PHPMailer/PHPMailerAutoload.php');

if(isset($_GET['send']))
{
	$eid=$_GET['send'];
	$ret="SELECT * 
	from registration
	inner join courses
	on registration.course = courses.course_fn
	where emailid=?
	";
	$stmt= $mysqli->prepare($ret);
	$stmt->bind_param('s',$eid);
	$stmt->execute();//ok
	$res=$stmt->get_result();
	//$cnt=1;
	
	while($row=$res->fetch_object())
	{  
		$student_id = $row->studentid;
		$student_email = $row->emailid;
		$student_room = $row->roomno;
		$student_name = $row->firstName;
		$reminder = $row->renewalNotice;
	}

	$checkout_date = date('Y-m-d', strtotime($reminder. ' + 30 days'));

	$mail = new PHPMailer;
	
	// $mail->SMTPDebug = 3;  showing debug output

	$mail->isSMTP();                                   // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                            // Enable SMTP authentication
	$mail->Username = 'swinhousingtest@gmail.com';     // SMTP username
	$mail->Password = 'swinburne123'; // SMTP password
	$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                 // TCP port to connect to

	$mail->setFrom('test@test.com', 'SwinburneHousing');
	$mail->addReplyTo('test@test.com', 'SwinburneHousing');
	$mail->addAddress($student_email);   // Add a recipient
	//$mail->addCC('admin@admin.com'); //student's claim details will send to admin as well
	//$mail->addBCC('bcc@example.com');

	$mail->isHTML(true);  // Set email format to HTML

	$bodyContent = '<h1>Swinburne Housing System <br/> You are reminded of the Check Out date</h1>';
	$bodyContent .= "<p>Your checkout date will be $checkout_date. Please do not forget to checkout.</p>";

	$mail->Subject = 'Swinbune Housing - Room Transfer Request';
	$mail->Body    = $bodyContent;

	$mail->smtpConnect([
		'ssl' => [
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
	]
	]);
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		//echo 'Message has been sent';
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
	<title>Tenant Renewal Notice</title>
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
						<h2 class="page-title">Tenant Renewal Notice</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All Tenants with Renewal Notice Date</div>
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No.</th>
											<th>Room No.</th>
											<th>Tenant Name</th>
											<th>Postgraduate Programs</th>
											<th>Course Duration (weeks)</th>
											<th>Renewal Notice</th>
											<th>Actions</th>
										</tr>
									</thead>
							
									<tbody>
									<?php	
										$aid=$_SESSION['id'];
										$ret="SELECT * 
										from registration
										inner join courses
										on registration.course = courses.course_fn
										";
										$stmt= $mysqli->prepare($ret) ;
										//$stmt->bind_param('i',$aid);
										$stmt->execute() ;//ok
										$res=$stmt->get_result();
										$cnt=1;
										while($row=$res->fetch_object())
										{
									?>
										<tr>
											<td><?php echo $cnt;?></td>
											<td><?php echo $row->roomno;?></td>
											<td><?php echo $row->firstName." ".$row->middleName." ".$row->lastName;?></td>
											<td><?php echo $row->course_fn;?></td>
											<td><?php echo $row->numberOfWeeks;?></td>
											<td><?php echo $row->renewalNotice;?></td>
											<td>
											<a href="javascript:void(0);" onClick="popUpWindow('/hostel/admin/full-profile.php?id=$row->id');" title="View Full Details">
												<i class='fa fa-desktop'></i>
											</a>
											&nbsp;&nbsp;&nbsp;&nbsp;
											<a href="tenant-renewal-notice.php?send=<?php echo $row->emailid;?>" onclick="return confirm('Send renewal notice to this student?');" title="Send Renewal Notice">
												<i class="fa fa-envelope"></i></a>
											</td>
										</tr>

									<?php
										$cnt=$cnt+1;
										} 
									?>
										
									</tbody>
								</table>
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

</body>

</html>
