<?php

require 'config/database.php';
session_start();

$username = $_SESSION['signin-data']['username'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>

<section class="form_section">
    <img src="images/blog38.jpg" class="bg">
    <div class="container form_section-container">
        <h2>INGRESAR</h2>
        <?php  if(isset($_SESSION['signup-success'])): ?>
            <div class="alert_message success">
                <p>
                    <?=  $_SESSION['signup-success'];
                         unset($_SESSION['signup-success']);
                    ?>
                </p>
            </div>
            <?php  elseif(isset($_SESSION['signin'])): ?>
            <div class="alert_message error">
                <p>
                    <?=  $_SESSION['signin'];
                         unset($_SESSION['signin']);
                    ?>
                </p>
            </div>

        <?php endif ?>

        <form action="signin-logic.php" method="POST" >
            <input type="text" name="username" value="<?= $username ?>" placeholder="ingrese usuario o email">
            <input type="password" name="password"  value="<?= $password ?>" placeholder="ingrese su contraseña">
              <button type="submit" name="submit" class="btn">INGRESAR</button>
              <small>No tienes una cuenta? <a href="signup.php">crea una</a></small>
        </form>
    </div>
</section>
  
</body>

</html>