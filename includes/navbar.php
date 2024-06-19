<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage.php">Manage</a>
                </li>
                <?php if (isset($_GET['slug'])){?>
                    <li class="nav-item">
                        <a class="nav-link" href="single_post.php?slug=<?php echo getPrevCommentBySlug($_GET['slug']) ?>">Prev post</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="single_post.php?slug=<?php echo getNextCommentBySlug($_GET['slug']) ?>">Next post</a>
                </li>
                <?php }?>
                <!--                <li class="nav-item dropdown">-->
                <!--                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">-->
                <!--                        Dropdown-->
                <!--                    </a>-->
                <!--                    <ul class="dropdown-menu">-->
                <!--                        <li><a class="dropdown-item" href="#">Action</a></li>-->
                <!--                        <li><a class="dropdown-item" href="#">Another action</a></li>-->
                <!--                        <li><hr class="dropdown-divider"></li>-->
                <!--                        <li><a class="dropdown-item" href="#">Something else here</a></li>-->
                <!--                    </ul>-->
                <!--                </li>-->
                <!--                <li class="nav-item">-->
                <!--                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>-->
                <!--                </li>-->
            </ul>
            <form class="d-flex" role="search">
                <!--                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">-->
<!--                <button class="btn btn-outline-success" type="submit">Login</button>-->
                <a href="<?php if(isset($_SESSION['currentUser'])) echo "logout.php"; else echo "login.php"?>" class="btn btn-outline-success" role="button"><?php if(isset($_SESSION['currentUser'])) echo "Logout"; else echo "Login"?></a>

            </form>
        </div>
    </div>
</nav>