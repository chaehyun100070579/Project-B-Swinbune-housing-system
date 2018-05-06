<?php
include('includes/pdoconfig.php');
if(!empty($_POST["roomid"]))
{	
$id=$_POST['roomid'];
//$stmt = $DB_con->prepare("SELECT * FROM rooms WHERE room_no = :id");
// SELECT is different because have to put rooms table at the back
// so that any NULL seater(because no booker) from registration table is not fetched
// because both tables have 'seater' column and will have 2 after joined
$query = "SELECT registration.*, rooms.* from rooms
inner join registration
on registration.roomno = rooms.room_no
where rooms.RoomType = :id
and (select count(*) from rooms inner join registration where rooms.RoomType = :id and registration.roomno = rooms.room_no) < rooms.seater
UNION
select registration.*, rooms.* from rooms
left outer join registration
on registration.roomno = rooms.room_no
where rooms.RoomType = :id
and registration.roomno IS NULL
";
$stmt = $DB_con->prepare($query);
$stmt->execute(array(':id' => $id));
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



if(!empty($_POST["rid"])) 
{	
$id=$_POST['rid'];
//$stmt = $DB_con->prepare("SELECT * FROM rooms WHERE room_no = :id");
$query = "SELECT * from rooms
inner join registration
on registration.roomno = rooms.room_no
where rooms.RoomType = :id
and (select count(*) from rooms inner join registration where rooms.RoomType = :id and registration.roomno = rooms.room_no) < rooms.seater
UNION
select * from rooms
left outer join registration
on registration.roomno = rooms.room_no
where rooms.RoomType = :id
and registration.roomno IS NULL
";
$stmt = $DB_con->prepare($query);
$stmt->execute(array(':id' => $id));
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