<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
include('PHPMailer/PHPMailerAutoload.php');

check_login();
//code for registration





if(isset($_POST['submit']))
{
    $aid=$_SESSION['id'];
    $ret="select * from userregistration where id=?";
    $stmt= $mysqli->prepare($ret) ;
    $stmt->bind_param('i',$aid);
    $stmt->execute() ;//ok
    $res=$stmt->get_result();
    //$cnt=1;

    while ($row=$res->fetch_object()) {


        if ($row->BookingFeeStatus == false)
        {   
            echo"<script>alert('You cant make a booking! You have to pay booking fee first!');</script>";
        }
        else{

            if ($row->BookedStatus == true)
            {
                echo"<script>alert('You cant make a booking! You are already booked!');</script>";
            }
            else{

                $roomno=$_POST['room'];
                $seater=$_POST['seater'];
                $feespm=$_POST['fpm'];

                $stayfrom="";
                $duration=$_POST['duration'];
                //$totalfee = $feespm*$duration;
                $course=$_POST['course'];
                $studentid=$_POST['studentid'];
                $fname=$_POST['fname'];
                $mname=$_POST['mname'];
                $lname=$_POST['lname'];
                $gender=$_POST['gender'];
                $contactno=$_POST['contact'];
                $emailid=$_POST['email'];
                $emcntno=$_POST['econtact'];
                $gurname=$_POST['gname'];
                $gurrelation=$_POST['grelation'];
                $gurcntno=$_POST['gcontact'];
                $caddress=$_POST['address'];
                $ccity=$_POST['city'];
                $cstate=$_POST['state'];
                $cpincode=$_POST['pincode'];
                $paddress=$_POST['paddress'];
                $pcity=$_POST['pcity'];
                $pstate=$_POST['pstate'];
                $ppincode=$_POST['ppincode'];
                $PreferPerson = $_POST['PreferPerson'];

                $query="insert into  registration(roomno,seater,feespm,stayfrom,duration,course,studentid,firstName,middleName,lastName,gender,contactno,emailid,egycontactno,guardianName,guardianRelation,guardianContactno,corresAddress,corresCIty,corresState,corresPincode,pmntAddress,pmntCity,pmnatetState,pmntPincode,PreferPerson) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $mysqli->prepare($query);
                $rc=$stmt->bind_param('siisisissssisississsisssis',$roomno,$seater,$feespm,$stayfrom,$duration,$course,$studentid,$fname,$mname,$lname,$gender,$contactno,$emailid,$emcntno,$gurname,$gurrelation,$gurcntno,$caddress,$ccity,$cstate,$cpincode,$paddress,$pcity,$pstate,$ppincode,$PreferPerson);
                $stmt->execute();


                $query2 = "update userregistration SET BookedStatus = '1' WHERE studentid = '$row->studentid' ";
                $stmt2 = $mysqli->prepare($query2);
                $stmt2->execute();

                echo"<script>alert('Student succssfully registered. Please kindly refer to your email');</script>";

                $mail = new PHPMailer;

                // $mail->SMTPDebug = 3;  //showing debug output

                $mail->isSMTP();                                   // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                            // Enable SMTP authentication
                $mail->Username = 'swinhousingtest@gmail.com';          // SMTP username
                $mail->Password = 'swinburne123'; // SMTP password
                $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                 // TCP port to connect to

                $mail->setFrom('test@test.com', 'SwinburneHousing');
                $mail->addReplyTo('test@test.com', 'SwinburneHousing');
                $mail->addAddress($emailid);   // Add a recipient
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                $mail->isHTML(true);  // Set email format to HTML

                $bodyContent = '<h1>Swinburne Housing - your booking has been successfully made</h1>';
                $bodyContent .= '<p>Hello</p>';
                $bodyContent .= "You have successfully booked your room. ".
                    " Here are the details:".

                    "
                    <table border='1' id='zctb' class='table table-bordered' cellspacing='0' width='90%'>
                     <tbody>


                                            <tr>
                                                <td colspan='6'><h4>Room Related Info</h4></td>
                                            </tr>


                                            <tr>
                                                <td><b>Room no :</b></td>
                                                <td>$roomno</td>
                                                <td><b>Single or Twin:</b></td>
                                                <td>$seater</td>
                                                <td><b>Fees PM :</b></td>
                                                <td>$feespm</td>
                                            </tr>

                                            <tr>

                                                <td><b>Stay From :</b></td>
                                                <td>$stayfrom</td>

                                                <td><b>Course :</b></td>
                                                <td>$course</td>

                                                <td><b>Duration:</b></td>
                                                <td>$duration Weeks</td>
                                            </tr>

                                            <tr>
                                                <td colspan='6'><b>Total Fee : 
                                                    ".$feespm*$duration."
                                            </b></td>
                                            </tr>
                                            <tr>
                                                <td colspan='6'><h4>Personal Info</h4></td>
                                            </tr>

                                            <tr>

                                                <td><b>Student ID. :</b></td>
                                                <td>$studentid</td>
                                                <td><b>Full Name :</b></td>
                                                <td>$fname&nbsp;$mname&nbsp;$lname</td>
                                                <td><b>Email :</b></td>
                                                <td>$emailid</td>
                                            </tr>


                                            <tr>
                                                <td><b>Contact No. :</b></td>
                                                <td>$contactno</td>
                                                <td><b>Gender :</b></td>
                                                <td>$gender</td>

                                            </tr>


                                            <tr>
                                                <td><b>Emergency Contact No. :</b></td>
                                                <td>$emcntno</td>
                                                <td><b>Guardian Name :</b></td>
                                                <td>$gurname</td>
                                                <td><b>Guardian Relation :</b></td>
                                                <td>$gurrelation</td>
                                            </tr>

                                            <tr>
                                                <td><b>Guardian Contact No. :</b></td>
                                                <td colspan='6'>$gurcntno</td>
                                            </tr>

                                            <tr>
                                                <td colspan='6'><h4>Addresses</h4></td>
                                            </tr>
                                            <tr>
                                                <td><b>Correspondense Address</b></td>
                                                <td colspan='2'>
                                                    $caddress<br />
                                                    $ccity, $cpincode<br />
                                                    $cstate
                                                </td>

                                                <td><b>Permanent Address</b></td>
                                                <td colspan='2'>
                                                    $paddress<br />
                                                    $pcity, $ppincode<br />
                                                    $pstate
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b>Preference Person</b></td>
                                                <td colspan='6'>$PreferPerson</td>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                    ".

                    "You can Now pay the total rental fee under Room Details category with button";

                $mail->Subject = 'Email from  Swinbune housing';
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
                    echo 'Message has been sent';
                }

                $mail->smtpClose();
            }
        }
    }
}





