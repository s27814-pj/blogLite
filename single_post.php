<?php include( './includes/header.php')?>


    <!--navbar-->
<?php include( './includes/navbar.php');?>

<?php

if (isset($_GET['slug'])) {
    $post = getPostBySlug($_GET['slug']);
}?>

<?php if (isset($post)){
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//    echo $_POST['comment'];
    if (isset($_SESSION['currentUser'])) addNewComment($_POST['comment'],$_SESSION['currentUser']['username'],$post['id']);
    else addNewComment($_POST['comment'],"Gość",$post['id']);
}


    ?>
<div class="card text-center">
    <div class="card-header">
        <?php echo $post['header'] ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $post['title'] ?></h5>
        <p class="card-text"><?php echo $post['body'] ?></p>
<!--        <a href="single_post.php?slug=--><?php //echo $post['slug'] ?><!--" class="btn btn-primary">Go somewhere</a>-->
    </div>
    <div class="card-footer text-body-secondary">
        <?php echo $post['created_at'] ?>
    </div>
    <img src="<?php echo $post['image'] ?>" class="card-img-bottom" alt="...">

</div>

<ol class="list-group list-group">

        <?php
        $comments = getNewComments($post['id']);
        foreach ($comments as $comment): ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><?php echo $comment['username'] ?></div>
                    <?php echo $comment['body'] ?>
                </div>
                <span class="badge text-bg-primary rounded-pill"><?php echo $comment['created_at'] ?></span>
            </li>
        <?php endforeach ?>

<!--    <div class="form-floating">-->
<!--        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>-->
<!--        <label for="floatingTextarea">Komentarz</label>-->
<!--    </div>-->


    <form method="post" action="single_post.php?slug=<?php echo $post['slug'] ?>">
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="comment" required></textarea>
            <label for="floatingTextarea">Comment</label>
        </div>
        <button type="submit" class="btn btn-primary">Add comment</button>
    </form>

<?php }else echo "null"?>


<?php include( './includes/footer.php')?>
