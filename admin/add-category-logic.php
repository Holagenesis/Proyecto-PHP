<?php


require './config/database.php';

session_start();

if(isset($_POST['submit'])){
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ;
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ;

    if(!$title){
        $_SESSION['add-category'] = "Ingrese titulo";
    }elseif(!$description){
        $_SESSION['add-category'] = "Ingrese descripcion";
    }

    if(isset($_SESSION['add-category'])){
       $_SESSION['add-category-data'] = $_POST;
       header('location:'. ROOT. 'admin/add-category.php');
       die();
    }else{
       $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
       $result = mysqli_query($conn, $query);

       if(mysqli_errno($conn)){
         $_SESSION['add-category'] ="No se pudo añadir la categoria";
         header('location:'.ROOT.'admin/add-category.php');
         die();
       }else{
        $_SESSION['add-category-success'] ="Categoria añadida con exito";
        header('location:'.ROOT.'admin/manage-category.php');
        die();
       }
    }
}else{
    header('location:'. ROOT. 'admin/add-category.php');
    die();
  
  }

?>