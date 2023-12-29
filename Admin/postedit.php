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
    <div id="content-wrapper" class="d-flex flex-column justify-content-center">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include "layout/topbar.php" ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">POST</h1>
                    <a href="post.php" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i
                            class="fas fa-plus"></i>Back to List</a>
                </div>




                <?php

                $error = [];
                $data = [];


                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $title = $_POST['title'];
                    $slug = $_POST['slug'];
                    $description = $_POST['description'];
                    $category = $_POST['category'] ?? '';
                    $tag = $_POST['tag'] ?? '';
                    $status = $_POST['status'] ?? '';
                    $fileName = $_FILES['image']['name'];
                    $fileTmp = $_FILES['image']['tmp_name'];
                    $fileSize = $_FILES['image']['size'];

                    $postId   = $_POST['postId'];
                    $postoldimage   = $_POST['postoldImage'];




                    if (empty($title)) {
                        $error['title'] = 'post title is requird';
                    } else {
                        $data['title'] = $title;
                    }


                    if (empty($slug)) {
                        $error['slug'] = 'Post Slug is Required';
                    } else {
                        $data['slug'] = $slug;
                    }

                    if (empty($description)) {
                        $error['description'] = 'post description is required';
                    } else {
                        $data['description'] = $description;
                    }
                    if (empty($category)) {
                        $error['category'] = 'Category is required';
                    } else {
                        $data['category'] = $category;
                    }

                    if (empty($tag)) {
                        $error['tag'] = 'tag is required';
                    } else {
                        $data['tag'] = $tag;
                    }

                    if (empty($status)) {
                        $error['status'] = 'status is required';
                    } else {
                        $data['status'] = $status;
                    }
                     
                    
if($fileName){
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowItems = array('jpg', 'jpeg', 'png', 'webp');
    $uniqueImage = uniqid() . time() . '.' . $ext;
    $upload_image = 'upload/post' . $uniqueImage;
if ($fileSize > 1048576) {
        $error['image'] = 'image size less then 1 mb';
    } else {
        if (in_array($ext, $allowItems)) {
            $error['image'] = 'only jpg,jpeg,webp,png';
        } else {
           unlink($postoldimage);
    
                move_uploaded_file($fileTmp, $upload_image);
           $data['image'] = $upload_image;
         }
    }



}

else{
$data['image'] = $postoldimage;
}
      
                 
                    if (
                        empty($error['title']) &&
                        empty($error['Slug']) &&
                        empty($error['description']) &&
                        empty($error['category']) &&
                        empty($error['tag']) &&
                        empty($error['status']) &&
                        empty($error['image'])
                    )
                        ; {

                        // SELECT `id`, `category_id`, `admin_id`, `title`, `slug`, `description`, `image`, `status`, `created_at` 
                
                        // FROM `post` WHERE 1
                
                        try {

                            $sql = "UPDATE post SET category_id=:categoryId,admin_id=:adminId, title=:title, slug=:slug, description=:description, image=:image, status=:status, WHERE id=:id" ;

                            if ($stmp = $conn->prepare($sql)) {
                                $cdtime = date('Y-m-d H:i:s');
                                $stmp->bindParam(':categoryId', $data['category'], PDO::PARAM_INT);
                                $stmp->bindParam(':adminId', $_SESSION['admin_id'], PDO::PARAM_INT);
                                $stmp->bindParam(':title', $data['title'], PDO::PARAM_STR);
                                $stmp->bindParam(':slug', $data['slug'], PDO::PARAM_STR);
                                $stmp->bindParam(':description', $data['description'], PDO::PARAM_STR);
                                $stmp->bindParam(':image', $data['image'], PDO::PARAM_STR);
                                $stmp->bindParam(':status', $data['status'], PDO::PARAM_BOOL);
                                $stmp->bindParam(':id', $postId, PDO::PARAM_INT);
                                // $stmp->bindParam(':created_at', $cdtime, PDO::PARAM_STR);
                                $stmp->execute();
                                $lastId = $conn->lastInsertId();


                                // insert post tag
                
                                if ($data['tag']) {
                                    foreach ($tag as $key => $tag) {
                                        $sql = "INSERT INTO post_tag(post_id,tag_id)VALUES(:post_id,:tag_id)";
                                        if ($stmp = $conn->prepare($sql)) {
                                            $stmp->bindParam(':post_id', $lastId, PDO::PARAM_INT);
                                            $stmp->bindParam(':tag_id', $tag[$key], PDO::PARAM_INT);
                                            $stmp->execute();
                                        }
                                    }
                                }






                            }


                            
                                $_SESSION['success'] = 'post insert successfully';
                                //header('location:category.php');    
                                echo '<script>window.location.href="post.php"</script>';
                        




                        } catch (PDOException $e) {
                            die('could not insert tag' . $sql . $e->getMessage());
                        }
                    }







                }









                // function valid($rose){
//     $data = trim($rose);
//     $data = stripcslashes($rose);
//     $data = htmlspecialchars($rose); 
//     return $data;
                
                //     }
                


                if (isset($_GET['id']) && !empty($_GET['id'])) {

                    $id = trim($_GET['id']);
                    $sql = "SELECT * FROM post WHERE id=:id";
                    $stmp = $conn->prepare($sql);
                    $stmp->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmp->execute();
                    $row = $stmp->fetch(PDO::FETCH_OBJ);

                }









                ?>











