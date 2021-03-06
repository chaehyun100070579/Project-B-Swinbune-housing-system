<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for registration
if(isset($_POST['submit']))
{
    $roomno=$_POST['room'];
    $seater=$_POST['seater'];
    $feespm=$_POST['fpm'];
    $stayfrom="";
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
    $query="insert into  registration(roomno,seater,feespm,stayfrom,duration,course,studentid,firstName,middleName,lastName,gender,contactno,emailid,egycontactno,guardianName,guardianRelation,guardianContactno,corresAddress,corresCIty,corresState,corresPincode,pmntAddress,pmntCity,pmnatetState,pmntPincode) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc=$stmt->bind_param('siisisissssisississsisssi',$roomno,$seater,$feespm,$stayfrom,$duration,$course,$studentid,$fname,$mname,$lname,$gender,$contactno,$emailid,$emcntno,$gurname,$gurrelation,$gurcntno,$caddress,$ccity,$cstate,$cpincode,$paddress,$pcity,$pstate,$ppincode);
    $stmt->execute();
    $stmt->close();


    $query1="insert into  userregistration(studentid,firstName,middleName,lastName,gender,contactNo,email,password) values(?,?,?,?,?,?,?,?)";
    $stmt1= $mysqli->prepare($query1);
    $stmt1->bind_param('sssssiss',$studentid,$fname,$mname,$lname,$gender,$contactno,$emailid,$contactno);
    $stmt1->execute();
    echo"<script>alert('Student Succssfully register');</script>";
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
                            <br/><br/><br/>
                            <h2 class="page-title">Register Student to a room</h2>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Fill all Info</div>
                                        <div class="panel-body">
                                            <form method="post" action="" class="form-horizontal">


                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label"><h4 style="color: green" align="left">Room Related info </h4> </label>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Gender(Building Type): </label>
                                                    <div class="col-sm-8">
                                                        <select name="gender"  class="form-control" required="required" id="gender" onChange="checkAvailability();getSeater(this.value)">
                                                            <option value="" disabled selected hidden>Select Gender</option>
                                                            <option value="male" >Male</option>
                                                            <option value="female" >Female</option>

                                                        </select>
                                                    </div>
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



                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Student ID :  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="studentid" id="studentid"  class="form-control" required="required" >
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">First Name :  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="fname" id="fname"  class="form-control" required="required" >
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Middle Name : </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="mname" id="mname"  class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Last Name :  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="lname" id="lname"  class="form-control" required="required">
                                                        </div>
                                                    </div>



                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Contact No :  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="contact" id="contact"  class="form-control" required="required">
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Email Address :  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="email" name="email" id="email"  class="form-control" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Emergency Contact:  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="econtact" id="econtact"  class="form-control" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Guardian  Name :  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="gname" id="gname"  class="form-control" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Guardian  Relation :  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="grelation" id="grelation"  class="form-control" required="required">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Guardian Contact No. :  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="gcontact" id="gcontact"  class="form-control" required="required">
                                                        </div>
                                                    </div>	

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label"><h4 style="color: green" align="left">Correspondence Address </h4> </label>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Address :  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <textarea  rows="5" name="address"  id="address" class="form-control" required="required"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">City :  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="city" id="city"  class="form-control" required="required">
                                                        </div>
                                                    </div>	

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">State : <span style="color:red">*</span></label>
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
                                                        <label class="col-sm-2 control-label">Pincode :  <span style="color:red">*</span></label>
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
                                                        <label class="col-sm-2 control-label">Address :  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <textarea  rows="5" name="paddress"  id="paddress" class="form-control" required="required"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">City :  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="pcity" id="pcity"  class="form-control" required="required">
                                                        </div>
                                                    </div>	

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">State : <span style="color:red">*</span></label>
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
                                                        <label class="col-sm-2 control-label">Pincode :  <span style="color:red">*</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="ppincode" id="ppincode"  class="form-control" required="required">
                                                        </div>
                                                    </div>	


                                                    <div class="col-sm-6 col-sm-offset-4">
                                                        <button class="btn btn-default" type="reset">Cancel</button>
                                                        <input type="submit" name="submit" Value="Register" class="btn btn-primary">
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

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap-select.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <script src="js/Chart.min.js"></script>
        <script src="js/fileinput.js"></script>
        <script src="js/chartData.js"></script>
        <script src="js/main.js"></script>

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



    </body>




</html>