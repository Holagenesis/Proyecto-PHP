<?php

session_start();
require './config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $update_query = "UPDATE posts SET category_id = 5 WHERE category_id=$id";
    $update_result = mysqli_query($conn, $update_query);

    if(!mysqli_errno($conn)){
    
    $delete_category_query = "DELETE FROM categories WHERE id = $id LIMIT 1";
    $delete_result = mysqli_query($conn,$delete_category_query);


    $_SESSION['delete-category-success'] = "categoria eliminada correctamente";
    
    }
}


header('location:'. ROOT. 'admin/manage-category.php');
die();

?>