<?php

session_start();
require './config/database.php';

if(isset($_POST['submit'])){

    $id = $_POST['id'];
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    if(!$firstname){
        $_SESSION['edit-user'] = "invalidar";

    }else{
        $query = "UPDATE users SET firstname='$firstname', lastname = '$lastname', is_admin = '$is_admin' WHERE id =$id";

        $result = mysqli_query($conn, $query);

        if(mysqli_errno($conn))
        {
             $_SESSION['edit-user'] = "fallo";
        }else{ 
            $_SESSION['edit-user-success'] = "usuario $firstname $lastname actualizado con exito";
        }
        
        

    }
}

header('location:'. ROOT. 'admin/manage-users.php');
die();

?>