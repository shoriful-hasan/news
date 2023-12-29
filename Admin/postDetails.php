<?php
$title = 'post';
include "layout/head.php";

?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include "layout/sidebar.php";
        ?>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
             <?php include "layout/topbar.php"?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="post.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i
                                class="fas fa-plus"></i>Back to List</a>
                    </div>

                    <!-- Content Row -->
                         <!-- DataTales Example -->
                         <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Post Details </h6>
                        </div>
                        <div class="card-body">

<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = trim($_GET['id']);
    $sql = "SELECT post.*,category.name AS CategoryName,admin.name AS Author FROM post 
    INNER JOIN category ON post.category_id=category.id 
    INNER JOIN admin ON post.admin_id=admin.id
     WHERE post.id=:postId";
    $stmp = $conn->prepare($sql);
    $stmp->bindParam(':postId', $id, PDO::PARAM_INT);
    $stmp->execute();
    $row = $stmp->fetch(PDO::FETCH_OBJ);

   
}





?>

<img src="<?php echo $row->image; ?>" alt="">

<h4 class="py-2"><?php echo $row->title?></h4>
<p>
    Author:<?php echo $row->Author?>  <?php echo $row->created_at?>
</p>

<div>
    <?php echo $row->description ?>
</div>

<?php 
                                                
        $sql = "SELECT tag.* FROM tag INNER JOIN post_tag ON tag.id = post_tag.tag_id WHERE post_id=:postId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':postId', $row->id, PDO::PARAM_INT);
        $stmt->execute();
        $tags = $stmt->fetchAll(PDO::FETCH_OBJ);
        if ($tags) {
            foreach ($tags as $key => $tag) { ?>
                <span class="fs-5 btn btn-info "><?php echo $tag->name; ?></span>
        <?php
            }
        }
        
        ?>



</div>
</div>
                    <!-- Content Row -->

 
                 
                    <!-- Content Row -->

                    
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>this is my country</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $('#categoryName').on('keyup', function () {
        $("#categorySlug").val('');
        var category = $(this).val();
        category = slugify(category);
        $("#categorySlug").val(category);
    });

    function slugify(text) {
        return text.toLowerCase()
            .replace(/^-+|-+$/g, '')
            .replace(/\s/g, '-')
            .replace(/\-\-+/g, '-');
    }


</script>








 <?php
include "layout/footer.php";
 
 ?>   
