<?php


require './config/database.php';

session_start();

if(isset($_POST['submit'])){

    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT); 
    $previous_thumbnail = filter_var($_POST['previous_thumbnail'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    

    $is_featured = $is_featured == 1?: 0;

    if(!$title){
        $_SESSION['edit-post'] = "introduzca el titulo";
    }elseif(!$category){
        $_SESSION['edit-post'] = "seleccione la categoria de su post";
    }elseif(!$body){
        $_SESSION['edit-post'] = "introduzca el cuerpo del post";
    }else{

        if($thumbnail['name']){
            $previous_path = '../img/'. $previous_thumbnail;
            if($previous_path){
                unlink($previous_path);
            }

        }

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
                $_SESSION['edit-post'] = "el archivo es muy grande";
            }
        }else{
            $_SESSION['edit-post'] = "el archivo debe ser png, jpg o jpeg"; 
        }
    }

    if(isset($_SESSION['edit-post'])){
        $_SESSION['edit-post-data'] = $_POST;
        header('location: '. ROOT. 'admin/edit-post.php');
        die();

    }else{
        if($is_featured == 1){
          $zero_query = "UPDATE posts SET is_featured=0";
          $zero_result = mysqli_query($conn, $zero_query);
        }

        $thumbnail_insert = $thumbnail_name ?? $previous_thumbnail;

      
        $edit = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_name', 
        category_id='$category', is_featured= '$is_featured' WHERE id=$id LIMIT 1";
        $result= mysqli_query($conn, $edit);

       
      
           $_SESSION['edit-post-success'] ="se actualizo con exito";
           header('location:'.ROOT.'admin/');
           die();
      
       
    }

    

}

header('location:'.ROOT.'admin/edit-post.php');
die();

?>