<?php

session_start();

include("db.php");

$username = $_POST['username'];

$password = $_POST['password'];

$sql = "SELECT * FROM admin WHERE username='$username'";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==1)
{

    $admin = mysqli_fetch_assoc($result);

    if(password_verify($password,$admin['password']))
    {

        $_SESSION['admin']=$username;

        header("Location: admin/dashboard.php");

    }

    else
    {

        echo "<script>

        alert('Wrong Password');

        window.location='login.php';

        </script>";

    }

}

else
{

    echo "<script>

    alert('Admin Not Found');

    window.location='login.php';

    </script>";

}

?>