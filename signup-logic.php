<?php

session_start();
require './config/database.php';

if(isset($_POST['submit'])){
    $first =filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last =filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user =filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email =filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn,$_POST['cpassword']);
    $avatar = $_FILES['avatar'];

    if(!$first){
        $_SESSION['signup'] = "Ingrese su nombre";
    }elseif(!$last){
        $_SESSION['signup'] = "Ingrese su segundo nombre";
    }elseif(!$user){
        $_SESSION['signup'] = "Ingrese su nombre de usuario";
    }elseif(!$email){
        $_SESSION['signup'] = "Ingrese su email";
    }elseif(strlen($password) < 8 || strlen($cpass)< 8){
        $_SESSION['signup'] = "su contraseña debe tener mas de 8 caracteres";
    }else {
        if($password !== $cpass){
            $_SESSION['signup'] = "las contraseñas no coinciden";
        }else{
         

            $user_check = "SELECT * FROM users WHERE username='$user' OR email='$email' ";
            $query = mysqli_query($conn, $user_check);

            if(mysqli_num_rows($query) > 0){
                $_SESSION['signup'] = 'este usuario ya existe';
            }else{
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp = $avatar['tmp_name'];
                $avatar_destination = 'img/' . $avatar_name;

                $allowed = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);

                if(in_array($extention, $allowed)){
                    if($avatar['size'] < 1000000){

                        move_uploaded_file($avatar_tmp, $avatar_destination);

                    }else{
                        $_SESSION['signup'] = "imagen muy grande";
                    }

                }else{
                    $_SESSION['signup'] = "el archivo debe ser png, jpg o jpeg";
                }
            }
        }
    }
   if(isset($_SESSION['signup'])){

      $_SESSION['signup-data'] = $_POST;

       header('location:signup.php');
       die();
    }else{
    $insert=  "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES
    ('$first','$last','$user', '$email', '$password','$avatar_name', 0)";

     $query_insert = mysqli_query($conn, $insert);
  
    $_SESSION['signup-success'] = "Registro exitoso";

   header('location:signin.php');
    die();   
   
    }

}else{
    header('location:signup.php');
    die();
}

?>