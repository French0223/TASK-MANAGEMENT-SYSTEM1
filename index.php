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
    <!-- Font Awesome for eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .password-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        .password-container input[type="password"],
        .password-container input[type="text"] {
            width: 100%;
            padding-right: 35px; /* space for the icon */
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            cursor: pointer;
            color: #555;
        }
    </style>
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
                <div class="password-container">
                    <input type="password" id="pass" name="pass" required>
                    <i class="fa-solid fa-eye toggle-password" id="togglePass"></i>
                </div>
                </br></br>

                <input type="submit" id="btn" value="Login" name="submit"/> <br>
            </form>
        </div>
    </div>

    <script>
        const passInput = document.getElementById('pass');
        const togglePass = document.getElementById('togglePass');

        togglePass.addEventListener('click', () => {
            const type = passInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passInput.setAttribute('type', type);
            togglePass.classList.toggle('fa-eye');
            togglePass.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
