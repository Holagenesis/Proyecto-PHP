<?php 

session_start();
require 'config/database.php';


if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];  
   

    if(!$username){
      $_SESSION['signin'] = "Se requiere el usuario y la contraseña";
    } else if (!$password){
        $_SESSION['signin'] = "contraseña incorrecta";
    }else{
        $fetch_query = "SELECT * FROM users WHERE username='$username' OR email='$username' AND password='$password' ";
        $result = mysqli_query($conn,$fetch_query);

        if(mysqli_num_rows($result) == 1){

            $user_record = mysqli_fetch_assoc($result);
            $dbpassword = $user_record['password'];

            if($password === $dbpassword){

                $_SESSION['user-id'] = $user_record['id'] ;

                if($user_record['is_admin'] == 1){
                    $_SESSION['user_is_admin'] = true ;
                }

                header('location:'.ROOT.'index.php');
                die();

            }

        }else{
          $_SESSION['signin'] = "usuario no encontrado";
        }

    }

    if(isset($_SESSION['signin'])){
       $_SESSION['signin-data'] = $_POST;
       header('location:signin.php');
       die();
    }
}else{
   header('location:signin.php');
   die();
}

?>