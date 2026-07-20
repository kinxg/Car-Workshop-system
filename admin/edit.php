<?php

session_start();

include("../db.php");

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: dashboard.php");
    exit();
}

$id = (int)$_GET['id'];

$sql = "SELECT * FROM appointments WHERE appointment_id='$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$mechanics = mysqli_query($conn,"SELECT * FROM mechanics");

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Appointment</title>

<link rel="stylesheet" href="../css/admin.css">

</head>

<body>

<div class="container">

<h1>Edit Appointment</h1>

<form action="update.php" method="POST">

<input type="hidden"
name="appointment_id"
value="<?php echo $row['appointment_id']; ?>">

<label>Client Name</label>

<input
type="text"
value="<?php echo $row['client_name']; ?>"
readonly>

<br><br>

<label>Appointment Date</label>

<input
type="date"
name="appointment_date"
value="<?php echo $row['appointment_date']; ?>"
required>

<br><br>

<label>Select Mechanic</label>

<select name="mechanic_id" required>

<?php

while($m=mysqli_fetch_assoc($mechanics))
{

?>

<option
value="<?php echo $m['mechanic_id']; ?>"

<?php

if($m['mechanic_id']==$row['mechanic_id'])
{
    echo "selected";
}

?>

>

<?php echo $m['mechanic_name']; ?>

</option>

<?php

}

?>

</select>

<br><br>

<input
class="edit"
type="submit"
value="Update Appointment">

</form>

</div>

</body>

</html>