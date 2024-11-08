<?php

include 'partials/header.php';

if(isset($_GET['id'])){

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM categories WHERE id=$id" ;
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) == 1){
      $category = mysqli_fetch_assoc($result);
    }

}else{
    header('location:' .ROOT. 'admin/manage-category');
    die();

}

?>


<div class="form_section">
    <div class="container form_section-container">
        <h2>EDITAR CATEGORIA</h2>
    
        <form action="edit-category-logic.php" method="POST">
            <input type="hidden" value="<?= $category['id'] ?>" name="id" >
            <input type="text" name="title" value="<?= $category['title'] ?>" placeholder="titulo">
            <textarea rows="8" name="description" placeholder="<?= $category['description'] ?>"></textarea>
              <button type="submit" name="submit" class="btn">EDITAR CATEGORIA</button>

        </form>
    </div>
</div>


