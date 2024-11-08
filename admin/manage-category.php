<?php

include 'partials/header.php';
session_start();

$query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($conn, $query);

?>


<?php  if(isset($_SESSION['add-category-success'])): ?>
            <div class="alert_message success container">
                <p>
                    <?=  $_SESSION['add-category-success'];
                         unset($_SESSION['add-category-success']);
                    ?>
                </p>
            </div>

<?php  elseif(isset($_SESSION['add-category'])): ?>
            <div class="alert_message error container">
                <p>
                    <?=  $_SESSION['add-category'];
                         unset($_SESSION['add-category']);
                    ?>
                </p>
            </div>
            <?php  elseif(isset($_SESSION['edit-category-success'])): ?>
            <div class="alert_message success container">
                <p>
                    <?=  $_SESSION['edit-category-success'];
                         unset($_SESSION['edit-category-success']);
                    ?>
                </p>
            </div>

        <?php  elseif(isset($_SESSION['edit-category'])): ?>
            <div class="alert_message error container">
                <p>
                    <?=  $_SESSION['edit-category'];
                         unset($_SESSION['edit-category']);
                    ?>
                </p>
            </div>
        <?php  elseif(isset($_SESSION['delete-category-success'])): ?>
            <div class="alert_message error container">
                <p>
                    <?=  $_SESSION['delete-category-success'];
                         unset($_SESSION['delete-category-success']);
                    ?>
                </p>
            </div>
        
<?php endif ?> 

    <div >
        <button id="show_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
       
           
       
        <div class="main">
            <h2>Tabla de categorias</h2>
            <?php if(mysqli_num_rows($categories) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>titulo</th>
                        <th>editar</th>
                        <th>eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($category = mysqli_fetch_assoc($categories)): ?>
                    <tr>
                        <td><?= $category['title'] ?></td>
                        <td><a href="<?= ROOT ?>admin/edit-category.php?id=<?= $category['id'] ?>" 
                        class="btn s">EDITAR</a></td>
                        <td><a href="<?= ROOT ?>admin/delete-category.php?id=<?= $category['id'] ?>" 
                        class="btn danger">ELIMINAR</a></td>
                    </tr>
                    
                </tbody>
                  <?php endwhile ?>
            </table>
            <?php else: ?>
               <div class="alert_message error"><?= "no hay categorias registradas" ?></div> 
            <?php endif ?>
            </div>
    </div>