<!-- Content Row -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">POST Create</h6>
</div>
<div class="card-body">
<div class="container py-4">




<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
<!-- ROW START HERE -->
<div class="row">
<div class="col-md-8">
<!-- Name field start here -->
<div class="form-group">
<label for="title" class="form-label">POST Name</label>
<input type="text" name="title" class="form-control" id="title" value="<?php echo $row->title??$data['title'] ?>">
<span class="text-danger">
    <?php echo $error['title'] ?? ''; ?>
</span>
</div>

<!-- Name field end here -->

<!-- slug field start here -->
<div class="form-group">
<label for="slug" class="form-label">POST Slug</label>
<input type="text" name="slug" class="form-control" id="slug" value="">
<span class="text-danger">
    <?php echo $error['slug'] ?? ''; ?>
</span>
</div>

<!-- slug field start here -->


<!-- tag here start -->
<div class="form-group">
<?php


if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = trim($_GET['id']);
    $sql = "SELECT * FROM tag WHERE id=:id";
    $stmp = $conn->prepare($sql);
    $stmp->bindParam(':id', $row->id, PDO::PARAM_INT);
    $stmp->execute();
    $tagIds = $stmp->fetchAll(PDO::FETCH_OBJ);

}









?>


<label for="tag" class="form-label">post Tags</label>

<select name="tag" id="tag" class="form-control" multiple>

    <option disabled>Select</option>
    <?php
    $sql = "SELECT * FROM tag";
    $stmt = $conn->query($sql);
    $tags = $stmt->fetchAll(PDO::FETCH_OBJ);


    if ($tags != null) {
        foreach ($tags as $key => $tag) { ?>

            <option
            <?php
            foreach ($tagIds as $tagid) {
           if($tagid->id == $tag->id){
            echo "selected";
           }
            }
            
            
            ?>
            
            value="<?php echo $tag->id ?>"><?php echo $tag->name ?></option>
            <?php
        }

    }
    ?>

</select>

<span class="text-danger">
    <?php echo $error['tag'] ?? ''; ?>
</span>
</div>

<!-- tag here end -->


<!-- description start here -->
<label for="description" class="form-label">Post Description</label>

<textarea name="description" id="description" class="form-control">
<?php echo $row->description??$data['description']?>
</textarea>
<span class="text-danger">
<?php echo $error['description'] ?? ''; ?>
</span>
<!-- description End here -->
</div>



<div class="col-md-4">
<!-- Post image start here -->
<div class="form-group">
<label for="image" class="form-label">Post Image</label>
<input type="file" name="image" class="form-control dropify" 

data-default-file="<?php echo $row->image??''?>";

id="image" value="">
<span class="text-danger">
    <?php echo $error['image'] ?? ''; ?>
</span>
</div>
<!-- Post image end here -->


<!-- category field start here -->
<div class="form-group">
<label for="category" class="form-label">Select Post Category</label>

<select name="category" id="category" class="form-control">

    <option disabled selected value="">Select</option>
    <?php



    $sql = "SELECT * FROM category";
    $stmt = $conn->query($sql);
    $categories = $stmt->fetchAll(PDO::FETCH_OBJ);

    if ($categories) {
        foreach ($categories as $key => $category) { ?>

<option <?php echo isset($row->category_id) && $row->category_id == $category->id? 'selected' : '' ?>  value="<?php echo $category->id ?>"> <?php echo $category->name ?> </option>



            <?php
        }


    }
    ?>





</select>

<span class="text-danger">
    <?php echo $error['category'] ?? ''; ?>
</span>
</div>
<!-- category field end here -->

<div class="form-group">
<label class="d-block">post status</label>
<div class="custom-control custom-radio custom-control-inline">
    <input type="radio" id="published" <?php  echo  isset($row->status) && $row->status==true ? 'checked' :''?>  name="status" value="1"
        class="custom-control-input">
    <label class="custom-control-label" for="published">published</label>
</div>

<div class="custom-control custom-radio custom-control-inline">
    <input type="radio" id="Draft" <?php   echo isset($row->status) && $row->status==false ? 'checked':''?>  name="status" value="0"
        class="custom-control-input">
    <label class="custom-control-label" for="Draft">Draft</label>
</div>



<span class="text-danger">
    <?php echo $error['status'] ?? ''; ?>
</span>


</div>






</div>
</div>

<!-- row end here -->
</div>




<input type="hidden" name="postId" value="<?php echo $row->id ?? ''; ?>">
<input type="hidden" name="postoldImage" value="<?php echo $row->image ?? ''; ?>">



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







<?php
include "layout/footer.php";

?>




<!-- page level plugin -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
    integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- page level custom script -->
<script>

    $(document).ready(function () {
        // summernote activer
        $('#description').summernote({
            height: 200,
        });

        // select 2 active

        $('#tag').select2();



    });



    //Dropify plugin active hare 

    $('#image').dropify({
        height: 220,


    });

    //Dropify plugin end hare  



    $('#title').on('keyup', function () {
        $("#slug").val('');
        var title = $(this).val();
        title = slugify(title);
        $("#slug").val(title);
    });

    function slugify(text) {
        return text.toLowerCase()
            .replace(/^-+|-+$/g, '')
            .replace(/\s/g, '-')
            .replace(/\-\-+/g, '-');
    }


</script>