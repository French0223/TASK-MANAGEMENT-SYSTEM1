<?php
    include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php include('links.php'); ?>
</head>
<body>
    <div class="container">
        <h1 id="prodify">Prodify.</h1>
        <div id="form">
            <center><h1>Login</h1></center>
            <form name="form" action="login.php" method="POST">
                <label>Username: </label>
                <input type="text" id="user" name="user" required></br></br>

                <label>Password:</label>
                <input type="password" id="pass" name="pass" required></br></br>

                <input type="submit" id="btn" value="Login" name="submit"/> <br>
            </form>
        </div>
    </div>
</body>
</html>
