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

    if($row->CheckinStatus == true)
    {
        echo"<script>alert('You cant check-out more than an one time! You are already CHECKED in!');</script>";
    }


    else{
        $studentid=$row->studentid;
        $email=$row->emailid;
        $CheckinStatus="1";
        $CheckoutStatus="0";

        $CheckinDate = $_POST['CheckinDate'];
        $AcessCardNum = $_POST['AcessCardNum'];

        $query = "update registration SET CheckoutStatus = '$CheckoutStatus',  CheckinStatus = '1',  CheckinDate='$CheckinDate', AcessCardNum='$AcessCardNum' WHERE studentid = '$studentid' ";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();


        echo"<script>alert('You have sucessfully checked in! please kindly refer to your e-mail');</script>";


        $mail = new PHPMailer;

        $mail->isSMTP();                                   // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                            // Enable SMTP authentication
        $mail->Username = 'samuelo0otiong1996@gmail.com';          // SMTP username
        $mail->Password = 'stck1996'; // SMTP password
        $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                 // TCP port to connect to

        $mail->setFrom('samuelo0otiong1996@gmail.com', 'SwinburneHousing');
        $mail->addReplyTo('samuelo0otiong1996@gmail.com', 'SwinburneHousing');
        $mail->addAddress($email);   // Add a recipient
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        $mail->isHTML(true);  // Set email format to HTML

        $bodyContent = '<h1>Swinburne Housing System - You have checked in sucessfully</h1>';
        $bodyContent .= '<p>hello</b></p>';
        $bodyContent .= "You have received a new message. ".
            " Here are the details:\n StudentID: $studentid \n ";

        $mail->Subject = 'Email from Swinbune housing';
        $mail->Body    = $bodyContent;

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
        <title>Check In</title>
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

        <script language="JavaScript1.1" type="text/javascript">
            function submitForm(value) 
            {	if ( value == "staff" ) { document.SearchGroup.action = "/staff/indexlist.asp" }
             else{ document.SearchGroup.action = "http://www.swinburne.edu.my/cse_result.htm" };
             document.SearchGroup.submit();
            };
            // -->
        </script>


        <script language="JavaScript" type="text/javascript" src="Checkout.js"></script>

        <!--<link media="only screen and (max-device-width: 480px)" 
href="local/css/iphone.css" type="text/css" rel="stylesheet" />-->
        <!--YB
<link href="http://global.swinburne.edu.au/template/css/whats_on.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://global.swinburne.edu.au/js/whats_on/jquery.coda-slider-2.0.js"></script>
<script type="text/javascript" src="http://global.swinburne.edu.au/js/whats_on/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="http://global.swinburne.edu.au/js/whats_on/slider-initiate.js"></script><link href="http://global.swinburne.edu.au/template/css/news.css" rel="stylesheet" type="text/css" />
-->
        <style type="text/css">
            <!--
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
            -->
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
                            <h1><br />
                                Check-In form
                            </h1>

                            <p class="title">&nbsp;</p>
                            <form action="" method="post" name="CheckoutForm" id="CheckoutForm" onsubmit="return checkEmpty();" >

                                <?php

                                $aid=$_SESSION['studentid'];
                                $ret="select * from registration where studentid=?";
                                $stmt= $mysqli->prepare($ret) ;
                                $stmt->bind_param('i',$aid);
                                $stmt->execute() ;//ok
                                $res=$stmt->get_result();
                                //$cnt=1;
                                $row=$res->fetch_object();


                                if($row->CheckinStatus == 1)
                                { ?>
                                <h3 style="color: red" align="left">You are alraedy CHECK IN!</h3>
                                <?php }
                                else{
                                    echo "";
                                }			
                                ?>	



                                <table class="Form_Table" border="1" width="660" cellspacing="0">
                                    <tr><h3>FACILTIES PROVIDED</h3></tr>
                                    <tr>
                                        <th>No</th>
                                        <th>Item</th> 
                                        <th>Condition <br> O=OK <br> F=Need Fixing <br> NA=Not Available</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Bed</td>
                                        <td><input type="text" name="Bed" id="Bed" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
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
                                        <td><input type="text" name="Fan" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Others</td>
                                        <td><input type="text" name="Others" style="background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" /></td>
                                    </tr>


                                </table>
                                <br>
                                <br>


                                <table class="Form_Table" border="1" width="660" cellspacing="0">
                                    <tr><h3>STUDENT'S DECLARATION</h3></tr>

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

                                    <tr>
                                        <td width="160" class="content_black1">Student Name</td>
                                        <td width="440" colspan="5" class="content_black1"><input type="text" name="FullName" style="width:450px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" value="<?php echo $row->firstName;?>" readonly    /></td>
                                    </tr>
                                    <tr>
                                        <td width="160" class="content_black1">Student ID</td>
                                        <td width="90" class="content_black1"><input type="text" name="StudID" style="width:80px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="9" onkeyup="displayStudEmail(this)" name="studentid" value="<?php echo $row->studentid;?>" readonly /></td>

                                        <td width="65" class="content_black1"><center>
                                            Contact No
                                            </center></td>
                                        <td width="285" colspan="3" class="content_black1"><input type="text" name="ContactNo" style="width:282px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="30" onkeyup="filterNonContactNo(this)" value="<?php echo $row->contactNo;?>" readonly/></td>
                                    </tr>
                                    <tr>
                                        <td class="content_black1">Personal E-mail Address</td>
                                        <td colspan="5" class="content_black1"><input type="text" name="Email" style="width:450px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" value="<?php echo $row->email;?>" readonly /></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="content_black1">Building</td>
                                        <td colspan="5" class="content_black1" required>
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
                                        <td width="60" class="content_black1"><input type="text" name="RoomNo" style="width:60px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="3" onkeyup="filterNonNumeric(this)" /></td>


                                        <td width="125" class="content_black1"><center>Acess Card Number</center></td>
                                        <td width="90" class="content_black1"><input type="text" name="AcessCardNum" id="AcessCardNum" style="width:60px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="3" onkeyup="filterNonNumeric(this)" required /></td>

                                    </tr>



                                    <tr>
                                        <td colspan="3" class="content_black1"><b>Check In Date</b> &nbsp;

                                            <input type="date" name="CheckinDate" id="CheckinDate"  style="width:150px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);">

                                        <td colspan="3" class="content_black1"><b>Check In Time</b> &nbsp;
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

                                        <td colspan="6" class="content_black1">
                                            Date &nbsp;
                                            <input type="text" name="Submission_Date" style="width:80px" value="<?php echo date('Y/m/d');?>" readonly="readonly" /></td>
                                    </tr>



                                    <tr>
                                        <td colspan="6"> i do hereby agree to pay for any damages or loss to the items listed above due to my negligence. I also have read the hostel rules of occupancy &amp; agreed to abide by the code of behavior in hostel <br> <input type="checkbox"/>  </td>  
                                    </tr>


                                </table>

                                <input type="hidden" name="Location_field" value="" />
                                <input type="hidden" name="Checkout_field" value="" />
                                <input type="hidden" name="Refund_MOP_field" value="" />
                                <input type="hidden" name="Refund_Name_field" value="" />
                                <br />


                                <p>Sugeestions for improvements/ Remakrk if(any):</p>

                                <p>
                                    <input type="text" name="suggestions" style="width:660px;background-color:#FFFFAA;" onfocus="changeInColor(this);" onblur="changeColorBack(this);" maxlength="100" />
                                </p>

                                <table border="0" width="600" cellpadding="0" cellspacing="2">

                                    <tr>
                                        <td><p align="center">
                                            <input type="submit" value="Submit" name="submit" />
                                            &nbsp;
                                            <input type="reset" value="Reset" name="B2" />
                                            </p></td>
                                    </tr>
                                </table>




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





    </body>

</html>





