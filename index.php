<?php include( './includes/header.php')?>


<!--navbar-->
<?php include( './includes/navbar.php'); ?>
<?php
$posts = getNewPosts();
foreach ($posts as $post):
?>


<div class="card text-center bg-dark text-white">
    <div class="card-header">
        <?php echo $post['header'] ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $post['title'] ?></h5>
        <p class="card-text"><?php echo $post['body'] ?></p>
        <a href="single_post.php?slug=<?php echo $post['slug'] ?>" class="btn btn-primary">Go to post</a>
    </div>
    <div class="card-footer text-body-secondary">
        <?php echo $post['created_at'] ?>
    </div>
    <img src="<?php echo $post['image'] ?>" class="card-img-bottom" alt="..."style="max-height: 60vh;width: auto; margin-left: auto; margin-right: auto">

</div>

<?php endforeach ?>




<?php include( './includes/footer.php')?>
