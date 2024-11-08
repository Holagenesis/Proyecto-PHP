<?php

include 'partials/header.php';



$query = "SELECT * FROM posts ORDER BY date_time DESC ";
$posts = mysqli_query($conn, $query);

?>


   
    <section class="search_bar">
        <form class="container search_bar-container" action="<?= ROOT ?>search.php" method ="GET">
            <div>
               <i class="uil uil-search"></i>
               <input type="search" name="search" placeholder="buscar">
            </div>
            <button type="submit" name="submit" class="btn">buscar</button>
        </form>
    </section>




   

    <section class="posts <?= $featured ?  '' : 'section__extra-margin' ?>">
        <div class="container posts_container">
        <?php while($post = mysqli_fetch_assoc($posts)): ?>

            <article class="post">
                <div class="post_thumbail">
                  <img src="./img/<?= $post['thumbnail'] ?>" alt="">
                </div>
                <div class="post_info">
                <?php
               
               $category_id = $post['category_id'];
               $category_query = "SELECT * FROM categories WHERE id=$category_id";
               $category_result = mysqli_query($conn, $category_query);
               $category = mysqli_fetch_assoc($category_result);

              ?>
                   <a href="<?= ROOT ?>category_posts.php?id=<?= $post['category_id'] ?>" class="category_button"><?= $category['title'] ?></a>
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