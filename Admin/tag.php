<?php
$title = 'tag';
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
                        <h1 class="h3 mb-0 text-gray-800">Tag</h1>
                        <a href="tagCreate.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus"></i>Add Tag</a>
                    </div>

                    <!-- Content Row -->
                         <!-- DataTales Example -->
                         <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tag List</h6>
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
                                        <th>serial</th>
                                        <th>category name</th>
                                        <th>slug</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        
                                        
<?php

$sql = "SELECT * FROM tag";
$stmt = $conn->query($sql);
$tags = $stmt->fetchAll(PDO::FETCH_OBJ);

if($tags != null){
    foreach($tags as $key=> $tag){?>

<tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $tag->name ;?> </td>
            <td><?php echo $tag->slug ;?> </td>
            <td>
            <a href="tagEdit.php?id=<?php echo $tag->id?>"><button class="btn btn-success"><i class="fa fa-pen-square"></i></button></a>
            <!-- <a href=""><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a> -->
            <a href="tagdelete.php?id=<?php echo $tag->id?>" onclick="return confirm('Are you sure to Delete')" class="btn btn-danger">
            <i class="fa fa-trash"></i></a>
           
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
