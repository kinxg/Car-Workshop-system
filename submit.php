```php
<?php

include("db.php");

if(isset($_POST['client_name']))
{

    // Get Form Data

    $name = mysqli_real_escape_string($conn,$_POST['client_name']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $license = mysqli_real_escape_string($conn,$_POST['car_license']);
    $engine = mysqli_real_escape_string($conn,$_POST['engine_number']);
    $date = $_POST['appointment_date'];
    $mechanic = $_POST['mechanic_id'];

    // ----------------------------
    // Validation
    // ----------------------------

    if(
        empty($name) ||
        empty($address) ||
        empty($phone) ||
        empty($license) ||
        empty($engine) ||
        empty($date) ||
        empty($mechanic)
    )
    {
        echo "<script>
        alert('All fields are required.');
        window.location='index.php';
        </script>";
        exit();
    }

    // Phone must be exactly 11 digits

    if(!preg_match("/^[0-9]{11}$/",$phone))
    {
        echo "<script>
        alert('Phone number must contain exactly 11 digits.');
        window.location='index.php';
        </script>";
        exit();
    }

    // Engine number must contain only numbers

    if(!preg_match("/^[0-9]+$/",$engine))
    {
        echo "<script>
        alert('Engine number must contain only numbers.');
        window.location='index.php';
        </script>";
        exit();
    }

    // Appointment date cannot be in the past

    if(strtotime($date) < strtotime(date("Y-m-d")))
    {
        echo "<script>
        alert('Appointment date cannot be in the past.');
        window.location='index.php';
        </script>";
        exit();
    }

    // ----------------------------
    // Check Duplicate Appointment
    // ----------------------------

    $check = mysqli_query($conn,"
    SELECT *
    FROM appointments
    WHERE phone='$phone'
    AND appointment_date='$date'
    ");

    if(mysqli_num_rows($check)>0)
    {
        echo "<script>
        alert('⚠️ You already have an appointment on this date.');
        window.location='index.php';
        </script>";
        exit();
    }

    // ----------------------------
    // Check Mechanic Availability
    // ----------------------------

    $slot = mysqli_query($conn,"
    SELECT COUNT(*) AS total
    FROM appointments
    WHERE mechanic_id='$mechanic'
    AND appointment_date='$date'
    ");

    $row = mysqli_fetch_assoc($slot);

    if($row['total'] >= 4)
    {
        echo "<script>
        alert('🚫 Selected mechanic is fully booked.');
        window.location='index.php';
        </script>";
        exit();
    }

    // ----------------------------
    // Save Appointment
    // ----------------------------

    $sql = "INSERT INTO appointments
    (client_name,address,phone,car_license,engine_number,appointment_date,mechanic_id)

    VALUES

    ('$name',
    '$address',
    '$phone',
    '$license',
    '$engine',
    '$date',
    '$mechanic')";

    if(mysqli_query($conn,$sql))
    {

        echo "<script>
        alert('✅ Appointment Booked Successfully!');
        window.location='index.php';
        </script>";

    }
    else
    {

        echo "<script>
        alert('❌ Something went wrong. Please try again.');
        window.location='index.php';
        </script>";

    }

}
else
{

    header("Location: index.php");
    exit();

}

?>
```
