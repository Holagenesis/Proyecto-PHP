<?php

session_start();
require './config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) == 1){
      $avatar_name = $user['avatar'];
      $avatar_path= '../img/'. $avatar_name;
        if($avatar_path){
           unlink($avatar_path);
        }
    }


    $thumbnail_query = "SELECT thumbnail FROM posts WHERE author_id = $id";
    $thumbnail_result = mysqli_query($conn, $thumbnail_query);

    if(mysqli_num_rows($thumbnail_result) > 0){
       while($thumbnail = mysqli_fetch_assoc($thumbnail_result)){
          $thumbnail_path = '../img/'.$thumbnail['thumbnail'];

          if($thumbnail_path){
             unlink($thumbnail_path);
          }

       }
    }



    $delete_user_query = "DELETE FROM users WHERE id = $id";
    $delete_result = mysqli_query($conn,$delete_user_query);

    if(mysqli_errno($conn)){
       $_SESSION['delete-user'] = "no se pudo eliminar al usuario"; 
    }else{
        $_SESSION['delete-user-success'] = "usuario '{$user['firstname']}' eliminado correctamente";
    }

}


header('location:'. ROOT. 'admin/manage-users.php');
die();

?>