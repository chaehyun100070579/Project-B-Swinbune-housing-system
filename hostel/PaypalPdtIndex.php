
<?php 
session_start();

include 'includes/config.php';
include 'process_pdt.function.php';
include('includes/checklogin.php');

$payment_data = isset($_GET['tx'])
    ? process_pdt($_GET['tx'])
    : FALSE;

$current_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];


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





?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>PDT Sample</title>


        <style>
            form
            {
                float: right;
                margin: 0 3em 0 4em;
            }
        </style>

    </head>
    <body>
        <h1>Transaction Results</h1>

        <p>Transaction Sucessful.</p>


        <?php if($payment_data)
    printf('<p>Thank you %s and welcome back. We will pretend to ship that stuffed bear to you ASAP.</p>', $payment_data['first_name'], $payment_data['mc_gross'], $payment_data['mc_currency']); ?>



        <?php if($_GET): ?>
        <hr/>
        <h2>Details</h2>

        <pre>GET: <?php print_r($_GET) ?></pre>
        <pre>PDT: <?php print_r($payment_data) ?></pre>
        <?php endif ?>


    </body>
</html>

