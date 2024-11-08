<?php

include 'partials/header.php';

$current_admin = $_SESSION['user-id'];

$query = "SELECT * FROM users WHERE NOT id=$current_admin";
$users = mysqli_query($conn,$query);

?>




<?php  if(isset($_SESSION['add-user-success'])): ?>
            <div class="alert_message success container">
                <p>
                    <?=  $_SESSION['add-user-success'];
                         unset($_SESSION['add-user-success']);
                    ?>
                </p>
            </div>

        <?php  elseif(isset($_SESSION['edit-user-success'])): ?>
            <div class="alert_message success container">
                <p>
                    <?=  $_SESSION['edit-user-success'];
                         unset($_SESSION['edit-user-success']);
                    ?>
                </p>
            </div>

        <?php  elseif(isset($_SESSION['edit-user'])): ?>
            <div class="alert_message error container">
                <p>
                    <?=  $_SESSION['edit-user'];
                         unset($_SESSION['edit-user']);
                    ?>
                </p>
            </div>
        <?php  elseif(isset($_SESSION['delete-user'])): ?>
            <div class="alert_message error container">
                <p>
                    <?=  $_SESSION['delete-user'];
                         unset($_SESSION['delete-user']);
                    ?>
                </p>
            </div>
        <?php  elseif(isset($_SESSION['delete-user-success'])): ?>
            <div class="alert_message error container">
                <p>
                    <?=  $_SESSION['delete-user-success'];
                         unset($_SESSION['delete-user-success']);
                    ?>
                </p>
            </div>
 <?php endif ?> 

    <div class="main">
        <button id="show_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>  

         
     
            <h2>Tabla de Usuarios</h2>
            <?php if(mysqli_num_rows($users) > 0):?>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Username</th>
                         <th>Editar</th>
                        <th>eliminar</th>
                         <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  while($user = mysqli_fetch_assoc($users)): ?>
                    <tr>
                        <td><?=  "{$user['firstname']} {$user['lastname']}" ?></td>
                        <td><?=  $user['username'] ?></td>
                        <td><a href="<?= ROOT ?>admin/edit-user.php?id=<?= $user['id']  ?>" 
                        class="btn  s">Editar</a></td>
                       
                        <td><a href="<?= ROOT ?>admin/delete-user.php?id=<?= $user['id'] ?>"
                         class="btn  danger">Eliminar</a></td>
                        <td><?= $user['is_admin'] ? 'SI': 'NO' ?></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else: ?>
               <div class="alert_message error"><?= "no hay usuarios registrados" ?></div> 
               <?php endif ?>
           
    </div>



