<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for add courses
if($_POST['submit'])
{
    $seater=$_POST['seater'];
    $rmno=$_POST['rmno'];
    $RoomType=$_POST['RoomType'];
    $fees=$_POST['fees'];
    
    $id=$_GET['id'];
    
    $query="update rooms set seater=?,room_no=?,fees=?,RoomType=? where id=?";
    $stmt = $mysqli->prepare($query);
    $rc=$stmt->bind_param('isisi',$seater,$rmno,$fees,$RoomType,$id);
    $stmt->execute();
    echo"<script>alert('Room Details has been Updated successfully');</script>";
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
        <p></p>
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

                            <h2 class="page-title">Edit Room Details </h2>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Edit Room Details</div>
                                        <div class="panel-body">
                                            <form method="post" class="form-horizontal">
                                                <?php	
                                                $id=$_GET['id'];
                                                $ret="select * from rooms where id=?";
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->bind_param('i',$id);
                                                $stmt->execute() ;//ok
                                                $res=$stmt->get_result();
                                                //$cnt=1;
                                                while($row=$res->fetch_object())
                                                {
                                                ?>
                                                <div class="hr-dashed"></div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Single or Sharing  </label>
                                                    <div class="col-sm-8">
                                                        <input type="text"  name="seater" value="<?php echo $row->seater;?>"  class="form-control"> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Room no </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="rmno" id="rmno" value="<?php echo $row->room_no;?>" >
                                                      
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Room Type </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="RoomType" id="RoomType" value="<?php echo $row->RoomType;?>" >
                                                      
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Rental (per week)</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="fees" value="<?php echo $row->fees;?>" >
                                                    </div>
                                                </div>


                                                <?php } ?>
                                                <div class="col-sm-8 col-sm-offset-2">

                                                    <input class="btn btn-primary" type="submit" name="submit" value="Update Room Details ">
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


    </body>

</html>
