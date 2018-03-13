<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
include('PHPMailer/PHPMailerAutoload.php');
check_login();
//code for registration

$duration2=$_POST['duration'];



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

                $stayfrom=$_POST['stayf'];
                $duration=$_POST['duration'];
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
                $rc=$stmt->bind_param('iiisisissssisississsisssis',$roomno,$seater,$feespm,$stayfrom,$duration,$course,$studentid,$fname,$mname,$lname,$gender,$contactno,$emailid,$emcntno,$gurname,$gurrelation,$gurcntno,$caddress,$ccity,$cstate,$cpincode,$paddress,$pcity,$pstate,$ppincode,$PreferPerson);
                $stmt->execute();


                $query2 = "update userregistration SET BookedStatus = '1' WHERE studentid = '$row->studentid' ";
                $stmt2 = $mysqli->prepare($query2);
                $stmt2->execute();

                echo"<script>alert('Student Succssfully register Please kindly refer to your email');</script>";

                $mail = new PHPMailer;
                
                // $mail->SMTPDebug = 3;  showing debug output
                
                $mail->isSMTP();                                   // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                            // Enable SMTP authentication
                $mail->Username = 'samuelo0otiong1996@gmail.com';          // SMTP username
                $mail->Password = 'stck1996'; // SMTP password
                $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                 // TCP port to connect to

                $mail->setFrom('samuelo0otiong1996@gmail.com', 'SwinburneHousing');
                $mail->addReplyTo('samuelo0otiong1996@gmail.com', 'SwinburneHousing');
                $mail->addAddress($emailid);   // Add a recipient
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                $mail->isHTML(true);  // Set email format to HTML

                $bodyContent = '<h1>Swinburne Hosuing - your booking has been successfully made</h1>';
                $bodyContent .= '<p>hello</b></p>';
                $bodyContent .= "You have received a new message. ".
                    " Here are the details:\n Room: $roomno \n ".
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
        <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">>
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
                $.ajax({
                    type: "POST",
                    url: "get_seater.php",
                    data:'roomid='+val,
                    success: function(data){
                        //alert(data);
                        $('#seater').val(data);
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "get_seater.php",
                    data:'rid='+val,
                    success: function(data){
                        //alert(data);
                        $('#fpm').val(data);
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


    </head>
    <body>
        <?php include('includes/header.php');?>
        <div class="ts-main-content">
            <?php include('includes/sidebar.php');?>
            <div class="content-wrapper">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <h2 class="page-title">Registration </h2>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Fill all Info</div>
                                        <div class="panel-body">
                                            <form method="post" action="" class="form-horizontal">
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
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label"><h4 style="color: green" align="left">Room Related info </h4> </label>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Room Type: </label>
                                                    <div class="col-sm-8">
                                                        <select name="room" id="room"class="form-control"  onChange="getSeater(this.value);checkAvailability()" onBlur="" required> 
                                                            <option value="" disabled selected>Select Room</option>
                                                            <?php $query ="SELECT * FROM rooms";
                                                            $stmt2 = $mysqli->prepare($query);
                                                            $stmt2->execute();
                                                            $res=$stmt2->get_result();
                                                            while($row=$res->fetch_object())
                                                            {
                                                            ?>
                                                            <option value="<?php echo $row->room_no;?>"> <?php echo $row->RoomType;?></option>
                                                            <?php } ?>
                                                        </select> 
                                                        <span id="room-availability-status" style="font-size:12px;color:red"></span>

                                                    </div>
                                                </div>

                                                <span id="hide-if-full">

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Single or Sharing:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="seater" id="seater"  class="form-control"  readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Fees Per Week:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="fpm" id="fpm"  class="form-control" readonly>

                                                    </div>
                                                </div>



                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Stay From</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" name="stayf" id="stayf"  class="form-control" required>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="form-group">
                                                    
                                                    <label class="col-sm-2 control-label">Duration:</label>
                                                    
                                                    <div class="col-sm-8">
                                                        <select name="duration" id="duration" class="form-control" required>
                                                            <option value="">Select Duration in weeks</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                    
                                                        </select>
                                                        
                                                    </div>
                                                   
                                                </div>
                                                   
                                           
                                                 <div class="form-group">
                                                    <label class="col-sm-2 control-label">Total Amount:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="ta" id="ta" value=""  class="result form-control" readonly>
                                                    </div>
                                                </div>

                                                

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label"><h4 style="color: green" align="left">Personal info </h4> </label>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">course </label>
                                                    <div class="col-sm-8">
                                                        <select name="course" id="course" class="form-control" required> 
                                                            <option value="">Select Course</option>
                                                            <?php $query ="SELECT * FROM courses";
                                                            $stmt2 = $mysqli->prepare($query);
                                                            $stmt2->execute();
                                                            $res=$stmt2->get_result();
                                                            while($row=$res->fetch_object())
                                                            {
                                                            ?>
                                                            <option value="<?php echo $row->course_fn;?>"><?php echo $row->course_fn;?>&nbsp;&nbsp;(<?php echo $row->course_sn;?>)</option>
                                                            <?php } ?>
                                                        </select> </div>
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
                                                        <input type="text" name="gender" value="<?php echo $row->gender;?>" class="form-control" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Contact No : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="contact" id="contact" value="<?php echo $row->contactNo;?>"  class="form-control" readonly>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Email id : </label>
                                                    <div class="col-sm-8">
                                                        <input type="email" name="email" id="email"  class="form-control" value="<?php echo $row->email;?>"  readonly>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Emergency Contact: </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="econtact" id="econtact"  class="form-control" required="required">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Guardian  Name : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="gname" id="gname"  class="form-control" required="required">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Guardian  Relation : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="grelation" id="grelation"  class="form-control" required="required">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Guardian Contact no : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="gcontact" id="gcontact"  class="form-control" required="required">
                                                    </div>
                                                </div>	

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"><h4 style="color: green" align="left">Current Address </h4> </label>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Address : </label>
                                                    <div class="col-sm-8">
                                                        <textarea  rows="5" name="address"  id="address" class="form-control" required="required"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">City : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="city" id="city"  class="form-control" required="required">
                                                    </div>
                                                </div>	

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">State </label>
                                                    <div class="col-sm-8">
                                                        <select name="state" id="state"class="form-control" required> 
                                                            <option value="">Select State</option>
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
                                                    <label class="col-sm-2 control-label">Postcode : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="pincode" id="pincode"  class="form-control" required="required">
                                                    </div>
                                                </div>	

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"><h4 style="color: green" align="left">Permanent Address </h4> </label>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label">Permanent Address same as Current address : </label>
                                                  
                                                    <div class="col-sm-4">
                                                        <input type="checkbox" name="adcheck" value="1"/>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Address : </label>
                                                    <div class="col-sm-8">
                                                        <textarea  rows="5" name="paddress"  id="paddress" class="form-control" required="required"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">City : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="pcity" id="pcity"  class="form-control" required="required">
                                                    </div>
                                                </div>	

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">State </label>
                                                    <div class="col-sm-8">
                                                        <select name="pstate" id="pstate"class="form-control" required> 
                                                            <option value="">Select State</option>
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
                                                    <label class="col-sm-2 control-label">Postcode : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="ppincode" id="ppincode"  class="form-control" required="required">
                                                    </div>
                                                </div>	

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"><h4 style="color: green" align="left">Accommodation preference </h4> </label>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">i would prefer to share with : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="PreferPerson" id="PreferPerson"  class="form-control" required="required">
                                                    </div>
                                                </div>	


                                                <div class="col-sm-6 col-sm-offset-4">
                                                    <button class="btn btn-default" type="submit">Cancel</button>
                                                    <input type="submit" name="submit" Value="Book Now" class="btn btn-primary">
                                                </div>

                                            </form>

                                            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">


                                                <input type="hidden" name="cmd" value="_xclick">

                                                <input type="hidden" name="business" value="swinburnehousing@gmail.com">

                                                <input type="hidden" name="item_name" value="Booking fee">

                                                <input type="hidden" name="item_number" value="0001">

                                                <input type="hidden" name="currency_code" value="MYR">

                                                <input type="hidden" name="amount" value="500">

                                                <input type="hidden" name="custom" value="">

                                                <input type="hidden" name="charset" value="UTF-8">

                                                <input type="submit" id ="submitBtn"value="Pay Rm500 Booking fee" class="btn btn-primary" onclick="submitform()">
                                            </form>
                                            </span> <!-- span id hide-if-full -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 	

        <script type="text/javascript" charset="utf-8">
            var dgFlowMini = new PAYPAL.apps.DGFlowMini({trigger: 'submitBtn'});
        </script>



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
                } 

            });
        });
    </script>
    <script>
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data:'roomno='+$("#room").val(),
                type: "POST",
                success:function(data){
                    $("#room-availability-status").html(data);
                    $("#loaderIcon").hide();
                    if(data > 0)
                    {
                        $("#hide-if-full").hide();
                        $("#room-availability-status").html(data+"room full");
                    } else {
                        $("#hide-if-full").show();
                        $("#room-availability-status").html(data+"room can be booked");
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