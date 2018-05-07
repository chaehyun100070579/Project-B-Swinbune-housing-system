<?php
include('includes/pdoconfig.php');

// GET ROOM SEATER AND AUTO FILL IN SEATER
if(!empty($_POST["roomid"]))
{
// roomid is room type
$id=$_POST['roomid'];
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
//$stmt = $DB_con->prepare("SELECT * FROM rooms WHERE room_no = :id");
// SELECT is different because have to put rooms table at the back
// so that any NULL seater(because no booker) from registration table is not fetched
// because both tables have 'seater' column and will have 2 after joined

/*
// !!! OLD QUERY WITHOUT ROOM BLOCK H, HL, HM !!!
// $query = "SELECT registration.*, rooms.* from rooms
// inner join registration
// on registration.roomno = rooms.room_no
// where rooms.RoomType = :id
// and (select count(*) from rooms inner join registration where rooms.RoomType = :id and registration.roomno = rooms.room_no) < rooms.seater
// UNION
// select registration.*, rooms.* from rooms
// left outer join registration
// on registration.roomno = rooms.room_no
// where rooms.RoomType = :id
// and registration.roomno IS NULL
// ";
*/
$query = "SELECT registration.*, rooms.* from rooms
inner join registration
on registration.roomno = rooms.room_no
where rooms.RoomType = :id
and (rooms.block = :gender2 or rooms.block = :gender3)
and (select count(*) from rooms inner join registration on registration.roomno = rooms.room_no 
where rooms.RoomType = :id and (rooms.block = :gender2 or rooms.block = :gender3)) < rooms.seater
UNION
select registration.*, rooms.* from rooms
left outer join registration
on registration.roomno = rooms.room_no
where rooms.RoomType = :id
and (rooms.block = :gender2 or rooms.block = :gender3)
and registration.roomno IS NULL
";
$stmt = $DB_con->prepare($query);
$stmt->execute(array(
    ':id' => $id,
    ':gender2' => $gen2,
    ':gender3' => $gen3
    ));
?>
 <?php
// while($row=$stmt->fetch(PDO::FETCH_ASSOC))
// {
 $row=$stmt->fetch(PDO::FETCH_ASSOC);
  ?>
 <?php echo htmlentities($row['seater']); ?>
  <?php
// }
}




// GET ROOM FEES AND AUTO FIlL IN WEEKLY FEES
if(!empty($_POST["rid"])) 
{
//rid is room type
$id=$_POST['rid'];
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
//$stmt = $DB_con->prepare("SELECT * FROM rooms WHERE room_no = :id");
/*
// !!! OLD QUERY WITHOUT ROOM BLOCK H, HL, HM !!!
// $query = "SELECT * from rooms
// inner join registration
// on registration.roomno = rooms.room_no
// where rooms.RoomType = :id
// and (select count(*) from rooms inner join registration where rooms.RoomType = :id and registration.roomno = rooms.room_no) < rooms.seater
// UNION
// select * from rooms
// left outer join registration
// on registration.roomno = rooms.room_no
// where rooms.RoomType = :id
// and registration.roomno IS NULL
// ";
*/
$query = "SELECT * from rooms
inner join registration
on registration.roomno = rooms.room_no
where rooms.RoomType = :id
and (rooms.block = :gender2 or rooms.block = :gender3)
and (select count(*) from rooms inner join registration on registration.roomno = rooms.room_no 
where rooms.RoomType = :id and (rooms.block = :gender2 or rooms.block = :gender3)) < rooms.seater
UNION
select * from rooms
left outer join registration
on registration.roomno = rooms.room_no
where rooms.RoomType = :id
and (rooms.block = :gender2 or rooms.block = :gender3)
and registration.roomno IS NULL
";
$stmt = $DB_con->prepare($query);
$stmt->execute(array(
    ':id' => $id,
    ':gender2' => $gen2,
    ':gender3' => $gen3
    ));
?>
 <?php
// while($row=$stmt->fetch(PDO::FETCH_ASSOC))
// {
 $row=$stmt->fetch(PDO::FETCH_ASSOC);
  ?>
 <?php echo htmlentities($row['fees']); ?>
  <?php
// }
}




// GET ROOM NUMBER AND REPLACE VALUE OF DROP DOWN OPTION
if(!empty($_POST["getroomnum"])) 
{
//getroomnum is room type
$id=$_POST['getroomnum'];
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
//$stmt = $DB_con->prepare("SELECT * FROM rooms WHERE room_no = :id");
/*
// !!! OLD QUERY WITHOUT ROOM BLOCK H, HL, HM !!!
// $query = "SELECT registration.*, rooms.* from rooms
// inner join registration
// on registration.roomno = rooms.room_no
// where rooms.RoomType = :id
// and (select count(*) from rooms inner join registration where rooms.RoomType = :id and registration.roomno = rooms.room_no) < rooms.seater
// UNION
// select registration.*, rooms.* from rooms
// left outer join registration
// on registration.roomno = rooms.room_no
// where rooms.RoomType = :id
// and registration.roomno IS NULL
// ";
*/
$query = "SELECT registration.*, rooms.* from rooms
inner join registration
on registration.roomno = rooms.room_no
where rooms.RoomType = :id
and (rooms.block = :gender2 or rooms.block = :gender3)
and (select count(*) from rooms inner join registration on registration.roomno = rooms.room_no 
where rooms.RoomType = :id and (rooms.block = :gender2 or rooms.block = :gender3)) < rooms.seater
UNION
select registration.*, rooms.* from rooms
left outer join registration
on registration.roomno = rooms.room_no
where rooms.RoomType = :id
and (rooms.block = :gender2 or rooms.block = :gender3)
and registration.roomno IS NULL
";
$stmt = $DB_con->prepare($query);
$stmt->execute(array(
    ':id' => $id,
    ':gender2' => $gen2,
    ':gender3' => $gen3
    ));
?>
 <?php
// while($row=$stmt->fetch(PDO::FETCH_ASSOC))
// {
 $row=$stmt->fetch(PDO::FETCH_ASSOC);
  ?>
 <?php echo htmlentities($row['room_no']); ?>
  <?php
// }
}




// GET DURATION OF COURSE CODE AND AUTO FILL IN DURATION (WEEKS)
if(!empty($_POST["course_code"])) 
{	
$id=$_POST['course_code'];
$stmt = $DB_con->prepare("SELECT * FROM courses WHERE course_code = :course_code");
$stmt->execute(array(':course_code' => $id));
?>
 <?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
 <?php echo htmlentities($row['numberOfWeeks']); ?>
  <?php
 }
}







?>