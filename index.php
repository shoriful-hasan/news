<?php
include "layout/head.php";

?>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
 <?php include "layout/header.php"; ?>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
<?php include "banner.php";?>
    <!-- Banner Ends Here -->



    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            
            <div class="all-blog-posts">
              <div class="row">


  <?php
$sql = "SELECT post.*,category.name AS CategoryName,admin.name AS Author FROM post 
INNER JOIN category ON post.category_id=category.id 
INNER JOIN admin ON post.admin_id=admin.id

WHERE post.status=true ORDER BY post.id DESC LIMIT 3";
$stmt = $conn->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

if($posts){
    foreach($posts as $post){?>
                <div class="col-lg-12">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="admin/<?php echo $post->image?>" alt="">
                    </div>
                    <div class="down-content">
                      <span><?php echo $post->CategoryName?></span>
                      <a href="post-details.php">
                        <h4><?php echo $post->title?></h4></a>
                      <ul class="post-info">

                        <li><a href="#"><?php echo $post->Author?></a></li>
                        <li><a href="#">
                        <?php 
                    $d= date_create($post->created_at);
                    echo date_format($d, 'M, d Y h:i;s');
                    
                    ?>
                        </a></li>
                      </ul>

                      <p>
                        <hr>
                        <!-- post description -->
                        <?php echo$post->description?>

                      </p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-6">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <li><a href="#">Beauty</a>,</li>
                              <li><a href="#">Nature</a></li>
                            </ul>
                          </div>
                          <div class="col-6">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
               <?php
               
    }
  }
               
               
               ?>



                <div class="col-lg-12">
                  <div class="main-button">
                    <a href="blog.php">View All Posts</a>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-lg-4">
<?php include "layout/sidebar.php"; ?>


          </div>
        </div>
      </div>
    </section>

    
   <?php include "layout/footer.php";?>

  </body>
</html>