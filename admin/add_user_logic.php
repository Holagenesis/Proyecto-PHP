<?php


require './config/database.php';

session_start();

if(isset($_POST['submit'])){

    $first =filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last =filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user =filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email =filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $is_admin= filter_var($_POST['user-role'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];

    if(!$first){
        $_SESSION['add-user'] = "Ingrese su nombre";
    }elseif(!$last){
        $_SESSION['add-user'] = "Ingrese su segundo nombre";
    }elseif(!$user){
        $_SESSION['add-user'] = "Ingrese su nombre de usuario";
    }elseif(!$email){
        $_SESSION['add-user'] = "Ingrese su email";
    }elseif(strlen($password) < 8 || strlen($cpass)< 8){
        $_SESSION['add-user'] = "su contraseña debe tener mas de 8 caracteres";
    }else {
        if($password != $cpass){
            $_SESSION['add-user'] = "las contraseñas no coinciden";
        }else{
           

            $user_check = "SELECT * FROM users WHERE username='$user' AND email='$email' ";
            $query = mysqli_query($conn, $user_check);

            if(mysqli_num_rows($query) > 0){
                $_SESSION['add-user'] = 'este usuario ya existe';
            }else{
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp = $avatar['tmp_name'];
                $avatar_destination = '../img/' . $avatar_name;

                $allowed = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);

                if(in_array($extention, $allowed)){
                    if($avatar['size'] < 1000000){

                        move_uploaded_file($avatar_tmp, $avatar_destination);

                    }else{
                        $_SESSION['add-user'] = "imagen muy grande";
                    }

                }else{
                    $_SESSION['add-user'] = "el archivo debe ser png, jpg o jpeg";
                }
            }
        }
    }
   if(isset($_SESSION['add-user'])){

      $_SESSION['add-user-data'] = $_POST;

       header('location:'.ROOT. 'admin/add-user.php');
       die();
    }else{
    $insert=  "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES
    ('$first','$last','$user', '$email', '$password','$avatar_name', $is_admin)";

     $query_insert = mysqli_query($conn, $insert);
  
    $_SESSION['add-user-success'] = "Nuevo usuario $firstname $lastname registrado con exito";

   header('location:'.ROOT.'admin/manage-users.php');
    die();   
   
    }

}else{
  header('location:'. ROOT. 'admin/add-user.php');
  die();

}

?>