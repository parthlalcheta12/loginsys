<?php
require "include/config_session.inc.php";
require "include/signup_view.inc.php";
require "include/login_view.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="container">
        <h3>
            <?php output_username();
            ?>
        </h3>
        <?php
if (!isset($_SESSION["user_id"])) {?>

        <h3>Login</h3>
        <form action="include/login.inc.php" method="post">

            Username:
            <input type="text" name="username" placeholder="username" autocomplete="on"><br><br>


            Password:
            <input type="password" name="pwd" placeholder="password"><br><br>

            <button>Login</button>
            <br><br>

        </form>
        <?php }?>


    </div>
    <?php
check_login_errors();
?>
   <div class="container">
        <h3>SignUp</h3>
        <form action="include/signup.inc.php" method="post">
            Username:
            <input type="text" name="username" placeholder="Enter your username" autocomplete="on"><br><br>

            Password:
            <input type="password" name="pwd" placeholder="password"><br><br>


            Email:
            <input type="text" name="email" placeholder="Email" autocomplete="on"><br><br>

            <button>SignUp</button>
        </form>
        <form action="include/logout.inc.php" method="post">
            <h3>Logout</h3>
            <button>Logout</button>
        </form>
    </div>
    <?php
check_signup_errors();
?>
</body>
</html>