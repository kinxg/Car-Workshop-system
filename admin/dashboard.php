<?php

session_start();

include("../db.php");

if(!isset($_SESSION['admin']))
{
    header("Location: ../login.php");
}

$search = "";

if(isset($_GET['search']))
{
    $search = $_GET['search'];
}

$sql = "SELECT appointments.*, mechanics.mechanic_name
FROM appointments
JOIN mechanics
ON appointments.mechanic_id = mechanics.mechanic_id
WHERE client_name LIKE '%$search%'
ORDER BY appointment_date ASC";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html>

<head>

<title>Admin Dashboard</title>

<link rel="stylesheet" href="../css/admin.css">

</head>

<body>

<div class="container">

<h1>Admin Dashboard</h1>

<div class="top">

<form>

<input
type="text"
name="search"
placeholder="Search Client"
value="<?php echo $search; ?>">

<button>Search</button>

</form>

<a href="../logout.php" class="logout">
Logout
</a>

</div>

<table>

<tr>

<th>ID</th>

<th>Client</th>

<th>Phone</th>

<th>License</th>

<th>Date</th>

<th>Mechanic</th>

<th>Edit</th>

<th>Delete</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['appointment_id']; ?></td>

<td><?php echo $row['client_name']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['car_license']; ?></td>

<td><?php echo $row['appointment_date']; ?></td>

<td><?php echo $row['mechanic_name']; ?></td>

<td>

<a class="edit"

href="edit.php?id=<?php echo $row['appointment_id']; ?>">

Edit

</a>

</td>

<td>

<a class="delete"

onclick="return confirm('Delete Appointment?')"

href="delete.php?id=<?php echo $row['appointment_id']; ?>">

Delete

</a>

</td>

</tr>

<?php

}

?>

</table>

</div>

</body>

</html>