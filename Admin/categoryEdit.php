<?php

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
                        <a href="category.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i
                                class="fas fa-plus"></i>Back to List</a>
                    </div>

                    <!-- Content Row -->
                         <!-- DataTales Example -->
                         <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Category Create</h6>
                        </div>
                        <div class="card-body">
                        <div class="container py-4">



<?php

$error = [];
$data = [];


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $category_name = $_POST['categoryName'];
    $category_slug = $_POST['categorySlug'];
    $categoryId    = $_POST['categoryId'];



if(empty($category_name))
{$error['categoryName'] = 'CategoryName is Require';}

else{
    $data['categoryName'] = $category_name;
}


if(empty($category_slug))
{
    $error['categorySlug'] = 'categorySlug is Required';
}



else{
    $data['categorySlug']  = $category_slug;
}

if(empty($error['categoryName']) && empty($error['categorySlug']))
{
   
   
   
    try {
    
      $sql = "UPDATE category SET name=:name,slug=:slug WHERE id  =:id";
      if($stmp = $conn->prepare($sql)){
        $stmp->bindParam(':name',$data['categoryName'],PDO::PARAM_STR);
        $stmp->bindParam(':slug',$data['categorySlug'],PDO::PARAM_STR);
        $stmp->bindParam(':id',$categoryId,PDO::PARAM_INT);
      }  
    if($stmp->execute()){
        $_SESSION['success'] = 'Category Edit successfully';
                //header('location:category.php');    
   echo '<script>window.location.href="category.php"</script>';
    }




    } catch (PDOException $e) {
      die('could not insert category'.$sql .$e->getMessage());
    }
} 







}

/*get url id*/ 

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = trim($_GET['id']);
    $sql = "SELECT * FROM category WHERE id=:id";
    $stmp = $conn->prepare($sql);
    $stmp->bindParam(':id',$id,PDO::PARAM_INT);
$stmp->execute();
   $row = $stmp->fetch(PDO::FETCH_OBJ);
    
    }
    






    

?>

 <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" autocomplete="off">


<div class="mb-3">
    <label for="categoryName" class="form-label">Category Name</label>
    <input type="text" name="categoryName" class="form-control" id="categoryName" value ="<?php echo $row ->name??'' ?>">
    <small class="text-danger">
        <?php echo $error['categoryName']??'' ?>
    </small>
</div>


<div class="mb-3">
    <label for="categorySlug" class="form-label">Category Slug</label>
    <input type="text" name="categorySlug" class="form-control" id="categorySlug" value ="<?php echo $row ->slug??'' ?>">
    <small class="text-danger">
<?php echo $error['categoryslug']??''?>
    </small>
</div>

<input type="hidden" name="categoryId" value="<?php echo $row->id??''?>">
<button type="submit" name="submit" class="btn btn-success">Update</button>

</form>














                <!-- </div> -->
            <!-- </div> -->
        <!-- </div> -->
    <!-- </div> -->
</div>
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



<!-- 

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
 -->

 <?php
include "layout/footer.php";
 
 ?>   
