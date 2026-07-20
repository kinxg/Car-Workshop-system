<?php

include("db.php");

$date = $_GET['date'];

$result = mysqli_query($conn,"SELECT * FROM mechanics");

$data = array();

while($row = mysqli_fetch_assoc($result))
{

$id = $row['mechanic_id'];

$count = mysqli_query($conn,"
SELECT COUNT(*) as total
FROM appointments
WHERE mechanic_id='$id'
AND appointment_date='$date'
");

$total = mysqli_fetch_assoc($count);

$remaining = 4 - $total['total'];

if($remaining<0)
{
    $remaining=0;
}

$data[] = array(

"mechanic_id"=>$id,

"remaining"=>$remaining

);

}

echo json_encode($data);

?>