/*
if(isset($_GET['tx']))
{

    $aid=$_SESSION['id'];
    $ret="select * from userregistration where id=?";
    $stmt= $mysqli->prepare($ret) ;
    $stmt->bind_param('i',$aid);
    $stmt->execute() ;//ok
    $res=$stmt->get_result();
    //$cnt=1;

    while ($row=$res->fetch_object()) { 

        $query2 = "update userregistration SET BookingFeeStatus = '1' WHERE id = '$row->id' ";
        $stmt2 = $mysqli->prepare($query2);
        $stmt2->execute();

    }


    $tx = $_GET['tx'];
    // Further processing
    $your_pdt_identity_token = 'Zl6viRQbLJkFs7GR8bzz5cKAVm-f8T0l-WOuz-N8rhCvJFY8w75lISB3y-a';

    // Init cURL
    $request = curl_init();

    // Set request options
    curl_setopt_array($request, array
                      (
        CURLOPT_URL => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
        CURLOPT_POST => TRUE,
        CURLOPT_POSTFIELDS => http_build_query(array
                                               (
        'cmd' => '_notify-synch',
        'tx' => $tx,
        'at' => $your_pdt_identity_token,
    )),
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HEADER => FALSE,
        // CURLOPT_SSL_VERIFYPEER => TRUE,
        // CURLOPT_CAINFO => 'cacert.pem',
    ));

    // Execute request and get response and status code
    $response = curl_exec($request);
    $status   = curl_getinfo($request, CURLINFO_HTTP_CODE);

    // Close connection
    curl_close($request);

    if($status == 200 AND strpos($response, 'SUCCESS') === 0)
    {
        // Further processing

    }
    else
    {
        echo"<script>alert('transcation unsucessful');</script>";

        // Log the error, ignore it, whatever 
    }

    // Remove SUCCESS part (7 characters long)
    $response = substr($response, 7);

    // URL decode
    $response = urldecode($response);

    // Turn into associative array
    preg_match_all('/^([^=\s]++)=(.*+)/m', $response, $m, PREG_PATTERN_ORDER);
    $response = array_combine($m[1], $m[2]);

    // Fix character encoding if different from UTF-8 (in my case)
    if(isset($response['charset']) AND strtoupper($response['charset']) !== 'UTF-8')
    {
        foreach($response as $key => &$value)
        {
            $value = mb_convert_encoding($value, 'UTF-8', $response['charset']);
        }
        $response['charset_original'] = $response['charset'];
        $response['charset'] = 'UTF-8';
    }

    // Sort on keys for readability (handy when debugging)
    ksort($response);

    echo "$response";



}

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
        <title>Student Hostel Registration</title>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-social.css">
        <link rel="stylesheet" href="css/bootstrap-select.css">
        <link rel="stylesheet" href="css/fileinput.min.css">
        <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
        <script type="text/javascript" src="js/validation.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

        <script>
            function getSeater(val) {
                // val no longer needed but still leave it there anyway

                var gen = document.getElementById("gender").value;

                $.ajax({
                    type: "POST",
                    url: "get_seater.php",
                    data:'roomid='+$("#room option:selected").text()+'&gender='+gen,
                    success: function(data){
                        //alert(data);
                        var trimmed = data.trim();
                        $('#seater').val(trimmed);
                    }
                });

                var dura = document.getElementById("duration").value;

                $.ajax({
                    type: "POST",
                    url: "get_seater.php",
                    data:'rid='+$("#room option:selected").text()+'&gender='+gen,
                    success: function(data){
                        //alert(data);
                        var trimmed = data.trim();
                        $('#fpm').val(trimmed);
                        newdata = data * dura;
                        $('#ta').val(newdata);
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "get_seater.php",
                    data:'getroomnum='+$("#room option:selected").text()+'&gender='+gen,
                    success: function(data){
                        //alert(data);
                        //$('#room').attr('value', data);
                        var asd = document.getElementById("room");
                        var trimmed = data.trim();
                        //asd.options[asd.selectedIndex].innerHTML = ("<option value='"+data+"'>"+val+"</option>");
                        //asd.options[asd.selectedIndex].innerHTML = ("<option value='123123'>123123</option>");
                        asd.options[asd.selectedIndex].value = trimmed;
                        //alert(asd.options[asd.selectedIndex].value);
                    }
                });
            }

            function getCourse(val){                
                $.ajax({
                    type: "POST",
                    url: "get_seater.php",
                    data: {
                        // data: "course_code"+val
                        // cannot pass value with & symbol in string
                        // some course has & in name
                        course_code: val
                    },
                    success: function(data){
                        //alert(data);
                        var trimmed = data.trim();
                        $('#duration').val(trimmed);
                    }
                });

                var fee = document.getElementById("fpm").value;

                $.ajax({
                    type: "POST",
                    url: "get_seater.php",
                    data: {
                        // data: "course_code"+val
                        // cannot pass value with & symbol in string
                        // some course has & in name
                        course_code: val
                    },
                    success: function(data){
                        //alert(data);
                        newdata = data * fee;
                        $('#ta').val(newdata);
                    }
                });
            }


        </script>

        <link href="../wp-content/themes/swinburne-sarawak-byhds/bootstrap/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/fonts/font-awesome.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/style.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/menus.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/responsive.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/flexslider.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/slider.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/isotope.css" media="screen" rel="stylesheet" type="text/css">
        <link href="../wp-content/themes/swinburne-sarawak-byhds/magnific-popup.css" media="screen" rel="stylesheet" type="text/css"> 


        <script src="https://www.paypalobjects.com/js/external/apdg.js" type="text/javascript"></script>

        <style>
            /* FOR BEAUTIFY DROPDOWN LIST */
            select:invalid { color: gray; }
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
                            <br/><br/>
                            <h2 class="page-title">Registration </h2>

                            <?php

                            $aid=$_SESSION['id'];
                            $ret="select * from userregistration where id=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$aid);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            $row=$res->fetch_object();
                             
                            if($row->BookingFeeStatus == "1")
                            {
                                
                                echo '<h3 style="color: blue" align="left">BookingFee = Paid!</h3>';

                            }
                            else
                            {
                                
                                echo '<h3 style="color: blue" align="left">You must pay booking fee first to proceed booking</h3>';
                                echo'

                                                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" accept-charset="utf-8">

                                                        <p>
                                                            <input type="hidden" name="cmd" value="_xclick" />

                                                            <input type="hidden" name="charset" value="UTF-8">

                                                            <input type="hidden" name="business" value="SwinburneHousingMerchant@gmail.com" />

                                                            <input type="hidden" name="item_name" value="Booking fee" />

                                                            <input type="hidden" name="item_number" value="0001" />

                                                            <input type="hidden" name="amount" value="500" />

                                                            <input type="hidden" name="currency_code" value="MYR" />

                                                            <input type="hidden" name="return"  value ="http://localhost/Swinburne%20hostel%20webstie17/hostel/PaypalPdtIndex.php" />

                                                            <input type="submit" name ="submitpaypal" id ="submitBtn"value="Pay Rm500 Booking fee" class="btn btn-primary" onclick="submitform()">  

                                                    </form>
                                                        ';
                            }

                            ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    $uid=$_SESSION['login'];
                                    $stmt=$mysqli->prepare("SELECT emailid FROM registration WHERE emailid=? ");
                                    $stmt->bind_param('s',$uid);
                                    $stmt->execute();
                                    $stmt -> bind_result($email);
                                    $rs=$stmt->fetch();
                                    $stmt->close();
                                    if($rs)
                                    { 
                                        echo "<h3 style='color: red' align='left'>Hostel already booked by you</h3>";
                                    }
                                    else{
                                        echo "";
                                    }			
                                    ?>
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Fill all Info</div>
                                        <div class="panel-body">
                                            <form method="post" action="" class="form-horizontal">			
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label"><h4 style="color: green" align="left">Room Related info </h4> </label>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Room Type : <span style="color:red">*</span></label>
                                                    <div class="col-sm-8">
                                                        <select name="room" id="room"class="form-control"  onChange="checkAvailability();getSeater(this.value)" onBlur="" required> 
                                                            <option value="" disabled selected hidden>Select Room</option>
                                                            <?php $query ="SELECT DISTINCT RoomType FROM rooms";
                                                            $stmt2 = $mysqli->prepare($query);
                                                            $stmt2->execute();
                                                            $res=$stmt2->get_result();
                                                            while($row=$res->fetch_object())
                                                            {
                                                            ?>
                                                            <!-- <option value="<?php //echo $row->room_no;?>"> <?php //echo $row->RoomType;?></option> -->
                                                            <option value="<?php echo $row->RoomType;?>"><?php echo $row->RoomType;?></option> 
                                                            <?php } ?>
                                                        </select> 
                                                        <span id="room-availability-status" style="font-size:12px;color:red"></span>

                                                    </div>
                                                </div>

                                                <span id="hide-if-full">

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Single or Sharing (Seater) :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="seater" id="seater"  class="form-control"  readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Fees Per Week (RM) :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="fpm" id="fpm"  class="form-control" readonly>

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Course : <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <select name="course" id="course" class="form-control"  onChange="getCourse(this.value);"  required> 
                                                                <option value="" disabled selected hidden>Select Course</option>
                                                                <?php $query ="SELECT * FROM courses";
                                                                $stmt2 = $mysqli->prepare($query);
                                                                $stmt2->execute();
                                                                $res=$stmt2->get_result();
                                                                while($row=$res->fetch_object())
                                                                {
                                                                ?>
                                                                <option value="<?php echo $row->course_code;?>"><?php echo $row->course_code;?></option>

                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Duration (Weeks) :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text"  name="duration" id="duration"  class="form-control" onChange="getTotalFee(this.value);"  readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Total Rental (RM) :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="ta" id="ta" value=""  class="result form-control" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label"><h4 style="color: green" align="left">Personal info </h4> </label>
                                                    </div>

                                                    <?php	
                                                    $aid=$_SESSION['id'];
                                                    $ret="select * from userregistration where id=?";
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->bind_param('i',$aid);
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    //$cnt=1;
                                                    while($row=$res->fetch_object())
                                                    {
                                                    ?>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Student ID : </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="studentid" id="studentid"  class="form-control" value="<?php echo $row->studentid;?>" readonly >
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">First Name : </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="fname" id="fname"  class="form-control" value="<?php echo $row->firstName;?>" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Middle Name : </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="mname" id="mname"  class="form-control" value="<?php echo $row->middleName;?>"  readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Last Name : </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="lname" id="lname"  class="form-control" value="<?php echo $row->lastName;?>" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Gender : </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="gender" id="gender" value="<?php echo $row->gender;?>" class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Contact No : </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="contact" id="contact" value="<?php echo $row->contactNo;?>"  class="form-control" readonly>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Email ID : </label>
                                                        <div class="col-sm-8">
                                                            <input type="email" name="email" id="email"  class="form-control" value="<?php echo $row->email;?>"  readonly>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Emergency Contact : <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="econtact" id="econtact"  class="form-control" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Guardian  Name : <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="gname" id="gname"  class="form-control" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Guardian  Relation : <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="grelation" id="grelation"  class="form-control" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Guardian Contact No : <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="gcontact" id="gcontact"  class="form-control" required="required">
                                                        </div>
                                                    </div>	

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label"><h4 style="color: green" align="left">Current Address </h4> </label>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Address : <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <textarea  rows="5" name="address"  id="address" class="form-control" required="required"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">City : <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="city" id="city"  class="form-control" required="required">
                                                        </div>
                                                    </div>	

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">State : <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <select name="state" id="state"class="form-control" required> 
                                                                <option value="" disabled selected hidden>Select State</option>
                                                                <?php $query ="SELECT * FROM states";
                                                                $stmt2 = $mysqli->prepare($query);
                                                                $stmt2->execute();
                                                                $res=$stmt2->get_result();
                                                                while($row=$res->fetch_object())
                                                                {
                                                                ?>
                                                                <option value="<?php echo $row->State;?>"><?php echo $row->State;?></option>
                                                                <?php } ?>
                                                            </select> </div>
                                                    </div>							

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Postcode : <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="pincode" id="pincode"  class="form-control" required="required">
                                                        </div>
                                                    </div>	

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label"><h4 style="color: green" align="left">Permanent Address </h4> </label>
                                                    </div>


                                                    <div class="form-group text-sm-left">
                                                        <label class="checkbox-inline col-sm-4 control-label" ><b>Permanent Address same as Current Address : </b>
                                                            &nbsp;
                                                            <input class="col-sm-2" type="checkbox" name="adcheck" value="1" style="transform: scale(1.3);"/>
                                                        </label>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Address : <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <textarea  rows="5" name="paddress"  id="paddress" class="form-control" required="required"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">City : <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="pcity" id="pcity"  class="form-control" required="required">
                                                        </div>
                                                    </div>	

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">State : <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <select name="pstate" id="pstate"class="form-control" required> 
                                                                <option value="" disabled selected hidden>Select State</option>
                                                                <?php $query ="SELECT * FROM states";
                                                                $stmt2 = $mysqli->prepare($query);
                                                                $stmt2->execute();
                                                                $res=$stmt2->get_result();
                                                                while($row=$res->fetch_object())
                                                                {
                                                                ?>
                                                                <option value="<?php echo $row->State;?>"><?php echo $row->State;?></option>
                                                                <?php } ?>
                                                            </select> </div>
                                                    </div>							

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Postcode : <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="ppincode" id="ppincode"  class="form-control" required="required">
                                                        </div>
                                                    </div>	

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label"><h4 style="color: green" align="left">Accommodation preference </h4> </label>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">I would prefer to share with: </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="PreferPerson" id="PreferPerson"  class="form-control">
                                                        </div>
                                                    </div>	


                                                    <div class="col-sm-6 col-sm-offset-4">
                                                        <button class="btn btn-default" type="submit">Cancel</button>
                                                        <input type="submit" name="submit" Value="Book Now" class="btn btn-primary">
                                                    </div>
                                                </span>

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

        <!--
        <script type="text/javascript" charset="utf-8">
            var dgFlowMini = new PAYPAL.apps.DGFlowMini({trigger: 'submitBtn'});
        </script>
        -->

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

    <script type="text/javascript">
        $(document).ready(function(){
            $('input[type="checkbox"]').click(function(){
                if($(this).prop("checked") == true){
                    $('#paddress').val( $('#address').val() );
                    $('#pcity').val( $('#city').val() );
                    $('#pstate').val( $('#state').val() );
                    $('#ppincode').val( $('#pincode').val() );
                } else {
                    $('#paddress').val('');
                    $('#pcity').val('');
                    $('#pstate').val('');
                    $('#ppincode').val('');
                }

            });
        });
    </script>

    <script>
        function checkAvailability() {

            var gen = document.getElementById("gender").value;

            $("#loaderIcon").show();

            jQuery.ajax({

                url: "check_availability.php",
                data:'roomno='+$("#room option:selected").text()+'&gender='+gen,
                type: "POST",
                success:function(data){
                    $("#room-availability-status").html(data);
                    $("#loaderIcon").hide();
                    if(data > 0)
                    {
                        $("#hide-if-full").show();
                        $("#room-availability-status").html(data+" room(s) available and can be booked");
                    } else {
                        $("#hide-if-full").hide();
                        $("#room-availability-status").html("All rooms are full and cannot be booked");
                    }
                },
                error:function (){}
            });
        }
    </script>


    <script type="text/javascript">

        $(document).ready(function() {
            $('#duration').keyup(function(){
                var fetch_dbid = $(this).val();
                $.ajax({
                    type:'POST',
                    url :"ins-amt.php?action=userid",
                    data :{userinfo:fetch_dbid},
                    success:function(data){
                        $('.result').val(data);
                    }
                });


            })});
    </script>

</html>