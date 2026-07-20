<?php
include("db.php");

$mechanics = mysqli_query($conn,"SELECT * FROM mechanics");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Car Workshop Appointment System</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

    <h1>🚗 Car Workshop Appointment System</h1>

    <form action="submit.php" method="POST" onsubmit="return validateForm()">

        <div class="form-grid">

            <div class="input-group">
                <label>Client Name</label>
                <input type="text" name="client_name" required>
            </div>

            <div class="input-group">
                <label>Phone Number</label>
                <input type="text" name="phone" placeholder="01xxxxxxxxx" maxlength="11" required>
            </div>

            <div class="input-group"><label>Address</label>
            <textarea name="address"
        id="address"
        maxlength="200"
        required></textarea>

    <small id="count">0 / 200</small>

</div>

            <div class="input-group">
                <label>Car License Number</label>
                <input type="text" name="car_license" required>
            </div>

            <div class="input-group">
                <label>Car Engine Number</label>
                <input type="text" name="engine_number" oninput ="this.value=this.value.replace(/[^0-9]/g,'')" required>
            </div>

            <div class="input-group">
                <label>Appointment Date</label>
                <input type="date" id="appointment_date" name="appointment_date" required>
                <script>
                document.getElementById("appointment_date").min =
new Date().toISOString().split("T")[0];

</script>
            </div>

        </div>

        <h2>Select Your Mechanic</h2>

        <div class="mechanic-container">

            <?php while($row = mysqli_fetch_assoc($mechanics)){ ?>

                <label class="mechanic-card">

                    <input
                    type="radio"
                    name="mechanic_id"
                    value="<?php echo $row['mechanic_id']; ?>"
                    required>

                    <div class="icon">🔧</div>

                    <h3><?php echo $row['mechanic_name']; ?></h3>

                    <p class="experience">Senior Mechanic</p>

                    <p class="slot" id="slot<?php echo $row['mechanic_id']; ?>">
                        Select Date
                    </p>

                </label>

            <?php } ?>

        </div>

        <input class="btn" type="submit" value="Book Appointment">

    </form>

</div>

<script src="js/script.js"></script>
<footer>

© 2026 Car Workshop Appointment System

</footer>

</body>

</html>