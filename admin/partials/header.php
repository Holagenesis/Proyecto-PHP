<?php


include '../partials/header.php';


if(!isset($_SESSION['user-id'])){
   header('location:'. ROOT .'signin.php');
   die();
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="../css/estilo.css">

    
</head>
<body>
    
    <nav>
        <div class="container nav_container">
            <a href="index.php" class="nav_logo">BLOG</a>
            <ul class="nav_items">
                <li><a href="<?php echo ROOT ?>index.php">Inicio</a></li>
                <li><a href="<?php echo ROOT ?>blog.php">Blog</a></li>
                <li><a href="<?php echo ROOT ?>about.php">Sobre mi</a></li>
                <li><a href="<?php echo ROOT ?>services.php">Servicios</a></li>
                <li><a href="<?php echo ROOT ?>contact.php">Contacto</a></li>

                <?php  if(isset($_SESSION['user-id'])){  ?>

                    <li class="nav_profile">
                    <div class="avatar">
                    <img src="<?= '../img/'. $avatar['avatar'] ?>" >
                    </div>
                    <ul>
                        <li><a href="<?php echo ROOT ?>admin/index.php">Dashboard</a></li>
                        <li><a href="<?php echo ROOT ?>logout.php">Salir</a></li>
                    </ul>
                
                   </li>
                <?php }else{  ?>

                <li><a href="../signin.php">Ingresar</a></li>

               <?php } ?>
            </ul>
            <button id="open_nav"><i class="uil uil-bars"></i></button>
            <button id="close_nav"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>

    <div class="dashboard">
      
    <ul>
                <li>
                    <a href="add-post.php"><i class="icon uil uil-pen"></i>
                      
                      Agregar Post
                    </a>
                </li>
                <li>
                    <a href="index.php"><i class="icon uil uil-postcard"></i>
                      Tabla Post
                    </a>
                </li>

                <?php if(isset($_SESSION['user_is_admin'])):  ?>

                <li>
                    <a href="add-user.php"><i class="icon uil uil-user-plus"></i>
                      Agregar Usuario
                    </a>
                </li>
                <li>
                    <a href="manage-users.php"><i class=" icon uil uil-users-alt"></i>
                     Tabla Usuarios
                    </a>
                </li>
                <li>
                    <a href="add-category.php"><i class="icon uil uil-edit"></i>
                      Agregar Categoria
                    </a>
                </li>
                <li>
                    <a href="manage-category.php" class="active"><i class="icon uil uil-list-ul"></i>
                      Tabla categorias
                    </a>
                </li>
               
            </ul>
            <?php  endif ?>
    </div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

