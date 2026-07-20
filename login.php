<!DOCTYPE html>
<html>

<head>

    <title>Admin Login</title>

    <link rel="stylesheet" href="css/login.css">

</head>

<body>

<div class="login-box">

    <h2>Admin Login</h2>

    <form action="login_process.php" method="POST">

        <input
        type="text"
        name="username"
        placeholder="Username"
        required>

        <input
        type="password"
        name="password"
        placeholder="Password"
        required>

        <input
        type="submit"
        value="Login">

    </form>

</div>

</body>

</html>