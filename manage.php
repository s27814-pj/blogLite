<?php include( './includes/header.php')?>



<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($currentUser = getUserByUsername($username)){
        if (password_verify($password,$currentUser['password'])) $_SESSION['currentUser']=$currentUser;
        else header('Location: login.php?noAccess=1');
    } else {
        header('Location: login.php?noAccess=1');
    }

}

include( './includes/navbar.php');

//else header('Location: login.php?noAccess=1');
if (isset($_SESSION['currentUser'])){
echo $_SESSION['currentUser']['username'];

?>


    <div class="accordion " id="accordionExample">
        <div class="accordion-item ">
            <h2 class="accordion-header">
                <button class="accordion-button bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Change <?php if($_SESSION['currentUser']['role'] != "Admin") echo "Your"?> password
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="actions.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">User</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION['currentUser']['username'] ?>" <?php if($_SESSION['currentUser']['role'] != "Admin") echo "readonly"?>>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
<!--                        <input type="hidden" name="username" value="--><?php //echo $_SESSION['currentUser']['username'] ?><!--">-->
                        <input type="hidden" name="func" value="change<?php if($_SESSION['currentUser']['role'] != "Admin") echo "Your"?>Password">
                        <button type="submit" class="btn btn-primary">CHANGE</button>
                    </form>


                  </div>
            </div>
        </div>
        <?php if (($_SESSION['currentUser']['role']== "Author") || (($_SESSION['currentUser']['role']== "Admin"))){ ?>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Add post
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="actions.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="header" class="form-label">header</label>
                            <input type="text" class="form-control" id="header" name="header">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">body</label>
                            <textarea class="form-control" id="body" name="body"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="inputGroupFile02" name="fileToUpload">
                            <label class="input-group-text" for="inputGroupFile02"></label>
                        </div>
                        <input type="hidden" name="func" value="addPost">
                        <button type="submit" class="btn btn-primary">GO</button>
                    </form></div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Delete post
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="actions.php" method="post">
                    <select class="form-select" multiple aria-label="Multiple select example" name="postId">
                                <?php
                                $posts=getPostsByUserId($_SESSION['currentUser']['id']);
                                if($_SESSION['currentUser']['role'] == "Admin") $posts=getNewPosts();
                                foreach ($posts as $post): ?>

                        <option value="<?php echo $post['id']?>"><?php echo $post['title']?></option>
                                <?php endforeach; ?>

                    </select>
                        <input type="hidden" name="func" value="deletePost">
                        <button type="submit" class="btn btn-primary">GO</button></div>
                    </form>
            </div>

            <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Edit body of post
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="actions.php" method="post">
                    <select class="form-select" multiple aria-label="Multiple select example" name="postId">
                                <?php
                                $posts=getPostsByUserId($_SESSION['currentUser']['id']);
                                if($_SESSION['currentUser']['role'] == "Admin") $posts=getNewPosts();
                                foreach ($posts as $post): ?>

                        <option value="<?php echo $post['id']?>"><?php echo $post['title']?></option>
                                <?php endforeach; ?>

                    </select>
                        <div class="mb-3">
                            <label for="title" class="form-label">body</label>
                            <textarea class="form-control" id="body" name="body"></textarea>
                        </div>

                        <input type="hidden" name="func" value="editBodyPost">
                        <button type="submit" class="btn btn-primary">GO</button></div>
                    </form>
            </div>

                <?php if($_SESSION['currentUser']['role'] == "Admin"){?>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Check logs
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse bg-dark text-white" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table bg-dark text-white">
                                <thead>
                                <tr>
                                    <th scope="col">Post id</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">User id</th>
                                    <th scope="col">Created at</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($_SESSION['currentUser']['role'] == "Admin") $posts=getNewPosts();
                                foreach ($posts as $post): ?>
                                <tr>
                                    <th scope="row"><?php echo $post['id']?></th>
                                    <td><?php echo $post['title']?></td>
                                    <td><?php echo $post['user_id']?></td>
                                    <td>@<?php echo $post['created_at']?></td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                    </div>
        </div>
        <?php }?>
    </div>

<?php
    } // author and admin
} //session current user
include('./includes/footer.php');