<?php

include 'partials/header.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM  users WHERE id=$id" ;
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

}else{
    header('location:'.ROOT.'admin/manage-users.php');
    die();

}

?>


<div class="form_section">
    <div class="container form_section-container">
        <h2>EDITAR USUARIO</h2>

        <form action="<?= ROOT ?>admin/edit-user-logic.php" method="POST">
        <input type="hidden" value="<?= $user['id'] ?>" name="id" >
            <input type="text" value="<?= $user['firstname'] ?>" name="firstname" placeholder="primer nombre">
            <input type="text" value="<?= $user['lastname'] ?>" name="lastname" placeholder="segundo nombre">
       
            <select name="userrole" >
                <option value="0">Autor</option>
                <option value="1">Admin</option>
            </select>
  
              <button type="submit" name="submit" class="btn">Editar usuario</button>
    
        </form>
    </div>
</div>



