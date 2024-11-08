<?php


require './config/database.php';

session_start();

if(isset($_POST['submit'])){
    $author = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    

    $is_featured = $is_featured == 1?: 0;

    if(!$title){
        $_SESSION['add-post'] = "introduzca el titulo";
    }elseif(!$category){
        $_SESSION['add-post'] = "seleccione la categoria de su post";
    }elseif(!$body){
        $_SESSION['add-post'] = "introduzca el cuerpo del post";
    }elseif(!$thumbnail['name']){
        $_SESSION['add-post'] = "seleccione la portada de su post";
    }else{

        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination = '../img/' . $thumbnail_name;

        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $thumbnail_name); 
        $extension = end($extension);

        if(in_array($extension, $allowed_files)){

            if($thumbnail['size'] < 1000000){
              move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination);
            }else{
                $_SESSION['add-post'] = "el archivo es muy grande";
            }
        }else{
            $_SESSION['add-post'] = "el archivo debe ser png, jpg o jpeg"; 
        }
    }

    if(isset($_SESSION['add-post'])){
        $_SESSION['add-post-data'] = $_POST;
        header('location: '. ROOT. 'admin/add-post.php');
        die();

    }else{
        if($is_featured == 1){
          $zero_query = "UPDATE posts SET is_featured=0";
          $zero_result = mysqli_query($conn, $zero_query);
        }

      
        $insert = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) VALUES ('$title','$body','$thumbnail_name', '$category','$author', $is_featured)";
        $result= mysqli_query($conn, $insert);

       
        if(mysqli_errno($conn)){
            $_SESSION['add-post'] ="No se pudo añadir ";
            header('location:'.ROOT.'admin/add-post.php');
            die();
          }else{
           $_SESSION['add-post-success'] =" exito";
           header('location:'.ROOT.'admin/');
           die();
          }
       
    }

    

}

header('location:'.ROOT.'admin/add-post.php');
die();

?>