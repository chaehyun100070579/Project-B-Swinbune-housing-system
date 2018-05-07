<?php
require_once("includes/config.php");
if(!empty($_POST["emailid"])) {
	$email= $_POST["emailid"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

		echo "error : You did not enter a valid email.";
	}
	else {
		$result ="SELECT count(*) FROM userRegistration WHERE email=?";
		$stmt = $mysqli->prepare($result);
		$stmt->bind_param('s',$email);
		$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();
if($count>0)
{
echo "<span style='color:red'> Email already exist .</span>";
}
else{
	echo "<span style='color:green'> Email available for registration .</span>";
}
}
}

if(!empty($_POST["oldpassword"])) 
{
$pass=$_POST["oldpassword"];
$result ="SELECT password FROM userregistration WHERE password=?";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('s',$pass);
$stmt->execute();
$stmt -> bind_result($result);
$stmt -> fetch();
$opass=$result;
if($opass==$pass) 
echo "<span style='color:green'> Password  matched .</span>";
else echo "<span style='color:red'> Password Not matched</span>";
}


if(!empty($_POST["roomno"])) 
{
// roomno is room type
$roomno=$_POST["roomno"];
$gen=$_POST['gender'];
if($gen == 'female')
{
    // if female
    $gen2 = 'h';
    $gen3 = '';
} else {
    // if male
    $gen2 = 'hl';
    $gen3 = 'hm';
}
//$result ="SELECT count(*) FROM registration WHERE RoomType=?";
// !!! OLD QUERY WITHOUT ROOM BLOCK H, HL, HM !!!
/*
// $result ="SELECT * from rooms
// left outer join registration
// on registration.roomno = rooms.room_no
// where rooms.RoomType = ?
// and registration.roomno IS NULL
// UNION
// select * from rooms
// inner join registration
// on registration.roomno = rooms.room_no
// where rooms.RoomType = ?
// and (select count(*) from rooms inner join registration where rooms.RoomType = ? and registration.roomno = rooms.room_no) < rooms.seater
// ";
*/
$result = "SELECT * from rooms
left outer join registration
on registration.roomno = rooms.room_no
where rooms.RoomType = ?
and (rooms.block = ? or rooms.block = ?)
and registration.roomno IS NULL
UNION
select * from rooms
inner join registration
on registration.roomno = rooms.room_no
where rooms.RoomType = ?
and (rooms.block = ? or rooms.block = ?)
and (select count(*) from rooms inner join registration on registration.roomno = rooms.room_no 
where rooms.RoomType = ? and (rooms.block = ? or rooms.block = ?)) < rooms.seater
";
// IMPORTANT !!
// THESE SQL STATEMENTS WILL RETURN ROWS WITH ROOM THAT HAVE SPOTS
// IMPORTANT !!
$stmt = $mysqli->prepare($result);
$stmt->bind_param('sssssssss',$roomno,$gen2,$gen3,$roomno,$gen2,$gen3,$roomno,$gen2,$gen3);
//$stmt->bind_param('sss',$roomno,$roomno,$roomno);
$stmt->execute();
$stmt->store_result();
//$stmt->bind_result($count);
$rowcount=$stmt->num_rows();
$stmt->free_result();
//$stmt->fetch();
$stmt->close();
//if($rowcount>0)
echo $rowcount;
}
?>