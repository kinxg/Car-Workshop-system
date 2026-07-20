<?php

session_start();

include("../db.php");

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

$id = $_POST['appointment_id'];
$date = $_POST['appointment_date'];
$mechanic = $_POST['mechanic_id'];

$sql = "
SELECT COUNT(*) AS total
FROM appointments
WHERE mechanic_id='$mechanic'
AND appointment_date='$date'
AND appointment_id!='$id'
";

$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

if($row['total']>=4)
{

    echo "<script>

    alert('Selected mechanic is already full.');

    window.location='dashboard.php';

    </script>";

    exit();

}

$update = "
UPDATE appointments
SET

appointment_date='$date',

mechanic_id='$mechanic'

WHERE appointment_id='$id'
";

if(mysqli_query($conn,$update))
{

    echo "<script>

    alert('Appointment Updated Successfully');

    window.location='dashboard.php';

    </script>";

}
else
{

    echo "<script>

    alert('Update Failed');

    window.location='dashboard.php';

    </script>";

}

?>