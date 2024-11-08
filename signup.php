<?php


require 'config/database.php';

session_start();

$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$password = $_SESSION['signup-data']['password'] ?? null;
$cpassword = $_SESSION['signup-data']['cpassword'] ?? null;

unset($_SESSION['signup-data']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="./css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>



<section class="form_section">
<img src="images/blog38.jpg" class="bg">
    <div class="container form_section-container">
        <h2>REGISTRO</h2>
        <?php  if(isset($_SESSION['signup'])): ?>
        <div class="alert_message error">
            <p>  
                 <?= $_SESSION['signup'];
                    unset( $_SESSION['signup']);
                 ?>
                     <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </p>
           </div>
        <?php endif ?>
        <form action="signup-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" placeholder="primer nombre" name="firstname" value="<?= $firstname ?>"  >
            <input type="text" placeholder="segundo nombre"  name="lastname" value="<?= $lastname ?>">
            <input type="text" placeholder="nombre de usuario" name="username"  value="<?= $username ?>"  >
            <input type="email" placeholder="email" name="email"  value="<?= $email ?>">
            <input type="password" placeholder="contraseña" name="password"   value="<?= $password ?>">
            <input type="password" placeholder="confirmar contraseña" name="cpassword"  value="<?= $cpassword ?>">
            <div class="form_control">
              
                <input type="file" id="avatar" name="avatar">

            </div>
              <input type="submit" class="btn" name="submit" value="registrar">
              <small>ya tiene una cuenta? <a href="signin.php">ingresa</a></small>
        </form>
    </div>
</section>
  
</body>

</html>