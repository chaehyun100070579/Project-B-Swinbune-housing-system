<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
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
        <title>Room Details</title>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-social.css">
        <link rel="stylesheet" href="css/bootstrap-select.css">
        <link rel="stylesheet" href="css/fileinput.min.css">
        <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
        <link rel="stylesheet" href="css/style.css">

        <script language="javascript" type="text/javascript">
            var popUpWin=0;
            function popUpWindow(URLStr, left, top, width, height)
            {	
                // http://localhost/hostel/admin/full-profile.php?id=$row->id
                var url = location.href; // entire url including querystring - also: window.location.href;
                var baseURL = url.substring(0, url.indexOf('/', 14));
                if (baseURL.indexOf('http://localhost') != -1) 
                {
                    // Base Url for localhost
                    var url = location.href; // window.location.href;
                    var pathname = location.pathname; // window.location.pathname;
                    var index1 = url.indexOf(pathname);
                    var index2 = url.indexOf("/", index1 + 1);
                    var baseLocalUrl = url.substr(0, index2);
                    var baseLocalUrl2 = baseLocalUrl.concat(URLStr);
                    // return baseLocalUrl + "/";
            
                    if(popUpWin)
                    {
                        if(!popUpWin.closed) popUpWin.close();
                    }
                    popUpWin = open(baseLocalUrl2,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+510+',height='+430+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
            
                }
                else 
                {
                    // Root Url for domain name
                    // return baseURL + "/";
                    var baseURL2 = baseURL.concat(URLStr);
                    if(popUpWin)
                    {
                        if(!popUpWin.closed) popUpWin.close();
                    }
                    popUpWin = open(baseURL2,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+510+',height='+430+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
            
                }
            
                // if(popUpWin)
                // {
                // 	if(!popUpWin.closed) popUpWin.close();
                // }
                // popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+510+',height='+430+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
            }
            
            function getBaseURL() // dynamic url for localhost
            {
                var url = location.href; // entire url including querystring - also: window.location.href;
                var baseURL = url.substring(0, url.indexOf('/', 14));
                if (baseURL.indexOf('http://localhost') != -1) 
                {
                    // Base Url for localhost
                    var url = location.href; // window.location.href;
                    var pathname = location.pathname; // window.location.pathname;
                    var index1 = url.indexOf(pathname);
                    var index2 = url.indexOf("/", index1 + 1);
                    var baseLocalUrl = url.substr(0, index2);
                    
                    return baseLocalUrl + "/";
                }
                else 
                {
                    // Root Url for domain name
                    return baseURL + "/";
                }
                
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
                            <br/>
                            <br/>
                            <h2 class="page-title">Rooms Details</h2>
                            <div class="panel panel-default">
                                <div class="panel-heading">All Room Details</div>

                                <div class="panel-body">
                                    <table id="zctb" class="table table-bordered " cellspacing="0" width="100%">


                                        <tbody>
                                            <?php	
                                            $aid=$_SESSION['login'];
                                            $ret="select * from registration where emailid=?";
                                            $stmt= $mysqli->prepare($ret) ;
                                            $stmt->bind_param('s',$aid);
                                            $stmt->execute() ;
                                            $res=$stmt->get_result();
                                            $cnt=1;
                                            while($row=$res->fetch_object())
                                            {
                                            ?>

                                            <tr>
                                                <td colspan="4"><h4>Room Related Info</h4></td>
                                                <td><a href="javascript:void(0);"  onClick="popUpWindow('/hostel/full-profile.php?id=<?php echo $row->emailid;?>');" title="View Full Details">Print Data</a></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"><b>Reg Date :<?php echo $row->postingDate;?></b></td>
                                            </tr>


                                            <tr>
                                                <td><b>Room no :</b></td>
                                                <td><?php echo $row->roomno;?></td>
                                                <td><b>Single or Twin:</b></td>
                                                <td><?php echo $row->seater;?></td>
                                                <td><b>Fees PM :</b></td>
                                                <td><?php echo $fpm=$row->feespm;?></td>
                                            </tr>

                                            <tr>

                                                <td><b>Stay From :</b></td>
                                                <td><?php echo $row->stayfrom;?></td>
                                                <td><b>Duration:</b></td>
                                                <td><?php echo $dr=$row->duration;?> Weeks</td>
                                            </tr>

                                            <tr>
                                                <td colspan="6"><b>Total Fee : 
                                                    <?php 
                                                {
                                                echo $dr*$fpm;
                                            }
                                                    ?></b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"><h4>Personal Info</h4></td>
                                            </tr>

                                            <tr>
                                                <td><b>Student ID :</b></td>
                                                <td><?php echo $row->studentid;?></td>
                                                <td><b>Full Name :</b></td>
                                                <td><?php echo $row->firstName;?>&nbsp;<?php echo $row->middleName;?>&nbsp;<?php echo $row->lastName;?></td>
                                                <td><b>Email :</b></td>
                                                <td><?php echo $row->emailid;?></td>
                                            </tr>


                                            <tr>
                                                <td><b>Contact No. :</b></td>
                                                <td><?php echo $row->contactno;?></td>
                                                <td><b>Gender :</b></td>
                                                <td><?php echo $row->gender;?></td>
                                                <td><b>Course :</b></td>
                                                <td><?php echo $row->course;?></td>
                                            </tr>


                                            <tr>
                                                <td><b>Emergency Contact No. :</b></td>
                                                <td><?php echo $row->egycontactno;?></td>
                                                <td><b>Guardian Name :</b></td>
                                                <td><?php echo $row->guardianName;?></td>
                                                <td><b>Guardian Relation :</b></td>
                                                <td><?php echo $row->guardianRelation;?></td>
                                            </tr>

                                            <tr>
                                                <td><b>Guardian Contact No. :</b></td>
                                                <td colspan="6"><?php echo $row->guardianContactno;?></td>
                                            </tr>

                                            <tr>
                                                <td colspan="6"><h4>Addresses</h4></td>
                                            </tr>
                                            <tr>
                                                <td><b>Correspondense Address</b></td>
                                                <td colspan="2">
                                                    <?php echo $row->corresAddress;?><br />
                                                    <?php echo $row->corresCIty;?>, <?php echo $row->corresPincode;?><br />
                                                    <?php echo $row->corresState;?>


                                                </td>
                                                <td><b>Permanent Address</b></td>
                                                <td colspan="2">
                                                    <?php echo $row->pmntAddress;?><br />
                                                    <?php echo $row->pmntCity;?>, <?php echo $row->pmntPincode;?><br />
                                                    <?php echo $row->pmnatetState;?>	

                                                </td>
                                            </tr>


                                            <?php
                                                $cnt=$cnt+1;
                                            } ?>
                                        </tbody>
                                    </table>

                                    <?php

                                    $aid=$_SESSION['studentid'];
                                    $ret="select * from registration where studentid=?";
                                    $stmt= $mysqli->prepare($ret) ;
                                    $stmt->bind_param('i',$aid);
                                    $stmt->execute() ;//ok
                                    $res=$stmt->get_result();
                                    $row=$res->fetch_object();
                            
                                    if($row->TotalPaymentStatus == "1")
                                    {
                                        echo '<h3 style="color: blue" align="left">TotalFee is already Paid!</h3>';
                                    }
                                        
                                    else{
                                        echo'
                                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

                                            <input type="hidden" name="cmd" value="_xclick">

                                            <input type="hidden" name="business" value="SwinburneHousingMerchant@gmail.com">

                                            <input type="hidden" name="item_name" value="Total room rental fee">

                                            <input type="hidden" name="item_number" value="0001">

                                            <input type="hidden" name="currency_code" value="MYR">

                                            <input type="hidden" name="amount" value=" '.$dr*$fpm.'">

                                            <input type="hidden" name="custom" value="">

                                            <input type="hidden" name="charset" value="UTF-8">

                                            <input type="hidden" name="return"  value ="http://localhost/Swinburne%20hostel%20webstie17/hostel/PaypalPdtIndexForTotalPayment.php" />

                                            <input type="submit" id ="submitBtn"value="Pay Total fee:'.$dr*$fpm.' "
                                            class="btn btn-primary" onclick="submitform()">
                                            </form>';
                                    }
                                    ?>

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