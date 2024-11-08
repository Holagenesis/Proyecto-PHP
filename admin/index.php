<?php


include 'partials/header.php';



$current_user = $_SESSION['user-id'];

$query= "SELECT id, title, category_id FROM posts Where author_id=$current_user ORDER BY id DESC";

$posts = mysqli_query($conn, $query);

?>



<?php  if(isset($_SESSION['add-post-success'])): ?>
            <div class="alert_message success container">
                <p>
                    <?=  $_SESSION['add-post-success'];
                         unset($_SESSION['add-post-success']);
                    ?>
                </p>
            </div>
<?php  elseif(isset($_SESSION['edit-post-success'])): ?>
            <div class="alert_message success container">
                <p>
                    <?=  $_SESSION['edit-post-success'];
                         unset($_SESSION['edit-post-success']);
                    ?>
                </p>
            </div>
<?php  elseif(isset($_SESSION['edit-post'])): ?>
            <div class="alert_message error container">
                <p>
                    <?=  $_SESSION['edit-post'];
                         unset($_SESSION['edit-post']);
                    ?>
                </p>
            </div>
<?php  elseif(isset($_SESSION['delete-post-success'])): ?>
            <div class="alert_message success container">
                <p>
                    <?=  $_SESSION['delete-post-success'];
                         unset($_SESSION['delete-post-success']);
                    ?>
                </p>
            </div>
<?php endif ?>

    <div >
        <button id="show_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
      
      
        <div class="main">
            <h2>Tabla de POST</h2>
            <?php  if(mysqli_num_rows($posts) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>titulo</th>
                        <th>categoria</th>
                        <th>editar</th>
                        <th>eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($post = mysqli_fetch_assoc($posts)): ?>

                        <?php
                            
                          $category = $post['category_id'];
                          $category_query = "SELECT title FROM categories WHERE id = $category";
                          $category_result = mysqli_query($conn, $category_query);
                          $category_fetch = mysqli_fetch_assoc($category_result);
                          ?>
                    <tr>
                        <td><?= $post['title'] ?></td>
                        <td><?= $category_fetch['title'] ?></td>
                        <td><a href="<?= ROOT ?>admin/edit-post.php?id=<?= $post['id'] ?>" class="btn  s">Editar</a></td>
                        <td><a href="<?= ROOT ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="btn  danger">Eliminar</a></td>
                    </tr>
                    <?php endwhile  ?>
                </tbody>
            </table>
            <?php else:  ?>
                <div class="alert_message error">no hay post </div>
            <?php endif ?>
            </div>
    </div>


<script src="index.js"></script>

<?php
/*
include 'partials/footer.php';
*/
?>