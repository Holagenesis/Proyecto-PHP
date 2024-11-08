<?php

include 'partials/header.php';



$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$password = $_SESSION['add-user-data']['password'] ?? null;
$cpassword = $_SESSION['add-user-data']['cpassword'] ?? null;


unset($_SESSION['add-user-data']);

?>


<div class="form_section">
    <div class="container form_section-container">
        <h2>AGREGAR USUARIO</h2>
        <?php  if(isset($_SESSION['add-user'])): ?>

            <div class="alert_message error">
             <p>
                <?= $_SESSION['add-user'];
                    unset($_SESSION['add-user']);
                ?>
             </p>
            </div>

            <?php endif ?>
        
        <form action="<?php echo ROOT ?>admin/add_user_logic.php" enctype="multipart/form-data" method="POST">
            <input type="text"  placeholder="primer nombre" name="firstname" value="<?= $firstname ?>">
            <input type="text"  placeholder="segundo nombre"  name="lastname" value="<?= $lastname ?>">
            <input type="text"  placeholder="nombre de usuario" name="username" value="<?= $username ?>">
            <input type="email"  placeholder="email" name="email" value="<?= $email ?>">
            <input type="password"  placeholder="contraseña" name="password" value="<?= $password ?>">
            <input type="password"  placeholder="confirmar contraseña" name="cpassword" value="<?= $cpassword ?>">
            <select name="user-role" >
                <option value="0">Autor</option>
                <option value="1">Admin</option>
            </select>
            <div class="form_control">
                <label for="avatar"></label>
                <input type="file" id="avatar" name="avatar">

            </div>
              <button type="submit" name="submit" class="btn">Agregar usuario</button>
    
        </form>
    </div>
</div>

