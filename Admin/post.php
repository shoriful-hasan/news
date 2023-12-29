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
                        <h1 class="h3 mb-0 text-gray-800">POST</h1>
                        <a href="postCreate.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus"></i>Add NEW POST</a>
                    </div>

                    <!-- Content Row -->
                         <!-- DataTales Example -->
                         <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">POST List</h6>
                        </div>
                        <div class="card-body">

                        <?php 
                        if(isset($_SESSION['success'])){?>

                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                     <?php echo $_SESSION['success'];?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>



                        <?php
                        }

                        unset($_SESSION['success'])
                        ?>


                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>s?N</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Category</th>
                                        <th>Create Date</th>
                                        <th>status</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        
<?php
$sql = "SELECT post.id,post.title,post.status,post.created_at,category.name AS CategoryName,admin.name AS Author FROM post 
INNER JOIN category ON post.category_id=category.id 
INNER JOIN admin ON post.admin_id=admin.id
ORDER BY post.id DESC";
$stmt = $conn->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_OBJ);
if ($posts) {
foreach ($posts as $key => $post) { ?>
<tr>
<td><?php echo $key + 1; ?></td>
<td><?php echo ($post->title); ?></td>
<td><?php echo $post->Author; ?></td>
<td><?php echo $post->CategoryName; ?></td>
<td><?php echo $post->created_at; ?></td>
<td>
<?php if ($post->status == true) { ?>
<span class="badge badge-success">Published</span>
<?php } else { ?>
<span class="badge badge-danger">Draft</span>
<?php
}
?>
</td>
                                                <td width="15%">
                                                    <a href="postDetails.php?id=<?php echo $post->id ?>" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="postEdit.php?id=<?php echo $post->id ?>" class="btn btn-success  btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="postDelete.php?id=<?php echo $post->id ?>" onclick="return confirm('Are you sure to delete this post?')" class="btn btn-danger  btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                    <?php
                                        }
                                    }

                                    ?>

                                        
                                    </tbody>
                                </table>
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
