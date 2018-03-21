<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if(isset($_GET['del']))
{
    $id=intval($_GET['del']);
    $adn="delete from registration where id=?";
    $stmt= $mysqli->prepare($adn);
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->close();	   
    echo "<script>alert('Data Deleted');</script>" ;
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
        <title>Manage Students</title>
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

    </head>

    <body>
        <?php include('includes/header.php');?>

        <div class="ts-main-content">
            <?php include('includes/sidebar.php');?>
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-title">Manage Students</h2>
                            <div class="panel panel-default">
                                <div class="panel-heading">All Room Details</div>
                                <div class="panel-body">
                                    <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                                <th>Student Name</th>
                                                <th>Student ID</th>
                                                <th>Contact no </th>
                                                <th>room no  </th>
                                                <th>Seater </th>
                                                <th>Staying From </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Sno.</th>
                                                <th>Student Name</th>
                                                <th>Student ID</th>
                                                <th>Contact no </th>
                                                <th>Room no  </th>
                                                <th>Seater </th>
                                                <th>Staying From </th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php	
											$aid=$_SESSION['id'];
											$ret="select * from registration";
											$stmt= $mysqli->prepare($ret) ;
											//$stmt->bind_param('i',$aid);
											$stmt->execute() ;//ok
											$res=$stmt->get_result();
											$cnt=1;
											//http://localhost/hostel/admin/full-profile.php?id=$row->id

											while($row=$res->fetch_object())
											{
												echo "<tr><td>$cnt</td>";
												echo "<td> $row->firstName $row->middleName $row->lastName</td>";
												echo "<td> $row->studentid</td>";
												echo "<td> $row->contactno</td>";
												echo "<td> $row->roomno</td>";
												echo "<td> $row->seater</td>";
												echo "<td> $row->stayfrom</td>";
												echo "<td>
														<a href='javascript:void(0);' onClick='popUpWindow(\"/hostel/admin/full-profile.php?id=$row->id\");' title='View Full Details'>
															<i class='fa fa-desktop'></i>
														</a>
														&nbsp;&nbsp;
														<a href='manage-students.php?del=$row->id' title='Delete Record' onclick='return confirm('Do you want to delete');'>
															<i class='fa fa-close'></i>
														</a>
														&nbsp;&nbsp;
														<a href='edit-student.php?id=$row->id' title='Edit Student'><i class='fa fa-edit'></i>
														</a>
													  </td>";
												echo "</tr>";
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
