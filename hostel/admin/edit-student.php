<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for add courses


if($_POST['submit'])
{

    $id=$_GET['id'];


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
    $query="update registration set roomno=?,seater=?,feespm=?,stayfrom=?,duration=?,course=?,studentid=?,firstName=?,middleName=?,lastName=?,gender=?,contactno=?,emailid=?,egycontactno=?,guardianName=?,guardianRelation=?,guardianContactno=?,corresAddress=?,corresCIty=?,corresState=?,corresPincode=?,pmntAddress=?,pmntCity=?,pmnatetState=?,pmntPincode=? where id=?";

    if ( $stmt = $mysqli->prepare($query) )
    {

        $rc=$stmt->bind_param('iiisisissssisississsisssii',$roomno,$seater,$feespm,$stayfrom,$duration,$course,$studentid,$fname,$mname,$lname,$gender,$contactno,$emailid,$emcntno,$gurname,$gurrelation,$gurcntno,$caddress,$ccity,$cstate,$cpincode,$paddress,$pcity,$pstate,$ppincode,$id);

        $stmt->execute();
        $stmt->close();

    }else{
        die("Errormessage:.". $mysqli->error);
    }




    $query2="update userregistration set firstName=?,middleName=?,lastName=?,gender=?,contactNo=?,email=? where studentid=?";
    $stmt2= $mysqli->prepare($query2);
    $rc2 = $stmt2->bind_param('ssssiss',$fname,$mname,$lname,$gender,$contactno,$emailid,$studentid);
    $stmt2->execute();
    echo"<script>alert('Student Details has been Updated successfully');</script>";

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
        <title>Edit Room Details</title>
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
                            <br>
                            <h2 class="page-title">Edit Student Details </h2>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Edit Student Details</div>
                                        <div class="panel-body">
                                            <form method="post" class="form-horizontal">
                                                <?php	
                                                $id=$_GET['id'];
                                                $ret="select * from registration where id=?";
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->bind_param('i',$id);
                                                $stmt->execute() ;//ok
                                                $res=$stmt->get_result();
                                                //$cnt=1;
                                                while($row=$res->fetch_object())
                                                {
                                                ?>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label"><h4 style="color: green" align="left">
                                                        <?php echo $row->firstName;?> <?php echo $row->lastName;?>'s  Room Related info </h4> </label>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Room no </label>
                                                    <div class="col-sm-8">
                                                        <select name="room" id="room"class="form-control"  onChange="getSeater(this.value);" onBlur="checkAvailability()" required> 
                                                            <option value=""><?php echo $row->roomno;?></option>
                                                            <?php $query ="SELECT * FROM rooms";
                                                    $stmt2 = $mysqli->prepare($query);
                                                    $stmt2->execute();
                                                    $res2=$stmt2->get_result();
                                                    while($row2=$res2->fetch_object())
                                                    {
                                                            ?>
                                                            <option value="<?php echo $row2->room_no;?>"> <?php echo $row2->room_no;?></option>
                                                            <?php } ?>
                                                        </select> 
                                                        <span id="room-availability-status" style="font-size:12px;"></span>

                                                    </div>
                                                </div>




                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Single or Sharing</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="seater" id="seater" value="<?php echo $row->seater;?>"  class="form-control"  >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Fees Per Month</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="fpm" id="fpm" value="<?php echo $row->feespm;?>" class="form-control" >
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Stay From</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" name="stayf" id="stayf" value="<?php echo $row->stayfrom;?>"  class="form-control" >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Duration</label>
                                                    <div class="col-sm-8">

                                                        <select name="duration" id="duration"  class="form-control" >
                                                            <option value=""><?php echo $row->duration;?></option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                        </select>


                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label"><h4 style="color: green" align="left"><?php echo $row->firstName;?> <?php echo $row->lastName;?>'s Personal info </h4> </label>
                                                </div>



                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Course </label>
                                                    <div class="col-sm-8">
                                                        <select name="course" id="course" class="form-control" required> 
                                                            <option value=""><?php echo $row->course;?></option>
                                                            <?php $query ="SELECT * FROM courses";
                                                    $stmt2 = $mysqli->prepare($query);
                                                    $stmt2->execute();
                                                    $res2=$stmt2->get_result();
                                                    while($row2=$res2->fetch_object())
                                                    {
                                                            ?>
                                                            <option value="<?php echo $row2->course_fn;?>"><?php echo $row2->course_fn;?>&nbsp;&nbsp;(<?php echo $row2->course_sn;?>)</option>
                                                            <?php } ?>
                                                        </select> </div>
                                                </div>





                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Student ID : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="studentid" id="studentid" value="<?php echo $row->studentid;?>"  class="form-control" required="required" readonly >
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">First Name : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="fname" id="fname" value="<?php echo $row->firstName;?>"  class="form-control" required="required" >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Middle Name : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="mname" id="mname" value="<?php echo $row->middleName;?>"  class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Last Name : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="lname" id="lname" value="<?php echo $row->lastName;?>"  class="form-control" required="required">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Gender : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="gender" value="<?php echo $row->gender;?>" class="form-control" required="required">

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Contact No : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="contact" id="contact" value="<?php echo $row->contactno;?>" class="form-control" required="required">
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Email id : </label>
                                                    <div class="col-sm-8">
                                                        <input type="email" name="email" id="email" value="<?php echo $row->emailid;?>" class="form-control" required="required">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Emergency Contact: </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="econtact" id="econtact" value="<?php echo $row->egycontactno;?>" class="form-control" required="required">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Guardian  Name : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="gname" id="gname" value="<?php echo $row->guardianName;?>" class="form-control" >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Guardian  Relation : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="grelation" id="grelation" value="<?php echo $row->guardianRelation;?>" class="form-control" required="required" >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Guardian Contact no : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="gcontact" id="gcontact"  value="<?php echo $row->guardianContactno;?>" class="form-control" required="required">
                                                    </div>
                                                </div>	



                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"><h4 style="color: green" align="left"> <?php echo $row->firstName;?> <?php echo $row->lastName;?>'s Correspondense Address </h4> </label>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Address : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" rows="5" name="address"  id="address"  value="<?php echo $row->corresAddress;?>" class="form-control" required="required">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">City : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="city" id="city" value="<?php echo $row->corresCIty;?>"   class="form-control" required="required">
                                                    </div>
                                                </div>	

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">State </label>
                                                    <div class="col-sm-8">
                                                        <select name="state" id="state"class="form-control" required> 
                                                            <option value=""><?php echo $row->corresState;?></option>
                                                            <?php $query ="SELECT * FROM states";
                                                    $stmt2 = $mysqli->prepare($query);
                                                    $stmt2->execute();
                                                    $res2=$stmt2->get_result();
                                                    while($row2=$res2->fetch_object())
                                                    {
                                                            ?>
                                                            <option value="<?php echo $row2->State;?>"><?php echo $row2->State;?></option>
                                                            <?php } ?>
                                                        </select> </div>
                                                </div>							

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Pincode : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="pincode" id="pincode" value="<?php echo $row->corresPincode;?>"  class="form-control" required="required">
                                                    </div>
                                                </div>	

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label"><h4 style="color: green" align="left"> <?php echo $row->firstName;?> <?php echo $row->lastName;?>'s Permanent Address </h4> </label>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-5 control-label">Permanent Address same as Correspondense address : </label>
                                                    <div class="col-sm-4">
                                                        <input type="checkbox" name="adcheck" value="1"/>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Address : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  rows="5" name="paddress" value="<?php echo $row->pmntAddress;?>"   id="paddress" class="form-control" required="required">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">City : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="pcity" id="pcity" value="<?php echo $row->pmntCity;?>"  class="form-control" required="required">
                                                    </div>
                                                </div>	

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">State </label>
                                                    <div class="col-sm-8">
                                                        <select name="pstate" id="pstate"class="form-control" required > 
                                                            <option value=""><?php echo $row->pmnatetState;?></option>
                                                            <?php $query ="SELECT * FROM states";
                                                    $stmt2 = $mysqli->prepare($query);
                                                    $stmt2->execute();
                                                    $res2=$stmt2->get_result();
                                                    while($row2=$res2->fetch_object())
                                                    {
                                                            ?>
                                                            <option value="<?php echo $row2->State;?>"><?php echo $row2->State;?></option>
                                                            <?php } ?>
                                                        </select> </div>
                                                </div>							

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Pincode : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="ppincode" id="ppincode" value="<?php echo $row->pmntPincode;?>"  class="form-control" required="required">
                                                    </div>
                                                </div>	






                                                <?php } ?>
                                                <div class="col-sm-8 col-sm-offset-2">

                                                    <input class="btn btn-primary" type="submit" name="submit" value="Update Student Details">
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
                    },
                    error:function (){}
                });
            }
        </script>

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



    </body>

</html>
