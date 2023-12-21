<?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index1.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary admin-logo-wrp mb-0">
                        <img src="img/logo.png" alt="" class="img-fluid d-lg-block d-none">
                        <img src="img/logo-mobile.png" alt="" class="img-fluid d-lg-none d-block">
                    </h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="index1.php" class="nav-item nav-link <?= ($activePage == 'index1')? 'active':''; ?>">Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?= ($activePage == 'user-list' || $activePage == 'user-create' ||  $activePage == 'update-user')? 'active':''; ?>" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">Users</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="user-list.php" class="dropdown-item <?= ($activePage == 'user-list')? 'active':''; ?>">List</a>
                            <a href="user-create.php" class="dropdown-item <?= ($activePage == 'user-create')? 'active':''; ?>">Add User</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?= ($activePage == 'menu' || $activePage =='menuadd' || $activePage =='update-menu')? 'active':''; ?>" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">Menus</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="menu.php" class="dropdown-item <?= ($activePage == 'menu')? 'active':''; ?>">List</a>
                            <a href="menuadd.php" class="dropdown-item <?= ($activePage == 'menuadd')? 'active':''; ?>">Add Menu</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?= ($activePage == 'cmslist' || $activePage == 'cmsadd' || $activePage == 'updatecms')? 'active':''; ?>" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">CMS</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="cmslist.php" class="dropdown-item <?= ($activePage == 'cmslist')? 'active':''; ?>">List</a>
                            <a href="cmsadd.php" class="dropdown-item <?= ($activePage == 'cmsadd')? 'active':''; ?>">Add CMS</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?= ($activePage == 'project_list' || $activePage == 'projectadd' || $activePage == 'updateproject')? 'active':''; ?>" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">Projects</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="project_list.php" class="dropdown-item <?= ($activePage == 'project_list')? 'active':''; ?>">List</a>
                            <a href="projectadd.php" class="dropdown-item <?= ($activePage == 'projectadd')? 'active':''; ?>">Add Project</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?= ($activePage == 'partner-list' || $activePage == 'partneradd' || $activePage == 'partner_update')? 'active':''; ?>" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">Partner</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="partner-list.php" class="dropdown-item <?= ($activePage == 'partner-list')? 'active':''; ?>">List</a>
                            <a href="partneradd.php" class="dropdown-item <?= ($activePage == 'partneradd')? 'active':''; ?>">Add Partner</a>
                        </div>
                    </div>                    
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">Reference Library</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="category-list.php" class="dropdown-item">Category List</a>
                            <a href="add-category.php" class="dropdown-item">Add Category</a>
                            <a href="librarylist.php" class="dropdown-item">Library List</a>
                            <a href="add-library.php" class="dropdown-item">Add Library</a>
                        </div>
                    </div> -->
                    <a href="header_slider_list.php" class="nav-link <?= ($activePage == 'header_slider_list')? 'active':''; ?>" data-bs-auto-close="outside" aria-expanded="false">HeaderSlider</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?= ($activePage == 'add_library' || $activePage == 'add_category' || $activePage == 'edit_library' || $activePage == 'edit_category' || $activePage == 'category_list' || $activePage == 'library_list')? 'active':''; ?>" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" aria-expanded="false">Reference Library</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="category_list.php" class="dropdown-item <?= ($activePage == 'category_list' || $activePage == 'add_category' || $activePage == 'edit_library')? 'active':''; ?>">Category List</a>
                            <a href="library_list.php" class="dropdown-item <?= ($activePage == 'library_list' || $activePage == 'add_library' || $activePage == 'edit_library')? 'active':''; ?>">Library List</a>
                        </div>
                    </div>
                    <!-- <div class="nav-item dropdown">
                        <a href="header_slider_list.php" class="nav-link" data-bs-auto-close="outside" aria-expanded="false">HeaderSlider</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="category-list.php" class="dropdown-item">Slider List</a>
                            <a href="add-category.php" class="dropdown-item">Add Category</a>
                            <a href="librarylist.php" class="dropdown-item">Library List</a>
                            <a href="add-library.php" class="dropdown-item">Add Library</a>
                        </div>
                    </div> -->
                    <!-- <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a> -->
                </div>
            </nav>