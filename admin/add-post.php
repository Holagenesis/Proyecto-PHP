<?php

include 'partials/header.php';


$query = "SELECT * FROM categories";
$categories = mysqli_query($conn, $query);

$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;

unset($_SESSION['add-post-data']);


?>


<div class="form_section">
    <div class="container form_section-container">
        <h2>AGREGAR POST</h2>
        <?php if(isset($_SESSION['add-post'])): ?>
           <div class="alert_message error ">
               <p>
                   <?= $_SESSION['add-post'];  
                       unset($_SESSION['add-post']);
                   ?>
               </p>
           </div>
        <?php  endif ?>
        <form action="add-post-logic.php" enctype="multipart/form-data" method ="POST">

            <input type="text" name="title" value="<?= $title ?>" placeholder="titulo">
            <select name="category">
                <?php while($category = mysqli_fetch_assoc($categories)): ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea rows="10" name="body" placeholder="cuerpo"<?= $body ?>></textarea>
            <?php if(isset($_SESSION['user_is_admin'])): ?>
            <div class="form_control  inline">
                <input type="checkbox" name="is_featured" value="1" checked>
                <label for="is_featured" >featured</label>

            </div>
            <?php endif ?>
            <div class="form_control">
                <label for="thumbnail" >Portada</label>
                <input type="file" name="thumbnail">

            </div>
            
            <button type="submit" name="submit" class="btn">AGREGAR</button>

        </form>
    </div>
 </div>
