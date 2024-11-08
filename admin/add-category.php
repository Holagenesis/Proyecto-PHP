<?php

include 'partials/header.php';

$title = $_SESSION['add-category-data']['title'] ?? null ;
$description = $_SESSION['add-category-data']['description'] ?? null;

unset($_SESSION['add-category-data']);
?>


<div class="form_section">
    <div class="container form_section-container">
        <h2>AGREGAR CATEGORIA</h2>
        <?php if(isset($_SESSION['add-category'])): ?>
           <div class="alert_message error">
              <p>
                <?=  
                    $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                ?>
              </p>
        
            </div>
        <?php endif ?>

        <form action="add-category-logic.php" method="POST">
            <input type="text" value="<?= $title ?>" name="title"  placeholder="titulo">
            <textarea rows="8" value="<?= $description ?>" name ="description" placeholder="descripcion"></textarea>
              <button type="submit" name="submit" class="btn">AGREGAR</button>

        </form>
    </div>
</div>

