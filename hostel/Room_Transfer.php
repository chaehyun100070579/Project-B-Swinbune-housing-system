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
        <title>Room Transfer</title>
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

        <script type="text/javascript">
            function ValInput()
            {

                if (document.frmTransfer.Tr_Name.value.length <= 0)
                { alert('Please enter your name.');
                 document.frmTransfer.Tr_Name.focus();
                 return false;
                }

                if (document.frmTransfer.Tr_StudID.value.length <= 0)
                { alert('Please enter your Student ID.');
                 document.frmTransfer.Tr_StudID.focus();
                 return false;
                }

                if (document.frmTransfer.Tr_ICpassport.value.length <= 0)
                { alert('Please enter your IC or Passport No.');
                 document.frmTransfer.Tr_ICpassport.focus();
                 return false;
                }

                if (document.frmTransfer.Tr_Tel.value.length <= 0)
                { alert('Please enter your contact no.');
                 document.frmTransfer.Tr_Tel.focus();
                 return false;
                }

                if (document.frmTransfer.Tr_Email.value.length <= 0)
                { alert('Please enter your email.');
                 document.frmTransfer.Tr_Email.focus();
                 return false;
                }

                if (document.frmTransfer.Tr_Reason.value.length <= 0)
                { alert('Please enter reason to transfer room.');
                 document.frmTransfer.Tr_Reason.focus();
                 return false;
                }

                if (!document.frmTransfer.AcceptTerm.checked){
                    alert('Please check the box to confirm that you understand and accept the terms & condition to continue.');
                    return false;
                }

                var confirm_form = confirm ("Confirm to Submit Room Transfer Request?")
                if (!confirm_form)
                    return false;

            }

        </script>  

        <meta name="Microsoft Border" content="b">
        
    </head>

    <body>
        <?php include('includes/header.php');?>

        <div class="ts-main-content">
            <?php include('includes/sidebar.php');?>
            <div class="content-wrapper">
                <div class="container-fluid">

                    <form method="POST" form enctype="multipart/form-data" name="frmTransfer" action="tr_SaveApp.php" onSubmit="return ValInput();">

                        <table border="0" style="border-collapse: collapse; font-family:Verdana" width="95%" id="table1" cellpadding="0">
                            <br>
                            <br>
                            <br>
                            <tr>
                                <td style="border-left-style: solid; border-left-width: 1px; border-right-style: 1px; border-right-width: medium; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" width="69%" height="76">
                                    <p align="center"><font size="5" face="Calibri">University Accommodation 
                                        - Room Transfer Request Form</font>
                                    </p>
                                </td>
                                <td style="border-left-style: none; border-left-width: medium; border-right-style: solid; border-right-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" width="31%" height="76">
                                    <p align="center"></p>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-left-style: solid; border-left-width: 1px; border-right-style: none; border-right-width: medium; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" valign="bottom" bgcolor="#B1D6CC" width="80%">
                                    <font face="Calibri">
                                        <font color="#000080"><b><font style="font-size: 9pt">&nbsp;</font>Personal 
                                            Details</b>&nbsp; </font>
                                    </font>
                                </td>
                                <td style="border-left-style: none; border-left-width: medium; border-right-style: solid; border-right-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" valign="bottom" bgcolor="#B1D6CC" width="20%">
                                    &nbsp;<b><font color="#000080" face="Calibri" style="font-size: 11pt">Room 
                                        Transfer Request Form</font></b>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-left-style: none; border-left-width: medium; border-right-style: solid; border-right-width: 1px; border-top-style: none; border-top-width: medium; " height="95" colspan="2">
                                    <table border="1" cellspacing="0" style="border-collapse: collapse; border-right-width: 0px; border-top-width: 0px; border-bottom-width: 0px" width="100%" id="table2" cellpadding="0" height="107">
                                        <font face="Calibri">
                                            <tr>
                                                <td width="110" style="border-left: 1px solid #C0C0C0; border-right-style: solid; border-right-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" height="20">
                                                    <font face="Calibri">
                                                        <span style="font-size: 11pt; font-weight:700">&nbsp;Name</span>
                                                    </font>
                                                </td>
                                                <td style="border-style: solid; border-width: 1px; font-family:Calibri; border-right: medium none #808080; font-size:11pt" height="20">
                                                    <font color="#000080">&nbsp;</font>
                                                    <font face="Calibri"><input type="text" name="Tr_Name" size="45"></font>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="110" style="border-left: 1px solid #C0C0C0; border-right-style: solid; border-right-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" height="22">
                                                    <font face="Calibri">
                                                        <span style="font-size: 11pt; font-weight:700">&nbsp;Gender</span>
                                                    </font>
                                                </td>
                                                <td style="border-style: solid; border-width: 1px; font-family:Calibri; border-right: medium none #808080; font-size:11pt" height="22">
                                                    <font face="Calibri">
                                                        <span style="font-size: 11pt">&nbsp;</span>
                                                    </font>

                                                    <label>
                                                        <span style="font-size: 9pt">
                                                            <input type="radio" value="Male" name="Gender" checked tabindex="7">
                                                        </span>
                                                        Male&nbsp;
                                                    </label>
                                                    <label>
                                                        <span style="font-size: 9pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="radio" value="Female" name="Gender" tabindex="8">
                                                        </span>
                                                        Female
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="110" style="border-left: 1px solid #C0C0C0; border-right-style: solid; border-right-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" height="22">
                                                    <font face="Calibri">
                                                        <span style="font-size: 11pt; font-weight:700">&nbsp;Course
                                                        </span>
                                                    </font>
                                                </td>
                                                <td style="border-style: solid; border-width: 1px; font-family:Calibri; border-right: medium none #808080; font-size:11pt" height="22">
                                                    <font face="Calibri">
                                                        <span style="font-size: 11pt">&nbsp;</span>
                                                    </font>

                                                    <label>
                                                        <span style="font-size: 11pt"><font face="Calibri">
                                                            <input type="radio" name="Course" value="Foundation" id="foundation" onclick="returnMinPay5();" tabindex="2"></font>
                                                        </span>Foundation
                                                    </label>

                                                    <span style="font-size: 9pt">&nbsp;&nbsp;
                                                    </span>

                                                    <label>
                                                        <span style="font-size: 11pt"><font face="Calibri">
                                                            <input type="radio" name="Course" value="Others" onclick="returnMinPay3();" tabindex="3"></font>
                                                        </span>Others&nbsp;&nbsp;&nbsp; 
                                                    </label>


                                                    <label>
                                                        <span style="font-size: 11pt"><font face="Calibri">
                                                            <input type="radio" value="Degree" checked name="Course" id="degree" onclick="returnMinPay5();" tabindex="4"></font>
                                                        </span>Degree&nbsp;&nbsp;
                                                    </label>


                                                    <label>
                                                        <span style="font-size: 11pt"><font face="Calibri">
                                                            <input type="radio" name="Course" value="Master" id="Master" onclick="returnMinPay5();" tabindex="5"></font>
                                                        </span>Master
                                                    </label>

                                                    <span style="font-size: 9pt">&nbsp;&nbsp;
                                                    </span>

                                                    <label>
                                                        <span style="font-size: 11pt"><font face="Calibri">
                                                            <input type="radio" value="PhD" name="Course" id="PhD" onclick="returnMinPay35();" tabindex="6"></font>
                                                        </span>PhD
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="110" style="border-left: 1px solid #C0C0C0; border-right-style: solid; border-right-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" height="22">
                                                    <font face="Calibri">
                                                        <span style="font-size: 11pt; font-weight:700">&nbsp;Student ID</span>
                                                    </font>
                                                </td>
                                                <td style="border-style: solid; border-width: 1px; font-family:Calibri; border-right: medium none #808080; font-size:11pt" height="22">
                                                    <font color="#000080">&nbsp;</font>
                                                    <font face="Calibri"><input type="text" name="Tr_StudID" size="9"></font>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="110" style="border-left: 1px solid #C0C0C0; border-right-style: solid; border-right-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" height="22">
                                                    <font face="Calibri">
                                                        <span style="font-size: 11pt; font-weight:700">&nbsp;IC/Passport No.</span>
                                                    </font>
                                                </td>
                                                <td style="border-style: solid; border-width: 1px; font-family:Calibri; border-right: medium none #808080; font-size:11pt" height="22" >
                                                    <font face="Calibri" color="Navy">
                                                        <span style="font-size: 11pt">&nbsp;</span>
                                                    </font>
                                                    <font face="Calibri"><input type="text" name="Tr_ICpassport" size="18"></font>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="110" style="border-left: 1px solid #C0C0C0; border-right-style: solid; border-right-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" height="22">
                                                    <font face="Calibri">
                                                        <span style="font-size: 11pt; font-weight:700">&nbsp;Tel (Hp)</span>
                                                    </font>
                                                </td>
                                                <td width="1085" style="border-left-style: solid; border-left-width: 1px; border-right: medium none #808080; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" height="22">
                                                    <font face="Calibri" color="Navy">
                                                        <span style="font-size: 11pt">&nbsp;</span>
                                                    </font>
                                                    <font face="Calibri"><input type="text" name="Tr_Tel" size="18"></font>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="110" style="border-left: 1px solid #C0C0C0; border-right-style: solid; border-right-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" height="22">
                                                    <font face="Calibri">
                                                        <span style="font-size: 11pt; font-weight:700">&nbsp;Email</span>
                                                    </font>
                                                </td>
                                                <td width="1085" style="border-left-style: solid; border-left-width: 1px; border-right: medium none #808080; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px" height="22">
                                                    <font face="Calibri" color="Navy">
                                                        <span style="font-size: 11pt">&nbsp;</span>
                                                    </font>
                                                    <font face="Calibri"><input type="text" name="Tr_Email" size="45"></font>
                                                </td>
                                            </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-left-style: solid; border-left-width: 1px; border-right-style: solid; border-right-width: 1px; border-top-style: solid; border-top-width: 1px; border-bottom-style: none; border-bottom-width: 1px" colspan="2">
                                    <table border="1" cellspacing="0" style="border-width:0px; border-collapse: collapse; " id="table3" cellpadding="0" width="100%">
                                        <tr>
                                            <font face="Calibri">
                                                <td width="100%" style="border-left: medium none #C0C0C0; border-right-style: none; border-right-width: medium; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium" height="22" colspan="4" bgcolor="#B1D6CC">
                                                    <font face="Calibri">
                                                        <span style="font-size: 11pt; font-weight: 700">&nbsp;<font color="#000080">Change To 
                                                            Room Below (Please select room type)</font>
                                                        </span>
                                                    </font>
                                                </td>
                                            </font>
                                        </tr>				
                                        <tr>
                                            <td style="border-left: medium none #C0C0C0; border-right-style: none; border-right-width: medium; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium" height="22">
                                                <font face="Calibri">
                                                    <span style="font-size: 11pt; font-weight: 700">&nbsp;Room Type </span>
                                                </font>
                                            </td>
                                            <td style="border-style:none; border-width:medium; " height="22">
                                                <font face="Calibri">
                                                    <span style="font-size: 11pt">&nbsp;:</span>
                                                </font>
                                            </td>
                                            <td style="border-style:none; border-width:medium; font-family:Verdana; font-size:9pt; " height="22" colspan="2">&nbsp;<font FACE="GillSansMT" style="font-size: 9pt">
                                                <select size="1" name="Tr_Choice" style="font-family: Calibri; font-size: 11pt" tabindex="31">				

                                                    <OPTION VALUE="1">Single Room Fan RM550/person/month
                                                        <OPTION VALUE="2">Single Room Air-Conditioned RM600/person/month
                                                            <OPTION VALUE="3">Twin-Sharing Fan RM340/person/month
                                                                <OPTION VALUE="4">Twin-Sharing Air-Conditioned RM420/person/month
                                                </select></font>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td width="14%" style="border-left: medium none #C0C0C0; border-right-style: none; border-right-width: medium; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium" height="22" valign="top">
                                                <p align="left">
                                                    <font face="Calibri">
                                                        <span style="font-size: 11pt; font-weight: 700">&nbsp;Reason</span>
                                                    </font>
                                                </p>
                                            </td>
                                            <td style="border-style:none; border-width:medium; " width="1%" height="22" valign="top">
                                                <font face="Calibri">
                                                    <span style="font-size: 11pt">&nbsp;:</span>
                                                </font>
                                            </td>
                                            <td width="85%" style="border-style:none; border-width:medium; font-family:Verdana; font-size:9pt; " height="22" colspan="2">
                                                &nbsp;<textarea rows="5" name="Tr_Reason" cols="64"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="14%" style="border-left: medium none #C0C0C0; border-right-style: none; border-right-width: medium; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium" height="22">&nbsp;
                                            </td>
                                            <td style="border-style:none; border-width:medium; " width="1%" height="22">&nbsp;
                                            </td>
                                            <td width="2%" style="border-style:none; border-width:medium; font-family:Verdana; font-size:9pt; " height="50" valign="top">
                                                <font FACE="Calibri" style="font-size: 11pt">
                                                    <br>
                                                    <input type="checkbox" name="AcceptTerm" value="OFF" tabindex="28">
                                                    <br>
                                                    &nbsp;
                                                </font>
                                            </td>
                                            <td width="83%" style="border-style:none; border-width:medium; font-family:Verdana; font-size:9pt; " height="50">
                                                <font FACE="Calibri" style="font-size: 11pt">
                                                    <br>
                                                    Please check this box to confirm that you understand and accept 
                                                    the
                                                    <a target="_blank" href="http://http://housing-recreation.swinburne.edu.my/housing-services/current-resident/rules-regulations/">
                                                        Swinburne Housing Rules and Regulations</a> before signing and 
                                                    submitting this form to avoid future disputes. I understand that 
                                                    there is a need for me to apply to Housing Services if I wish to 
                                                    CHANGE my room/flat/university accommodation. I also understand 
                                                    that changing room will have to be done within the stipulated 
                                                    date determine by Housing Services. If the request for a change 
                                                    of room is done NOT within the stipulated date, a <b>CHANGING 
                                                    ROOM FEE of RM53(inclusive GST 6%) will apply</b>. <br>
                                                    &nbsp;
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="14%" style="border-left: medium none #C0C0C0; border-right-style: none; border-right-width: medium; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium" height="22">&nbsp;
                                            </td>
                                            <td style="border-style:none; border-width:medium; " width="1%" height="22">&nbsp;
                                            </td>
                                            <td width="85%" style="border-style:none; border-width:medium; font-family:Verdana; font-size:9pt; " colspan="2">
                                                &nbsp;<input type="submit" value="Submit" name="btn_Transfer" style="font-family: Calibri; font-size: 11pt">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td style="border-left-style: solid; border-left-width: 1px; border-right-style: solid; border-right-width: 1px; border-top-style: none; border-top-width: medium; border-bottom-style: solid; border-bottom-width: 1px" height="22" valign="bottom" colspan="2">&nbsp;
                                </td>
                            </tr>
                    </form>
                </table>
                        

                        <table border="1" cellspacing="1" style="border-collapse: collapse; border-width: 0px" width="95%" id="table1">
                            <tr>
                                <td style="border-style: none; border-width: medium" bgcolor="#B1D6CC">
                                    <p align="center">
                                        <font face="Calibri" size="2">
                                            I consent to the collection, use, processing, disclosure and retention by Swinburne University and Swinburne Sarawak of my personal data (and any sensitive personal data as defined by the Personal data Protection Act 2010, where applicable) under the terms of Swinburne University’s Privacy Policy and the Personal Data Protection Act 2010 in Malaysia. (Please visit us at www.swinburne.edu.my/privacy/PDPA%20Notice.pdf to view our Personal Data Protection Notice in accordance to the Personal Data Protection Act 2010.)
                                        </font>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-style: none; border-width: medium" bgcolor="#B1D6CC">
                                    <p align="center">
                                        <font face="Calibri" style="font-size: 9pt">
                                            Swinburne University, Malaysia, CDT 250, 98009 Miri, Sarawak, 
                                            Malaysia. Email: <a href="mailto:housing@swinburne.edu.my">
                                            housing@swinburne.edu.my</a>
                                        </font>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-style: none; border-width: medium" bgcolor="#B1D6CC">
                                    <p align="center">
                                        <font face="Calibri" size="2">
                                            Best View with Internet Explorer 1280 by 1024 pixels
                                        </font>
                                    </p>
                                </td>
                            </tr>	
                        </table>
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








