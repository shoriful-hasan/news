<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Blog Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo isset($title) && $title == 'dashboard'?'active' : '' ?>" >
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>



     

         
      
            <!-- Nav Item - Charts -->
            <li class="nav-item <?php echo isset($title) && $title == 'category'?'active' : '' ?>">
                <a class="nav-link" href="category.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Category</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item <?php echo isset($title)&& $title == 'tag'?'active':'' ?> ">
                <a class="nav-link" href="tag.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tags</span></a>
            </li>

            <li class="nav-item <?php echo isset($title) && $title == 'post'?'active':'' ?>">
                <a class="nav-link" href="post.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Post</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-user"></i>
                    <span>Admin</span></a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
        

        </ul>