<?php

session_start();
require './config/database.php';

if(isset($_POST['submit'])){

    $id = $_POST['id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if(!$title || !$description){
        $_SESSION['edit-category'] = "colocar titulo o descripcion";

    }else{
        $query = "UPDATE categories SET title='$title', description = '$description'
        WHERE id = $id ";

        $result = mysqli_query($conn, $query);

        if(mysqli_errno($conn))
        {
             $_SESSION['edit-category'] = "fallo la actualizacion";
        }else{ 
            $_SESSION['edit-category-success'] = "categoria actualizada con exito";
        }
        
        

    }
}

header('location:'. ROOT. 'admin/manage-category.php');
die();

?>