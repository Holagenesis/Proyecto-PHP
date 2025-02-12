<?php

include 'partials/header.php';

if(isset($_GET['id'])){
   $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
   $query = "SELECT * FROM posts WHERE category_id=$id ORDER BY date_time DESC";
   $posts = mysqli_query($conn, $query);
}else{
   header('location:'. ROOT . 'blog.php');
   die();
}

?>
   <header class="category_title">
    <h2>
          <?php
               
               $category_id = $id;
               $category_query = "SELECT * FROM categories WHERE id=$id";
               $category_result = mysqli_query($conn, $category_query);
               $category = mysqli_fetch_assoc($category_result);
               echo $category['title'];
              ?>
    </h2>
   </header>

 <?php if(mysqli_num_rows($posts) > 0): ?>   
   <section class="posts">
        <div class="container posts_container">
        <?php while($post = mysqli_fetch_assoc($posts)): ?>

            <article class="post">
                <div class="post_thumbail">
                  <img src="./img/<?= $post['thumbnail'] ?>" alt="">
                </div>
                <div class="post_info">
              
                   <h3 class="post_title">
                      <a href="<?= ROOT ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                   </h3>
                   <p class="post_body">
                       <?= substr( $post['body'], 0, 150 ) ?>...
                   </p>
                    <div class="post_author">
                       <?php
                          $author_id = $post['author_id'];
                          $author_query = "SELECT * FROM users WHERE id = $author_id";
                          $author_result = mysqli_query($conn, $author_query);
                          $author = mysqli_fetch_assoc($author_result);
                        ?>
                       <div class="post_author-avatar">
                          <img src="./img/<?= $author['avatar'] ?>">
                       </div>
                       <div class="post_autor-info">
                          <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                          <small>
                             <?= date("M d, Y - H:i", strtotime($post['date_time']))  ?>
                          </small>
                       </div>
                   </div>
                </div>

            </article>
        <?php endwhile ?>

        </div>
    </section>
<?php else: ?>
   <div class="alert_message error">
      <p>NO SE ENCONTRARON POSTS</p>

   </div>
<?php endif ?>

    <section class="category_buttons">
        <div class="container category_buttons-container">
           <?php 
              $all_categories = "SELECT * FROM categories";
              $all = mysqli_query($conn, $all_categories);
           ?> 
           <?php while($category = mysqli_fetch_assoc($all)): ?>
            <a href="<?= ROOT ?>category_posts.php?id=<?= $category['id'] ?>" class="category_button"><?= $category['title'] ?></a>
          <?php endwhile ?>
           

        </div>
    </section>


<?php

include 'partials/footer.php';

?>

