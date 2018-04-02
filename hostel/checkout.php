<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
date_default_timezone_set('Asia/Kuala_Lumpur');
include('PHPMailer/PHPMailerAutoload.php');


$aid=$_SESSION['id'];
$ret="select * from userregistration where id=?";
$stmt= $mysqli->prepare($ret) ;
$stmt->bind_param('i',$aid);
$stmt->execute() ;//ok
$res=$stmt->get_result();
//$cnt=1;
while($row=$res->fetch_object())
{  
    $_SESSION['studentid'] = $row->studentid;   
    $BookedStatus = $row->BookedStatus;
}

if(isset($_POST['submit']))
{


    $aid=$_SESSION['studentid'];

    $ret="select * from registration where studentid=?";
    $stmt= $mysqli->prepare($ret) ;
    $stmt->bind_param('i',$aid);
    $stmt->execute() ;//ok
    $res=$stmt->get_result();
    //$cnt=1;
    $row=$res->fetch_object();

    if($row->CheckoutStatus == true)
    {
        echo"<script>alert('You cant check-out more than an one time! You are already CHECKED OUT!');</script>";
    }

    else
    {
        $studentid=$row->studentid;
        $email = $row->emailid;
        //$CheckoutStatus="1";
        //$CheckinStatus="0";
        $CheckoutDate = $_POST['CheckoutDate'];
        $CheckoutTime = $_POST['CheckoutTime'];        
        
        $CheckoutOption = $_POST['Checkout'];

        if ($CheckoutOption == "1")
        {
            // Semester Break Notification
            $CheckoutStatus="1";
            $CheckinStatus="0";
            //echo"<script>alert('Semester Break Notification');</script>";
        }
        elseif($CheckoutOption == "2")
        {
            // Accommodation Rental Overpayment
            $CheckoutStatus="1";
            $CheckinStatus="0";
            //echo"<script>alert('Accommodation Rental Overpayment');</script>";
        }
        elseif($CheckoutOption == "3")
        {
            // End Tenancy
            $CheckoutStatus="1";
            $CheckinStatus="1";
            //echo"<script>alert('End Tenancy');</script>";
        }
        elseif($CheckoutOption == "4")
        {
            // Move to Private Accommodation
            $CheckoutStatus="1";
            $CheckinStatus="0";
            //echo"<script>alert('Move to Private Accommodation');</script>";
        }
        else
        {
            // if all fail (wont trigger)
            $CheckoutStatus="1";
            $CheckinStatus="1";
            //echo"<script>alert('all fail');</script>";
        }

        $KeyReturnedDate = $_POST['KeyReturnedDate'];

        $Building = $_POST['Location'];
        $Bed = $_POST['Bed'];
        $Mattress = $_POST['Mattress'];
        $StudyTable = $_POST['Table'];
        $BookShelf = $_POST['Bookshelf'];
        $Chair = $_POST['Chair'];
        $Wardrobe = $_POST['Wardrobe'];
        $VenetianBlind = $_POST['Blind'];
        $Curtain = $_POST['Curtain'];
        $Fan = $_POST['Fan'];
        $Ac = $_POST['Ac'];

        $query = "update registration SET CheckoutStatus = '$CheckoutStatus', CheckinStatus = '$CheckinStatus',  CheckoutDate='$CheckoutDate'  WHERE studentid = '$studentid' ";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();

        echo"<script>alert('You have sucessfully CHECKED OUT! please kindly refer to your e-mail');</script>";
        
        $mail = new PHPMailer;

        $mail->isSMTP();                                   // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                            // Enable SMTP authentication
        $mail->Username = 'samuelo0otiong1996@gmail.com';          // SMTP username
        $mail->Password = 'stck1996'; // SMTP password
        $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                 // TCP port to connect to

        $mail->setFrom('samuelo0otiong1996@gmail.com', 'Swinburne');
        $mail->addReplyTo('samuelo0otiong1996@gmail.com', 'Swinburne');
        $mail->addAddress($email);   // Add a recipient
        //$mail->addCC('admin@admin.com'); //student's claim details will send to admin as well
        //$mail->addBCC('bcc@example.com');

        $mail->isHTML(true);  // Set email format to HTML

        $bodyContent = '<h1>Swinburne Housing System - You have checked Out sucessfully</h1>';
        $bodyContent .= '<p>hello</b></p>';
        $bodyContent .= "You have received a new message. ".
            " Here are the details".
            "
                    <table border='1' id='zctb' class='table table-bordered' cellspacing='0' width='90%'>
                     <tbody>

                                            <tr>
                                                <td colspan='6'><h4>Room Realted Info</h4></td>
                                            </tr>


                                            <tr>
                                                <td><b>Room no :</b></td>
                                                <td>$row->roomno</td>
                                                <td><b>Single or Twin:</b></td>
                                                <td>$row->seater</td>

                                            </tr>
                                            <tr>
                                                <td><b>Building:</b></td>
                                                <td>$Building</td>
                                            </tr>


                                            <tr>
                                                <td colspan='6'><h4>Personal Info</h4></td>
                                            </tr>

                                            <tr>
                                                <td><b>Student ID :</b></td>
                                                <td>$studentid</td>
                                                <td><b>Full Name :</b></td>
                                                <td>$row->firstName&nbsp;$row->middleName&nbsp;$row->lastName</td>
                                                <td><b>Email :</b></td>
                                                <td>$email</td>
                                            </tr>


                                            <tr>
                                                <td colspan='6'><h4>Facilities Conditions(O=OK, F=Need Fxing, NA=Not Available)</h4></td>
                                            </tr>

                                            <tr>
                                                <td><b>Bed :</b></td>
                                                <td>$Bed</td>
                                            </tr>

                                            <tr>
                                                <td><b>Clean Mattress with fitted cover :</b></td>
                                                <td>$Mattress</td>
                                            </tr>

                                            <tr>
                                                <td><b>Study Table :</b></td>
                                                <td>$StudyTable</td>
                                            </tr>

                                            <tr>
                                                <td><b>Book Shelf :</b></td>
                                                <td>$BookShelf</td>
                                            </tr>

                                            <tr>
                                                <td><b>Chair :</b></td>
                                                <td>$Chair</td>
                                            </tr>

                                            <tr>
                                                <td><b>Wardrobe :</b></td>
                                                <td>$Wardrobe</td>
                                            </tr>

                                            <tr>
                                                <td><b>Venetian Blind(for non Ac room only) :</b></td>
                                                <td>$VenetianBlind</td>
                                            </tr>

                                            <tr>
                                                <td><b>Curtain(for AC Room only) :</b></td>
                                                <td>$Curtain</td>
                                            </tr>

                                            <tr>
                                                <td><b>Fan :</b></td>
                                                <td>$Fan</td>
                                            </tr>

                                            <tr>
                                                <td><b>Air-Conditioner(for AC room only) :</b></td>
                                                <td>$Ac</td>
                                            </tr>

                                            <tr>
                                                <td colspan='6'><h4>Check-Out Info</h4></td>
                                            </tr>
                                            
                                             <tr>
                                                <td><b>I wish to :</b></td>
                                                <td>$CheckoutOption</td>
                                            </tr>
                                            
                                             <tr>
                                                <td><b>Check-Out Date :</b></td>
                                                <td>$CheckoutDate</td>
                                            </tr>

                                             <tr>
                                                <td><b>Check-Out Time :</b></td>
                                                <td>$CheckoutTime</td>
                                            </tr>
                                            
                                            <tr>
                                               <td><b>Key / Acess Card Returned Date :</b></td>
                                               <td>$KeyReturnedDate</td>
                                            </tr>



                                        </tbody>
                                    </table>

                    ";

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
        <title>Check Out</title>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-social.css">
        <link rel="stylesheet" href="css/bootstrap-select.css">
        <link rel="stylesheet" href="css/fileinput.min.css">
        <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
        <link rel="stylesheet" href="css/style.css">
        <link href="../wp-content/themes/swinburne-sarawak-byhds/bootstrap/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/fonts/font-awesome.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/style.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/menus.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/responsive.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/flexslider.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/slider.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../wp-content/themes/swinburne-sarawak-byhds/isotope.css" media="screen" rel="stylesheet" type="text/css">
        <link href="../wp-content/themes/swinburne-sarawak-byhds/magnific-popup.css" media="screen" rel="stylesheet" type="text/css">

        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <title>Room Transfer Request Form</title>

        <script language="JavaScript" type="text/javascript" src="Checkout.js"></script>
        
        <script type="text/javascript">
            // function to auto call the onclick() function of first checkbox to enable ticking the T&S checkbox
            window.onload = function() {
                if(document.forms[0] && document.forms[0].Checkout) {
                    document.forms[0].Checkout[0].checked = true;
                    document.forms[0].Checkout[0].onclick();
                }
            }
        </script>
        <!--
            <link media="only screen and (max-device-width: 480px)" href="local/css/iphone.css" type="text/css" rel="stylesheet" />
        -->
        <!--
            YB
            <link href="http://global.swinburne.edu.au/template/css/whats_on.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="http://global.swinburne.edu.au/js/whats_on/jquery.coda-slider-2.0.js"></script>
            <script type="text/javascript" src="http://global.swinburne.edu.au/js/whats_on/jquery.easing.1.3.js"></script>
            <script type="text/javascript" src="http://global.swinburne.edu.au/js/whats_on/slider-initiate.js"></script><link href="http://global.swinburne.edu.au/template/css/news.css" rel="stylesheet" type="text/css" />
        -->

        <style type="text/css">
            /*
            .content_black {font-size: 12px;
            line-height: 20px;
            }
            .small_title {font-size: 12px;
            font-weight: bold;
            }
            .style2 {font-size: 12px; line-height: 20px; font-weight: bold; }
            .content_black1 {font-size: 12px;
            line-height: 18px;
            }
            .content_black_small {font-size: 10px;
            line-height: 14px;
            }
            .title {font-size: 18px;
            font-weight: bold;
            }
            */
        </style>

        <meta name="Microsoft Border" content="b">

    </head>

    <body>
        <?php include('includes/header.php');?>

        <div class="ts-main-content">
            <?php include('includes/sidebar.php');?>
            <div class="content-wrapper">
                <div class="container-fluid">

                    <div id="top_navigation"></div>
                    <div class="page_positioning">
                        <div id="content" class="no_small">
                            <h1>
                                <br />CheckOut Confirmation / Clearance & Deposit Refund Form
                            </h1>

                            <p class="title">&nbsp;</p>
                            <form action="" method="post" name="CheckoutForm" id="CheckoutForm" onsubmit="return checkEmpty();">

                                <?php
                                $aid=$_SESSION['studentid'];
                                $ret="select * from registration where studentid=?";
                                $stmt= $mysqli->prepare($ret) ;
                                $stmt->bind_param('i',$aid);
                                $stmt->execute() ;//ok
                                $res=$stmt->get_result();
                                //$cnt=1;
                                $row=$res->fetch_object();

                                
                                
                                if($BookedStatus == 0)
                                {
                                    echo '<h3 style="color: red" align="left">You have NO ROOM to check out!</h3>';
                                }
                                elseif($row->CheckinStatus == false)
                                {
                                    echo '<h3 style="color: red" align="left">You are not checked in. Please check in first before checking out.</h3>';
                                }
                                elseif($row->CheckoutStatus == true)
                                { 
                                    echo '<h3 style="color: red" align="left">You are already CHECKED OUT!</h3>';
                                }
   
                                else
                                {
                                    // <!-- enclose table(form) in php to hide if already checked out (and also escape \')-->
                                    echo '

                                <table class="Form_Table" border="1" width="660" cellspacing="0">
                                    <tr><h3>FACILTIES PROVIDED (Returned Condition)</h3></tr>
                                    <tr>
                                        <th>No</th>
                                        <th>Item</th> 
                                        <th>Condition <br> O=OK <br> F=Need Fixing <br> NA=Not Available</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Bed</td>
                                        <td><input type="text" name="Bed" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Clean Mattress with fitted cover</td>
                                        <td><input type="text" name="Mattress" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Study Table</td>
                                        <td><input type="text" name="Table" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Book Shelf</td>
                                        <td><input type="text" name="Bookshelf" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Chair</td>
                                        <td><input type="text" name="Chair" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Wardrobe</td>
                                        <td><input type="text" name="Wardrobe" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Venetian Blind(for non AC room only)</td>
                                        <td><input type="text" name="Blind" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Curtain(for AC Room only)</td>
                                        <td><input type="text" name="Curtain" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Fan</td>
                                        <td><input type="text" name="Fan" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Air-Conditioner(for AC room only)</td>
                                        <td><input type="text" name="Ac" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Others</td>
                                        <td><input type="text" name="Others" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
                                    </tr>

                                </table>
                                <br>
                                <br>

                                <table class="Form_Table" border="1" width="650" cellspacing="0">
                                    <tr><h3>ROOM CHECKLIST</h3></tr>

                                        <tr>
                                            <td width="160" class="content_black1">Student Name</td>
                                            <td width="440" colspan="5" class="content_black1"><input type="text" name="FullName" style="width:450px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" value='.$row->firstName.' readonly    /></td>
                                        </tr>
                                        <tr>
                                            <td width="160" class="content_black1">Student ID</td>
                                            <td width="90" class="content_black1"><input type="text" name="StudID" style="width:80px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="9" onkeyup="displayStudEmail(this)" value='.$row->studentid.' readonly /></td>

                                            <td width="65" class="content_black1"><center>
                                                Contact No
                                                </center></td>
                                            <td width="285" colspan="3" class="content_black1"><input type="text" name="ContactNo" style="width:282px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="30" onkeyup="filterNonContactNo(this)" value='.$row->contactno.' readonly/></td>
                                        </tr>
                                        <tr>
                                            <td class="content_black1">Personal E-mail Address</td>
                                            <td colspan="5" class="content_black1"><input type="text" name="Email" style="width:450px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" value='.$row->emailid.' readonly /></td>
                                        </tr>


                                    <tr>
                                        <td class="content_black1">Location</td>
                                        <td colspan="5" class="content_black1">
                                            <input type="checkbox" name="Location" value="Male Hostel" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" onclick="getLocation(1,this.form.Location)" />
                                            Male Hostel
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="Location" value="Female Hostel" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" onclick="getLocation(2,this.form.Location)" />
                                            Female Hostel
                                            &nbsp;&nbsp;&nbsp;

                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="80" class="content_black1">
                                            House / Flat
                                            <br> A - Twin with fan 
                                            <br> B - Single with fan
                                            <br> C - Twin with Air-Cond
                                            <br> D - Single with Air-Cond

                                        </td>

                                        <td width="60" class="content_black1"><input type="text" name="House_Flat" style="width:80px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="4" /></td>
                                        <td width="60" class="content_black1"><center> Room No</center></td>
                                        <td width="60" class="content_black1"><input type="text" name="RoomNo" style="width:60px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="3" onkeyup="filterNonNumeric(this)" value='.$row->roomno.' readonly /></td>
                                        <td width="75" class="content_black1"><center>
                                            Key / Acess Card Returned Date 
                                            </center></td>
                                        <td width="90" class="content_black1">
                                            <input type="date" name="KeyReturnedDate" id="KeyReturnedDate"  style="width:115px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="content_black1"><b>I wish to</b></td>
                                        <td colspan="5" class="content_black1">
                                            <label>
                                                <!-- Semester Break Notification -->
                                                <input type="checkbox" name="Checkout" value="1" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" checked onclick="getCheckout(1,this.form.Checkout)" />
                                                <b>Renewal for Next Semester</b>
                                            </label>
                                            <br />
                                            <label>
                                                <!-- Accommodation Rental Overpayment -->
                                                <input type="checkbox" name="Checkout" value="2" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" onclick="getCheckout(2,this.form.Checkout)" />
                                                <b>Accommodation rental overpayment</b> 
                                            </label>
                                            <br />
                                            <label>
                                                <!-- End Tenancy -->
                                                <input type="checkbox" name="Checkout" value="3" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" onclick="getCheckout(3,this.form.Checkout)" />
                                                <b>Permanent check out - Graduated/Withdrawal</b>
                                            </label>
                                            <br />
                                            <label>
                                                <!-- Move to Private Accommodation -->
                                                <input type="checkbox" name="Checkout" value="4" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" onclick="getCheckout(4,this.form.Checkout)" />
                                                <b>Moving out to private accommodation</b>
                                            </label>

                                            <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <label>
                                                <b>New Address: </b>
                                                <input type="text" name="NewAddress" style="width:500px;" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" disabled="disabled" />
                                            </label>
                                            <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>
                                                <b>Owner Name: </b>&nbsp;
                                                <input type="text" name="OwnerName" style="width:200px;" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" disabled="disabled" />
                                            </label>
                                            <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>
                                                <b>Contact: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="text" name="OwnerContact" style="width:200px;" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" disabled="disabled" />
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td valign="top" class="content_black1"><b>Reasons / Others</b></td>
                                        <td colspan="5" class="content_black1"><input type="text" name="CheckoutReason" style="width:450px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" /></td>
                                    </tr>

                                    <tr>
                                        <td width="160" valign="top" class="content_black1">and to request refund</td>
                                        <td colspan="5" class="content_black1"><input type="checkbox" name="Refund_Deposit" value="Deposit less your charges" onfocus="changeInColor(this);" onblur="changeColorBack(this);" disabled="disabled" />
                                            Deposit less your charges
                                            &nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" name="Refund_Others" value="Others" onfocus="changeInColor(this);" onblur="changeColorBack(this);" onclick="document.CheckoutForm.RefundDetail.focus();" disabled="disabled" />
                                            Others
                                            <input type="text" name="RefundDetail" style="width:210px;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" disabled="disabled" /></td>
                                    </tr>

                                    <tr>
                                        <td valign="top" class="content_black1">by the selected mode of payment</td>
                                        <td colspan="5" class="content_black1"><input type="checkbox" name="Refund_MOP" value="Direct Bank In" onfocus="changeInColor(this);" onblur="changeColorBack(this);" onclick="getRefund_MOP(1,this.form.Refund_MOP)" disabled="disabled" />
                                            Direct Bank In <i>(below RM 25,000 and for Malaysian bank accounts)</i> <br />
                                            <input type="checkbox" name="Refund_MOP" value="TT" onfocus="changeInColor(this);" onblur="changeColorBack(this);" onclick="getRefund_MOP(2,this.form.Refund_MOP)" disabled="disabled" />
                                            Telegraphic Transfer (TT)* in
                                            <input type="text" name="TT_Currency" style="width:100px;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="20" disabled="disabled" />
                                            <i> (foreign currency)</i> <br />
                                            <input type="checkbox" name="Cheque" value="Cheque In" onfocus="changeInColor(this);" onblur="changeColorBack(this);" onclick="getRefund_MOP(3,this.form.Refund_MOP)" disabled="disabled" />
                                            Cheque <i>(above RM25,000 * with RM2.12 charge(GST 6% Inclusive))</i>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="6"><table border="0" width="550" cellpadding="0" cellspacing="2" align="center">
                                            <tr>
                                                <td width="10" valign="top" class="content_black1">*</td>
                                                <td width="10" valign="top" class="content_black1">(1)</td>
                                                <td width="540" class="content_black_small"><i>Please complete the details below. Kindly ensure that the Payee Name and IC/Passport Number are as exactly stated in your Bank Account. If any of this information is wrong, then the refund will be returned by the University Bank. Not only your refund will be delayed but a service charge of RM10.60 (GST 6% Inclusive) shall also be imposed for a replacement.
                                                    </i></td>
                                            </tr>
                                            <tr>
                                                <td width="10" valign="top" class="content_black1"></td>
                                                <td width="10" valign="top" class="content_black1">(2)</td>
                                                <td width="540" class="content_black_small"><i>If you choose Telegraphic Transfer (TT), the cost of bank charges and GST for TT shall be borne by you. Foreign currency T/T shall be translated by the Universtity\'s bank at the prevailing exchange rate on the day of transaction. <b>Please provide a copy of your passport as a bank\'s supporting document for TT</b>.
                                                    </i></td>
                                            </tr>
                                            <tr>
                                                <td width="10" valign="top" class="content_black1"></td>
                                                <td width="10" valign="top" class="content_black1">(3)</td>
                                                <td width="540" class="content_black_small"><i>For the safety of your money, refund to third party other than yourself or your parents is not encouraged unless you are able to prove that you don\'t have a Malaysian bank account <u>AND</u> when the University\'s bank is unable to TT the refund to your home country from Malaysia. In this case, a handwritten authorization letter is required from you, e-mail authorization is not accepted.
                                                    </i></td>
                                            </tr>
                                            </table>
                                            <table border="0" width="580" cellpadding="0" cellspacing="1" align="center">
                                                <tr>
                                                    <td width="30" valign="top"><input type="checkbox" name="Refund_Bank_FName" value="Payee Name" onfocus="changeInColor(this);" onblur="changeColorBack(this);" onclick="getRefund_Bank_FName(1,this.form.Refund_Bank_FName)" disabled="disabled" /></td>
                                                    <td width="280" valign="top" class="content_black1"><b>Payee Name</b><br />
                                                        <span class="content_black_small">(<b><u>Student\'s name</u></b> stated as in their Own bank book)</span></td>
                                                    <td width="270" class="content_black1"><input type="text" name="Bank_FullName" style="width:300px;height:30px;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" disabled="disabled" /></td>
                                                </tr>
                                                <tr>
                                                    <td width="580" colspan="3" class="content_black1"><center>
                                                        <b>OR</b>
                                                        </center></td>
                                                </tr>
                                                <tr>
                                                    <td width="30" valign="top"><input type="checkbox" name="Refund_Bank_FName" value="Parent Name" onfocus="changeInColor(this);" onblur="changeColorBack(this);" onclick="getRefund_Bank_FName(2,this.form.Refund_Bank_FName)" disabled="disabled" /></td>
                                                    <td width="280" valign="top" class="content_black1"><b>Please prepare the cheque under my <u><i>Father\'s / Mother\'s</i></u> Name</b><br />
                                                        <span class="content_black_small">(As stated in their bank book)</span></td>
                                                    <td width="270" class="content_black1"><input type="text" name="Bank_ParentName" style="width:300px;height:30px;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" disabled="disabled" /></td>
                                                </tr>
                                            </table>
                                            <table border="0" width="580" cellpadding="0" cellspacing="1" align="center">
                                                <tr>
                                                    <td width="30">&nbsp;</td>
                                                    <td width="30" class="content_black1">&nbsp;</td>
                                                    <td width="250" valign="top" class="content_black1"> Payee <u><b>IC No</b></u> <i>(for Malaysian)</i> <br />
                                                        Payee <u><b>Passport No</b></u> <i>(for foreigner)</td>
                                                    <td width="270" class="content_black1"><input type="text" name="Payee_ID" style="width:300px;height:30px;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="30" disabled="disabled" />
                                                        <br><font color="orange"><b>All international student needs to provide <u>passport front page</u></b> <br>for bank verification purpose. </font>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="30">&nbsp;</td>
                                                    <td width="30" class="content_black1">&nbsp;</td>
                                                    <td width="250" valign="top" class="content_black1"><b>Bank Account No</b></td>
                                                    <td width="270" class="content_black1"><input type="text" name="Bank_AcctNo" style="width:300px" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="30" disabled="disabled" /></td>
                                                </tr>
                                                <tr>
                                                    <td width="30">&nbsp;</td>
                                                    <td width="30">&nbsp;</td>
                                                    <td width="250" valign="top" class="content_black1">Bank Name</td>
                                                    <td width="270" class="content_black1"><input type="text" name="Bank_Name" style="width:300px" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="50" disabled="disabled" /></td>
                                                </tr>
                                                <tr>
                                                    <td width="30">&nbsp;</td>
                                                    <td width="30">&nbsp;</td>
                                                    <td width="250" valign="top" class="content_black1">Bank Address</td>
                                                    <td width="270" class="content_black1"><input type="text" name="Bank_Address" style="width:300px" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" disabled="disabled" /></td>
                                                </tr>						
                                                <tr>
                                                    <td width="30">&nbsp;</td>
                                                    <td width="30">&nbsp;</td>
                                                    <td width="250" valign="top" class="content_black1">Bank Swift Code<br />
                                                        <span class="content_black_small">(International Bank T/T only)</span></td>
                                                    <td width="270" class="content_black1"><input type="text" name="Bank_Swift_Code" style="width:300px" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="20" /></td>
                                                </tr>
                                            </table>
                                            <table border="0" width="580" cellpadding="0" cellspacing="2" align="center">
                                                <tr>
                                                    <td width="20"><input type="checkbox" name="Agree_Refund_Term" onfocus="changeInColor(this);" onblur="changeColorBack(this);" disabled="disabled" required /></td>
                                                    <td colspan="2" class="content_black1"> I understand that the process of refund is subject to the reasons below, and agree
                                                        not to hold the University liable for late payment of refund should the conditions
                                                        not be met &amp;/or due to other unforeseen circumstances:</td>
                                                </tr>
                                                <tr>
                                                    <td width="20">&nbsp;</td>
                                                    <td width="10" valign="top"><center>
                                                        •
                                                        </center></td>
                                                    <td width="550"class="content_black1">Completion of documentation; and</td>
                                                </tr>
                                                <tr>
                                                    <td width="20">&nbsp;</td>
                                                    <td width="10" valign="top"><center>
                                                        •
                                                        </center></td>
                                                    <td width="550"class="content_black1">Quotation to repair &amp;/or replace damaged assets (if any); and</td>
                                                </tr>
                                                <tr>
                                                    <td width="20">&nbsp;</td>
                                                    <td width="10" valign="top"><center>
                                                        •
                                                        </center></td>
                                                    <td width="550"class="content_black1">Availability of utilities bill up to expiry of tenancy for calculation of excess utilities to be charged; and</td>
                                                </tr>
                                                <tr>
                                                    <td width="20">&nbsp;</td>
                                                    <td width="10" valign="top"><center>
                                                        •
                                                        </center></td>
                                                    <td width="550"class="content_black1">Outstanding fees (other than student housing related) owing to the University.</td>
                                                </tr>
                                            </table></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" class="content_black1"><b>Check Out Date</b> &nbsp;
                                            <input type="date" name="CheckoutDate" id="CheckoutDate" style="width:150px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" required />
                                        </td>
                                        <td colspan="3" class="content_black1"><b>Check Out Time</b> &nbsp;
                                            <select name="CheckoutTime" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);">
                                                <option value=""> </option>
                                                <option value="9:00 am">9:00 am </option>
                                                <option value="9:30 am">9:30 am </option>
                                                <option value="10:00 am">10:00 am </option>
                                                <option value="10:30 am">10:30 am </option>
                                                <option value="11:00 am">11:00 am </option>
                                                <option value="11:30 am">11:30 am </option>
                                                <option value="12:00 pm">12:00 pm </option>
                                                <option value="12:30 pm">12:30 pm </option>
                                                <option value="1:00 pm">1:00 pm </option>
                                                <option value="1:30 pm">1:30 pm </option>
                                                <option value="2:00 pm">2:00 pm </option>
                                                <option value="2:30 pm">2:30 pm </option>
                                                <option value="3:00 pm">3:00 pm </option>
                                                <option value="3:30 pm">3:30 pm </option>
                                                <option value="4:00 pm">4:00 pm </option>
                                                <option value="4:30 pm">4:30 pm </option>
                                                <option value="5:00 pm">5:00 pm </option>
                                            </select></td>
                                    </tr>

                                    <tr>

                                        <td colspan="3" class="content_black1">
                                            Date &nbsp;
                                            <input type="text" name="Submission_Date" style="width:80px" value='.date('Y/m/d').' readonly="readonly" /></td>
                                    </tr>

                                </table>

                                <input type="hidden" name="Location_field" value="" />
                                <input type="hidden" name="Checkout_field" value="" />
                                <input type="hidden" name="Refund_MOP_field" value="" />
                                <input type="hidden" name="Refund_Name_field" value="" />
                                <br />

                                <table border="0" width="600" cellpadding="0" cellspacing="2">
                                    <tr>
                                        <td><p align="center">
                                            <input type="submit" value="Submit" name="submit" />
                                            &nbsp;
                                            <input type="reset" value="Reset" name="B2" />
                                            </p></td>
                                    </tr>
                                </table>';
                                }
                                ?>	<!-- enclose table(form) in php to hide if already checked out (and also escape \') -->
                            </form>
                        </div>
                    </div>

                    <div class="clearing"></div>     

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

        <script language="JavaScript" type="text/javascript" src="Checkout.js"></script>

    </body>

</html>
