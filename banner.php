<div class="main-banner header-text">
    <div class="container-fluid">
        <div class="owl-banner owl-carousel">

<?php
$sql = "SELECT post.id,post.title,post.image,post.status,post.created_at,category.name AS 
CategoryName,admin.name AS Author FROM post 
INNER JOIN category ON post.category_id=category.id 
INNER JOIN admin ON post.admin_id=admin.id

WHERE post.status=true ORDER BY post.id DESC LIMIT 6";
$stmt = $conn->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

if($posts){
    foreach($posts as $post){?>


        <div class="item">
        <img src="admin/<?php echo $post->image?>" alt="">
        <div class="item-content">
            <div class="main-content">
                <div class="meta-category">
                    <span><?php echo $post->CategoryName?></span>
                </div>
                <a href="post-details.html">
                    <h4><?php echo $post->title?></h4>
                </a>
                <ul class="post-info">
                    <li><a href="#"><?php echo $post->Author?></a></li>
                    <li><a href="#">
                        
                    
                    <?php 
                    $d= date_create($post->created_at);
                    echo date_format($d, 'M, d Y h:i;s');
                    
                    ?>
                
                
                
                </a></li>
                </ul>
            </div>
        </div>
    </div>



  <?php  }
}

?>

          



        </div>
    </div>
</div>